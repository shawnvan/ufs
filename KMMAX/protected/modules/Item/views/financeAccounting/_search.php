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
          <?php echo $form->label($model,'fPropertyAll1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyAll1'); ?>
 
          <?php echo $form->error($model,'fPropertyAll1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyIncrease1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyIncrease1'); ?>
 
          <?php echo $form->error($model,'fPropertyIncrease1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fDebtAll1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fDebtAll1'); ?>
 
          <?php echo $form->error($model,'fDebtAll1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fDebtIncrease1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fDebtIncrease1'); ?>
 
          <?php echo $form->error($model,'fDebtIncrease1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fShareholderRights1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderRights1'); ?>
 
          <?php echo $form->error($model,'fShareholderRights1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fShareholderRightsIncrease1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderRightsIncrease1'); ?>
 
          <?php echo $form->error($model,'fShareholderRightsIncrease1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyDebt1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyDebt1'); ?>
 
          <?php echo $form->error($model,'fPropertyDebt1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyDebtIncrease1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyDebtIncrease1'); ?>
 
          <?php echo $form->error($model,'fPropertyDebtIncrease1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fBusinessReceipt1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fBusinessReceipt1'); ?>
 
          <?php echo $form->error($model,'fBusinessReceipt1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fBusinessReceiptIncrease1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fBusinessReceiptIncrease1'); ?>
 
          <?php echo $form->error($model,'fBusinessReceiptIncrease1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fClearProfit1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fClearProfit1'); ?>
 
          <?php echo $form->error($model,'fClearProfit1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fClearProfitIncrease1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fClearProfitIncrease1'); ?>
 
          <?php echo $form->error($model,'fClearProfitIncrease1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockProfit1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockProfit1'); ?>
 
          <?php echo $form->error($model,'fPerStockProfit1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockProfitIncrease1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockProfitIncrease1'); ?>
 
          <?php echo $form->error($model,'fPerStockProfitIncrease1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockIncome1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockIncome1'); ?>
 
          <?php echo $form->error($model,'fPerStockIncome1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockIncomeIncrease1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockIncomeIncrease1'); ?>
 
          <?php echo $form->error($model,'fPerStockIncomeIncrease1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFreeCash1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFreeCash1'); ?>
 
          <?php echo $form->error($model,'fFreeCash1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFreeCashIncrease1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFreeCashIncrease1'); ?>
 
          <?php echo $form->error($model,'fFreeCashIncrease1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyAll2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyAll2'); ?>
 
          <?php echo $form->error($model,'fPropertyAll2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyIncrease2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyIncrease2'); ?>
 
          <?php echo $form->error($model,'fPropertyIncrease2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fDebtAll2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fDebtAll2'); ?>
 
          <?php echo $form->error($model,'fDebtAll2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fDebtIncrease2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fDebtIncrease2'); ?>
 
          <?php echo $form->error($model,'fDebtIncrease2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fShareholderRights2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderRights2'); ?>
 
          <?php echo $form->error($model,'fShareholderRights2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fShareholderRightsIncrease2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderRightsIncrease2'); ?>
 
          <?php echo $form->error($model,'fShareholderRightsIncrease2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyDebt2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyDebt2'); ?>
 
          <?php echo $form->error($model,'fPropertyDebt2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyDebtIncrease2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyDebtIncrease2'); ?>
 
          <?php echo $form->error($model,'fPropertyDebtIncrease2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fBusinessReceipt2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fBusinessReceipt2'); ?>
 
          <?php echo $form->error($model,'fBusinessReceipt2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fBusinessReceiptIncrease2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fBusinessReceiptIncrease2'); ?>
 
          <?php echo $form->error($model,'fBusinessReceiptIncrease2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fClearProfit2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fClearProfit2'); ?>
 
          <?php echo $form->error($model,'fClearProfit2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fClearProfitIncrease2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fClearProfitIncrease2'); ?>
 
          <?php echo $form->error($model,'fClearProfitIncrease2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockProfit2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockProfit2'); ?>
 
          <?php echo $form->error($model,'fPerStockProfit2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockProfitIncrease2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockProfitIncrease2'); ?>
 
          <?php echo $form->error($model,'fPerStockProfitIncrease2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockIncome2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockIncome2'); ?>
 
          <?php echo $form->error($model,'fPerStockIncome2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockIncomeIncrease2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockIncomeIncrease2'); ?>
 
          <?php echo $form->error($model,'fPerStockIncomeIncrease2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFreeCash2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFreeCash2'); ?>
 
          <?php echo $form->error($model,'fFreeCash2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFreeCashIncrease2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFreeCashIncrease2'); ?>
 
          <?php echo $form->error($model,'fFreeCashIncrease2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyAll3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyAll3'); ?>
 
          <?php echo $form->error($model,'fPropertyAll3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyIncrease3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyIncrease3'); ?>
 
          <?php echo $form->error($model,'fPropertyIncrease3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fDebtAll3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fDebtAll3'); ?>
 
          <?php echo $form->error($model,'fDebtAll3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fDebtIncrease3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fDebtIncrease3'); ?>
 
          <?php echo $form->error($model,'fDebtIncrease3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fShareholderRights3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderRights3'); ?>
 
          <?php echo $form->error($model,'fShareholderRights3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fShareholderRightsIncrease3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fShareholderRightsIncrease3'); ?>
 
          <?php echo $form->error($model,'fShareholderRightsIncrease3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyDebt3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyDebt3'); ?>
 
          <?php echo $form->error($model,'fPropertyDebt3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPropertyDebtIncrease3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPropertyDebtIncrease3'); ?>
 
          <?php echo $form->error($model,'fPropertyDebtIncrease3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fBusinessReceipt3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fBusinessReceipt3'); ?>
 
          <?php echo $form->error($model,'fBusinessReceipt3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fBusinessReceiptIncrease3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fBusinessReceiptIncrease3'); ?>
 
          <?php echo $form->error($model,'fBusinessReceiptIncrease3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fClearProfit3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fClearProfit3'); ?>
 
          <?php echo $form->error($model,'fClearProfit3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fClearProfitIncrease3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fClearProfitIncrease3'); ?>
 
          <?php echo $form->error($model,'fClearProfitIncrease3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockProfit3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockProfit3'); ?>
 
          <?php echo $form->error($model,'fPerStockProfit3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockProfitIncrease3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockProfitIncrease3'); ?>
 
          <?php echo $form->error($model,'fPerStockProfitIncrease3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockIncome3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockIncome3'); ?>
 
          <?php echo $form->error($model,'fPerStockIncome3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fPerStockIncomeIncrease3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fPerStockIncomeIncrease3'); ?>
 
          <?php echo $form->error($model,'fPerStockIncomeIncrease3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFreeCash3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFreeCash3'); ?>
 
          <?php echo $form->error($model,'fFreeCash3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFreeCashIncrease3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fFreeCashIncrease3'); ?>
 
          <?php echo $form->error($model,'fFreeCashIncrease3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAuditOpinion1'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fAuditOpinion1',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fAuditOpinion1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAuditOpinion2'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fAuditOpinion2',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fAuditOpinion2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAuditOpinion3'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fAuditOpinion3',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fAuditOpinion3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fInvisiblePropertyRate'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fInvisiblePropertyRate'); ?>
 
          <?php echo $form->error($model,'fInvisiblePropertyRate'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fFinanceAnalyse'); ?>
  
          <div class="inputs">
          <?php echo $form->textArea($model,'fFinanceAnalyse',array('rows'=>6, 'cols'=>50)); ?>
 
          <?php echo $form->error($model,'fFinanceAnalyse'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAffixName1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAffixName1',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fAffixName1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAffixAddress1'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAffixAddress1',array('size'=>60,'maxlength'=>500)); ?>
 
          <?php echo $form->error($model,'fAffixAddress1'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAffixName2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAffixName2',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fAffixName2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAffixAddress2'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAffixAddress2',array('size'=>60,'maxlength'=>500)); ?>
 
          <?php echo $form->error($model,'fAffixAddress2'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAffixName3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAffixName3',array('size'=>60,'maxlength'=>200)); ?>
 
          <?php echo $form->error($model,'fAffixName3'); ?>
        
      	</div>
      </div>


		<div class="input-group">
          <?php echo $form->label($model,'fAffixAddress3'); ?>
  
          <div class="inputs">
          <?php echo $form->textField($model,'fAffixAddress3',array('size'=>60,'maxlength'=>500)); ?>
 
          <?php echo $form->error($model,'fAffixAddress3'); ?>
        
      	</div>
      </div>


	<div class="row buttons">
	</div>
<div class="form-submit">
		<?php echo CHtml::submitButton('Search', array('class' =>'btn-icon submit no-margin' , )); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->