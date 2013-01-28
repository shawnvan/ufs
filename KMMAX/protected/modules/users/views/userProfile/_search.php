<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'fUserID'); ?>
		<?php echo $form->textField($model,'fUserID',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fModelName'); ?>
		<?php echo $form->textField($model,'fModelName',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fDataGridColumn'); ?>
		<?php echo $form->textArea($model,'fDataGridColumn',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fQueryCondition'); ?>
		<?php echo $form->textArea($model,'fQueryCondition',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fCreateUser'); ?>
		<?php echo $form->textField($model,'fCreateUser',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fCreateDate'); ?>
		<?php echo $form->textField($model,'fCreateDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fUpdateUser'); ?>
		<?php echo $form->textField($model,'fUpdateUser',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fUpdateDate'); ?>
		<?php echo $form->textField($model,'fUpdateDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->