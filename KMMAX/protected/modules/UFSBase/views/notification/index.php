<?php
$this->breadcrumbs=array(
	'Notifications',
);

$this->menu=array(
	array('label'=>'Create Notification', 'url'=>array('create')),
	array('label'=>'Manage Notification', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Notifications</h2>

			<div class="content-action">
			<ul class="submenu">
				<li class="current"><a href="">添加用户</a></li>
				<li><a href="">修改用户</a></li>
				<li><a href="">复制用户</a></li><li><a href="">查看用户</a></li>
			</ul>
			</div>
   			
   		</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fNotifyID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fComparison'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fValue'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fModelType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fModelID'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fFieldName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUserName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUserID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreatedBy'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fViewed'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fNotifyID'),
		array('name'=>'fType'),
		array('name'=>'fComparison'),
		array('name'=>'fValue'),
		array('name'=>'fModelType'),
		array('name'=>'fModelID'),
		/*
		array('name'=>'fFieldName'),
		array('name'=>'fUserName'),
		array('name'=>'fUserID'),
		array('name'=>'fCreatedBy'),
		array('name'=>'fViewed'),
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fNotifyID')),
		array('title'=>$sort->link('fType')),
		array('title'=>$sort->link('fComparison')),
		array('title'=>$sort->link('fValue')),
		array('title'=>$sort->link('fModelType')),
		array('title'=>$sort->link('fModelID')),
		/*
		array('title'=>$sort->link('fFieldName')),
		array('title'=>$sort->link('fUserName')),
		array('title'=>$sort->link('fUserID')),
		array('title'=>$sort->link('fCreatedBy')),
		array('title'=>$sort->link('fViewed')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		*/
	
        ),
         		'sortname'=>'fNotifyID',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('UFSBase/notification/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>