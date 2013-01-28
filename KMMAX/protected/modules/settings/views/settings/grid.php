<div class="page">
  
  <div class="datagrid-box">
    <?php
     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            array('title'=>CHtml::encode($sort->resolveLabel('fName'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fLabel'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fValue'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fGroupName'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fName','frozen'=>true),
            array('name'=>'fLabel'),
            array('name'=>'fValue'),
            array('name'=>'fGroupName'),
        ),
        'pages'=>$pages,
        'sColumns'=>array(
            array('title'=>$sort->link('fName')),
            array('title'=>$sort->link('fLabel')),
            array('title'=>$sort->link('fValue')),
            array('title'=>$sort->link('fGroupName')),
        ),
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sortname'=>'fName',
        'sortorder'=>'asc',
		'grouping'=>'true',
   		'groupField'=>'fGroupName',
        'url'=>Yii::app()->createUrl('settings/settings/gridData',$_GET),
        'modulename'=>'Settings',
    )); ?>
  </div>
</div>
