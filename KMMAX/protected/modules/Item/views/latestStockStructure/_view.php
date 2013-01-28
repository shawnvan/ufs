<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fHistoryNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fHistoryNo), array('view', 'id'=>$data->fHistoryNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemNo')); ?>:</b>
	<?php echo CHtml::encode($data->fItemNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholderName')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholderName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFristStrands')); ?>:</b>
	<?php echo CHtml::encode($data->fFristStrands); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFristRate')); ?>:</b>
	<?php echo CHtml::encode($data->fFristRate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fSecondStrands')); ?>:</b>
	<?php echo CHtml::encode($data->fSecondStrands); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fSecondRate')); ?>:</b>
	<?php echo CHtml::encode($data->fSecondRate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fThirdStrands')); ?>:</b>
	<?php echo CHtml::encode($data->fThirdStrands); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fThirdRate')); ?>:</b>
	<?php echo CHtml::encode($data->fThirdRate); ?>
	<br />

	*/ ?>

</div>