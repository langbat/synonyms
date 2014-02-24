<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_search'); ?>
		<?php echo $form->textField($model,'user_search',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'feedback_text'); ?>
		<?php echo $form->textField($model,'feedback_text',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_feedback_type'); ?>
		<?php echo $form->textField($model,'id_feedback_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_search_type'); ?>
		<?php echo $form->textField($model,'id_search_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user_feedback_status'); ?>
		<?php echo $form->textField($model,'id_user_feedback_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->