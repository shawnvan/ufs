<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'timezone-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTimeZoneID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTimeZoneID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTimeZoneID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTimeZoneName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTimeZoneName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fTimeZoneName'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->