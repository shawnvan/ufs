<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTimeZoneID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fTimeZoneID), array('view', 'id'=>$data->fTimeZoneID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTimeZoneName')); ?>:</b>
	<?php echo CHtml::encode($data->fTimeZoneName); ?>
	<br />


</div>