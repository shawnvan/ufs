
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'fUser'); ?>
		<?php echo $form->textField($model,'fUser'); ?>
		<?php echo $form->error($model,'fUser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fPassword'); ?>
		<?php echo $form->passwordField($model,'fPassword'); ?>
		<?php echo $form->error($model,'fPassword'); ?>
		<p class="hint">
			Hint: You may login with <tt>demo/demo</tt>.
		</p>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('登录并授权',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>
    </div>
