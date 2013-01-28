<?php
$this->breadcrumbs=array(
	'Itemplans'=>array('index'),
	$model->fItemNo=>array('view','id'=>$model->fItemNo),
	'Update',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Itemplans</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Itemplan'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Index')),
						array('label'=>Yii::t('label','Create Itemplan'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Create')),					
						array('label'=>Yii::t('label','Update Itemplan'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fItemNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Update')),
						array('label'=>Yii::t('label','Manage Itemplan'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.itemplan.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fItemNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'itemplan-form',
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
          <?php echo $form->labelEx($model,'fItemTimeNode'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemTimeNode'); ?>
   
          <?php echo $form->error($model,'fItemTimeNode'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemStart'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemStart'); ?>
   
          <?php echo $form->error($model,'fItemStart'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemEnd'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemEnd'); ?>
   
          <?php echo $form->error($model,'fItemEnd'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemPerson'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemPerson',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fItemPerson'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemFee'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemFee'); ?>
   
          <?php echo $form->error($model,'fItemFee'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemOtherPerson'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemOtherPerson',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fItemOtherPerson'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->