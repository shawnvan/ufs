<?php
$this->breadcrumbs=array(
	'Templetstandardtasks'=>array('index'),
	$model->fTaskNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyTempletstandardtask').attr('href',$('#CopyTempletstandardtask').attr('href')+'/id/".$keyid."');
$('#UpdateTempletstandardtask').attr('href',$('#UpdateTempletstandardtask').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2>Templetstandardtasks</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Templetstandardtask'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.templetstandardtask.Index')),
						array('label'=>Yii::t('label','Create Templetstandardtask'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.templetstandardtask.Create')),					
						array('label'=>Yii::t('label','Copy Templetstandardtask'), 'linkOptions'=>array('id'=>'CopyTempletstandardtask'),'id'=>$model->fTaskNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('admin.templetstandardtask.Copy')),
						array('label'=>Yii::t('label','Update Templetstandardtask'),'linkOptions'=>array('id'=>'UpdateTempletstandardtask'),'id'=>$model->fTaskNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.templetstandardtask.Update')),
						array('label'=>Yii::t('label','View Templetstandardtask'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fTaskNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('admin.templetstandardtask.View')),
						array('label'=>Yii::t('label','Manage Templetstandardtask'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.templetstandardtask.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'templetstandardtask-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTemplateNo'); ?>
        
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
          <?php echo $form->labelEx($model,'fTaskNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTaskNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTaskNo'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->