<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

		<div class="input-group">
          <?php echo $form->label($model,'fCatalogueNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fCatalogueNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCatalogueName'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fCatalogueName',array('size'=>60,'maxlength'=>100)); ?>
 
          <?php echo $form->error($model,'fCatalogueName'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFatherCatalogueNo'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFatherCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fFatherCatalogueNo'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fStatus'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fStatus'); ?>
        
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


		<div class="input-group">
          <?php echo $form->label($model,'fUserGroup'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fUserGroup',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fUserGroup'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fMemo1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fMemo1',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fMemo1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fMemo2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fMemo2',array('size'=>50,'maxlength'=>50)); ?>
 
          <?php echo $form->error($model,'fMemo2'); ?>
        
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