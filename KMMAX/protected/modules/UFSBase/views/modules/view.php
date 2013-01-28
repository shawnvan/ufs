<?php
$this->breadcrumbs=array(
	'Modules'=>array('index'),
	$model->fModuleID,
);

$this->menu=array(
	array('label'=>'List Modules', 'url'=>array('index')),
	array('label'=>'Create Modules', 'url'=>array('create')),
	array('label'=>'Update Modules', 'url'=>array('update', 'id'=>$model->fModuleID)),
	array('label'=>'Delete Modules', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fModuleID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Modules', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
");
?>

<h1>View Modules #<?php echo $model->fModuleID; ?></h1>


<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'modules-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fModuleID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fModuleID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fModuleID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fModuleName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fModuleName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fModuleName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fModuleTitle'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fModuleTitle',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fModuleTitle'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsVisible'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsVisible'); ?>
   
          <?php echo $form->error($model,'fIsVisible'); ?>
        
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
          <?php echo $form->labelEx($model,'FCustom'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'FCustom',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'FCustom'); ?>
        
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