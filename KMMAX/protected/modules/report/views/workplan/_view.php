<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPlanNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fPlanNo), array('view', 'id'=>$data->fPlanNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTitle')); ?>:</b>
	<?php echo CHtml::encode($data->fTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fMonth')); ?>:</b>
	<?php echo CHtml::encode($data->fMonth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpPlan')); ?>:</b>
	<?php echo CHtml::encode($data->fUpPlan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fNowPlan')); ?>:</b>
	<?php echo CHtml::encode($data->fNowPlan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fMemo')); ?>:</b>
	<?php echo CHtml::encode($data->fMemo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateUser); ?>
	<br />

	*/ ?>

</div>