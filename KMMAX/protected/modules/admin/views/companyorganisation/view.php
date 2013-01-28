<?php
$this->breadcrumbs=array(
	'Companyorganisations'=>array('index'),
	$model->fOrgNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyCompanyorganisation').attr('href',$('#CopyCompanyorganisation').attr('href')+'/id/".$keyid."');
$('#UpdateCompanyorganisation').attr('href',$('#UpdateCompanyorganisation').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2>Companyorganisations</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyCompanyorganisation'),'id'=>$model->fOrgNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateCompanyorganisation'),'id'=>$model->fOrgNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fOrgNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'companyorganisation-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOrgNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOrgNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fOrgNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOrgName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOrgName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fOrgName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpOrgNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpOrgNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpOrgNo'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->