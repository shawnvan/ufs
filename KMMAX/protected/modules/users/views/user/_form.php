<div class="content">

<input type="hidden" value="fUserID" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPassword'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPassword',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fPassword'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLastName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLastName',array('size'=>40,'maxlength'=>40)); ?>
   
          <?php echo $form->error($model,'fLastName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFirstName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFirstName',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fFirstName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEmail'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEmail',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fEmail'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsAdmin'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsAdmin'); ?>
   
          <?php echo $form->error($model,'fIsAdmin'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsActive'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsActive'); ?>
   
          <?php echo $form->error($model,'fIsActive'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsLog'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsLog'); ?>
   
          <?php echo $form->error($model,'fIsLog'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fMemo',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($model,'fMemo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus'); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
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
          <?php echo $form->labelEx($model,'fUpadateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpadateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpadateUser'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->