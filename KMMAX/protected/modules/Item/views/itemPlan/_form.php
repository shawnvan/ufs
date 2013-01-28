<div class="content">

<input type="hidden" value="fItemNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'itemplan-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fItemNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemTimeNode'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemTimeNode'); ?>
   
          <?php echo $form->error($model,'fItemTimeNode'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemStart'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemStart'); ?>
   
          <?php echo $form->error($model,'fItemStart'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemEnd'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemEnd'); ?>
   
          <?php echo $form->error($model,'fItemEnd'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemPerson'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemPerson',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fItemPerson'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemFee'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemFee'); ?>
   
          <?php echo $form->error($model,'fItemFee'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemOtherPerson'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemOtherPerson',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fItemOtherPerson'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->