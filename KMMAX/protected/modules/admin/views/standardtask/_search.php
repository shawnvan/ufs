<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>
		<div class="input-group">
          <?php echo $form->label($model,'fAttachName'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fAttachName',$model->fAttachName,array('size'=>10,'maxlength'=>50))?>     
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fTheme'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fTheme',$model->fTheme,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fSubmitUser'); ?>
  
          <div class="inputs">

   <?php echo CHtml::textField('fSubmitUser',$model->fSubmitUser,array('size'=>10,'maxlength'=>50))?>

        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSubmitDate'); ?>
  
          <div class="inputs">
    <?php echo CHtml::textField('fSubmitDate',$model->fSubmitDate,array('size'=>10,'maxlength'=>50))?>

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
  <?php echo CHtml::textField('fConfirmDate',$model->fConfirmDate,array('size'=>10,'maxlength'=>50))?>
        
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


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Search'), array('class' =>'btn-icon submit no-margin')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Clear'), array('class' =>'btn-icon submit no-margin Clear')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->