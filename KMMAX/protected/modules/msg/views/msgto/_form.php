<div class="content">

<input type="hidden" value="fSendToNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'msgto-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendToNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendFromNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToUserNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToUserNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendToUserNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToAccount'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToAccount',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToAccount'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendMsgStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendMsgStatus',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendMsgStatus'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToLookDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToLookDate'); ?>
   
          <?php echo $form->error($model,'fSendToLookDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendUserNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendUserNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendUserNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendFromName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromDate'); ?>
   
          <?php echo $form->error($model,'fSendFromDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromModule'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromModule',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendFromModule'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromType',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendFromType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromTheme'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromTheme',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendFromTheme'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fSendFromContent',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fSendFromContent'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToAllUserNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToAllUserNo',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToAllUserNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToAllAccount'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToAllAccount',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToAllAccount'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToAllName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToAllName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToAllName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemark1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRemark1',array('size'=>60,'maxlength'=>2000)); ?>
   
          <?php echo $form->error($model,'fRemark1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemark2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRemark2',array('size'=>60,'maxlength'=>2000)); ?>
   
          <?php echo $form->error($model,'fRemark2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemark3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRemark3',array('size'=>60,'maxlength'=>2000)); ?>
   
          <?php echo $form->error($model,'fRemark3'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->