<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fUserID), array('view', 'id'=>$data->fUserID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserName')); ?>:</b>
	<?php echo CHtml::encode($data->fUserName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCity')); ?>:</b>
	<?php echo CHtml::encode($data->fCity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fWebsite')); ?>:</b>
	<?php echo CHtml::encode($data->fWebsite); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fZipCode')); ?>:</b>
	<?php echo CHtml::encode($data->fZipCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCountry')); ?>:</b>
	<?php echo CHtml::encode($data->fCountry); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAssignedTo')); ?>:</b>
	<?php echo CHtml::encode($data->fAssignedTo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fQQ')); ?>:</b>
	<?php echo CHtml::encode($data->fQQ); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fLinkedIn')); ?>:</b>
	<?php echo CHtml::encode($data->fLinkedIn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fMSN')); ?>:</b>
	<?php echo CHtml::encode($data->fMSN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFullName')); ?>:</b>
	<?php echo CHtml::encode($data->fFullName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fOfficePhone')); ?>:</b>
	<?php echo CHtml::encode($data->fOfficePhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCellPhone')); ?>:</b>
	<?php echo CHtml::encode($data->fCellPhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fHomePhone')); ?>:</b>
	<?php echo CHtml::encode($data->fHomePhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fNotes')); ?>:</b>
	<?php echo CHtml::encode($data->fNotes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAvatar')); ?>:</b>
	<?php echo CHtml::encode($data->fAvatar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fLanguage')); ?>:</b>
	<?php echo CHtml::encode($data->fLanguage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTimeZone')); ?>:</b>
	<?php echo CHtml::encode($data->fTimeZone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShowSocialMedia')); ?>:</b>
	<?php echo CHtml::encode($data->fShowSocialMedia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShowDetailView')); ?>:</b>
	<?php echo CHtml::encode($data->fShowDetailView); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShowWorkflow')); ?>:</b>
	<?php echo CHtml::encode($data->fShowWorkflow); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fGridviewSettings')); ?>:</b>
	<?php echo CHtml::encode($data->fGridviewSettings); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFormSettings')); ?>:</b>
	<?php echo CHtml::encode($data->fFormSettings); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fEmailSignature')); ?>:</b>
	<?php echo CHtml::encode($data->fEmailSignature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fEnableFullWidth')); ?>:</b>
	<?php echo CHtml::encode($data->fEnableFullWidth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fSyncGoogleCalendarId')); ?>:</b>
	<?php echo CHtml::encode($data->fSyncGoogleCalendarId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fSyncGoogleCalendarAccessToken')); ?>:</b>
	<?php echo CHtml::encode($data->fSyncGoogleCalendarAccessToken); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fSyncGoogleCalendarRefreshToken')); ?>:</b>
	<?php echo CHtml::encode($data->fSyncGoogleCalendarRefreshToken); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fGoogleId')); ?>:</b>
	<?php echo CHtml::encode($data->fGoogleId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUserCalendarsVisible')); ?>:</b>
	<?php echo CHtml::encode($data->fUserCalendarsVisible); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fGroupCalendarsVisible')); ?>:</b>
	<?php echo CHtml::encode($data->fGroupCalendarsVisible); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTagsShowAllUsers')); ?>:</b>
	<?php echo CHtml::encode($data->fTagsShowAllUsers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fWidgets')); ?>:</b>
	<?php echo CHtml::encode($data->fWidgets); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAllowPost')); ?>:</b>
	<?php echo CHtml::encode($data->fAllowPost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fBackgroundColor')); ?>:</b>
	<?php echo CHtml::encode($data->fBackgroundColor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fTagLine')); ?>:</b>
	<?php echo CHtml::encode($data->fTagLine); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fCreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fCreateDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateUser')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateUser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fUpdateDate')); ?>:</b>
	<?php echo CHtml::encode($data->fUpdateDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fEmailUserSignature')); ?>:</b>
	<?php echo CHtml::encode($data->fEmailUserSignature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAddress1')); ?>:</b>
	<?php echo CHtml::encode($data->fAddress1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAddress2')); ?>:</b>
	<?php echo CHtml::encode($data->fAddress2); ?>
	<br />

	*/ ?>

</div>