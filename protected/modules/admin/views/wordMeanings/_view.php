<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_meaning')); ?>:</b>
	<?php echo CHtml::encode($data->id_meaning); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_word')); ?>:</b>
	<?php echo CHtml::encode($data->id_word); ?>
	<br />


</div>