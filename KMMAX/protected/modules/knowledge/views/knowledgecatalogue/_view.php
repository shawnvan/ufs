<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCatalogueNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fCatalogueNo), array('view', 'id'=>$data->fCatalogueNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCatalogueName')); ?>:</b>
	<?php echo CHtml::encode($data->fCatalogueName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFatherCatalogueNo')); ?>:</b>
	<?php echo CHtml::encode($data->fFatherCatalogueNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fStatus')); ?>:</b>
	<?php echo CHtml::encode($data->fStatus); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserGroup')); ?>:</b>
	<?php echo CHtml::encode($data->fUserGroup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fMemo1')); ?>:</b>
	<?php echo CHtml::encode($data->fMemo1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fMemo2')); ?>:</b>
	<?php echo CHtml::encode($data->fMemo2); ?>
	<br />

	*/ ?>

</div>