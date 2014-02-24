<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('word_meanings_id1')); ?>:</b>
	<?php echo CHtml::encode($data->word_meanings_id1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('word_meanings_id2')); ?>:</b>
	<?php echo CHtml::encode($data->word_meanings_id2); ?>
	<br />


</div>