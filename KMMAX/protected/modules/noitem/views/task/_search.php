<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>
		<div class="input-group">
          <?php echo $form->label($model,'fTheme'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fTheme',$model->fTheme,array('size'=>10,'maxlength'=>50))?>     
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fStartDate'); ?>
  
          <div class="inputs">
   <?php echo CHtml::textField('fStartDate',$model->fStartDate,array('size'=>10,'maxlength'=>50))?> 

      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fEndDate'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fEndDate',$model->fEndDate,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSponsor'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSponsor',$model->fSponsor,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fExecutor'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fExecutor',$model->fExecutor,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateUser'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fCreateUser',$model->fCreateUser,array('size'=>10,'maxlength'=>50))?> 

        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateDate'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fCreateDate',$model->fCreateDate,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fStatus'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fStatus',$model->fStatus,array('size'=>10,'maxlength'=>50))?> 
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPriority'); ?>
  
          <div class="inputs">
   <?php echo CHtml::textField('fPriority',$model->fPriority,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fWarnFrequency'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fWarnFrequency',$model->fWarnFrequency,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fTaskType'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fTaskType',$model->fTaskType,array('size'=>10,'maxlength'=>50))?> 

        
      	</div>
      </div>
		<div class="input-group">
          <?php echo $form->label($model,'fStandardStatus'); ?>
  
          <div class="inputs">
   <?php echo CHtml::textField('fStandardStatus',$model->fStandardStatus,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Search'), array('class' =>'btn-icon submit no-margin')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Clear'), array('class' =>'btn-icon submit no-margin Clear')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->