
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'languages-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'region_code'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'region_code',array('size'=>2,'maxlength'=>2)); ?>
            <?php echo $form->error($model,'region_code'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'icon'); ?>
        </div>
		<div class="span9">
            <?php echo $form->fileField($model,'icon'); ?>
            <?php echo $form->error($model,'icon'); ?>
            <?php if ($model->icon):?>
                <a class="fancybox" <?php echo 'href="/uploads/flag/'.$model->icon.'"'?> rel="group">
                    <img class="img-polaroid" <?php echo 'src="/uploads/flag/'.$model->icon.'"'?> style="height: 10px;"/>
                </a>
            <?php endif;?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->