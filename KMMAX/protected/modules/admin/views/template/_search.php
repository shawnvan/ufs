<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fTemplateName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateName',array('size'=>50,'maxlength'=>50)); ?>
      	</div>
      </div>

      <div class="input-group">
          <?php echo $form->label($model,'fTemplateType'); ?>
  
          <div class="inputs">
           <?php echo $form->dropdownList($model,'fTemplateType',$fTemplateType); ?>
      	</div>
      </div>     
      
		<div class="input-group">
          <?php echo $form->label($model,'fCreate'); ?>
          <div class="inputs">
          <?php echo $form->textField($model,'fCreate',array('size'=>50,'maxlength'=>50)); ?>
          <?php echo $form->error($model,'fCreate'); ?>
      	</div>
      </div>

        <div class="input-group">
	          <?php echo $form->label($model,'fCreateDateBeginDate'); ?>
	          <div class="inputs">
	          <?php echo $form->textField($model,'fCreateDateBeginDate',array('size'=>50,'maxlength'=>50,'class'=>'datepicker')); ?>        
	      	</div>
	      </div>
	      
         <div class="input-group">
	          <?php echo $form->label($model,'fCreateDateEndDate'); ?>
	          <div class="inputs">
	          <?php echo $form->textField($model,'fCreateDateEndDate',array('size'=>50,'maxlength'=>50,'class'=>'datepicker')); ?>        
	      	</div>
	      </div>

	       <div class="input-group">
	          <?php echo $form->label($model,'fUpdate'); ?>
	          <div class="inputs">
	          <?php echo $form->textField($model,'fUpdate',array('size'=>50,'maxlength'=>50)); ?>        
	      	</div>
	      </div>
	      
			<div class="input-group">
	          <?php echo $form->label($model,'fUpdateDateBeginDate'); ?>
	          <div class="inputs">
	          <?php echo $form->textField($model,'fUpdateDateBeginDate',array('size'=>50,'maxlength'=>50,'class'=>'datepicker')); ?>        
	      	</div>
	      </div>
    
	     <div class="input-group">
	          <?php echo $form->label($model,'fUpdateDateEndDate'); ?>
	          <div class="inputs">
	          <?php echo $form->textField($model,'fUpdateDateEndDate',array('size'=>50,'maxlength'=>50,'class'=>'datepicker')); ?>        
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