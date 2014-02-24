<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'User Feedbacks'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'User Feedbacks'); ?></h1>
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-feedback-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_email',
		'feedback_text',
        array(
            'name'=>'feedbacktype',
            'value'=>'$data->idFeedbackType->description'
        ),
        array(
            'name'=>'searchtype',
            'value'=>'$data->idSearchType->description'
        ),
        array(
            'name'=>'status',
            'value'=>'$data->idUserFeedbackStatus->description'
            ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>