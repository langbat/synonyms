
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'antonyms-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'word_meanings_id1'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'word_meanings_id1'); ?>
            <?php echo $form->error($model,'word_meanings_id1'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'word_meanings_id2'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'word_meanings_id2'); ?>
            <?php echo $form->error($model,'word_meanings_id2'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->