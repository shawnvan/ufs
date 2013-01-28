<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fEmployeeNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fEmployeeNo), array('view', 'id'=>$data->fEmployeeNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemNo')); ?>:</b>
	<?php echo CHtml::encode($data->fItemNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fEmployeeName')); ?>:</b>
	<?php echo CHtml::encode($data->fEmployeeName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fRoleNo')); ?>:</b>
	<?php echo CHtml::encode($data->fRoleNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserGroup')); ?>:</b>
	<?php echo CHtml::encode($data->fUserGroup); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserType')); ?>:</b>
	<?php echo CHtml::encode($data->fUserType); ?>
	<br />

	*/ ?>

</div>