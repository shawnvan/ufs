<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fSSNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fSSNo), array('view', 'id'=>$data->fSSNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemNo')); ?>:</b>
	<?php echo CHtml::encode($data->fItemNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fHistoryNo')); ?>:</b>
	<?php echo CHtml::encode($data->fHistoryNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholderName')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholderName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholdingNum')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholdingNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholderRate')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholderRate); ?>
	<br />


</div>