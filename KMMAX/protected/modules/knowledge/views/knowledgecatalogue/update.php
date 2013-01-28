<?php
$this->breadcrumbs=array(
	'Knowledgecatalogues'=>array('index'),
	$model->fCatalogueNo=>array('view','id'=>$model->fCatalogueNo),
	'Update',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Knowledgecatalogues')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledgecatalogue.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledgecatalogue.Create')),					
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fCatalogueNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledgecatalogue.Update')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledgecatalogue.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fCatalogueNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'knowledgecatalogue-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fCatalogueName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFatherCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFatherCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fFatherCatalogueNo'); ?>
        
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


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserGroup'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserGroup',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserGroup'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fMemo1',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fMemo2',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo2'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->