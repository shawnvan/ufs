<?php
$this->breadcrumbs=array(
	'Contacts',
);

$this->menu=array(
	array('label'=>'Create Contacts', 'url'=>array('create')),
	array('label'=>'Manage Contacts', 'url'=>array('admin')),
);
?>

<div class="content-head underline">
   			<h2>Contacts</h2>

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
            		array('title'=>CHtml::encode($sort->resolveLabel('fContactID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fContactName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fFristName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLastName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fContactTitle'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCompany'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fPhone'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fPhone2'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fEmail'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fWebsite'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fAddress'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fAddress2'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCity'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fState'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fZipCode'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCountry'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fVisibility'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fAssignedTo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fBackGroundInfo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fQQ'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLinkedIn'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fMSN'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpadateUser'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fContactID'),
		array('name'=>'fContactName'),
		array('name'=>'fFristName'),
		array('name'=>'fLastName'),
		array('name'=>'fContactTitle'),
		array('name'=>'fCompany'),
		/*
		array('name'=>'fPhone'),
		array('name'=>'fPhone2'),
		array('name'=>'fEmail'),
		array('name'=>'fWebsite'),
		array('name'=>'fAddress'),
		array('name'=>'fAddress2'),
		array('name'=>'fCity'),
		array('name'=>'fState'),
		array('name'=>'fZipCode'),
		array('name'=>'fCountry'),
		array('name'=>'fVisibility'),
		array('name'=>'fAssignedTo'),
		array('name'=>'fBackGroundInfo'),
		array('name'=>'fQQ'),
		array('name'=>'fLinkedIn'),
		array('name'=>'fMSN'),
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fUpadateUser'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fContactID')),
		array('title'=>$sort->link('fContactName')),
		array('title'=>$sort->link('fFristName')),
		array('title'=>$sort->link('fLastName')),
		array('title'=>$sort->link('fContactTitle')),
		array('title'=>$sort->link('fCompany')),
		/*
		array('title'=>$sort->link('fPhone')),
		array('title'=>$sort->link('fPhone2')),
		array('title'=>$sort->link('fEmail')),
		array('title'=>$sort->link('fWebsite')),
		array('title'=>$sort->link('fAddress')),
		array('title'=>$sort->link('fAddress2')),
		array('title'=>$sort->link('fCity')),
		array('title'=>$sort->link('fState')),
		array('title'=>$sort->link('fZipCode')),
		array('title'=>$sort->link('fCountry')),
		array('title'=>$sort->link('fVisibility')),
		array('title'=>$sort->link('fAssignedTo')),
		array('title'=>$sort->link('fBackGroundInfo')),
		array('title'=>$sort->link('fQQ')),
		array('title'=>$sort->link('fLinkedIn')),
		array('title'=>$sort->link('fMSN')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fUpadateUser')),
		*/
	
        ),
         		'sortname'=>'fContactID',
	
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('users/contacts/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>