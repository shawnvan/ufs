<?php
$this->breadcrumbs=array(
	'Financeaccountings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Financeaccounting', 'url'=>array('index')),
	array('label'=>'Create Financeaccounting', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('financeaccounting-grid', {
		data: $(this).serialize()
	});
	return false;
});
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Financeaccountings</h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List Financeaccounting'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('Item.financeaccounting.Index')),
						array('label'=>Yii::t('label','Create Financeaccounting'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.financeaccounting.Create')),					
						array('label'=>Yii::t('label','Manage Financeaccounting'),'linkOptions'=>array('class'=>'current') ,'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.financeaccounting.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'financeaccounting-grid',
	'dataProvider'=>$model->search(),
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<div class="title-bar">'.'{summary}</div>{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'fItemNo',
		'fPropertyAll1',
		'fPropertyIncrease1',
		'fDebtAll1',
		'fDebtIncrease1',
		'fShareholderRights1',
		/*
		'fShareholderRightsIncrease1',
		'fPropertyDebt1',
		'fPropertyDebtIncrease1',
		'fBusinessReceipt1',
		'fBusinessReceiptIncrease1',
		'fClearProfit1',
		'fClearProfitIncrease1',
		'fPerStockProfit1',
		'fPerStockProfitIncrease1',
		'fPerStockIncome1',
		'fPerStockIncomeIncrease1',
		'fFreeCash1',
		'fFreeCashIncrease1',
		'fPropertyAll2',
		'fPropertyIncrease2',
		'fDebtAll2',
		'fDebtIncrease2',
		'fShareholderRights2',
		'fShareholderRightsIncrease2',
		'fPropertyDebt2',
		'fPropertyDebtIncrease2',
		'fBusinessReceipt2',
		'fBusinessReceiptIncrease2',
		'fClearProfit2',
		'fClearProfitIncrease2',
		'fPerStockProfit2',
		'fPerStockProfitIncrease2',
		'fPerStockIncome2',
		'fPerStockIncomeIncrease2',
		'fFreeCash2',
		'fFreeCashIncrease2',
		'fPropertyAll3',
		'fPropertyIncrease3',
		'fDebtAll3',
		'fDebtIncrease3',
		'fShareholderRights3',
		'fShareholderRightsIncrease3',
		'fPropertyDebt3',
		'fPropertyDebtIncrease3',
		'fBusinessReceipt3',
		'fBusinessReceiptIncrease3',
		'fClearProfit3',
		'fClearProfitIncrease3',
		'fPerStockProfit3',
		'fPerStockProfitIncrease3',
		'fPerStockIncome3',
		'fPerStockIncomeIncrease3',
		'fFreeCash3',
		'fFreeCashIncrease3',
		'fAuditOpinion1',
		'fAuditOpinion2',
		'fAuditOpinion3',
		'fInvisiblePropertyRate',
		'fFinanceAnalyse',
		'fAffixName1',
		'fAffixAddress1',
		'fAffixName2',
		'fAffixAddress2',
		'fAffixName3',
		'fAffixAddress3',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
