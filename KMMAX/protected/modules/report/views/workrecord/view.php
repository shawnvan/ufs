<?php
$this->breadcrumbs=array(
	'Workrecords'=>array('index'),
	$model->fRecordNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('textarea').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyWorkrecord').attr('href',$('#CopyWorkrecord').attr('href')+'/id/".$keyid."');
$('#UpdateWorkrecord').attr('href',$('#UpdateWorkrecord').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2>Workrecords</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('report.workrecord.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('report.workrecord.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyWorkrecord'),'id'=>$model->fRecordNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('report.workrecord.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateWorkrecord'),'id'=>$model->fRecordNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('report.workrecord.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fRecordNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('report.workrecord.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('report.workrecord.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'workrecord-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRecordUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRecordUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fRecordUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRecordDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRecordDate'); ?>
   
          <?php echo $form->error($model,'fRecordDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPlan'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fPlan',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fPlan'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResult'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fResult',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fResult'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSummary'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fSummary',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fSummary'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEvaluate'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fEvaluate',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fEvaluate'); ?>
        
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

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->