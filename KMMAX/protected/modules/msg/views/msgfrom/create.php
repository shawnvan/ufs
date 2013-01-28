<?php
$this->breadcrumbs=array(
	'Msgfroms'=>array('index'),
	'Create',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
$('.SelectUser').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('users/User/addmultiuser')."';
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {
         
       }});
    return false;
 })
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
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('msg.msgfrom.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('msg.msgfrom.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<input type="hidden" value="fSendFromNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'msgfrom-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromTheme'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSendFromTheme',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fSendFromTheme'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendToName'); ?>
          <div class="inputs">
          <?php echo $form->hiddenField($model,'fSendToAccount',array('size'=>60,'maxlength'=>200)); ?>
          <?php echo $form->textField($model,'fSendToName',array('size'=>60,'maxlength'=>200)); ?>
    <span class="btn-icon-horizontal btn-icon-input btn-icon-user SelectUser"></span>
          <?php echo $form->error($model,'fSendToName'); ?>
        
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
          <?php echo $form->labelEx($model,'fSendFromModule'); ?>
     
          <div class="inputs">
          <?php echo $form->dropdownList($model,'fSendFromModule',$MsgModule); ?>
          <?php echo $form->error($model,'fSendFromModule'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSendFromType'); ?>
     
          <div class="inputs">
           <?php echo $form->dropdownList($model,'fSendFromType',$MsgType); ?>
          <?php echo $form->error($model,'fSendFromType'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->