<div class="content">

<input type="hidden" value="fCalendarNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'calendar-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCalendarNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCalendarNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCalendarNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fViewer'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fViewer',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fViewer'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStartTime'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStartTime'); ?>
   
          <?php echo $form->error($model,'fStartTime'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEndTime'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEndTime'); ?>
   
          <?php echo $form->error($model,'fEndTime'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOtherNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOtherNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fOtherNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTheme'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTheme',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fTheme'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fContent',array('size'=>60,'maxlength'=>2000)); ?>
   
          <?php echo $form->error($model,'fContent'); ?>
        
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
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->