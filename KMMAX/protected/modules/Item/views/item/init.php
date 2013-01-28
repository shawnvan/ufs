<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Create',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});

 $('.SelectUser').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('users/User/popgrid')."';
	console.log(url);
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {}});
    return false;
 })
			
");
?>
<div class="content-head underline">
<h2><?php echo Yii::t('label','Items')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.item.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.item.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.item.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<input type="hidden" value="fItemNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNum',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fItemNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fItemName'); ?>
        
      	</div>
      </div>

     <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateNo'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('fTemplateName',$fTemplateName,array('size'=>60,'maxlength'=>100,'disabled' => 'disabled')); ?>
          <?php echo $form->hiddenField($model,'fTemplateNo'); ?>
          <?php echo $form->error($model,'fTemplateNo'); ?>
        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemType'); ?>
     
          <div class="inputs">
          <?php echo $form->dropdownList($model,'fItemType',$fItemType); ?>
          <?php echo $form->error($model,'fItemType'); ?>
        
      	</div>
      </div>

      <div class="input-group">
          <?php echo $form->labelEx($model,'fResponsibleCreate'); ?>
          <div class="inputs">
          <?php echo $form->textField($model,'fResponsibleCreate',array('size'=>60,'maxlength'=>100)); ?>
          <span class="btn-icon-horizontal btn-icon-input btn-icon-user SelectUser"></span>
          <?php echo $form->error($model,'fResponsibleCreate'); ?>
        
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
          <?php echo $form->labelEx($model,'fRemark'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemark',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fRemark'); ?>
        
      	</div>
      </div>


      
	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->