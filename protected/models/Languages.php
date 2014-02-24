<?php

/**
 * This is the model class for table "languages".
 *
 * The followings are the available columns in table 'languages':
 * @property integer $id
 * @property string $region_code
 * @property string $name
 * @property string $icon
 *
 * The followings are the available model relations:
 * @property Word[] $words
 */
class Languages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Languages the static model class
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
		return 'languages';
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
			array('region_code, name, icon', 'required'),
			array('region_code', 'length', 'max'=>10),
			array('name', 'length', 'max'=>50),
			array('icon', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, region_code, name, icon', 'safe', 'on'=>'search'),
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
			'words' => array(self::HAS_MANY, 'Word', 'id_language'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'region_code' => Yii::t('global', 'Region Code'),
			'name' => Yii::t('global', 'Name'),
			'icon' => Yii::t('global', 'Icon'),
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
		$criteria->compare('region_code',$this->region_code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('icon',$this->icon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getIconLang($icon){
        return "<img src='/uploads/flag/".$icon."' />";
    }

    public function getCurrentLanguage($lang=null){
        if($lang == null)
            $lang = Yii::app()->language;

        $currentLang = $this->findByAttributes(array('region_code'=>$lang));
        $result=1;
        if($currentLang){
            $result = $currentLang->id;
        }
        return $result;
    }
}