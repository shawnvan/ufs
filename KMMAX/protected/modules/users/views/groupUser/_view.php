<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fGroupUID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fGroupUID), array('view', 'id'=>$data->fGroupUID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fGroupID')); ?>:</b>
	<?php echo CHtml::encode($data->fGroupID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserID')); ?>:</b>
	<?php echo CHtml::encode($data->fUserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserName')); ?>:</b>
	<?php echo CHtml::encode($data->fUserName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateUser); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateDate); ?>
	<br />

	*/ ?>

</div>