<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_email')); ?>:</b>
	<?php echo CHtml::encode($data->user_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_search')); ?>:</b>
	<?php echo CHtml::encode($data->user_search); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('feedback_text')); ?>:</b>
	<?php echo CHtml::encode($data->feedback_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_feedback_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_feedback_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_search_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_search_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user_feedback_status')); ?>:</b>
	<?php echo CHtml::encode($data->id_user_feedback_status); ?>
	<br />


</div>