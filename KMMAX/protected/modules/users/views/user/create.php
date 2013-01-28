<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('submenu .current').click(function(){
	return false;
});
$('.SelectUser').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('users/user/popgrid')."/id/'+jQuery('#hiddenpkey').val();
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'100%',onClosed: function (message) {}});
    return false;
 })	
$('.SelectOrg').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('admin/companyorganisation/popgrid')."/id/'+jQuery('#hiddenpkey').val();
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'100%',onClosed: function (message) {}});
    return false;
 })			
  $('.btn-icon-search').live('click',function(){ 
	var companyId='';
	var companyName='';
	var url =	'".Yii::app()->createUrl('admin/Cooperativecompany/popgrid')."';
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {}});
    return false;
 })		
");
?>
<div class="content-head underline">
<h2><?php echo Yii::t('label','Users')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('users.user.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('users.user.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('users.user.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<input type="hidden" value="fUserID" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPassword'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPassword',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fPassword'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLastName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLastName',array('size'=>40,'maxlength'=>40)); ?>
   
          <?php echo $form->error($model,'fLastName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFirstName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFirstName',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fFirstName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEmail'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEmail',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fEmail'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsAdmin'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsAdmin'); ?>
   
          <?php echo $form->error($model,'fIsAdmin'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsActive'); ?>     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsActive'); ?>   
          <?php echo $form->error($model,'fIsActive'); ?>        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIsLog'); ?>     
          <div class="inputs">
          <?php echo $form->textField($model,'fIsLog'); ?>   
          <?php echo $form->error($model,'fIsLog'); ?>        
      	</div>
      </div>

     <div class="input-group">
          <?php echo $form->labelEx($model,'fLead'); ?>     
          <div class="inputs">
          <?php echo $form->textField($model,'fLead'); ?>
           <span class="btn-icon-horizontal btn-icon-input btn-icon-user SelectUser"></span>
          <?php echo $form->error($model,'fLead'); ?>        
      	</div>
      </div>
      
      <div class="input-group">
          <?php echo $form->labelEx($model,'fOrgNo'); ?>     
          <div class="inputs">
           <?php echo $form->hiddenField($model,'fOrgNo'); ?>
           <?php echo CHtml::textField('fOrgName','',array('disabled'=>'disabled')); ?>
           <span class="btn-icon-horizontal btn-icon-input btn-icon-user SelectOrg"></span>
          <?php echo $form->error($model,'fOrgNo'); ?>        
      	</div>
      </div>
      
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMemo'); ?>     
          <div class="inputs">
          <?php echo $form->textField($model,'fMemo',array('size'=>60,'maxlength'=>500)); ?>   
          <?php echo $form->error($model,'fMemo'); ?>        
      	</div>
      </div>


      <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus'); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
      	</div>
      </div>


	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->