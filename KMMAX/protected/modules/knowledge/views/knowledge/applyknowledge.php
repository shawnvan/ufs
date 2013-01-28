<?php
$this->breadcrumbs=array(
	'Knowledges'=>array('index'),
	'Create',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
$('.SelectTag').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('admin/companyorganisation/multigrid')."/id/'+jQuery('#hiddenpkey').val();
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'100%',onClosed: function (message) {}});
    return false;
 })			
");
?>
<div class="content-head underline">
<h2><?php echo Yii::t('label','ApplyKnowledge') ?></h2>
	<div class="content-action">
	</div>
</div>
<div class="content">

<input type="hidden" value="fKnowledgeNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'knowledge-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	 <?php echo $form->hiddenField($model,'fKnowledgeNo',array('size'=>60,'maxlength'=>200)); ?>
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fKnowledgeName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fKnowledgeName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fKnowledgeName'); ?>
        
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
          <?php echo CHtml::label(Yii::t('label','KnowledgeCAdvice'),'')?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo'); ?>
        
      	</div>
      </div>

      <div class="input-group">
          <?php echo CHtml::label(Yii::t('label','TagsAdvice'),'')?>
          <div class="inputs">
            <?php echo $form->textArea($model,'fTags',array('rows'=>6, 'cols'=>50)); ?>

          <?php echo $form->error($model,'fTags'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachmentName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachmentName',array('size'=>60,'maxlength'=>200,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fAttachmentName'); ?>
        
      	</div>
      </div>


	<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Apply'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->