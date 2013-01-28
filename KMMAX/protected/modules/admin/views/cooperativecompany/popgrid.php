<?php
$this->breadcrumbs=array(
	'CooperativeCompany',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
	function dbClickRow(rowid,status){
		if(rowid){
			var ret = grid.jqGrid('getRowData',rowid);
		     parent.$('#fUserCompanyName').val(ret.fCooperativeCompanyName);
		     parent.$('#User_fUserCompany').val(ret.fCooperativeCompanyID);
		     parent.$('#fCooperativeCompanyID').val(ret.fCooperativeCompanyID);
		     parent.$('#Cooperativepartner_fCooperativeCompanyID').val(ret.fCooperativeCompanyName);
		     parent.$('.btn-icon-search').colorbox.close('保存成功');
		}
	} 
");
?>
<div class="content-head underline">
   <h2><?php echo Yii::t('label','Cooperativecompanies') ?></h2>
 </div>
  <!-- search-box -->
   <div class="content">
    <?php
     $this->widget('application.modules.UFSBase.utils.WGrid',array(
     	'gridId'=>'company',
        'columns'=>array(
        	array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyID'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyName'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyShortName'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fStarLevel'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fType'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fKeyContacts'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fIndustry'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fMainProduct'))),
        ),
        'columnsModel'=>array(
			array('name'=>'fCooperativeCompanyID','editrules'=>'{required:true,edithidden:true}', 'hidden'=>true),
            array('name'=>'fCooperativeCompanyName','frozen'=>true),
			array('name'=>'fCooperativeCompanyShortName'),
            array('name'=>'fStarLevel'),
			array('name'=>'fType'),
			array('name'=>'fKeyContacts'),	
            array('name'=>'fIndustry'),
        	array('name'=>'fMainProduct'),
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
			array('title'=>$sort->link('fIndustry')),
            array('title'=>$sort->link('fMainProduct')),
        ),
        'sortname'=>'fCooperativeCompanyName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/Cooperativecompany/popgridData',$_GET),
    )); ?>
 </div>

	
