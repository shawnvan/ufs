<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fSSNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSSNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fSSNo'); ?>
        
      	</div>
      </div>


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
          <?php echo $form->textField($model,'fShareholderName',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fShareholderName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fShareholdingNum'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholdingNum'); ?>
 
          <?php echo $form->error($model,'fShareholdingNum'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fShareholderRate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderRate'); ?>
 
          <?php echo $form->error($model,'fShareholderRate'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->