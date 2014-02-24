<?php

/**
 * This is the model class for table "user_feedback".
 *
 * The followings are the available columns in table 'user_feedback':
 * @property integer $id
 * @property string $user_email
 * @property string $user_search
 * @property string $feedback_text
 * @property integer $id_feedback_type
 * @property integer $id_search_type
 * @property integer $id_user_feedback_status
 *
 * The followings are the available model relations:
 * @property UserFeedbackStatus $idUserFeedbackStatus
 * @property FeedbackType $idFeedbackType
 * @property SearchType $idSearchType
 */
class UserFeedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFeedback the static model class
	 */
    public $feedbacktype, $searchtype, $status;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_feedback';
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
			array(' feedback_text', 'required'),
			array('id_feedback_type, id_search_type, id_user_feedback_status', 'numerical', 'integerOnly'=>true),
			array('user_email, user_search', 'length', 'max'=>100),
			array('feedback_text', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('feedbacktype,searchtype, status,id, user_email, user_search, feedback_text, id_feedback_type, id_search_type, id_user_feedback_status', 'safe', 'on'=>'search'),
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
			'idUserFeedbackStatus' => array(self::BELONGS_TO, 'UserFeedbackStatus', 'id_user_feedback_status'),
			'idFeedbackType' => array(self::BELONGS_TO, 'FeedbackType', 'id_feedback_type'),
			'idSearchType' => array(self::BELONGS_TO, 'SearchType', 'id_search_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'user_email' => Yii::t('global', 'User Email'),
			'user_search' => Yii::t('global', 'User Search'),
			'feedback_text' => Yii::t('global', 'Feedback Text'),
			'id_feedback_type' => Yii::t('global', 'Id Feedback Type'),
			'id_search_type' => Yii::t('global', 'Id Search Type'),
			'id_user_feedback_status' => Yii::t('global', 'Id User Feedback Status'),
			'feedbacktype' => Yii::t('global', 'Feedback Type'),
			'searchtype' => Yii::t('global', 'Search Type'),
			'status' => Yii::t('global', 'Status'),
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
        $criteria->with = array('idFeedbackType','idUserFeedbackStatus','idSearchType');
		$criteria->compare('id',$this->id);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_search',$this->user_search,true);
		$criteria->compare('feedback_text',$this->feedback_text,true);
		$criteria->compare('idFeedbackType.description',$this->feedbacktype);
		$criteria->compare('idSearchType.description',$this->searchtype);
		$criteria->compare('idUserFeedbackStatus.description',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}