<link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/less/login.less">
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/less-1.3.0.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jquery.js"></script>    
<script type="text/javascript">
jQuery(function(){
	jQuery('.username').focus(function(){
		jQuery(this).addClass('username-focus');	
	}).blur(function(){
		if(jQuery(this).val().length==0){
			jQuery(this).removeClass('username-focus');	
			
		}else{
			return false;
		}
	})	
})
</script>             


<div class="loginlogo">
	<img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/images/logo.png" alt="Logo">
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'login-form',
						'enableClientValidation'=>true,
						'clientOptions'=>array(
							'validateOnSubmit'=>true,
						),
					)); ?>
<div class="notification notifyError loginNotify"><?php echo CHtml::errorSummary($model); ?></div>
<div class="loginbox">
	<div class="loginbox_inner">
			<?php if($model->useCaptcha && CCaptcha::checkRequirements()) { ?>
			<div class="row">
				<?php
				echo '<div>';
				$this->widget('CCaptcha',array(
					'clickableImage'=>true,
					'showRefreshButton'=>false,
					'imageOptions'=>array(
						'style'=>'display:block;cursor:pointer;',
						'title'=>Yii::t('app','Click to get a new image')
					)
				)); echo '</div>';
				echo '<p class="hint">'.Yii::t('app','Please enter the letters in the image above.').'</p>';
				echo $form->textField($model,'verifyCode');
				?>
			</div><?php } ?>

    	<div class="loginbox_content">
			<?php echo CHtml::activeTextField($model,'fUserName',array('class'=>'username')) ?>
            <?php echo CHtml::submitButton(Yii::t('label','Confirm'),array('class'=>'submit')); ?>
        </div><!--loginbox_content-->
    </div><!--loginbox_inner-->
</div><!--loginbox-->
<div class="loginoption">

</div><!--loginoption-->
<?php $this->endWidget(); ?>
