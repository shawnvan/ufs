<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->fName=>array('view','id'=>$model->fName),
	'Update',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Settings</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Settings'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('settings.setting.Index')),
						array('label'=>Yii::t('label','Create Settings'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('settings.setting.Create')),					
						array('label'=>Yii::t('label','Update Settings'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fName,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('settings.setting.Update')),
						array('label'=>Yii::t('label','Manage Settings'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('settings.setting.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fName" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLabel'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLabel',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fLabel'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fValue'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fValue',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fValue'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDescription'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDescription',array('size'=>60,'maxlength'=>1000)); ?>
   
          <?php echo $form->error($model,'fDescription'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fGroupName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fGroupName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fGroupName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSequence'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSequence'); ?>
   
          <?php echo $form->error($model,'fSequence'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsActive'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsActive'); ?>
   
          <?php echo $form->error($model,'fIsActive'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fModule'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fModule',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fModule'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->