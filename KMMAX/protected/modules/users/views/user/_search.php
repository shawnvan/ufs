<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fUserID'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUserID',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUserID'); ?>
        
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
          <?php echo $form->label($model,'fPassword'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPassword',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fPassword'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fLastName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fLastName',array('size'=>40,'maxlength'=>40)); ?>
 
          <?php echo $form->error($model,'fLastName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFirstName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFirstName',array('size'=>20,'maxlength'=>20)); ?>
 
          <?php echo $form->error($model,'fFirstName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fEmail'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fEmail',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fEmail'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fIsAdmin'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fIsAdmin'); ?>
 
          <?php echo $form->error($model,'fIsAdmin'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fIsActive'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fIsActive'); ?>
 
          <?php echo $form->error($model,'fIsActive'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fIsLog'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fIsLog'); ?>
 
          <?php echo $form->error($model,'fIsLog'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fMemo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fMemo',array('size'=>60,'maxlength'=>500)); ?>
 
          <?php echo $form->error($model,'fMemo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fStatus'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus'); ?>
 
          <?php echo $form->error($model,'fStatus'); ?>
        
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
          <?php echo $form->label($model,'fCreateUser'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUpdateDate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
 
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fUpadateUser'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUpadateUser',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUpadateUser'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->