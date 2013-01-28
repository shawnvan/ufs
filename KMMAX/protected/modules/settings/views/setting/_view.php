<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fName')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fName), array('view', 'id'=>$data->fName)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fLabel')); ?>:</b>
	<?php echo CHtml::encode($data->fLabel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fValue')); ?>:</b>
	<?php echo CHtml::encode($data->fValue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fDescription')); ?>:</b>
	<?php echo CHtml::encode($data->fDescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fGroupName')); ?>:</b>
	<?php echo CHtml::encode($data->fGroupName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fSequence')); ?>:</b>
	<?php echo CHtml::encode($data->fSequence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fIsActive')); ?>:</b>
	<?php echo CHtml::encode($data->fIsActive); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fModule')); ?>:</b>
	<?php echo CHtml::encode($data->fModule); ?>
	<br />

	*/ ?>

</div>