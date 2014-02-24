<?php

/**
 * This is the model class for table "word_meanings".
 *
 * The followings are the available columns in table 'word_meanings':
 * @property integer $id
 * @property integer $id_meaning
 * @property integer $id_word
 *
 * The followings are the available model relations:
 * @property Word $idWord
 * @property Meaning $idMeaning
 */
class WordMeanings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WordMeanings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'word_meanings';
	}
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_meaning, id_word', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_meaning, id_word', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idWord' => array(self::BELONGS_TO, 'Word', 'id_word'),
			'idMeaning' => array(self::BELONGS_TO, 'Meaning', 'id_meaning'),
            'antonyms' => array(self::HAS_MANY, 'Antonyms', 'word_meanings_id1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'id_meaning' => Yii::t('global', 'Id Meaning'),
			'id_word' => Yii::t('global', 'Id Word'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_meaning',$this->id_meaning);
		$criteria->compare('id_word',$this->id_word);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getMeanById($id){
        $meanings = $this->findAllByAttributes(array('id_word'=>$id));
        $result=array();
        if($meanings){
            $result = array();
            foreach($meanings as $meaning){
                $result[]=$meaning->idMeaning->meaning;
            }
        }
        return $result;
    }
    
    public function getMeanByWork( $keyword ){
        //$sql = "SELECT meaning.meaning 
        //                FROM meaning
        //                INNER JOIN word_meanings
        //                ON meaning.id = word_meanings.id_meaning
        //                INNER JOIN word
        //                ON word_meanings.id_word = word.id
        //                WHERE word = '".$keyword."'";
        $sql    = "SELECT id_meaning 
                   FROM  `word_meanings` 
                   WHERE id_word IN ( SELECT id FROM word WHERE word = '".$keyword."' AND id_language= (SELECT id FROM languages WHERE region_code='".Yii::app()->language."' ) )";
        $id_meanings = Yii::app()->db->createCommand($sql)->queryAll();
        $id_meaning = '';
        $i          = 0;
        foreach ( $id_meanings as $resultId ){
            if( $i == count($id_meanings) - 1 )
                $ext = '';
            else
                $ext = ',';
            $id_meaning .= $resultId['id_meaning'].$ext;
            $i++;
        }
        if( $id_meaning != '' ){
            $sqlResult = " SELECT word, id_meaning 
                            FROM  `word_meanings`
                            INNER JOIN  `word` 
                            ON word.id = word_meanings.id_word
                            WHERE id_meaning
                            IN ( ".$id_meaning." ) ";
            $ResultWord = Yii::app()->db->createCommand($sqlResult)->queryAll();                 
             return $ResultWord;               
        }
        //return $result;
    }
    public function removedWordMeaning($word_id,$meaning){
        $criteria=new CDbCriteria;
        $criteria->with='idMeaning';
        $criteria->condition = 'id_word='.$word_id.' AND idMeaning.meaning="'.$meaning.'"';
        $meaningRemoved = WordMeanings::model()->find($criteria);
        $meaningRemoved->delete();
    }
}