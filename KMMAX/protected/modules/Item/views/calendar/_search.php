<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fCalendarNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCalendarNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fCalendarNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUserName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUserName',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUserName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fViewer'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fViewer',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fViewer'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fStartTime'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fStartTime'); ?>
 
          <?php echo $form->error($model,'fStartTime'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fEndTime'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fEndTime'); ?>
 
          <?php echo $form->error($model,'fEndTime'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fOtherNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fOtherNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fOtherNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fTheme'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fTheme',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fTheme'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fContent'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fContent',array('size'=>60,'maxlength'=>2000)); ?>
 
          <?php echo $form->error($model,'fContent'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fMemo'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fMemo',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fMemo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateUser'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateDate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
 
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Search'), array('class' =>'btn-icon submit no-margin Search')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Clear'), array('class' =>'btn-icon submit no-margin Clear')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->