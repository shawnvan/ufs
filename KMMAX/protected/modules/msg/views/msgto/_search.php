<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fSendToNo'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSendToNo',$model->fSendToNo,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromNo'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fSendFromNo',$model->fSendFromNo,array('size'=>10,'maxlength'=>50))?>
        
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


		<div class="input-group">
          <?php echo $form->label($model,'fSendMsgStatus'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fSendMsgStatus',$model->fSendMsgStatus,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendUserNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSendUserNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fSendUserNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromName',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fSendFromName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromDate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromDate'); ?>
 
          <?php echo $form->error($model,'fSendFromDate'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromModule'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromModule',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fSendFromModule'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSendFromType'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromType',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fSendFromType'); ?>
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fSendFromTheme'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromTheme',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fSendFromTheme'); ?>
        
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