<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fItemNum'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fItemNum',$model->fItemNum,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fItemName'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fItemName',$model->fItemName,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fItemType'); ?>
  
          <div class="inputs">
   <?php echo CHtml::textField('fItemType',$model->fItemType,array('size'=>10,'maxlength'=>50))?>
        
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
          <?php echo $form->label($model,'fResponsibleCreate'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fResponsibleCreate',$model->fResponsibleCreate,array('size'=>10,'maxlength'=>50))?>
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fTemplateNo'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fTemplateNo',$model->fTemplateNo,array('size'=>10,'maxlength'=>50))?>
        
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