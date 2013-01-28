<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'itemcatalogue-form',
	'action'=>Yii::app()->createUrl('Item/itemcatalogue/UpdateTree'),
	'enableAjaxValidation'=>false,
)); ?>
   <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->hiddenField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>		
		<?php echo $form->hiddenField($model,'fTemplateNo',array('size'=>50,'maxlength'=>50)); ?>

   
	<div class="row">
		<?php echo $model->fathercatalogue->fCatalogueName ?>
	</div>
	
	 <div class="row">
	 	<?php echo $form->textField($model,'fCatalogueName',array('value'=>$model->catalogue->fCatalogueName)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fIsActive'); ?>
		<?php echo $form->textField($model,'fIsActive',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fIsActive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fSort'); ?>
		<?php echo $form->textField($model,'fSort'); ?>
		<?php echo $form->error($model,'fSort'); ?>

		<?php echo $form->labelEx($model,'fStatus'); ?>
		<?php echo $form->textField($model,'fStatus'); ?>
		<?php echo $form->error($model,'fStatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fWarnStart'); ?>
		<?php echo $form->textField($model,'fWarnStart'); ?>
		<?php echo $form->error($model,'fWarnStart'); ?>

		<?php echo $form->labelEx($model,'fWarnEnd'); ?>
		<?php echo $form->textField($model,'fWarnEnd'); ?>
		<?php echo $form->error($model,'fWarnEnd'); ?>
	</div>
	

<?php $this->endWidget(); ?>



</div><!-- form -->