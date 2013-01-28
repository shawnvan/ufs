<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->fUserID,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('submenu .current').click(function(){
	return false;
});
$('#CopyUser').attr('href',$('#CopyUser').attr('href')+'/id/".$keyid."');
$('#UpdateUser').attr('href',$('#UpdateUser').attr('href')+'/id/".$keyid."');
 
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
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('users.user.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyUser'),'id'=>$model->fUserID,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('users.user.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateUser'),'id'=>$model->fUserID,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('users.user.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fUserID,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('users.user.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('users.user.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="" id="hiddenpkey" name="hiddenpkey" />
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
	          <?php echo $form->labelEx($model,'fUserType'); ?>
	     
	          <div class="inputs">
	            <?php echo $form->dropdownList($model,'fUserType',$UserType,array('disabled'=>'disabled')); ?>
	          <?php echo $form->error($model,'fUserType'); ?>
	        
	      	</div>
	      </div>
	      
	      <div class="input-group">
	          <?php echo $form->labelEx($model,'fUserCompany'); ?>
	     
	          <div class="inputs">
	          <?php echo CHtml::textField('fUserCompanyName',empty($model->company->fCooperativeCompanyName)?'':$model->company->fCooperativeCompanyName,array('size'=>60,'maxlength'=>500)) ?>
	          <?php echo $form->hiddenField($model,'fUserCompany',array('size'=>60,'maxlength'=>500)); ?>
	           <span class="btn-icon-horizontal btn-icon-input btn-icon-search"></span>
	          <?php echo $form->error($model,'fUserCompany'); ?>
	        
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
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('label','Create') : Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php echo $msg?>