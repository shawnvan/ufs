<?php
$this->breadcrumbs=array(
	'Standardtasks'=>array('index'),
	$model->fTaskNo=>array('view','id'=>$model->fTaskNo),
	'Update',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Standardtasks') ?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Standardtask'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Index')),
						array('label'=>Yii::t('label','Create Standardtask'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Create')),					
						array('label'=>Yii::t('label','Copy Standardtask'),'linkOptions'=>array('class'=>'current'),  'id'=>$model->fTaskNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Copy')),
						array('label'=>Yii::t('label','Manage Standardtask'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fTaskNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'standardtask-form',
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
          <?php echo $form->labelEx($model,'fCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fAttachNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachName',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($model,'fAttachName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachFalseName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachFalseName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fAttachFalseName'); ?>
        
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
          <?php echo $form->labelEx($model,'fOldTaskNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOldTaskNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fOldTaskNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fTaskType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskType',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTaskType'); ?>
        
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
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
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
          <?php echo $form->labelEx($model,'fUserGroup'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserGroup',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserGroup'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton('Create', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->