<?php
$this->breadcrumbs=array(
	'Itemusers'=>array('index'),
	$model->fEmployeeNo=>array('view','id'=>$model->fEmployeeNo),
	'Update',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Itemusers</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Itemuser'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.itemuser.Index')),
						array('label'=>Yii::t('label','Create Itemuser'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.itemuser.Create')),					
						array('label'=>Yii::t('label','Update Itemuser'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fEmployeeNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('Item.itemuser.Update')),
						array('label'=>Yii::t('label','Manage Itemuser'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.itemuser.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fEmployeeNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'itemuser-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fItemNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEmployeeNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEmployeeNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fEmployeeNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEmployeeName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEmployeeName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fEmployeeName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRoleNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRoleNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fRoleNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fUserGroup'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserGroup',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserGroup'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserType',array('size'=>2,'maxlength'=>2)); ?>
   
          <?php echo $form->error($model,'fUserType'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->