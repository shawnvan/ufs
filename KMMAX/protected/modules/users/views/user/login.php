<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jquery-latest.js"></script>    
<link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/less/login.less">
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/less-1.3.0.min.js"></script>    
      

<div class="loginlogo">
	<img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/images/logo.png" alt="Logo">
</div>
<div class="notification notifyError loginNotify"><?php echo CHtml::errorSummary($model); ?></div>
<?php echo CHtml::beginForm(); ?>
<div class="loginbox">
	<div class="loginbox_inner">
    	<div class="loginbox_content">
			<?php echo CHtml::activeTextField($model,'username',array('class'=>'username')) ?>
        	<?php echo CHtml::activePasswordField($model,'password',array('class'=>'password')) ?>
            <?php echo CHtml::submitButton(UserModule::t("Login"),array('class'=>'submit')); ?>
        </div><!--loginbox_content-->
    </div><!--loginbox_inner-->
</div><!--loginbox-->
<?php echo CHtml::endForm(); ?>
<div class="loginoption">
	<?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl,array('class'=>'cant')); ?>

    <?php echo CHtml::activeCheckBox($model,'rememberMe',array('class'=>'remember')); ?><?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
</div><!--loginoption-->
</form>
<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>