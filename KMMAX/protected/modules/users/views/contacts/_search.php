<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fContactID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fContactID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fContactID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fContactName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fContactName',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fContactName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFristName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFristName',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fFristName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fLastName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fLastName',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fLastName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fContactTitle'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fContactTitle',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fContactTitle'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCompany'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCompany',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fCompany'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPhone'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPhone',array('size'=>20,'maxlength'=>20)); ?>
 
          <?php echo $form->error($model,'fPhone'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPhone2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPhone2',array('size'=>20,'maxlength'=>20)); ?>
 
          <?php echo $form->error($model,'fPhone2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fEmail'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fEmail',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fEmail'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fWebsite'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fWebsite',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fWebsite'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAddress'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAddress',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fAddress'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAddress2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAddress2',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fAddress2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCity'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCity',array('size'=>40,'maxlength'=>40)); ?>
 
          <?php echo $form->error($model,'fCity'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fState'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fState',array('size'=>40,'maxlength'=>40)); ?>
 
          <?php echo $form->error($model,'fState'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fZipCode'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fZipCode',array('size'=>20,'maxlength'=>20)); ?>
 
          <?php echo $form->error($model,'fZipCode'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCountry'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCountry',array('size'=>40,'maxlength'=>40)); ?>
 
          <?php echo $form->error($model,'fCountry'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fVisibility'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fVisibility'); ?>
 
          <?php echo $form->error($model,'fVisibility'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAssignedTo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAssignedTo',array('size'=>20,'maxlength'=>20)); ?>
 
          <?php echo $form->error($model,'fAssignedTo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fBackGroundInfo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fBackGroundInfo',array('size'=>60,'maxlength'=>1000)); ?>
 
          <?php echo $form->error($model,'fBackGroundInfo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fQQ'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fQQ'); ?>
 
          <?php echo $form->error($model,'fQQ'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fLinkedIn'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fLinkedIn',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fLinkedIn'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fMSN'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fMSN',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fMSN'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateDate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
 
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateUser'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUpdateDate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
 
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUpadateUser'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUpadateUser',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUpadateUser'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->