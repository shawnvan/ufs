<?php
$this->breadcrumbs=array(
	'Fields'=>array('index'),
	$model->fFieldID,
);

$this->menu=array(
	array('label'=>'List Fields', 'url'=>array('index')),
	array('label'=>'Create Fields', 'url'=>array('create')),
	array('label'=>'Update Fields', 'url'=>array('update', 'id'=>$model->fFieldID)),
	array('label'=>'Delete Fields', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fFieldID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Fields', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
");
?>

<h1>View Fields #<?php echo $model->fFieldID; ?></h1>


<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fields-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFieldID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFieldID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fFieldID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fModelName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fModelName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fModelName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFieldName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFieldName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fFieldName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttributeLabel'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttributeLabel',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fAttributeLabel'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fModified'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fModified'); ?>
   
          <?php echo $form->error($model,'fModified'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCustom'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCustom'); ?>
   
          <?php echo $form->error($model,'fCustom'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fType',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRequired'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRequired'); ?>
   
          <?php echo $form->error($model,'fRequired'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fReadOnly'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fReadOnly'); ?>
   
          <?php echo $form->error($model,'fReadOnly'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLinkType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLinkType',array('size'=>60,'maxlength'=>250)); ?>
   
          <?php echo $form->error($model,'fLinkType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSearchable'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSearchable'); ?>
   
          <?php echo $form->error($model,'fSearchable'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRelevance'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRelevance',array('size'=>60,'maxlength'=>250)); ?>
   
          <?php echo $form->error($model,'fRelevance'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsVirtual'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsVirtual'); ?>
   
          <?php echo $form->error($model,'fIsVirtual'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
   
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->