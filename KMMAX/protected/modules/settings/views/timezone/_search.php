<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fTimeZoneID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fTimeZoneID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fTimeZoneID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fTimeZoneName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fTimeZoneName',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fTimeZoneName'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->