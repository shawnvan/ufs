<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fGroupID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fGroupID), array('view', 'id'=>$data->fGroupID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fGroupName')); ?>:</b>
	<?php echo CHtml::encode($data->fGroupName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fDescription')); ?>:</b>
	<?php echo CHtml::encode($data->fDescription); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateDate); ?>
	<br />


</div>