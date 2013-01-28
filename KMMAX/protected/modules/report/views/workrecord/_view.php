<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fRecordNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fRecordNo), array('view', 'id'=>$data->fRecordNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fRecordUser')); ?>:</b>
	<?php echo CHtml::encode($data->fRecordUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fRecordDate')); ?>:</b>
	<?php echo CHtml::encode($data->fRecordDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPlan')); ?>:</b>
	<?php echo CHtml::encode($data->fPlan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fResult')); ?>:</b>
	<?php echo CHtml::encode($data->fResult); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fSummary')); ?>:</b>
	<?php echo CHtml::encode($data->fSummary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fEvaluate')); ?>:</b>
	<?php echo CHtml::encode($data->fEvaluate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fMemo')); ?>:</b>
	<?php echo CHtml::encode($data->fMemo); ?>
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

	*/ ?>

</div>