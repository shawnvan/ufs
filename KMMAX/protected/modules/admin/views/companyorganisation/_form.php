<div class="content">

<input type="hidden" value="fOrgNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'companyorganisation-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOrgNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOrgNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fOrgNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOrgName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOrgName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fOrgName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpOrgNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpOrgNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpOrgNo'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->