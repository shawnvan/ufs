<?php
$this->breadcrumbs=array(
	'Histories',
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
                		array('label'=>Yii::t('label','List History'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.history.Index')),
						array('label'=>Yii::t('label','Create History'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.history.Create')),					
						array('label'=>Yii::t('label','Manage History'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.history.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fItemNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fHistoryNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fHistoryeVolution'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStockeVolution'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLatestGreatBusinessRecombination'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLatestCorrelationTrade'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fPublisherExplain'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fTeamAppraise'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fItemNo'),
		array('name'=>'fHistoryNo'),
		array('name'=>'fHistoryeVolution'),
		array('name'=>'fStockeVolution'),
		array('name'=>'fLatestGreatBusinessRecombination'),
		array('name'=>'fLatestCorrelationTrade'),
		/*
		array('name'=>'fPublisherExplain'),
		array('name'=>'fTeamAppraise'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fItemNo')),
		array('title'=>$sort->link('fHistoryNo')),
		array('title'=>$sort->link('fHistoryeVolution')),
		array('title'=>$sort->link('fStockeVolution')),
		array('title'=>$sort->link('fLatestGreatBusinessRecombination')),
		array('title'=>$sort->link('fLatestCorrelationTrade')),
		/*
		array('title'=>$sort->link('fPublisherExplain')),
		array('title'=>$sort->link('fTeamAppraise')),
		*/
	
        ),
       'sortname'=>'fHistoryNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/history/gridData',$_GET),
        'modulename'=>'History',
    )); ?>
</div>