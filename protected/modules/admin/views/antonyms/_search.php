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
		<?php echo $form->label($model,'word_meanings_id1'); ?>
		<?php echo $form->textField($model,'word_meanings_id1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'word_meanings_id2'); ?>
		<?php echo $form->textField($model,'word_meanings_id2'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->