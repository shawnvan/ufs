<?php
$this->breadcrumbs=array(
	'Groupusers',
);

$this->menu=array(
	array('label'=>'Create Groupuser', 'url'=>array('create')),
	array('label'=>'Manage Groupuser', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Groupusers</h2>

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
            		array('title'=>CHtml::encode($sort->resolveLabel('fGroupUID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fGroupID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUserID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUserName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fGroupUID'),
		array('name'=>'fGroupID'),
		array('name'=>'fUserID'),
		array('name'=>'fUserName'),
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		/*
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fGroupUID')),
		array('title'=>$sort->link('fGroupID')),
		array('title'=>$sort->link('fUserID')),
		array('title'=>$sort->link('fUserName')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		/*
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		*/
	
        ),
         		'sortname'=>'fGroupUID',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('users/groupUser/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>