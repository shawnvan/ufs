<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route).'/id/'.$model->fItemNo,
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fCatalogueNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fAttachmentNo'); ?>
  
          <div class="inputs">
         <?php echo CHtml::textField('fAttachmentNo',$model->fAttachmentNo,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fApplyArchiveUser'); ?>
  
          <div class="inputs">
 <?php echo CHtml::textField('fApplyArchiveUser',$model->fApplyArchiveUser,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fApplyArchiveDate'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fApplyArchiveDate',$model->fApplyArchiveDate,array('size'=>10,'maxlength'=>50))?> 
        
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fArchiveUser'); ?>
  
          <div class="inputs">
  <?php echo CHtml::textField('fArchiveUser',$model->fArchiveUser,array('size'=>10,'maxlength'=>50))?>  
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fArchiveDate'); ?>
  
          <div class="inputs">
   <?php echo CHtml::textField('fArchiveDate',$model->fArchiveDate,array('size'=>10,'maxlength'=>50))?> 
        
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
          <?php echo $form->label($model,'fDocumentStatus'); ?>  
          <div class="inputs">
             <?php echo CHtml::textField('fDocumentStatus',$model->fDocumentStatus,array('size'=>10,'maxlength'=>50))?>      
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