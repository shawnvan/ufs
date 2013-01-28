<div class="content">

<input type="hidden" value="fTaskNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'templetstandardtask-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTemplateNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTaskNo'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->