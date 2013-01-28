<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fName',array('size'=>60,'maxlength'=>64)); ?>
   
          <?php echo $form->error($model,'fName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLabel'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLabel',array('size'=>60,'maxlength'=>64)); ?>
   
          <?php echo $form->error($model,'fLabel'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fValue'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fValue',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fValue'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDescription'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDescription',array('size'=>60,'maxlength'=>255)); ?>
   
          <?php echo $form->error($model,'fDescription'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fGroupName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fGroupName',array('size'=>60,'maxlength'=>64)); ?>
   
          <?php echo $form->error($model,'fGroupName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSequence'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSequence'); ?>
   
          <?php echo $form->error($model,'fSequence'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fVisible'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fVisible'); ?>
   
          <?php echo $form->error($model,'fVisible'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fModule'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fModule',array('size'=>60,'maxlength'=>64)); ?>
   
          <?php echo $form->error($model,'fModule'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->