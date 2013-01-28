<div class="content">

<input type="hidden" value="fAttachmentId" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attachment-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachmentId'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachmentId',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fAttachmentId'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTaskNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fKnowledgeNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fKnowledgeNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fKnowledgeNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fAttachmentName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachmentName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fAttachmentName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachmentFalseName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachmentFalseName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fAttachmentFalseName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDownloadNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDownloadNum'); ?>
   
          <?php echo $form->error($model,'fDownloadNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fViewNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fViewNum'); ?>
   
          <?php echo $form->error($model,'fViewNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fVersion'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fVersion',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fVersion'); ?>
        
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->