<?php
$this->breadcrumbs=array(
	'Templatecatalogue Copies'=>array('index'),
	$model->fCatalogueNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyTemplatecatalogueCopy').attr('href',$('#CopyTemplatecatalogueCopy').attr('href')+'/id/".$keyid."');
$('#UpdateTemplatecatalogueCopy').attr('href',$('#UpdateTemplatecatalogueCopy').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2>Templatecatalogue Copies</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyTemplatecatalogueCopy'),'id'=>$model->fCatalogueNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateTemplatecatalogueCopy'),'id'=>$model->fCatalogueNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fCatalogueNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('admin.templatecatalogueCopy.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'templatecatalogue-copy-form',
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
          <?php echo $form->labelEx($model,'fTemplateNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTemplateNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fWarnStart'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWarnStart'); ?>
   
          <?php echo $form->error($model,'fWarnStart'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnEnd'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWarnEnd'); ?>
   
          <?php echo $form->error($model,'fWarnEnd'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWarnRate',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fWarnRate'); ?>
        
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
          <?php echo $form->labelEx($model,'fSort'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSort'); ?>
   
          <?php echo $form->error($model,'fSort'); ?>
        
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
          <?php echo $form->labelEx($model,'fUserGroup'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserGroup',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserGroup'); ?>
        
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
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
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
          <?php echo $form->labelEx($model,'fUpdateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->