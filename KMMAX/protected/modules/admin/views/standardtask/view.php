<?php
$this->breadcrumbs=array(
	'Standardtasks'=>array('index'),
	$model->fTaskNo,
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyStandardtask').attr('href',$('#CopyStandardtask').attr('href')+'/id/".$keyid."');
$('#UpdateStandardtask').attr('href',$('#UpdateStandardtask').attr('href')+'/id/".$keyid."');
$('.ViewAttach').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('Item/attachment/view')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'100%', height:'100%',onClosed: function (message) {}});
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
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Index')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateStandardtask'),'id'=>$model->fTaskNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fTaskNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
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
          <?php echo $form->textField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachName',array('size'=>60,'maxlength'=>500)); ?>
          <span class="btn-icon-horizontal btn-icon-input btn-icon-search ViewAttach" rel='<?php echo $model->fAttachNo ?>'></span>
          <?php echo $form->error($model,'fAttachName'); ?>
        
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
          <?php echo $form->labelEx($model,'fContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fContent',array('rows'=>6, 'cols'=>50,'disabled' => 'disabled')); ?>
   
          <?php echo $form->error($model,'fContent'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemarks'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemarks',array('rows'=>6, 'cols'=>50,'disabled' => 'disabled')); ?>
   
          <?php echo $form->error($model,'fRemarks'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTaskType'); ?>
     
          <div class="inputs">
   <?php echo $form->dropdownList($model,'fTaskType',$fTaskType,array('disabled' => 'disabled')); ?>
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
         <?php echo $form->dropdownList($model,'fStatus',$fStatus,array('disabled' => 'disabled')); ?>
   
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

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->