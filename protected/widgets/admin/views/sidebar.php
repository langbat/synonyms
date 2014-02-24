<?php
// Side bar menu
$this->widget('widgets.NBADMenu', array(
	'activateParents' => true,
	'htmlOptions' => array( 'class' => 'navigation' ) ,
    'items' => array(
					// dashboard
        			 array( 
							'label' => Yii::t('global', 'Dashboard'), 
							'url' => array('index/index'),
							'icon' => 'isw-grid'
						  ),
					 // System
					 array( 
							'label' => Yii::t('global', 'System'), 
							'url' => array('settings/index'),
							'icon' => 'isw-settings',
							'itemOptions' => array( 'class' => 'openable' ),
							'items' => array(
									array(
											'label' => Yii::t('global', 'Manage Settings'),
											'url' => array('settings/index'),
											'icon' => 'icon-wrench'
                                    ),
                                    array(
                                        'label' => Yii::t('global', 'Manage Setting Languages'),
                                        'url' => array('languages/setting'),
                                        'icon' => 'icon-wrench'
                                    ),

                            ),
                                    	
                                    
                     ),

    				 // Members
					 array( 
							'label' => Yii::t('global', 'Dictionary'),
							'url' => array('members'),
							'icon' => 'isw-list',
							'itemOptions' => array( 'class' => 'openable' ),
							'items' => array(
								array( 
										'label' => Yii::t('global', 'Manage Words'),
										'url' => array('word/index'),
                                        'icon' => 'icon-book'
								 ),
                                array(
                                    'label' => Yii::t('global', 'Manage Meaning'),
                                    'url' => array('meaning/index'),
                                    'icon' => 'icon-list-alt'
                                ),
                                array(
                                    'label' => Yii::t('global', 'Manage Definitions'),
                                    'url' => array('definition/index'),
                                    'icon' => ' icon-star-empty'
                                ),
                                array(
                                    'label' => Yii::t('global', 'Manage Languages'),
                                    'url' => array('languages/index'),
                                    'icon' => 'icon-globe'
                                ),
						  ),
                     ),
                   	 // Advertise
					 array( 
							'label' => Yii::t('global', 'Advertise & Social'),
							'url' => array('banners'),
							'icon' => 'isw-ok',
							'itemOptions' => array( 'class' => 'openable' ),
							'items' => array(
								array( 
										'label' => Yii::t('global', 'Manage Advertise'),
										'url' => array('banners/index'),
                                        'icon' => 'icon-file'
								 ),
						  ),
                     ),
                    // Suggest
                    array(
                        'label' => Yii::t('global', 'Manage Suggest'),
                        'url' => array('UserFeedback/index'),
                        'icon' => 'isw-grid'
                    ),
                     
    )
));
?>