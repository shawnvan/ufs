<?php
$this->breadcrumbs=array(
	'Codeheaders',
);

$this->menu=array(
	array('label'=>'Create Codeheader', 'url'=>array('create')),
	array('label'=>'Manage Codeheader', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Codeheaders</h2>

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
            		array('title'=>CHtml::encode($sort->resolveLabel('fListName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fDescription'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
        ),
        'columnsModel'=>array(
 					array('name'=>'fListName'),
		array('name'=>'fDescription'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fUpdateUser'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fListName')),
		array('title'=>$sort->link('fDescription')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fUpdateUser')),
	
        ),
         		'sortname'=>'fListName',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('settings/codeheader/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>