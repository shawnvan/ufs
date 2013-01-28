<?php
$this->breadcrumbs=array(
	'Cooperativepartners',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
		
$('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Cooperativepartner/delete/id')."/'+$(this).attr('rel'),
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('admin/Cooperativepartner/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });
");
?>

<div class="content-head underline">
    <h2><?php echo Yii::t('label','Cooperativepartners') ?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativepartner.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativepartner.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativepartner.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fPartnerName'))),
        array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fRole'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fBirthday'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fPosition'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSex'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCellphone'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fEmail'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fEducationalLevel'))),
        array('title'=>CHtml::encode($sort->resolveLabel('fQq'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
        ),
        'columnsModel'=>array(   
		array('name'=>'fPartnerName'),
        array('name'=>'fCooperativeCompanyID'),
		array('name'=>'fRole'),
		array('name'=>'fBirthday'),
		array('name'=>'fPosition'),
		array('name'=>'fSex'),
		array('name'=>'fCellphone'),
		array('name'=>'fEmail'),
		array('name'=>'fEducationalLevel'),
        array('name'=>'fQq'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),	
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
		array('title'=>$sort->link('fPartnerName')),
 		array('title'=>$sort->link('fCooperativeCompanyID')),
		array('title'=>$sort->link('fRole')),
		array('title'=>$sort->link('fBirthday')),
		array('title'=>$sort->link('fPosition')),
		array('title'=>$sort->link('fSex')),
		array('title'=>$sort->link('fCellphone')),
		array('title'=>$sort->link('fEmail')),
		array('title'=>$sort->link('fEducationalLevel')),
		array('title'=>$sort->link('fQq')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
	
        ),
       'sortname'=>'fCooperativePartnerID',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/cooperativepartner/gridData',$_GET),
        'modulename'=>'Cooperativepartner',
    )); ?>
</div>