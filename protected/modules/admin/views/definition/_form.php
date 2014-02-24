
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'definition-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'word'); ?>
        </div>
		<div class="span9">
            <?php if(!$model->id_word){
                $word = Word::model()->findAll(array('condition'=>'id_language="'.Languages::model()->getCurrentLanguage().'"'));

                foreach ($word as $item){
                    $definition[$item['id']]=$item['word'];
                }  ?>

                <?php echo $form->dropDownList($model,'id_word',$definition); ?>
                <?php echo $form->error($model,'id_word'); ?>

            <?php } else
                echo ucfirst($model->idWord->word); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'definition'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'definition',array('size'=>60,'maxlength'=>1000)); ?>
            <?php echo $form->error($model,'definition'); ?>
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