<div class="page">
    <div class="datagrid-box">
    <?php
     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
           array('title'=>CHtml::encode($sort->resolveLabel('fItemNum'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fItemName'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fItemType'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fResponsibleCreate'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fItemNum','frozen'=>true),
			array('name'=>'fItemName'),
			array('name'=>'fItemType'),
            array('name'=>'fResponsibleCreate'),
			array('name'=>'fCreateUser'),
        	array('name'=>'fCreateDate'),
			array('name'=>'fUpdateUser'),	
        	array('name'=>'fCreateDate'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
           array('title'=>$sort->link('fItemNum')),
			array('title'=>$sort->link('fItemName')),
			array('title'=>$sort->link('fItemType')),
            array('title'=>$sort->link('fResponsibleCreate')),
			array('title'=>$sort->link('fCreateUser')),
			array('title'=>$sort->link('fCreateDate')),
        	array('title'=>$sort->link('fUpdateUser')),
        	array('title'=>$sort->link('fCreateDate')),
        ),
        'sortname'=>'fTypeName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/Item/commongridData',$_GET),
    )); ?>
    </div>
 </div>

	
