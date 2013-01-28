<?php
$this->breadcrumbs=array(
	'Resultdocuments'=>array('index'),
	$model->fResultNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('textarea').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#ListDoc').attr('href',$('#ListDoc').attr('href')+'/id/".$fItemNo."');

");

?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','Documents')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'),'linkOptions'=>array('id'=>'ListDoc'), 'url'=>array('docgrid'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Docgrid')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Create')),					
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fResultNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resultdocument-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachmentNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachmentNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fAttachmentNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsDocument'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsDocument'); ?>
   
          <?php echo $form->error($model,'fIsDocument'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResultSubmitUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResultSubmitUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fResultSubmitUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResultSubmitDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResultSubmitDate'); ?>
   
          <?php echo $form->error($model,'fResultSubmitDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResultConfirmUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResultConfirmUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fResultConfirmUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResultConfirmDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResultConfirmDate'); ?>
   
          <?php echo $form->error($model,'fResultConfirmDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fArchiveUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fArchiveUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fArchiveUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fArchiveDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fArchiveDate'); ?>
   
          <?php echo $form->error($model,'fArchiveDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fApplyArchiveUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fApplyArchiveUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fApplyArchiveUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fApplyArchiveDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fApplyArchiveDate'); ?>
   
          <?php echo $form->error($model,'fApplyArchiveDate'); ?>
        
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
          <?php echo $form->labelEx($model,'fMemo1'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo1',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo1'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDocumentStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDocumentStatus',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fDocumentStatus'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->