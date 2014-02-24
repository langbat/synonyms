<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Banners'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Banners'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'position',
		'type',
		'is_active',
		'filename',
        array(
            'name'=>'content',
            'value'=>$model->content,
            'cssClass'=>'fix-null'
        ),
		'link',
		array(
            'name'=>'created',
            'value'=>Utils::date_format24h($model->created),
            'cssClass'=>'fix-null'
        ),
        //'created',
	),
)); ?>


</div>
</div>