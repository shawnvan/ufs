<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->fItemNo=>array('view','id'=>$model->fItemNo),
	'Update',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Items')?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.item.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.item.Create')),					
						array('label'=>Yii::t('label','Copy'),'linkOptions'=>array('class'=>'current'),  'id'=>$model->fItemNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('Item.item.Copy')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.item.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="fItemNo" id="hiddenpkey" name="hiddenpkey" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
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
          <?php echo $form->labelEx($model,'fItemNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNum',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fItemNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fItemName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemType',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fItemType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
   
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fContent',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fContent'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRemark'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fRemark',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fRemark'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fResponsibleCreate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResponsibleCreate',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fResponsibleCreate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPartnerNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fPartnerNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fPartnerNo'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemIncome'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemIncome'); ?>
   
          <?php echo $form->error($model,'fItemIncome'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSetOwnership'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fSetOwnership',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fSetOwnership'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fBusinessIintroduce'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fBusinessIintroduce',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fBusinessIintroduce'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDevelopForeground'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fDevelopForeground',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fDevelopForeground'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFuturePlans'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fFuturePlans',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fFuturePlans'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fProfitForecast'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fProfitForecast',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fProfitForecast'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fFundInvest'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fFundInvest',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fFundInvest'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemRisk'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fItemRisk',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fItemRisk'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fApplicantSummary'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fApplicantSummary',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fApplicantSummary'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOtherOpinion'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fOtherOpinion',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fOtherOpinion'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fQualityOpinion'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fQualityOpinion',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fQualityOpinion'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fPresidentOpinion'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fPresidentOpinion',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fPresidentOpinion'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus'); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUserGroup'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUserGroup',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUserGroup'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTemplateNo'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Create'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->