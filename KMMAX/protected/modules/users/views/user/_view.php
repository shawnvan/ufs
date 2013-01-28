<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fUserID), array('view', 'id'=>$data->fUserID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserName')); ?>:</b>
	<?php echo CHtml::encode($data->fUserName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPassword')); ?>:</b>
	<?php echo CHtml::encode($data->fPassword); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fLastName')); ?>:</b>
	<?php echo CHtml::encode($data->fLastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFirstName')); ?>:</b>
	<?php echo CHtml::encode($data->fFirstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fEmail')); ?>:</b>
	<?php echo CHtml::encode($data->fEmail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fIsAdmin')); ?>:</b>
	<?php echo CHtml::encode($data->fIsAdmin); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fIsActive')); ?>:</b>
	<?php echo CHtml::encode($data->fIsActive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fIsLog')); ?>:</b>
	<?php echo CHtml::encode($data->fIsLog); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fMemo')); ?>:</b>
	<?php echo CHtml::encode($data->fMemo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fStatus')); ?>:</b>
	<?php echo CHtml::encode($data->fStatus); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpadateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fUpadateUser); ?>
	<br />

	*/ ?>

</div>