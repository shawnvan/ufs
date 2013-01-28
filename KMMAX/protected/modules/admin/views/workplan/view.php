<?php
$this->breadcrumbs=array(
	'Workplans'=>array('index'),
	$model->fPlanNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyWorkplan').attr('href',$('#CopyWorkplan').attr('href')+'/id/".$keyid."');
$('#UpdateWorkplan').attr('href',$('#UpdateWorkplan').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2>工作计划</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.workplan.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.workplan.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyWorkplan'),'id'=>$model->fPlanNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('admin.workplan.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateWorkplan'),'id'=>$model->fPlanNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.workplan.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fPlanNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('admin.workplan.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.workplan.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workplan-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPlanNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPlanNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPlanNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTitle'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTitle',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fTitle'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMonth'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fMonth',array('size'=>2,'maxlength'=>2)); ?>
   
          <?php echo $form->error($model,'fMonth'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpPlan'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fUpPlan',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fUpPlan'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fNowPlan'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fNowPlan',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fNowPlan'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fMemo'); ?>
        
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
          <?php echo $form->labelEx($model,'fUpdateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->