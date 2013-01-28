<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fOrgNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fOrgNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fOrgNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fOrgName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fOrgName',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fOrgName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUpOrgNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUpOrgNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUpOrgNo'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->