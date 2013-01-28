<?php
$this->breadcrumbs=array(
	'Cooperativecompanies',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Cooperativecompanies') ?></h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativecompany.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativecompany.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.cooperativecompany.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
 <?php
    $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
    Yii::app()->clientScript->registerScript('search', "
		jQuery('.close').click(function(){
			jQuery('.form-table-search-more').toggle();
		});

     $('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Cooperativecompany/delete/id')."/'+$(this).attr('rel'),
				  success: function(data){
                	alert(data);
				    var urlindex='".Yii::app()->createUrl('admin/Cooperativecompany/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });

	");
    ?>
<div class="content">

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
        array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyID'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyShortName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStarLevel'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fType'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fKeyContacts'))),
		/*
		array('title'=>CHtml::encode($sort->resolveLabel('fCity'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fIndustry'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fDownIndustry'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fOnIndustry'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fMainProduct'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fWebSite'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fZipCode'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fMaintenanceEmployee'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fMemo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUserGroup'))),
		*/
        ),
        'columnsModel'=>array(
 		array('name'=>'fCooperativeCompanyID','editrules'=>'{required:true,edithidden:true}', 'hidden'=>true),
		array('name'=>'fCooperativeCompanyName'),
		array('name'=>'fCooperativeCompanyShortName'),
		array('name'=>'fStarLevel'),
		array('name'=>'fType'),
		array('name'=>'fKeyContacts'),
		/*
		array('name'=>'fCity'),
		array('name'=>'fIndustry'),
		array('name'=>'fDownIndustry'),
		array('name'=>'fOnIndustry'),
		array('name'=>'fMainProduct'),
		array('name'=>'fWebSite'),
		array('name'=>'fZipCode'),
		array('name'=>'fMaintenanceEmployee'),
		array('name'=>'fMemo'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fUserGroup'),
		*/
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            		array('title'=>$sort->link('fCooperativeCompanyID')),
		array('title'=>$sort->link('fCooperativeCompanyName')),
		array('title'=>$sort->link('fCooperativeCompanyShortName')),
		array('title'=>$sort->link('fStarLevel')),
		array('title'=>$sort->link('fType')),
		array('title'=>$sort->link('fKeyContacts')),
		/*
		array('title'=>$sort->link('fCity')),
		array('title'=>$sort->link('fIndustry')),
		array('title'=>$sort->link('fDownIndustry')),
		array('title'=>$sort->link('fOnIndustry')),
		array('title'=>$sort->link('fMainProduct')),
		array('title'=>$sort->link('fWebSite')),
		array('title'=>$sort->link('fZipCode')),
		array('title'=>$sort->link('fMaintenanceEmployee')),
		array('title'=>$sort->link('fMemo')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdateUser')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fUserGroup')),
		*/
	
        ),
       'sortname'=>'fCooperativeCompanyID',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/cooperativecompany/gridData',$_GET),
        'modulename'=>'Cooperativecompany',
    )); ?>
</div>
<?php echo $msg?>