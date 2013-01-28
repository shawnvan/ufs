<?php
$this->breadcrumbs=array(
	'Histories'=>array('index'),
	'Create',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>
<div class="content-head underline">
<h2>Histories</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List History'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.history.Index')),
						array('label'=>Yii::t('label','Create History'), 'url'=>array('create'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.history.Create')),					
						array('label'=>Yii::t('label','Manage History'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.history.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<input type="hidden" value="fHistoryNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'history-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fItemNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fHistoryNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fHistoryNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fHistoryNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fHistoryeVolution'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fHistoryeVolution',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fHistoryeVolution'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStockeVolution'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fStockeVolution',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fStockeVolution'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLatestGreatBusinessRecombination'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fLatestGreatBusinessRecombination',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fLatestGreatBusinessRecombination'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLatestCorrelationTrade'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fLatestCorrelationTrade',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fLatestCorrelationTrade'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPublisherExplain'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fPublisherExplain',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fPublisherExplain'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTeamAppraise'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fTeamAppraise',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fTeamAppraise'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->