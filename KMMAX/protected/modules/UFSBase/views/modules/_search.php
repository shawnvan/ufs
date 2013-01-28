<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fModuleID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fModuleID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fModuleID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fModuleName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fModuleName',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fModuleName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fModuleTitle'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fModuleTitle',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fModuleTitle'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fIsVisible'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fIsVisible'); ?>
 
          <?php echo $form->error($model,'fIsVisible'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSearchable'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSearchable'); ?>
 
          <?php echo $form->error($model,'fSearchable'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'FCustom'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'FCustom',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'FCustom'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateDate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
 
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateUser'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUpdateUser'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUpdateDate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
 
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->