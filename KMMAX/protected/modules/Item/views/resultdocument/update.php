<?php
$this->breadcrumbs=array(
	'Resultdocuments'=>array('index'),
	$model->fResultNo=>array('view','id'=>$model->fResultNo),
	'Update',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Resultdocuments</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Resultdocument'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Index')),
						array('label'=>Yii::t('label','Create Resultdocument'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Create')),					
						array('label'=>Yii::t('label','Update Resultdocument'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fResultNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Update')),
						array('label'=>Yii::t('label','Manage Resultdocument'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fResultNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resultdocument-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTaskNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fItemNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResultNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResultNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fResultNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDocumentNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDocumentNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fDocumentNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fAttachmentNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachmentNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fAttachmentNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fIsItemResult'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsItemResult'); ?>
   
          <?php echo $form->error($model,'fIsItemResult'); ?>
        
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
          <?php echo $form->labelEx($model,'fCreateUesr'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUesr',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreateUesr'); ?>
        
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
          <?php echo $form->textArea($model,'fMemo1',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo2'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo2',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo3'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo3',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo4'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo4',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo4'); ?>
        
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->