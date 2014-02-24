<div class="page-header">
    <h1><?php echo Yii::t('global', 'View'); ?> 
    <small><?php echo Yii::t('global', 'Languages'); ?> #<?php echo $model->id; ?></small></h1>
</div>

<div class="row-fluid">
<div class="span12">
    <div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Yii::t('global', 'Languages'); ?> #<?php echo $model->id; ?></small></h1>
        <ul class="buttons">
            <li><a class="isw-left tipb" href="javascript: history.back()" data-original-title="Back"></a></li>
        </ul> 
    </div>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'region_code',
		'name',
        array(
            'name'=>'icon',
            'value'=>'<img src="/uploads/flag/'.$model->icon.'" />',
            'type'=>'raw'
        )
	),
)); ?>


</div>
</div>