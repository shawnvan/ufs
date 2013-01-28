<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fAreaID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAreaID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fAreaID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAreaName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAreaName',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fAreaName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fParentID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fParentID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fParentID'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->