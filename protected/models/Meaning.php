<?php

/**
 * This is the model class for table "meaning".
 *
 * The followings are the available columns in table 'meaning':
 * @property integer $id
 * @property string $meaning
 * @property integer $order
 *
 * The followings are the available model relations:
 * @property WordMeanings[] $wordMeanings
 */
class Meaning extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Meaning the static model class
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
		return 'meaning';
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
			array('meaning', 'required'),
			array('order', 'numerical', 'integerOnly'=>true),
			array('meaning', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, meaning, order', 'safe', 'on'=>'search'),
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
			'wordMeanings' => array(self::HAS_MANY, 'WordMeanings', 'id_meaning'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'meaning' => Yii::t('global', 'Meaning'),
			'order' => Yii::t('global', 'Order'),
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
		$criteria->compare('meaning',$this->meaning,true);
		$criteria->compare('order',$this->order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getMeaning(){
        $allMeaning = $this->findAll();
        $result = array();
        if($allMeaning){
            foreach($allMeaning as $meaning){
                $result[]= $meaning['meaning'];
            }
        }
        return $result;
    }

    public function updateMeaning($meanings,$word_id){
        $allWordMeaning = WordMeanings::model()->getMeanById($word_id);
        $mergeMeanings =  array_unique(array_merge($allWordMeaning,$meanings));
        $meaningRemoves = array_diff($mergeMeanings,$meanings);
        $meaningAdds = array_diff($mergeMeanings,$allWordMeaning);
        $this->saveMeanings($meaningAdds,$word_id);
        foreach($meaningRemoves as $meaningRemove){
            WordMeanings::model()->removedWordMeaning($word_id,$meaningRemove);
        }
    }
    public function saveMeanings($meanings,$word_id){
        foreach($meanings as $meaning){
            $checkExist = self::exists('meaning=:name',array(':name'=>$meaning));
            $wordMeaning =  new WordMeanings();
            if($checkExist){
                $infoMeaning = $this->findByAttributes(array('meaning'=>$meaning));
                $wordMeaning->id_word = $word_id;
                $wordMeaning->id_meaning = $infoMeaning->id;
                $wordMeaning->save();
            } else {
                $newMeanings =  new Meaning();
                $newMeanings->meaning = $meaning;
                $newMeanings->order = 1;
                $newMeanings->save();
                $wordMeaning->id_word = $word_id;
                $wordMeaning->id_meaning = $newMeanings->id;
                $wordMeaning->save();
            }
        }
    }
}