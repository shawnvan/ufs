<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCalendarNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fCalendarNo), array('view', 'id'=>$data->fCalendarNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserName')); ?>:</b>
	<?php echo CHtml::encode($data->fUserName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fViewer')); ?>:</b>
	<?php echo CHtml::encode($data->fViewer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fStartTime')); ?>:</b>
	<?php echo CHtml::encode($data->fStartTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fEndTime')); ?>:</b>
	<?php echo CHtml::encode($data->fEndTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fOtherNo')); ?>:</b>
	<?php echo CHtml::encode($data->fOtherNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTheme')); ?>:</b>
	<?php echo CHtml::encode($data->fTheme); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fContent')); ?>:</b>
	<?php echo CHtml::encode($data->fContent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fMemo')); ?>:</b>
	<?php echo CHtml::encode($data->fMemo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateDate); ?>
	<br />

	*/ ?>

</div>