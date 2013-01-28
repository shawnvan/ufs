<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fOrgNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fOrgNo), array('view', 'id'=>$data->fOrgNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fOrgName')); ?>:</b>
	<?php echo CHtml::encode($data->fOrgName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpOrgNo')); ?>:</b>
	<?php echo CHtml::encode($data->fUpOrgNo); ?>
	<br />


</div>