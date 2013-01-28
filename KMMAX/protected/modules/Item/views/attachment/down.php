<?php
$this->breadcrumbs=array(
	'Attachments'=>array('index'),
	$model->fAttachmentId,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
  $('.download').live('click',function(){ 
      jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/attachment/download')."',
				  type:'POST',
				  data:'id='+$(this).attr('rel'),
				  success: function(data){
				     
				  }
			 });		
  		return false;
     });		

");

?>
<div class="content" style='height:400px;width:300px;'>
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attachment-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>
<div style="position:absolute;left:10px;top:50px;">
   <div class="input-group">
          <div class="inputs">
             <?php echo CHtml::textField('number','',array('size'=>60,'maxlength'=>200)); ?>
      	</div>
      </div>
   <div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','DownLoad') : Yii::t('label','DownLoad'), array('class' =>'btn-icon submit no-margin')); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Cancel') : Yii::t('label','Cancel'), array('class' =>'btn-icon submit no-margin')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
