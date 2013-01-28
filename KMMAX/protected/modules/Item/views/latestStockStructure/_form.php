<div class="content">

<input type="hidden" value="fHistoryNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'latest-stock-structure-form',
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
          <?php echo $form->labelEx($model,'fHistoryNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fHistoryNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fHistoryNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShareholderName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fShareholderName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFristStrands'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFristStrands'); ?>
   
          <?php echo $form->error($model,'fFristStrands'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFristRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFristRate'); ?>
   
          <?php echo $form->error($model,'fFristRate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSecondStrands'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSecondStrands'); ?>
   
          <?php echo $form->error($model,'fSecondStrands'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSecondRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSecondRate'); ?>
   
          <?php echo $form->error($model,'fSecondRate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fThirdStrands'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fThirdStrands'); ?>
   
          <?php echo $form->error($model,'fThirdStrands'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fThirdRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fThirdRate'); ?>
   
          <?php echo $form->error($model,'fThirdRate'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->