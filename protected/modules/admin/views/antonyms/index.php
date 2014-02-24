<div class="page-header">
    <h1><?php echo Yii::t('global', 'Manage'); ?> 
    <small><?php echo Yii::t('global', 'Antonyms'); ?></small></h1>
</div>

<div class="row-fluid"><div class="span12">
<div class="head clearfix">
    <div class="isw-grid"></div>
    <h1><?php echo Yii::t('global', 'Antonyms'); ?></h1>      
    <ul class="buttons">
        <li><a class="isw-plus tipb" href="<?php echo $this->createUrl('antonyms/create') ?>" data-original-title="<?php echo Yii::t('global', 'Create'); ?> <?php echo Yii::t('global', 'Antonyms'); ?>"></a></li>
    </ul>                        
</div>
<div class="block-fluid table-sorting">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'antonyms-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'word_meanings_id1',
		'word_meanings_id2',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div></div>