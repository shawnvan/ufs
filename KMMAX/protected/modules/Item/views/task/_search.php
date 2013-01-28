<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route).'/id/'.$model->fItemNo,
	'method'=>'get',
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>
		<div class="input-group">
          <?php echo $form->label($model,'fTheme'); ?>  
          <div class="inputs">
          <?php echo CHtml::textField('fTheme',$model->fTheme,array('size'=>10,'maxlength'=>50))?>     
      	</div>
      </div>
      
		<div class="input-group">
          <?php echo $form->label($model,'fCatalogueNo'); ?>
  
          <div class="inputs">
         <?php echo CHtml::textField('fCatalogueName','',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
          <?php echo $form->hiddenField($model,'fCatalogueNo',array('size'=>50,'maxlength'=>50)); ?>
          <span class="btn-icon-horizontal btn-icon-input btn-icon-search SelectCatalogue"></span>
      	</div>
      </div>
      
		<div class="input-group">
          <?php echo $form->label($model,'fStartDate'); ?>
  
          <div class="inputs">
            <?php echo CHtml::textField('fStartDate',$model->fStartDate,array('class'=>'datepicker','size'=>10,'maxlength'=>50))?>     
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fEndDate'); ?>
  
          <div class="inputs">
          <?php echo CHtml::textField('fEndDate',$model->fEndDate,array('class'=>'datepicker','size'=>10,'maxlength'=>50))?>             
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fSponsor'); ?>
  
          <div class="inputs">
          <?php echo CHtml::textField('fSponsor',$model->fSponsor,array('size'=>10,'maxlength'=>50))?>             
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fExecutor'); ?>
  
          <div class="inputs">
            <?php echo CHtml::textField('fExecutor',$model->fExecutor,array('size'=>10,'maxlength'=>50))?>        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fCreateUser'); ?>
  
          <div class="inputs">
 			<?php echo CHtml::textField('fCreateUser',$model->fCreateUser,array('size'=>10,'maxlength'=>50))?>            
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fCreateDate'); ?>
  
          <div class="inputs">
            <?php echo CHtml::textField('fCreateDate',$model->fCreateDate,array('class'=>'datepicker','size'=>10,'maxlength'=>50))?>             
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fStatus'); ?>
  
          <div class="inputs">
            <?php echo CHtml::textField('fStatus',$model->fStatus,array('size'=>10,'maxlength'=>50))?>             
      	</div>
      </div>

		<div class="input-group">
          <?php echo $form->label($model,'fStandardStatus'); ?>
  
          <div class="inputs">
            <?php echo CHtml::textField('fStandardStatus',$model->fStandardStatus,array('size'=>10,'maxlength'=>50))?>     
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Search'), array('class' =>'btn-icon submit no-margin')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Clear'), array('class' =>'btn-icon submit no-margin Clear')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->