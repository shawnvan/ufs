<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fFieldID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFieldID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fFieldID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fModelName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fModelName',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fModelName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFieldName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFieldName',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fFieldName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAttributeLabel'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAttributeLabel',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fAttributeLabel'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fModified'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fModified'); ?>
 
          <?php echo $form->error($model,'fModified'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCustom'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCustom'); ?>
 
          <?php echo $form->error($model,'fCustom'); ?>
        
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
          <?php echo $form->label($model,'fRequired'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fRequired'); ?>
 
          <?php echo $form->error($model,'fRequired'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fReadOnly'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fReadOnly'); ?>
 
          <?php echo $form->error($model,'fReadOnly'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fLinkType'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fLinkType',array('size'=>60,'maxlength'=>250)); ?>
 
          <?php echo $form->error($model,'fLinkType'); ?>
        
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
          <?php echo $form->label($model,'fRelevance'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fRelevance',array('size'=>60,'maxlength'=>250)); ?>
 
          <?php echo $form->error($model,'fRelevance'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fIsVirtual'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fIsVirtual'); ?>
 
          <?php echo $form->error($model,'fIsVirtual'); ?>
        
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