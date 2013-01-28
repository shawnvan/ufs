<?php
$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	$model->fNotifyID,
);

$this->menu=array(
	array('label'=>'List Notification', 'url'=>array('index')),
	array('label'=>'Create Notification', 'url'=>array('create')),
	array('label'=>'Update Notification', 'url'=>array('update', 'id'=>$model->fNotifyID)),
	array('label'=>'Delete Notification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fNotifyID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Notification', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
");
?>

<h1>View Notification #<?php echo $model->fNotifyID; ?></h1>


<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fNotifyID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fNotifyID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fNotifyID'); ?>
        
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
          <?php echo $form->labelEx($model,'fComparison'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fComparison',array('size'=>0,'maxlength'=>0)); ?>
   
          <?php echo $form->error($model,'fComparison'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fValue'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fValue',array('size'=>60,'maxlength'=>250)); ?>
   
          <?php echo $form->error($model,'fValue'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fModelType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fModelType',array('size'=>60,'maxlength'=>250)); ?>
   
          <?php echo $form->error($model,'fModelType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fModelID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fModelID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fModelID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFieldName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFieldName',array('size'=>60,'maxlength'=>250)); ?>
   
          <?php echo $form->error($model,'fFieldName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserName',array('size'=>60,'maxlength'=>60)); ?>
   
          <?php echo $form->error($model,'fUserName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreatedBy'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreatedBy',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreatedBy'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fViewed'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fViewed'); ?>
   
          <?php echo $form->error($model,'fViewed'); ?>
        
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