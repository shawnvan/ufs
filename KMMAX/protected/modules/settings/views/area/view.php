<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	$model->fAreaID,
);

$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Update Area', 'url'=>array('update', 'id'=>$model->fAreaID)),
	array('label'=>'Delete Area', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fAreaID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
");
?>

<h1>View Area #<?php echo $model->fAreaID; ?></h1>


<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAreaID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAreaID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fAreaID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAreaName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAreaName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fAreaName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fParentID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fParentID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fParentID'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->