<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fItemNo), array('view', 'id'=>$data->fItemNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyAll1')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyAll1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyIncrease1')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyIncrease1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fDebtAll1')); ?>:</b>
	<?php echo CHtml::encode($data->fDebtAll1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fDebtIncrease1')); ?>:</b>
	<?php echo CHtml::encode($data->fDebtIncrease1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholderRights1')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholderRights1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholderRightsIncrease1')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholderRightsIncrease1); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyDebt1')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyDebt1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyDebtIncrease1')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyDebtIncrease1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fBusinessReceipt1')); ?>:</b>
	<?php echo CHtml::encode($data->fBusinessReceipt1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fBusinessReceiptIncrease1')); ?>:</b>
	<?php echo CHtml::encode($data->fBusinessReceiptIncrease1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fClearProfit1')); ?>:</b>
	<?php echo CHtml::encode($data->fClearProfit1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fClearProfitIncrease1')); ?>:</b>
	<?php echo CHtml::encode($data->fClearProfitIncrease1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockProfit1')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockProfit1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockProfitIncrease1')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockProfitIncrease1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockIncome1')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockIncome1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockIncomeIncrease1')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockIncomeIncrease1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFreeCash1')); ?>:</b>
	<?php echo CHtml::encode($data->fFreeCash1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFreeCashIncrease1')); ?>:</b>
	<?php echo CHtml::encode($data->fFreeCashIncrease1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyAll2')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyAll2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyIncrease2')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyIncrease2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fDebtAll2')); ?>:</b>
	<?php echo CHtml::encode($data->fDebtAll2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fDebtIncrease2')); ?>:</b>
	<?php echo CHtml::encode($data->fDebtIncrease2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholderRights2')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholderRights2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholderRightsIncrease2')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholderRightsIncrease2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyDebt2')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyDebt2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyDebtIncrease2')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyDebtIncrease2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fBusinessReceipt2')); ?>:</b>
	<?php echo CHtml::encode($data->fBusinessReceipt2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fBusinessReceiptIncrease2')); ?>:</b>
	<?php echo CHtml::encode($data->fBusinessReceiptIncrease2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fClearProfit2')); ?>:</b>
	<?php echo CHtml::encode($data->fClearProfit2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fClearProfitIncrease2')); ?>:</b>
	<?php echo CHtml::encode($data->fClearProfitIncrease2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockProfit2')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockProfit2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockProfitIncrease2')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockProfitIncrease2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockIncome2')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockIncome2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockIncomeIncrease2')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockIncomeIncrease2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFreeCash2')); ?>:</b>
	<?php echo CHtml::encode($data->fFreeCash2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFreeCashIncrease2')); ?>:</b>
	<?php echo CHtml::encode($data->fFreeCashIncrease2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyAll3')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyAll3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyIncrease3')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyIncrease3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fDebtAll3')); ?>:</b>
	<?php echo CHtml::encode($data->fDebtAll3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fDebtIncrease3')); ?>:</b>
	<?php echo CHtml::encode($data->fDebtIncrease3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholderRights3')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholderRights3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fShareholderRightsIncrease3')); ?>:</b>
	<?php echo CHtml::encode($data->fShareholderRightsIncrease3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyDebt3')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyDebt3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPropertyDebtIncrease3')); ?>:</b>
	<?php echo CHtml::encode($data->fPropertyDebtIncrease3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fBusinessReceipt3')); ?>:</b>
	<?php echo CHtml::encode($data->fBusinessReceipt3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fBusinessReceiptIncrease3')); ?>:</b>
	<?php echo CHtml::encode($data->fBusinessReceiptIncrease3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fClearProfit3')); ?>:</b>
	<?php echo CHtml::encode($data->fClearProfit3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fClearProfitIncrease3')); ?>:</b>
	<?php echo CHtml::encode($data->fClearProfitIncrease3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockProfit3')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockProfit3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockProfitIncrease3')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockProfitIncrease3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockIncome3')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockIncome3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPerStockIncomeIncrease3')); ?>:</b>
	<?php echo CHtml::encode($data->fPerStockIncomeIncrease3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFreeCash3')); ?>:</b>
	<?php echo CHtml::encode($data->fFreeCash3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFreeCashIncrease3')); ?>:</b>
	<?php echo CHtml::encode($data->fFreeCashIncrease3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAuditOpinion1')); ?>:</b>
	<?php echo CHtml::encode($data->fAuditOpinion1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAuditOpinion2')); ?>:</b>
	<?php echo CHtml::encode($data->fAuditOpinion2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAuditOpinion3')); ?>:</b>
	<?php echo CHtml::encode($data->fAuditOpinion3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fInvisiblePropertyRate')); ?>:</b>
	<?php echo CHtml::encode($data->fInvisiblePropertyRate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fFinanceAnalyse')); ?>:</b>
	<?php echo CHtml::encode($data->fFinanceAnalyse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAffixName1')); ?>:</b>
	<?php echo CHtml::encode($data->fAffixName1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAffixAddress1')); ?>:</b>
	<?php echo CHtml::encode($data->fAffixAddress1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAffixName2')); ?>:</b>
	<?php echo CHtml::encode($data->fAffixName2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAffixAddress2')); ?>:</b>
	<?php echo CHtml::encode($data->fAffixAddress2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAffixName3')); ?>:</b>
	<?php echo CHtml::encode($data->fAffixName3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fAffixAddress3')); ?>:</b>
	<?php echo CHtml::encode($data->fAffixAddress3); ?>
	<br />

	*/ ?>

</div>