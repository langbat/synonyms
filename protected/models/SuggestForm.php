<?php
/**
 * Login form model class
 */
class SuggestForm extends CFormModel
{
	/**
	 * @var string - email
	 */
	public $email;
    
	/**
	 * @var string - suggest
	 */
	public $suggest;
	
	/**
	 * table data rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('email, suggest', 'required'),
            array('email','email', 'message'=>'Email is not valid'),

		);
	}	
	/**
	 * Attribute values
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'email' => Yii::t('global', 'Email'),
			'suggest' => Yii::t('global', 'Suggest'),
		);
	}
	
}