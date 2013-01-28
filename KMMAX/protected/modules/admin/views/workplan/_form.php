<div class="content">

<input type="hidden" value="fPlanNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workplan-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPlanNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPlanNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPlanNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTitle'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTitle',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fTitle'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMonth'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fMonth',array('size'=>2,'maxlength'=>2)); ?>
   
          <?php echo $form->error($model,'fMonth'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpPlan'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fUpPlan',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fUpPlan'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fNowPlan'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fNowPlan',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fNowPlan'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
   
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->