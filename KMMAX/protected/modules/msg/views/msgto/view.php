<?php
$this->breadcrumbs=array(
	'Msgtos'=>array('index'),
	$model->fSendToNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyMsgto').attr('href',$('#CopyMsgto').attr('href')+'/id/".$keyid."');
$('#UpdateMsgto').attr('href',$('#UpdateMsgto').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Msgtos') ?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('msg.msgto.Index')),
											
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fSendToNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('msg.msgto.View')),
											
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'msgto-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendToNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendFromNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToUserNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToUserNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendToUserNo'); ?>
        
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


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendMsgStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendMsgStatus',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendMsgStatus'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToLookDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToLookDate'); ?>
   
          <?php echo $form->error($model,'fSendToLookDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendUserNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendUserNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fSendUserNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendFromName'); ?>
        
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
          <?php echo $form->labelEx($model,'fSendFromModule'); ?>
     
          <div class="inputs">
          
          <?php echo $form->dropdownList($model,'fSendFromModule',$MsgModule,array('disabled'=>'disabled')); ?>
          <?php echo $form->error($model,'fSendFromModule'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromType'); ?>
     
          <div class="inputs">

   <?php echo $form->dropdownList($model,'fSendFromType',$MsgType,array('disabled'=>'disabled')); ?>
          <?php echo $form->error($model,'fSendFromType'); ?>
        
      	</div>
      </div>


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
          <?php echo $form->textArea($model,'fSendFromContent',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fSendFromContent'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToAllUserNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToAllUserNo',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToAllUserNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToAllAccount'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToAllAccount',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToAllAccount'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToAllName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendToAllName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendToAllName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemark1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRemark1',array('size'=>60,'maxlength'=>2000)); ?>
   
          <?php echo $form->error($model,'fRemark1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemark2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRemark2',array('size'=>60,'maxlength'=>2000)); ?>
   
          <?php echo $form->error($model,'fRemark2'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemark3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRemark3',array('size'=>60,'maxlength'=>2000)); ?>
   
          <?php echo $form->error($model,'fRemark3'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->