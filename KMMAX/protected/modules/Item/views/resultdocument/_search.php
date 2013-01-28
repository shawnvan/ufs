<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route).'/id/'.$model->fItemNo,
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fTaskNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fTaskNo'); ?>
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fStatus'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fStatus',$model->fStatus,array('size'=>10,'maxlength'=>50))?>  
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAttachmentNo'); ?>
  
          <div class="inputs">
         <?php echo CHtml::textField('fAttachmentNo',$model->fAttachmentNo,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fResultSubmitUser'); ?>
  
          <div class="inputs">

 <?php echo CHtml::textField('fResultSubmitUser',$model->fResultSubmitUser,array('size'=>10,'maxlength'=>50))?> 

        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fResultSubmitDate'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fResultSubmitDate',$model->fResultSubmitDate,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fResultConfirmUser'); ?>
  
          <div class="inputs">
   <?php echo CHtml::textField('fResultConfirmUser',$model->fResultConfirmUser,array('size'=>10,'maxlength'=>50))?> 
          <?php echo $form->error($model,'fResultConfirmUser'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fResultConfirmDate'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fResultConfirmDate',$model->fResultConfirmDate,array('size'=>10,'maxlength'=>50))?> 
        
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

	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Search'), array('class' =>'btn-icon submit no-margin')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Clear'), array('class' =>'btn-icon submit no-margin Clear')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->