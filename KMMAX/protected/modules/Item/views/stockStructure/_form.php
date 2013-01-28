<div class="content">

<input type="hidden" value="fSSNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'stock-structure-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSSNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSSNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSSNo'); ?>
        
      	</div>
      </div>


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
          <?php echo $form->textField($model,'fShareholderName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fShareholderName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShareholdingNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholdingNum'); ?>
   
          <?php echo $form->error($model,'fShareholdingNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShareholderRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderRate'); ?>
   
          <?php echo $form->error($model,'fShareholderRate'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->