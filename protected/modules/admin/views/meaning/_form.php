
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'meaning-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'meaning'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'meaning',array('size'=>60,'maxlength'=>500)); ?>
            <?php echo $form->error($model,'meaning'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'order'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'order'); ?>
            <?php echo $form->error($model,'order'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->