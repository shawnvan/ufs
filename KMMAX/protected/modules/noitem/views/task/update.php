<?php
$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	$model->fTaskNo=>array('view','id'=>$model->fTaskNo),
	'Update',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
jQuery('.datepicker').datepicker();
$('#CreateTask').attr('href',$('#CreateTask').attr('href')+'/id/+jQuery('#Task_fItemNo').val()');
		
$('.SelectUser').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('users/User/popgrid')."';
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'100%',onClosed: function (message) {}});
    return false;
 })
$('.SelectCatalogue').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('knowledge/knowledgecatalogue/popgrid')."';
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {}});
    return false;
 })
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
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('noitem.task.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'), 'linkOptions'=>array('id'=>'CreateTask'),'visible'=>Yii::app()->user->checkAccess('noitem.task.Create')),					
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fTaskNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('noitem.task.Update')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('noitem.task.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fTaskNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>
    
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
          <?php echo $form->hiddenField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
           <?php echo CHtml::submitButton(Yii::t('label','SelectKnowledgeCatalogue'), array('class' =>'btn-icon submit no-margin SelectCatalogue' , )); ?>
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
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
         <?php echo $form->textField($model,'fStartDate',array('class'=>'datepicker')); ?>
   
          <?php echo $form->error($model,'fStartDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEndDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEndDate',array('class'=>'datepicker')); ?>
   
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
          <?php echo CHtml::submitButton(Yii::t('label','SelectUser'), array('class' =>'btn-icon submit no-margin SelectUser' , )); ?>
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
           <?php echo $form->dropdownList($model,'fPriority',$fPriority); ?>
          <?php echo $form->error($model,'fPriority'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWarnFrequency'); ?>
     
          <div class="inputs">
          <?php echo $form->dropdownList($model,'fWarnFrequency',$fWarnFrequency); ?>
          <?php echo $form->error($model,'fWarnFrequency'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskType'); ?>
     
          <div class="inputs">
   
          <?php echo $form->dropdownList($model,'fTaskType',$fTaskType); ?>
          <?php echo $form->error($model,'fTaskType'); ?>
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLatestAffixId'); ?>
          <div class="inputs">
          <?php echo $form->fileField($model,'fLatestAffixId',array('size'=>50,'maxlength'=>50)); ?>
          <?php echo $form->error($model,'fLatestAffixId'); ?>
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

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->