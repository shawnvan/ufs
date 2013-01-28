<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAreaID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fAreaID), array('view', 'id'=>$data->fAreaID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAreaName')); ?>:</b>
	<?php echo CHtml::encode($data->fAreaName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fParentID')); ?>:</b>
	<?php echo CHtml::encode($data->fParentID); ?>
	<br />


</div>