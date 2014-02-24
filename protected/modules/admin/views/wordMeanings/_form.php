
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'word-meanings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'id_meaning'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'id_meaning'); ?>
            <?php echo $form->error($model,'id_meaning'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'id_word'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'id_word'); ?>
            <?php echo $form->error($model,'id_word'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->