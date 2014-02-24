<?php

/**
* Switch languages widget
*
*
**/
class LanguageSwitcher extends CWidget
{
	/**
	* Display languages to choose From
	*
	*
	**/
	public function run()
	{
		$links=array();
        $allLang = Languages::model()->findAll();
		foreach($allLang as $id=>$language)
		{
			$links[]=CHtml::link(Yii::t('global', $language['name']), array('index/index', 'lang'=>$language['region_code']));
		}
		echo implode(' | ',$links);
	}
	
}