<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fNotifyID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fNotifyID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fNotifyID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fType'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fType',array('size'=>20,'maxlength'=>20)); ?>
 
          <?php echo $form->error($model,'fType'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fComparison'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fComparison',array('size'=>0,'maxlength'=>0)); ?>
 
          <?php echo $form->error($model,'fComparison'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fValue'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fValue',array('size'=>60,'maxlength'=>250)); ?>
 
          <?php echo $form->error($model,'fValue'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fModelType'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fModelType',array('size'=>60,'maxlength'=>250)); ?>
 
          <?php echo $form->error($model,'fModelType'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fModelID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fModelID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fModelID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFieldName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFieldName',array('size'=>60,'maxlength'=>250)); ?>
 
          <?php echo $form->error($model,'fFieldName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUserName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUserName',array('size'=>60,'maxlength'=>60)); ?>
 
          <?php echo $form->error($model,'fUserName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUserID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUserID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUserID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreatedBy'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCreatedBy',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fCreatedBy'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fViewed'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fViewed'); ?>
 
          <?php echo $form->error($model,'fViewed'); ?>
        
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