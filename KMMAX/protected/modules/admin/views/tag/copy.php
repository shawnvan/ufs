<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->fTagNo=>array('view','id'=>$model->fTagNo),
	'Update',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Tags</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Tag'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.tag.Index')),
						array('label'=>Yii::t('label','Create Tag'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.tag.Create')),					
						array('label'=>Yii::t('label','Copy Tag'),'linkOptions'=>array('class'=>'current'),  'id'=>$model->fTagNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('admin.tag.Copy')),
						array('label'=>Yii::t('label','Manage Tag'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.tag.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fTagNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tag-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTagNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTagNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTagNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
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
		<?php echo CHtml::submitButton('Create', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->