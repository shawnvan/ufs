<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fItemNo), array('view', 'id'=>$data->fItemNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemTimeNode')); ?>:</b>
	<?php echo CHtml::encode($data->fItemTimeNode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemStart')); ?>:</b>
	<?php echo CHtml::encode($data->fItemStart); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemEnd')); ?>:</b>
	<?php echo CHtml::encode($data->fItemEnd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemPerson')); ?>:</b>
	<?php echo CHtml::encode($data->fItemPerson); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemFee')); ?>:</b>
	<?php echo CHtml::encode($data->fItemFee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemOtherPerson')); ?>:</b>
	<?php echo CHtml::encode($data->fItemOtherPerson); ?>
	<br />


</div>