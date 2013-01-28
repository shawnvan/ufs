<?php
$this->breadcrumbs=array(
	'Msgfroms'=>array('index'),
	$model->fSendFromNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyMsgfrom').attr('href',$('#CopyMsgfrom').attr('href')+'/id/".$keyid."');
$('#UpdateMsgfrom').attr('href',$('#UpdateMsgfrom').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Msgfroms') ?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('msg.msgfrom.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('msg.msgfrom.Create')),										
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'msgfrom-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>
	<?php echo $form->errorSummary($model); ?>
       <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromTheme'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromTheme',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendFromTheme'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fSendFromContent',array('rows'=>6, 'cols'=>50 ,'disabled' => 'disabled')); ?>
   
          <?php echo $form->error($model,'fSendFromContent'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromModule'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromModule',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendFromModule'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromType',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendFromType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromDate'); ?>
   
          <?php echo $form->error($model,'fSendFromDate'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromStatus',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendFromStatus'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToAccount'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToAccount',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToAccount'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToName'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->