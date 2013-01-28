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
          <?php echo $form->label($model,'fHistoryeVolution'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fHistoryeVolution',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fHistoryeVolution'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fStockeVolution'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fStockeVolution',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fStockeVolution'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fLatestGreatBusinessRecombination'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fLatestGreatBusinessRecombination',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fLatestGreatBusinessRecombination'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fLatestCorrelationTrade'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fLatestCorrelationTrade',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fLatestCorrelationTrade'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPublisherExplain'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fPublisherExplain',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fPublisherExplain'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fTeamAppraise'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fTeamAppraise',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fTeamAppraise'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->