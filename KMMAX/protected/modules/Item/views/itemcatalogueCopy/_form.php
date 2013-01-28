<div class="content">

<input type="hidden" value="fCatalogueNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'itemcatalogue-copy-form',
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
          <?php echo $form->labelEx($model,'fItemNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fItemNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fIsActive'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsActive',array('size'=>10,'maxlength'=>10)); ?>
   
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
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus'); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
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
          <?php echo $form->labelEx($model,'fWaitFinishingNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWaitFinishingNum'); ?>
   
          <?php echo $form->error($model,'fWaitFinishingNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFinishedNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFinishedNum'); ?>
   
          <?php echo $form->error($model,'fFinishedNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResultNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResultNum'); ?>
   
          <?php echo $form->error($model,'fResultNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDocumentNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDocumentNum'); ?>
   
          <?php echo $form->error($model,'fDocumentNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskNum'); ?>
   
          <?php echo $form->error($model,'fTaskNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fKnowledgeNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fKnowledgeNum'); ?>
   
          <?php echo $form->error($model,'fKnowledgeNum'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->