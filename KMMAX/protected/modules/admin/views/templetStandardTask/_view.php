<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTaskNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fTaskNo), array('view', 'id'=>$data->fTaskNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTemplateNo')); ?>:</b>
	<?php echo CHtml::encode($data->fTemplateNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCatalogueNo')); ?>:</b>
	<?php echo CHtml::encode($data->fCatalogueNo); ?>
	<br />


</div>