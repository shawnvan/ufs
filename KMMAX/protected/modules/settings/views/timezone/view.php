<?php
$this->breadcrumbs=array(
	'Timezones'=>array('index'),
	$model->fTimeZoneID,
);

$this->menu=array(
	array('label'=>'List Timezone', 'url'=>array('index')),
	array('label'=>'Create Timezone', 'url'=>array('create')),
	array('label'=>'Update Timezone', 'url'=>array('update', 'id'=>$model->fTimeZoneID)),
	array('label'=>'Delete Timezone', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fTimeZoneID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Timezone', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
");
?>

<h1>View Timezone #<?php echo $model->fTimeZoneID; ?></h1>


<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'timezone-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTimeZoneID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTimeZoneID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTimeZoneID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTimeZoneName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTimeZoneName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fTimeZoneName'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->