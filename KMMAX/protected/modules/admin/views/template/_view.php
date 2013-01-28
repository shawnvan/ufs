<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTemplateNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fTemplateNo), array('view', 'id'=>$data->fTemplateNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTemplateName')); ?>:</b>
	<?php echo CHtml::encode($data->fTemplateName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTemplateType')); ?>:</b>
	<?php echo CHtml::encode($data->fTemplateType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdate')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fStatus')); ?>:</b>
	<?php echo CHtml::encode($data->fStatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserGroup')); ?>:</b>
	<?php echo CHtml::encode($data->fUserGroup); ?>
	<br />

	*/ ?>

</div>