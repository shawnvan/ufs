<?php
$this->breadcrumbs=array(
	'Userfilters'=>array('index'),
	$model->fUserFilterID,
);

$this->menu=array(
	array('label'=>'List Userfilter', 'url'=>array('index')),
	array('label'=>'Create Userfilter', 'url'=>array('create')),
	array('label'=>'Update Userfilter', 'url'=>array('update', 'id'=>$model->fUserFilterID)),
	array('label'=>'Delete Userfilter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fUserFilterID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userfilter', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
");
?>

<h1>View Userfilter #<?php echo $model->fUserFilterID; ?></h1>


<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userfilter-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserFilterID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserFilterID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserFilterID'); ?>
        
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
          <?php echo $form->labelEx($model,'fFormID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFormID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fFormID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDataGridColumn'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDataGridColumn',array('size'=>60,'maxlength'=>1000)); ?>
   
          <?php echo $form->error($model,'fDataGridColumn'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fQueryCondition'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fQueryCondition',array('size'=>60,'maxlength'=>1000)); ?>
   
          <?php echo $form->error($model,'fQueryCondition'); ?>
        
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
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
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