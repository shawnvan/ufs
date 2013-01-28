<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->fItemNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('textarea').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyItem').attr('href',$('#CopyItem').attr('href')+'/id/".$keyid."');
$('#UpdateItem').attr('href',$('#UpdateItem').attr('href')+'/id/".$keyid."');

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
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyItem'),'id'=>$model->fItemNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('Item.item.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateItem'),'id'=>$model->fItemNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('Item.item.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fItemNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('Item.item.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.item.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

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
          <?php echo $form->labelEx($model,'fResponsibleCreate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResponsibleCreate',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fResponsibleCreate'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTemplateNo'); ?>
        
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

<?php $this->endWidget(); ?>
<div id="tabs" class="tabs">
	    <ul>
	        <li><a href="#tabs-0"><?php echo Yii::t('label','基本信息');?></a></li>
	        <li><a href="#tabs-1"><?php echo Yii::t('label','历史情况');?></a></li>
	        <li><a href="#tabs-2"><?php echo Yii::t('label','财务与会计');?></a></li>
	        <li><a href="#tabs-3"><?php echo Yii::t('label','发行人情况');?></a></li>
	        <li><a href="#tabs-4"><?php echo Yii::t('label','发展前景和募集资金运用');?></a></li>
	        <li><a href="#tabs-5"><?php echo Yii::t('label','审核意见');?></a></li>
	    </ul>
	    <div id="tabs-0" class="tabs-panel">
	   <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'history-form',
				'enableAjaxValidation'=>false,
				'action'=>Yii::app()->createUrl('Item/item/update/id/'.$model->fItemNo),
				'htmlOptions'=>array('class'=>'removeborder horizontal-form'),
			)); ?>

      <p class="note">Fields with <span class="required">*</span> are required.</p>
	       <?php echo $form->errorSummary($model); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCompanyName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCompanyName',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($model,'fCompanyName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCompanyaddress'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCompanyaddress',array('size'=>60,'maxlength'=>1000)); ?>
   
          <?php echo $form->error($model,'fCompanyaddress'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fContactor'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fContactor',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fContactor'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCapitalAuthority'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCapitalAuthority'); ?>
   
          <?php echo $form->error($model,'fCapitalAuthority'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fSetTime'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fSetTime'); ?>
   
          <?php echo $form->error($model,'fSetTime'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCompanyType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCompanyType',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCompanyType'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fLegalRepresentative'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fLegalRepresentative',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fLegalRepresentative'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fIndustry'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fIndustry',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fIndustry'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fBusiness'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fBusiness',array('size'=>60,'maxlength'=>2000)); ?>
   
          <?php echo $form->error($model,'fBusiness'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fProduct'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fProduct',array('size'=>60,'maxlength'=>2000)); ?>
   
          <?php echo $form->error($model,'fProduct'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShareholder'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholder',array('size'=>60,'maxlength'=>1000)); ?>
   
          <?php echo $form->error($model,'fShareholder'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShareholdeRatio'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholdeRatio'); ?>
   
          <?php echo $form->error($model,'fShareholdeRatio'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fRealityMan'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fRealityMan',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fRealityMan'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fShareholderBackground'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fShareholderBackground',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fShareholderBackground'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fProjectSituation'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fProjectSituation',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fProjectSituation'); ?>
        
      	</div>
      </div>

      <div class="input-group">
          <?php echo $form->labelEx($model,'fItemIncome'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemIncome'); ?>
   
          <?php echo $form->error($model,'fItemIncome'); ?>
        
      	</div>
      </div>
      
	<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
	<?php $this->endWidget(); ?>
	    </div>
	    <div id="tabs-1" class="tabs-panel">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'history-form',
				'enableAjaxValidation'=>false,
				'action'=>Yii::app()->createUrl('Item/history/update/id/'.$history->fHistoryNo),
				'htmlOptions'=>array('class'=>'removeborder horizontal-form'),
			)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($history); ?>

          <?php echo $form->hiddenField($history,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>

          <?php echo $form->hiddenField($history,'fHistoryNo',array('size'=>50,'maxlength'=>50)); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($history,'fHistoryeVolution'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($history,'fHistoryeVolution',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($history,'fHistoryeVolution'); ?>
        
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
          <?php echo $form->labelEx($history,'fStockeVolution'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($history,'fStockeVolution',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($history,'fStockeVolution'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($history,'fLatestGreatBusinessRecombination'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($history,'fLatestGreatBusinessRecombination',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($history,'fLatestGreatBusinessRecombination'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($history,'fLatestCorrelationTrade'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($history,'fLatestCorrelationTrade',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($history,'fLatestCorrelationTrade'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($history,'fPublisherExplain'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($history,'fPublisherExplain',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($history,'fPublisherExplain'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($history,'fTeamAppraise'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($history,'fTeamAppraise',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($history,'fTeamAppraise'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
			
<?php $this->endWidget(); ?>
			
	    </div>
	    <div id="tabs-2" class="tabs-panel">
			<?php $form=$this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl('Item/financeaccounting/update/id/'.$model->fItemNo),
			'id'=>'financeaccounting-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('class'=>'horizontal-form removeborder'),
		)); ?>

          <?php echo $form->hiddenField($financeAccounting,'fItemNo',array('size'=>50,'maxlength'=>50)); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyAll1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyAll1'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyAll1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyIncrease1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyIncrease1'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyIncrease1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fDebtAll1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fDebtAll1'); ?>
   
          <?php echo $form->error($financeAccounting,'fDebtAll1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fDebtIncrease1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fDebtIncrease1'); ?>
   
          <?php echo $form->error($financeAccounting,'fDebtIncrease1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fShareholderRights1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fShareholderRights1'); ?>
   
          <?php echo $form->error($financeAccounting,'fShareholderRights1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fShareholderRightsIncrease1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fShareholderRightsIncrease1'); ?>
   
          <?php echo $form->error($financeAccounting,'fShareholderRightsIncrease1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyDebt1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyDebt1'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyDebt1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyDebtIncrease1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyDebtIncrease1'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyDebtIncrease1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fBusinessReceipt1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fBusinessReceipt1'); ?>
   
          <?php echo $form->error($financeAccounting,'fBusinessReceipt1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fBusinessReceiptIncrease1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fBusinessReceiptIncrease1'); ?>
   
          <?php echo $form->error($financeAccounting,'fBusinessReceiptIncrease1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fClearProfit1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fClearProfit1'); ?>
   
          <?php echo $form->error($financeAccounting,'fClearProfit1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fClearProfitIncrease1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fClearProfitIncrease1'); ?>
   
          <?php echo $form->error($financeAccounting,'fClearProfitIncrease1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockProfit1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockProfit1'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockProfit1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockProfitIncrease1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockProfitIncrease1'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockProfitIncrease1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockIncome1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockIncome1'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockIncome1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockIncomeIncrease1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockIncomeIncrease1'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockIncomeIncrease1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fFreeCash1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fFreeCash1'); ?>
   
          <?php echo $form->error($financeAccounting,'fFreeCash1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fFreeCashIncrease1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fFreeCashIncrease1'); ?>
   
          <?php echo $form->error($financeAccounting,'fFreeCashIncrease1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyAll2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyAll2'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyAll2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyIncrease2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyIncrease2'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyIncrease2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fDebtAll2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fDebtAll2'); ?>
   
          <?php echo $form->error($financeAccounting,'fDebtAll2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fDebtIncrease2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fDebtIncrease2'); ?>
   
          <?php echo $form->error($financeAccounting,'fDebtIncrease2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fShareholderRights2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fShareholderRights2'); ?>
   
          <?php echo $form->error($financeAccounting,'fShareholderRights2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fShareholderRightsIncrease2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fShareholderRightsIncrease2'); ?>
   
          <?php echo $form->error($financeAccounting,'fShareholderRightsIncrease2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyDebt2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyDebt2'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyDebt2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyDebtIncrease2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyDebtIncrease2'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyDebtIncrease2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fBusinessReceipt2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fBusinessReceipt2'); ?>
   
          <?php echo $form->error($financeAccounting,'fBusinessReceipt2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fBusinessReceiptIncrease2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fBusinessReceiptIncrease2'); ?>
   
          <?php echo $form->error($financeAccounting,'fBusinessReceiptIncrease2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fClearProfit2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fClearProfit2'); ?>
   
          <?php echo $form->error($financeAccounting,'fClearProfit2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fClearProfitIncrease2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fClearProfitIncrease2'); ?>
   
          <?php echo $form->error($financeAccounting,'fClearProfitIncrease2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockProfit2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockProfit2'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockProfit2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockProfitIncrease2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockProfitIncrease2'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockProfitIncrease2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockIncome2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockIncome2'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockIncome2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockIncomeIncrease2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockIncomeIncrease2'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockIncomeIncrease2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fFreeCash2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fFreeCash2'); ?>
   
          <?php echo $form->error($financeAccounting,'fFreeCash2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fFreeCashIncrease2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fFreeCashIncrease2'); ?>
   
          <?php echo $form->error($financeAccounting,'fFreeCashIncrease2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyAll3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyAll3'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyAll3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyIncrease3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyIncrease3'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyIncrease3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fDebtAll3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fDebtAll3'); ?>
   
          <?php echo $form->error($financeAccounting,'fDebtAll3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fDebtIncrease3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fDebtIncrease3'); ?>
   
          <?php echo $form->error($financeAccounting,'fDebtIncrease3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fShareholderRights3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fShareholderRights3'); ?>
   
          <?php echo $form->error($financeAccounting,'fShareholderRights3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fShareholderRightsIncrease3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fShareholderRightsIncrease3'); ?>
   
          <?php echo $form->error($financeAccounting,'fShareholderRightsIncrease3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyDebt3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyDebt3'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyDebt3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPropertyDebtIncrease3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPropertyDebtIncrease3'); ?>
   
          <?php echo $form->error($financeAccounting,'fPropertyDebtIncrease3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fBusinessReceipt3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fBusinessReceipt3'); ?>
   
          <?php echo $form->error($financeAccounting,'fBusinessReceipt3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fBusinessReceiptIncrease3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fBusinessReceiptIncrease3'); ?>
   
          <?php echo $form->error($financeAccounting,'fBusinessReceiptIncrease3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fClearProfit3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fClearProfit3'); ?>
   
          <?php echo $form->error($financeAccounting,'fClearProfit3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fClearProfitIncrease3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fClearProfitIncrease3'); ?>
   
          <?php echo $form->error($financeAccounting,'fClearProfitIncrease3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockProfit3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockProfit3'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockProfit3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockProfitIncrease3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockProfitIncrease3'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockProfitIncrease3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockIncome3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockIncome3'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockIncome3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fPerStockIncomeIncrease3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fPerStockIncomeIncrease3'); ?>
   
          <?php echo $form->error($financeAccounting,'fPerStockIncomeIncrease3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fFreeCash3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fFreeCash3'); ?>
   
          <?php echo $form->error($financeAccounting,'fFreeCash3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fFreeCashIncrease3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fFreeCashIncrease3'); ?>
   
          <?php echo $form->error($financeAccounting,'fFreeCashIncrease3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fAuditOpinion1'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($financeAccounting,'fAuditOpinion1',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($financeAccounting,'fAuditOpinion1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fAuditOpinion2'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($financeAccounting,'fAuditOpinion2',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($financeAccounting,'fAuditOpinion2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fAuditOpinion3'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($financeAccounting,'fAuditOpinion3',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($financeAccounting,'fAuditOpinion3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fInvisiblePropertyRate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fInvisiblePropertyRate'); ?>
   
          <?php echo $form->error($financeAccounting,'fInvisiblePropertyRate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fFinanceAnalyse'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($financeAccounting,'fFinanceAnalyse',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($financeAccounting,'fFinanceAnalyse'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fAffixName1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fAffixName1',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($financeAccounting,'fAffixName1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fAffixAddress1'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fAffixAddress1',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($financeAccounting,'fAffixAddress1'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fAffixName2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fAffixName2',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($financeAccounting,'fAffixName2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fAffixAddress2'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fAffixAddress2',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($financeAccounting,'fAffixAddress2'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fAffixName3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fAffixName3',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($financeAccounting,'fAffixName3'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($financeAccounting,'fAffixAddress3'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($financeAccounting,'fAffixAddress3',array('size'=>60,'maxlength'=>500)); ?>
   
          <?php echo $form->error($financeAccounting,'fAffixAddress3'); ?>
        
      	</div>
      </div>

	<div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>

   <?php $this->endWidget(); ?>
			
	    </div>
	    <div id="tabs-3" class="tabs-panel">
	       <?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'horizontal-form removeborder'),
	 )); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	   <?php echo $form->errorSummary($model); ?>

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
          <?php $this->endWidget(); ?>
			
	    </div>
	    <div id="tabs-4" class="tabs-panel">
	    <?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'horizontal-form removeborder'),
	 )); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	   <?php echo $form->errorSummary($model); ?>

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


          <?php $this->endWidget(); ?>
	    </div>
		<div id="tabs-5" class="tabs-panel">
	      <?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'horizontal-form removeborder'),
	 )); ?>

	      
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
          <?php $this->endWidget(); ?>
	    </div>
	</div>
</div><!-- form -->
	      <?php echo $msg ?>>