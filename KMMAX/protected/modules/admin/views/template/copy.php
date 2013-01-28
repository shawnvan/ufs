<?php
$this->breadcrumbs=array(
	'Templates'=>array('index'),
	$model->fTemplateNo=>array('view','id'=>$model->fTemplateNo),
	'Update',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Templates') ?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.template.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.template.Create')),					
						array('label'=>Yii::t('label','Copy'),'linkOptions'=>array('class'=>'current'),  'id'=>$model->fTemplateNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('admin.template.Copy')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.template.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fTemplateNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTemplateNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTemplateName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateType',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTemplateType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreate',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreate'); ?>
        
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
          <?php echo $form->labelEx($model,'fUpdate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdate',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpdate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
   
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus'); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserGroup'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserGroup',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserGroup'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Create'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->