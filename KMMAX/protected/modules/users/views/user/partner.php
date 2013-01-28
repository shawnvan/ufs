<?php
$this->breadcrumbs=array(
	'Users',
);

Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('submenu .current').click(function(){
	return false;
});
	
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Cooperativepartners')?></h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('users.user.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('users.user.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('users.user.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fUserName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLastName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fFirstName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fEmail'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fLead'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
        ),
        'columnsModel'=>array(
		array('name'=>'fUserName'),
		array('name'=>'fLastName'),
		array('name'=>'fFirstName'),
		array('name'=>'fEmail'),
		array('name'=>'fLead'),
		array('name'=>'fStatus'),
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fUpdateUser'),
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
        array('title'=>$sort->link('fUserID')),
		array('title'=>$sort->link('fUserName')),
		array('title'=>$sort->link('fPassword')),
		array('title'=>$sort->link('fLastName')),
		array('title'=>$sort->link('fFirstName')),
		array('title'=>$sort->link('fEmail')),
		array('title'=>$sort->link('fLead')),
		array('title'=>$sort->link('fStatus')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fUpdateUser')),
	
        ),
       'sortname'=>'fUserID',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('users/user/partnerData',$_GET),
        'modulename'=>'User',
    )); ?>
</div>
<?php echo $msg?>