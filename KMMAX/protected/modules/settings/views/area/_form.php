<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAreaID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAreaID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fAreaID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAreaName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAreaName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fAreaName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fParentID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fParentID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fParentID'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->