<?php
$this->breadcrumbs=array(
	'Knowledges'=>array('index'),
	$model->fKnowledgeNo=>array('view','id'=>$model->fKnowledgeNo),
	'Update',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
$('.SelectCatalogue').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('knowledge/knowledgecatalogue/popgrid')."';
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {}});
    return false;
 })	
$('.SelectTag').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('admin/tag/multigrid')."';
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {}});
    return false;
 })	
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Knowledges') ?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledge.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledge.Create')),					
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fKnowledgeNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledge.Update')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledge.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fKnowledgeNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'knowledge-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form','enctype' => 'multipart/form-data',),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fKnowledgeName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fKnowledgeName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fKnowledgeName'); ?>
        
      	</div>
      </div>
  <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueNo'); ?>
     
          <div class="inputs">
           <?php echo CHtml::textField('fCatalogueName',empty($model->knowledgecatalogue->fCatalogueName)?'':$model->knowledgecatalogue->fCatalogueName,array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
          <?php echo $form->hiddenField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
          <span class="btn-icon-horizontal btn-icon-input btn-icon-search SelectCatalogue"></span>
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fContent',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fContent'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsOpen'); ?>
     
          <div class="inputs">
          <?php echo $form->dropdownList($model,'fIsOpen',$fIsOpen); ?>
          <?php echo $form->error($model,'fIsOpen'); ?>
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
          <div class="inputs">
             <?php echo $form->dropdownList($model,'fStatus',$fStatus); ?>
          <?php echo $form->error($model,'fStatus'); ?>
      	</div>
      </div>
      
   <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachmentName'); ?>
     
          <div class="inputs">
          
          <?php echo $form->textField($model,'fAttachmentName',array('size'=>60,'maxlength'=>200,'disabled'=>'disabled')); ?>
          <?php echo $form->fileField($model,'fAttachmentFalseName',array('size'=>60,'maxlength'=>200)); ?>
          <span class="btn-icon-horizontal btn-icon-input btn-icon-search UFSGrid-row-attach" rel='<?php echo $model->fAttachmentNo?>'></span>
          <?php echo $form->error($model,'fAttachmentName'); ?>
        
      	</div>
      </div>
      
       <div class="input-group">
          <?php echo $form->labelEx($model,'fTags'); ?>
     
          <div class="inputs">
          <?php echo $form->hiddenField($model,'fTags'); ?>
          <?php echo CHtml::textField('fTags','',array('size'=>60,'maxlength'=>200,'disabled'=>'disabled')); ?>
          <span class="btn-icon-horizontal btn-icon-input btn-icon-search SelectTag"></span>
          <?php echo $form->error($model,'fTags'); ?>
        
      	</div>
      </div>
	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->