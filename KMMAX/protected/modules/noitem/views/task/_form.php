<div class="content">

<input type="hidden" value="fTaskNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
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
          <?php echo $form->labelEx($model,'fCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTheme'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTheme',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fTheme'); ?>
        
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
          <?php echo $form->labelEx($model,'fRemarks'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fRemarks'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStartDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStartDate'); ?>
   
          <?php echo $form->error($model,'fStartDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEndDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEndDate'); ?>
   
          <?php echo $form->error($model,'fEndDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSponsor'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSponsor',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSponsor'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fExecutor'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fExecutor',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fExecutor'); ?>
        
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
          <?php echo $form->labelEx($model,'fSchedule'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSchedule',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fSchedule'); ?>
        
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
          <?php echo $form->labelEx($model,'fPriority'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPriority',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPriority'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnFrequency'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWarnFrequency',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fWarnFrequency'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskType',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTaskType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLatestAffixId'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLatestAffixId',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fLatestAffixId'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsItem'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsItem',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fIsItem'); ?>
        
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
          <?php echo $form->labelEx($model,'fRemarks1'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks1',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fRemarks1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks2'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks2',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fRemarks2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks3'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks3',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fRemarks3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks4'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks4',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fRemarks4'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks5'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks5',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fRemarks5'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStandardStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStandardStatus',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fStandardStatus'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->