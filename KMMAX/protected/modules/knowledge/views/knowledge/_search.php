<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fKnowledgeName'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fKnowledgeName',$model->fKnowledgeName,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fAttachmentName'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fAttachmentName',$model->fAttachmentName,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fIsOpen'); ?>
  
          <div class="inputs">
   <?php echo CHtml::textField('fIsOpen',$model->fIsOpen,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fStatus'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fStatus'); ?>
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fSubmitDate'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fSubmitDate',$model->fSubmitDate,array('class'=>'datepicker','size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSubmitUser'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSubmitUser',$model->fSubmitUser,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fConfirmUser'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fConfirmUser',$model->fConfirmUser,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fConfirmDate'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fConfirmDate',$model->fConfirmDate,array('class'=>'datepicker','size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreate'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fCreate',$model->fCreate,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateDate'); ?>
  
          <div class="inputs">
           <?php echo CHtml::textField('fCreateDate',$model->fCreateDate,array('class'=>'datepicker','size'=>10,'maxlength'=>50))?>

        
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