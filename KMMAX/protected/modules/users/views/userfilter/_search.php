<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fUserFilterID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUserFilterID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUserFilterID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUserID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUserID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUserID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFormID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFormID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fFormID'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fDataGridColumn'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fDataGridColumn',array('size'=>60,'maxlength'=>1000)); ?>
 
          <?php echo $form->error($model,'fDataGridColumn'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fQueryCondition'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fQueryCondition',array('size'=>60,'maxlength'=>1000)); ?>
 
          <?php echo $form->error($model,'fQueryCondition'); ?>
        
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