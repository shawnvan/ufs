<?php
$this->breadcrumbs=array(
	'Cooperativepartners'=>array('index'),
	$model->fCooperativePartnerID=>array('view','id'=>$model->fCooperativePartnerID),
	'Update',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
jQuery('.datepicker').datepicker();			   		
  $('.btn-icon-search').live('click',function(){ 
	var companyId='';
	var companyName='';
	var url =	'".Yii::app()->createUrl('admin/Cooperativecompany/popgrid')."';
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {}});
 })
			  

");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Cooperativepartners') ?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativepartner.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativepartner.Create')),					
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fCooperativePartnerID,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativepartner.Update')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativepartner.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fCooperativePartnerID" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cooperativepartner-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCooperativeCompanyID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCooperativeCompanyID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo CHtml::hiddenField('fCooperativeCompanyID','',array('size'=>50,'maxlength'=>50,'class'=>'required')); ?>
          <?php echo $form->error($model,'fCooperativeCompanyID'); ?>
            <span class="btn-icon-horizontal btn-icon-input btn-icon-search"></span>
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPartnerName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPartnerName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPartnerName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPartnerPassword'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPartnerPassword',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPartnerPassword'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRole'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRole',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fRole'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fBirthday'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fBirthday',array('size'=>50,'maxlength'=>50,'class'=>'datepicker')); ?>
   
          <?php echo $form->error($model,'fBirthday'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPosition'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPosition',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPosition'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSex'); ?>
     
          <div class="inputs">
          <?php echo $form->radioButtonList($model,'fSex',$Sex,array('class'=>'label_radio r_off')); ?>
   
          <?php echo $form->error($model,'fSex'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCellphone'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCellphone',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCellphone'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEmail'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEmail',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fEmail'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEducationalLevel'); ?>
     
          <div class="inputs">
          <?php echo CHtml::dropdownList('EducationalLevel', false,$EducationLevel);  ?>
   
          <?php echo $form->error($model,'fEducationalLevel'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fHomeAddress'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fHomeAddress',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fHomeAddress'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPhoto'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPhoto',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPhoto'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fQq'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fQq',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fQq'); ?>
        
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

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->