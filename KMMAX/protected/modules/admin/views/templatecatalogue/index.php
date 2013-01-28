<?php
$this->breadcrumbs=array(
	'Templatecatalogue Copies',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2>Templatecatalogue Copies</h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List TemplatecatalogueCopy'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Index')),
						array('label'=>Yii::t('label','Create TemplatecatalogueCopy'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Create')),					
						array('label'=>Yii::t('label','Manage TemplatecatalogueCopy'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.templatecatalogueCopy.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            		array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fTemplateNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fWarnStart'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fWarnEnd'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fWarnRate'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fIsActive'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSort'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fFatherCatalogueNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUserGroup'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		*/
        ),
        'columnsModel'=>array(
 					array('name'=>'fCatalogueNo'),
		array('name'=>'fTemplateNo'),
		array('name'=>'fCatalogueName'),
		array('name'=>'fWarnStart'),
		array('name'=>'fWarnEnd'),
		array('name'=>'fWarnRate'),
		/*
		array('name'=>'fIsActive'),
		array('name'=>'fSort'),
		array('name'=>'fFatherCatalogueNo'),
		array('name'=>'fUserGroup'),
		array('name'=>'fCreateDate'),
		array('name'=>'fCreateUser'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fUpdateUser'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fCatalogueNo')),
		array('title'=>$sort->link('fTemplateNo')),
		array('title'=>$sort->link('fCatalogueName')),
		array('title'=>$sort->link('fWarnStart')),
		array('title'=>$sort->link('fWarnEnd')),
		array('title'=>$sort->link('fWarnRate')),
		/*
		array('title'=>$sort->link('fIsActive')),
		array('title'=>$sort->link('fSort')),
		array('title'=>$sort->link('fFatherCatalogueNo')),
		array('title'=>$sort->link('fUserGroup')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fUpdateUser')),
		*/
	
        ),
       'sortname'=>'fCatalogueNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/templatecatalogueCopy/gridData',$_GET),
        'modulename'=>'TemplatecatalogueCopy',
    )); ?>
</div>