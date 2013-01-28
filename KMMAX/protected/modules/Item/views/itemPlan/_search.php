<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fItemNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fItemNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fItemTimeNode'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fItemTimeNode'); ?>
 
          <?php echo $form->error($model,'fItemTimeNode'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fItemStart'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fItemStart'); ?>
 
          <?php echo $form->error($model,'fItemStart'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fItemEnd'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fItemEnd'); ?>
 
          <?php echo $form->error($model,'fItemEnd'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fItemPerson'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fItemPerson',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fItemPerson'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fItemFee'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fItemFee'); ?>
 
          <?php echo $form->error($model,'fItemFee'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fItemOtherPerson'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fItemOtherPerson',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fItemOtherPerson'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->