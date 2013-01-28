<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fRecordNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fRecordNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fRecordNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fRecordUser'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fRecordUser',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fRecordUser'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fRecordDate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fRecordDate'); ?>
 
          <?php echo $form->error($model,'fRecordDate'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPlan'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fPlan',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fPlan'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fResult'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fResult',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fResult'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSummary'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fSummary',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fSummary'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fEvaluate'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fEvaluate',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fEvaluate'); ?>
        
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


		<div class="input-group">
          <?php echo $form->label($model,'fUpdateUser'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUpdateDate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
 
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->