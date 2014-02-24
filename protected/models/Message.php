<?php

class Message extends CActiveRecord
{
	/**
	 * @return Message
	 */
	public static function model()
	{
		return parent::model(__CLASS__);
	}
	
	/**
	 * @return string Table name
	 */
	public function tableName()
	{
		return 'message';
	}
	public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }
	/**
	 * Grab language names by their keys
	 */
	public function getLanguageNames($lang)
	{
		if( !$lang )
		{
			return Yii::t('global', 'All');
		}
		
		$names = array();
        $allLang = Languages::model()->findAll();
		foreach(explode(',', $lang) as $language)
		{

			$names[] = $allLang[ $language ];
		}
		
		return implode(', ', $names);
	}
}