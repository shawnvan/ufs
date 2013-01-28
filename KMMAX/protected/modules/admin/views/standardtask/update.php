<?php
$this->breadcrumbs=array(
	'Standardtasks'=>array('index'),
	$model->fTaskNo=>array('view','id'=>$model->fTaskNo),
	'Update',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
$('.SelectCatalogue').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('knowledge/knowledgecatalogue/popgrid')."';
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {}});
    return false;
 })		
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
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Index')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fTaskNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Update')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Admin')),					
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
          <?php echo $form->labelEx($model,'fTheme'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTheme',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fTheme'); ?>
        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCatalogueNo'); ?>
     
          <div class="inputs">
           <?php echo CHtml::textField('fCatalogueName','',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
           <?php echo $form->hiddenField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
          <span class="btn-icon-horizontal btn-icon-input btn-icon-search SelectCatalogue"></span>
          <?php echo $form->error($model,'fCatalogueNo'); ?>
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachName',array('size'=>60,'maxlength'=>500,'disabled' => 'disabled')); ?>
   
          <?php echo $form->error($model,'fAttachName'); ?>
        
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
          <?php echo $form->dropdownList($model,'fTaskType',$fTaskType); ?>
          <?php echo $form->error($model,'fTaskType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSubmitUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSubmitUser',array('size'=>50,'maxlength'=>50,'disabled' => 'disabled')); ?>
   
          <?php echo $form->error($model,'fSubmitUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSubmitDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSubmitDate',array('disabled' => 'disabled')); ?>
   
          <?php echo $form->error($model,'fSubmitDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fConfirmUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fConfirmUser',array('size'=>50,'maxlength'=>50,'disabled' => 'disabled')); ?>
   
          <?php echo $form->error($model,'fConfirmUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fConfirmDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fConfirmDate',array('disabled' => 'disabled')); ?>
   
          <?php echo $form->error($model,'fConfirmDate'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->dropdownList($model,'fStatus',$fStatus,array('disabled' => 'disabled')); ?>
          <?php echo $form->error($model,'fStatus'); ?>
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->