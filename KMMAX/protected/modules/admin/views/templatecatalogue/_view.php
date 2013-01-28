<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCatalogueNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fCatalogueNo), array('view', 'id'=>$data->fCatalogueNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTemplateNo')); ?>:</b>
	<?php echo CHtml::encode($data->fTemplateNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCatalogueName')); ?>:</b>
	<?php echo CHtml::encode($data->fCatalogueName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fWarnStart')); ?>:</b>
	<?php echo CHtml::encode($data->fWarnStart); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fWarnEnd')); ?>:</b>
	<?php echo CHtml::encode($data->fWarnEnd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fWarnRate')); ?>:</b>
	<?php echo CHtml::encode($data->fWarnRate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fIsActive')); ?>:</b>
	<?php echo CHtml::encode($data->fIsActive); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fSort')); ?>:</b>
	<?php echo CHtml::encode($data->fSort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFatherCatalogueNo')); ?>:</b>
	<?php echo CHtml::encode($data->fFatherCatalogueNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserGroup')); ?>:</b>
	<?php echo CHtml::encode($data->fUserGroup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateDate); ?>
	<br />

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