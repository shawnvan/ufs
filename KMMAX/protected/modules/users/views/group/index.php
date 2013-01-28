<?php
$this->breadcrumbs=array(
	'Groups',
);

$this->menu=array(
	array('label'=>'Create Group', 'url'=>array('create')),
	array('label'=>'Manage Group', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Groups</h2>

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
            		array('title'=>CHtml::encode($sort->resolveLabel('fGroupID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fGroupName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fDescription'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fGroupID'),
		array('name'=>'fGroupName'),
		array('name'=>'fDescription'),
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fUpdateUser'),
		/*
		array('name'=>'fUpdateDate'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fGroupID')),
		array('title'=>$sort->link('fGroupName')),
		array('title'=>$sort->link('fDescription')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateUser')),
		/*
		array('title'=>$sort->link('fUpdateDate')),
		*/
	
        ),
         		'sortname'=>'fGroupID',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('users/group/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>