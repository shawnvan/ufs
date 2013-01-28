<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTagNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fTagNo), array('view', 'id'=>$data->fTagNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fName')); ?>:</b>
	<?php echo CHtml::encode($data->fName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fStatus')); ?>:</b>
	<?php echo CHtml::encode($data->fStatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateDate); ?>
	<br />


</div>