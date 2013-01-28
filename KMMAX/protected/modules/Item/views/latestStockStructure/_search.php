<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fItemNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fItemNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fHistoryNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fHistoryNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fHistoryNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fShareholderName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderName',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fShareholderName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFristStrands'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFristStrands'); ?>
 
          <?php echo $form->error($model,'fFristStrands'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFristRate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFristRate'); ?>
 
          <?php echo $form->error($model,'fFristRate'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSecondStrands'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSecondStrands'); ?>
 
          <?php echo $form->error($model,'fSecondStrands'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSecondRate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSecondRate'); ?>
 
          <?php echo $form->error($model,'fSecondRate'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fThirdStrands'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fThirdStrands'); ?>
 
          <?php echo $form->error($model,'fThirdStrands'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fThirdRate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fThirdRate'); ?>
 
          <?php echo $form->error($model,'fThirdRate'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->