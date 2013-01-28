<div class="content">

<input type="hidden" value="fCooperativePartnerID" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cooperativepartner-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCooperativePartnerID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCooperativePartnerID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCooperativePartnerID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCooperativeCompanyID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCooperativeCompanyID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCooperativeCompanyID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPartnerName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPartnerName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPartnerName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPartnerPassword'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPartnerPassword',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPartnerPassword'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRole'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRole',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fRole'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fBirthday'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fBirthday',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fBirthday'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPosition'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPosition',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPosition'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSex'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSex'); ?>
   
          <?php echo $form->error($model,'fSex'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCellphone'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCellphone',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCellphone'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEmail'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEmail',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fEmail'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEducationalLevel'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEducationalLevel',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fEducationalLevel'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fHomeAddress'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fHomeAddress',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fHomeAddress'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPhoto'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPhoto',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPhoto'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fQq'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fQq',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fQq'); ?>
        
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

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->