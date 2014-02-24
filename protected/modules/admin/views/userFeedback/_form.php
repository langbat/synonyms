
<div class="block-fluid">

<?php
$list_fb_type = FeedbackType::model()->findAll();
foreach ($list_fb_type as $item){
    $list_type[$item['id']]=$item['description'];
}
$list_search_type = SearchType::model()->findAll();
foreach ($list_search_type as $item){
    $list_search[$item['id']]=$item['description'];
}
$list_status = UserFeedbackStatus::model()->findAll();
foreach ($list_status as $item){
    $list_stt[$item['id']]=$item['description'];
}
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-feedback-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'user_email'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'user_email'); ?>
        </div>
	</div>

	<!--<div class="row-form clearfix">
		<div class="span3">
            <?php /*echo $form->labelEx($model,'user_search'); */?>
        </div>
		<div class="span9">
            <?php /*echo $form->textField($model,'user_search',array('size'=>60,'maxlength'=>100)); */?>
            <?php /*echo $form->error($model,'user_search'); */?>
        </div>
	</div>-->

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'feedback_text'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'feedback_text',array('size'=>60,'maxlength'=>1000)); ?>
            <?php echo $form->error($model,'feedback_text'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'feedbacktype'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model,'id_feedback_type',$list_type); ?>
            <?php echo $form->error($model,'id_feedback_type'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'id_search_type'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model,'id_search_type',$list_search); ?>
            <?php echo $form->error($model,'id_search_type'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'id_user_feedback_status'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model,'id_user_feedback_status',$list_stt); ?>
            <?php echo $form->error($model,'id_user_feedback_status'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->