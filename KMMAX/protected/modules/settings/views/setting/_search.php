<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fName',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fLabel'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fLabel',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fLabel'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fValue'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fValue',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fValue'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fDescription'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fDescription',array('size'=>60,'maxlength'=>1000)); ?>
 
          <?php echo $form->error($model,'fDescription'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fGroupName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fGroupName',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fGroupName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSequence'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fSequence'); ?>
 
          <?php echo $form->error($model,'fSequence'); ?>
        
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
          <?php echo $form->label($model,'fModule'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fModule',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fModule'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->