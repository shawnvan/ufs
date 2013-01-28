<?php
$this->breadcrumbs=array(
	'Companyorganisations'=>array('index'),
	'Create',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>
<div class="content-head underline">
<h2>Companyorganisations</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Companyorganisation'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Index')),
						array('label'=>Yii::t('label','Create Companyorganisation'), 'url'=>array('create'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Create')),					
						array('label'=>Yii::t('label','Manage Companyorganisation'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<input type="hidden" value="fOrgNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'companyorganisation-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOrgNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOrgNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fOrgNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOrgName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOrgName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fOrgName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpOrgNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpOrgNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpOrgNo'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->