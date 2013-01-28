<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fModuleID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fModuleID), array('view', 'id'=>$data->fModuleID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fModuleName')); ?>:</b>
	<?php echo CHtml::encode($data->fModuleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fModuleTitle')); ?>:</b>
	<?php echo CHtml::encode($data->fModuleTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fIsVisible')); ?>:</b>
	<?php echo CHtml::encode($data->fIsVisible); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fSearchable')); ?>:</b>
	<?php echo CHtml::encode($data->fSearchable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCustom')); ?>:</b>
	<?php echo CHtml::encode($data->FCustom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateDate); ?>
	<br />

	*/ ?>

</div>