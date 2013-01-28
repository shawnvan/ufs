<?php
$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->fContactID,
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Create Contacts', 'url'=>array('create')),
	array('label'=>'Update Contacts', 'url'=>array('update', 'id'=>$model->fContactID)),
	array('label'=>'Delete Contacts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fContactID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contacts', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
");
?>

<h1>View Contacts #<?php echo $model->fContactID; ?></h1>


<div class="content">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contacts-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fContactID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fContactID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fContactID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fContactName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fContactName',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fContactName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFristName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFristName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fFristName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLastName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLastName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fLastName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fContactTitle'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fContactTitle',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fContactTitle'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCompany'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCompany',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fCompany'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPhone'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPhone',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fPhone'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPhone2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPhone2',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fPhone2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEmail'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEmail',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fEmail'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWebsite'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWebsite',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fWebsite'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAddress'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAddress',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fAddress'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAddress2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAddress2',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fAddress2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCity'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCity',array('size'=>40,'maxlength'=>40)); ?>
   
          <?php echo $form->error($model,'fCity'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fState'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fState',array('size'=>40,'maxlength'=>40)); ?>
   
          <?php echo $form->error($model,'fState'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fZipCode'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fZipCode',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fZipCode'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCountry'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCountry',array('size'=>40,'maxlength'=>40)); ?>
   
          <?php echo $form->error($model,'fCountry'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fVisibility'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fVisibility'); ?>
   
          <?php echo $form->error($model,'fVisibility'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAssignedTo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAssignedTo',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fAssignedTo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fBackGroundInfo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fBackGroundInfo',array('size'=>60,'maxlength'=>1000)); ?>
   
          <?php echo $form->error($model,'fBackGroundInfo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fQQ'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fQQ'); ?>
   
          <?php echo $form->error($model,'fQQ'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLinkedIn'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLinkedIn',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fLinkedIn'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMSN'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fMSN',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fMSN'); ?>
        
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
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
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
          <?php echo $form->labelEx($model,'fUpadateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpadateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpadateUser'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->