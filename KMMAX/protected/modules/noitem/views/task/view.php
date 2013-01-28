<?php
$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	$model->fTaskNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyTask').attr('href',$('#CopyTask').attr('href')+'/id/".$keyid."');
$('#UpdateTask').attr('href',$('#UpdateTask').attr('href')+'/id/".$keyid."');
$('#CreateTask').attr('href',$('#CreateTask').attr('href')+'/id/".$keyid."');
$('#ListTask').attr('href',$('#ListTask').attr('href')+'/id/".$keyid."');
$('#ManageTask').attr('href',$('#ManageTask').attr('href')+'/id/".$keyid."');
");

?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','NoTasks')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('id'=>'ListTask'),'visible'=>Yii::app()->user->checkAccess('noitem.task.Index')),
						array('label'=>Yii::t('label','Create'), 'linkOptions'=>array('id'=>'CreateTask'),'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('noitem.task.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyTask'),'id'=>$model->fTaskNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('noitem.task.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateTask'),'id'=>$model->fTaskNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('noitem.task.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fTaskNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('noitem.task.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'linkOptions'=>array('id'=>'ManageTask'),'visible'=>Yii::app()->user->checkAccess('noitem.task.Admin')),				
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	 <div class="input-group">
          <?php echo $form->labelEx($model,'fTheme'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTheme',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fTheme'); ?>
        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('fCatalogueName',empty($model->knowcatalogue)?'':$model->knowcatalogue->fCatalogueName,array('size'=>50,'maxlength'=>50)); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fContent',array('rows'=>6, 'cols'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fContent'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks',array('rows'=>6, 'cols'=>50,'disabled'=>'disabled')); ?>
   
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
              <?php echo $form->dropdownList($model,'fPriority',$fPriority,array('disabled'=>'disabled')); ?>
          <?php echo $form->error($model,'fPriority'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnFrequency'); ?>
     
          <div class="inputs">
                 <?php echo $form->dropdownList($model,'fWarnFrequency',$fWarnFrequency,array('disabled'=>'disabled')); ?>
          <?php echo $form->error($model,'fWarnFrequency'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskType'); ?>
     
          <div class="inputs">
   <?php echo $form->dropdownList($model,'fTaskType',$fTaskType,array('disabled'=>'disabled')); ?>
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
          <?php echo $form->labelEx($model,'fRemarks1'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks1',array('rows'=>6, 'cols'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fRemarks1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks2'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks2',array('rows'=>6, 'cols'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fRemarks2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks3'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks3',array('rows'=>6, 'cols'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fRemarks3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks4'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks4',array('rows'=>6, 'cols'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fRemarks4'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks5'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks5',array('rows'=>6, 'cols'=>50,'disabled'=>'disabled')); ?>
   
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
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->