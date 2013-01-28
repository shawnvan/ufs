<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-profile-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fUserID'); ?>
		<?php echo $form->textField($model,'fUserID',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'fUserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fModelName'); ?>
		<?php echo $form->textField($model,'fModelName',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'fModelName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fDataGridColumn'); ?>
		<?php echo $form->textArea($model,'fDataGridColumn',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fDataGridColumn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fQueryCondition'); ?>
		<?php echo $form->textArea($model,'fQueryCondition',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fQueryCondition'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fCreateUser'); ?>
		<?php echo $form->textField($model,'fCreateUser',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'fCreateUser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fCreateDate'); ?>
		<?php echo $form->textField($model,'fCreateDate'); ?>
		<?php echo $form->error($model,'fCreateDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fUpdateUser'); ?>
		<?php echo $form->textField($model,'fUpdateUser',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'fUpdateUser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fUpdateDate'); ?>
		<?php echo $form->textField($model,'fUpdateDate'); ?>
		<?php echo $form->error($model,'fUpdateDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->