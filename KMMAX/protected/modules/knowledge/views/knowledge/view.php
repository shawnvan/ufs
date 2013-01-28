<?php
$this->breadcrumbs=array(
	'Knowledges'=>array('index'),
	$model->fKnowledgeNo,
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('textarea').each(function(){
	$(this).attr('disabled','disabled');
});
$('.UFSGrid-row-attach').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('Item/attachment/view')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'100%', height:'100%',onClosed: function (message) {}});
  		return false;
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyKnowledge').attr('href',$('#CopyKnowledge').attr('href')+'/id/".$keyid."');
$('#UpdateKnowledge').attr('href',$('#UpdateKnowledge').attr('href')+'/id/".$keyid."');

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
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateKnowledge'),'id'=>$model->fKnowledgeNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledge.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fKnowledgeNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledge.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledge.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'knowledge-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTaskNo'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>


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
          <?php echo $form->labelEx($model,'fMemo'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachmentName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachmentName',array('size'=>60,'maxlength'=>200)); ?>
          <span class="btn-icon-horizontal btn-icon-input btn-icon-search UFSGrid-row-attach" rel='<?php echo $model->fAttachmentNo?>'></span>
          <?php echo $form->error($model,'fAttachmentName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsOpen'); ?>
     
          <div class="inputs">
          <?php echo $form->dropdownList($model,'fIsOpen',$fIsOpen,array('disabled'=>'disabled')); ?>
          <?php echo $form->error($model,'fIsOpen'); ?>
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
            <?php echo $form->dropdownList($model,'fStatus',$fStatus,array('disabled'=>'disabled')); ?>
          <?php echo $form->error($model,'fStatus'); ?>
        
      	</div>
      </div>

      <div class="input-group">
          <?php echo $form->labelEx($model,'fSubmitUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSubmitUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSubmitUser'); ?>
        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSubmitDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSubmitDate'); ?>
   
          <?php echo $form->error($model,'fSubmitDate'); ?>
        
      	</div>
      </div>


	  


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fConfirmUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fConfirmUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fConfirmUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fConfirmDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fConfirmDate'); ?>
   
          <?php echo $form->error($model,'fConfirmDate'); ?>
        
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
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->