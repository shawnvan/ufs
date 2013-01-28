<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fSendFromNo'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSendFromNo',$model->fSendFromNo,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromUserNo'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSendFromUserNo',$model->fSendFromUserNo,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromName'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSendFromName',$model->fSendFromName,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fSendFromModule'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fSendFromModule',$model->fSendFromModule,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromType'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSendFromType',$model->fSendFromType,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromDate'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSendFromDate',$model->fSendFromDate,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromTheme'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fSendFromTheme',$model->fSendFromTheme,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromStatus'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSendFromStatus',$model->fSendFromStatus,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendToUserNo'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fSendToUserNo',$model->fSendToUserNo,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendToAccount'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSendToAccount',$model->fSendToAccount,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendToName'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fSendToName',$model->fSendToName,array('size'=>10,'maxlength'=>50))?>
        
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