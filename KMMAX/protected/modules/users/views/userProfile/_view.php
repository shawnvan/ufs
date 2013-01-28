<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fUserID), array('view', 'id'=>$data->fUserID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fModelName')); ?>:</b>
	<?php echo CHtml::encode($data->fModelName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fDataGridColumn')); ?>:</b>
	<?php echo CHtml::encode($data->fDataGridColumn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fQueryCondition')); ?>:</b>
	<?php echo CHtml::encode($data->fQueryCondition); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateDate); ?>
	<br />

	*/ ?>

</div>