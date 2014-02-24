<?php

/**
 * This is the model class for table "antonyms".
 *
 * The followings are the available columns in table 'antonyms':
 * @property integer $id
 * @property integer $word_meanings_id1
 * @property integer $word_meanings_id2
 */
class Antonyms extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Antonyms the static model class
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
		return 'antonyms';
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
			array('word_meanings_id1, word_meanings_id2', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, word_meanings_id1, word_meanings_id2', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'word_meanings_id1' => Yii::t('global', 'Word Meanings Id1'),
			'word_meanings_id2' => Yii::t('global', 'Word Meanings Id2'),
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
		$criteria->compare('word_meanings_id1',$this->word_meanings_id1);
		$criteria->compare('word_meanings_id2',$this->word_meanings_id2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function updateAntonyms($antonyms,$word){

    }
    
    public function getAntonymsByWork( $keyword ){
        //Get id word_meanings
        $sql = "SELECT word_meanings.id
                FROM word
                INNER JOIN word_meanings
                ON word.id = word_meanings.id_word
                WHERE word.word = '".$keyword."' AND word.id_language= (SELECT id FROM languages WHERE region_code='".Yii::app()->language."') ";
        $resultIds = Yii::app()->db->createCommand($sql)->queryAll();
        $id_meaning = '';
        $i          = 0;
        foreach( $resultIds as $resultId ){
            if( $i == count($resultIds) - 1 )
                $ext = '';
            else
                $ext = ',';
            $id_meaning .= $resultId['id'].$ext;
            $i++;
        }
        
       if( count( $resultIds ) > 0 ){
           $sqlIdAntonyms = "SELECT word_meanings_id1,word_meanings_id2 
                            FROM  `antonyms` 
                            WHERE word_meanings_id1
                            IN ( ".$id_meaning." ) 
                            OR word_meanings_id2
                            IN ( ".$id_meaning." )";
           $resultIdAntonyms = Yii::app()->db->createCommand($sqlIdAntonyms)->queryAll();
           $idAntonyms    = '';
           foreach ( $resultIdAntonyms as $resultIdAntonym){
                $idAntonyms .= $resultIdAntonym['word_meanings_id1'].', '.$resultIdAntonym['word_meanings_id2'];
           }
           if( $idAntonyms != '' ){
               //Result word Antonyms
               $sqlResult = "SELECT word.word, word.alias, id_meaning, id_word 
                            FROM word
                            INNER JOIN  word_meanings
                            ON word.id = word_meanings.id_word
                            WHERE word_meanings.id IN ( ". $idAntonyms ." ) AND word.word != '".$keyword."'";
               $result =Yii::app()->db->createCommand( $sqlResult )->queryAll();
               return $result;
           }
           else{
                $sql = "SELECT word_meanings.id,word.word
                FROM word
                INNER JOIN word_meanings
                ON word.id = word_meanings.id_word
                WHERE word.word = ''";     
                return Yii::app()->db->createCommand($sql)->queryAll();
           }
               
       }
       else{
            return $resultIds;
       }
       
    } 

}