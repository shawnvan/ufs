<?php
$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->fUserID,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('submenu .current').click(function(){
	return false;
});
$('#CopyProfile').attr('href',$('#CopyProfile').attr('href')+'/id/".$keyid."');
$('#UpdateProfile').attr('href',$('#UpdateProfile').attr('href')+'/id/".$keyid."');

");

?>

<div class="content-head underline">
	<h2>Profiles</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Profile'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('users.profile.Index')),
						array('label'=>Yii::t('label','Create Profile'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('users.profile.Create')),					
						array('label'=>Yii::t('label','Copy Profile'), 'linkOptions'=>array('id'=>'CopyProfile'),'id'=>$model->fUserID,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('users.profile.Copy')),
						array('label'=>Yii::t('label','Update Profile'),'linkOptions'=>array('id'=>'UpdateProfile'),'id'=>$model->fUserID,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('users.profile.Update')),
						array('label'=>Yii::t('label','View Profile'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fUserID,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('users.profile.View')),
						array('label'=>Yii::t('label','Manage Profile'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('users.profile.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserID'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserID',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserID'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserName',array('size'=>60,'maxlength'=>60)); ?>
   
          <?php echo $form->error($model,'fUserName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCity'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCity',array('size'=>40,'maxlength'=>40)); ?>
   
          <?php echo $form->error($model,'fCity'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWebsite'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWebsite',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fWebsite'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fZipCode'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fZipCode',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fZipCode'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCountry'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCountry',array('size'=>40,'maxlength'=>40)); ?>
   
          <?php echo $form->error($model,'fCountry'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAssignedTo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAssignedTo',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fAssignedTo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fQQ'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fQQ'); ?>
   
          <?php echo $form->error($model,'fQQ'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLinkedIn'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLinkedIn',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fLinkedIn'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fMSN'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fMSN',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fMSN'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFullName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFullName',array('size'=>60,'maxlength'=>60)); ?>
   
          <?php echo $form->error($model,'fFullName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOfficePhone'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOfficePhone',array('size'=>30,'maxlength'=>30)); ?>
   
          <?php echo $form->error($model,'fOfficePhone'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCellPhone'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCellPhone',array('size'=>30,'maxlength'=>30)); ?>
   
          <?php echo $form->error($model,'fCellPhone'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fHomePhone'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fHomePhone',array('size'=>30,'maxlength'=>30)); ?>
   
          <?php echo $form->error($model,'fHomePhone'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fNotes'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fNotes',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($model,'fNotes'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAvatar'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAvatar',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fAvatar'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLanguage'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLanguage',array('size'=>20,'maxlength'=>20)); ?>
   
          <?php echo $form->error($model,'fLanguage'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTimeZone'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTimeZone',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fTimeZone'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShowSocialMedia'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShowSocialMedia'); ?>
   
          <?php echo $form->error($model,'fShowSocialMedia'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShowDetailView'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShowDetailView'); ?>
   
          <?php echo $form->error($model,'fShowDetailView'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShowWorkflow'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShowWorkflow'); ?>
   
          <?php echo $form->error($model,'fShowWorkflow'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fGridviewSettings'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fGridviewSettings',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($model,'fGridviewSettings'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFormSettings'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fFormSettings',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($model,'fFormSettings'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEmailSignature'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEmailSignature',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($model,'fEmailSignature'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEnableFullWidth'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEnableFullWidth'); ?>
   
          <?php echo $form->error($model,'fEnableFullWidth'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSyncGoogleCalendarId'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fSyncGoogleCalendarId',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fSyncGoogleCalendarId'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSyncGoogleCalendarAccessToken'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fSyncGoogleCalendarAccessToken',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fSyncGoogleCalendarAccessToken'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSyncGoogleCalendarRefreshToken'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fSyncGoogleCalendarRefreshToken',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fSyncGoogleCalendarRefreshToken'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fGoogleId'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fGoogleId',array('size'=>60,'maxlength'=>250)); ?>
   
          <?php echo $form->error($model,'fGoogleId'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserCalendarsVisible'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserCalendarsVisible'); ?>
   
          <?php echo $form->error($model,'fUserCalendarsVisible'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fGroupCalendarsVisible'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fGroupCalendarsVisible'); ?>
   
          <?php echo $form->error($model,'fGroupCalendarsVisible'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTagsShowAllUsers'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTagsShowAllUsers'); ?>
   
          <?php echo $form->error($model,'fTagsShowAllUsers'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fWidgets'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fWidgets',array('size'=>60,'maxlength'=>255)); ?>
   
          <?php echo $form->error($model,'fWidgets'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAllowPost'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAllowPost'); ?>
   
          <?php echo $form->error($model,'fAllowPost'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fBackgroundColor'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fBackgroundColor',array('size'=>6,'maxlength'=>6)); ?>
   
          <?php echo $form->error($model,'fBackgroundColor'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTagLine'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTagLine',array('size'=>60,'maxlength'=>255)); ?>
   
          <?php echo $form->error($model,'fTagLine'); ?>
        
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


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fEmailUserSignature'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fEmailUserSignature',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($model,'fEmailUserSignature'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAddress1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAddress1',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fAddress1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAddress2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAddress2',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fAddress2'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' ,'disabled' => 'disabled')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->