<?php
$this->breadcrumbs=array(
	'Tasks',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.clear').click(function(){
	$('input:text').val('');
	return false;
});			
jQuery('.datepicker').datepicker().datepicker('option', 'dateFormat','yy-mm-dd');		
$('#CreateTask').attr('href',$('#CreateTask').attr('href')+'/id/".$keyid."');
$('#ListTask').attr('href',$('#ListTask').attr('href')+'/id/".$keyid."');
$('#ManageTask').attr('href',$('#ManageTask').attr('href')+'/id/".$keyid."');
$('.SelectCatalogue').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('Item/Itemcatalogue/popgrid')."/id/'+jQuery('#hiddenpkey').val();
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {}});
    return false;
 })		
$('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/task/delete/id')."/'+$(this).attr('rel'),
				  type:'POST',
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('Item/task/gridData')."';
				    var url=urlindex +'/id/'+jQuery('#hiddenpkey').val();
					gridReload(url);
				  }
			 });		
    	}
  		return false;
     });
				    		
     function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
		var noteid=noteid+'_span';
		jQuery('#ztree-checked-note').val(noteid);
		 jQuery('#treeId').val(treeId);
		jQuery.ajax({				
		  cache: false,
		  success: function(html){
		    var urlindex='".Yii::app()->createUrl('Item/task/griddata')."';
			var url=urlindex +'/cno/'+treeId +'/id/'+jQuery('#hiddenpkey').val();
			gridReload(url);
		  }
		});		
	}				    		
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Tasks')?></h2>
<input type="hidden" value="<?php echo $keyid?>" id="hiddenpkey" name="hiddenpkey" />
<input type="hidden" id=treeId name="hiddenpkey" />
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('id'=>'ListTask','class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.task.Index')),
						array('label'=>Yii::t('label','Create'), 'linkOptions'=>array('id'=>'CreateTask'),'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('Item.task.Create')),					
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'linkOptions'=>array('id'=>'ManageTask'),'visible'=>Yii::app()->user->checkAccess('Item.task.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 <ul id="treeDemo" class="tree el-finder-tree"></ul>
          <?php 
		       $this->widget('application.extensions.ztree.zTree',array(
			  'treeNodeNameKey'=>'name',
			  'treeNodeKey'=>'id',
			  'treeNodeParentKey'=>'pId',
		      'htmlOptions'=>array('id'=>'fe'),
			  'options'=>array(
				'expandSpeed'=>'slow',//设置为慢速显示动画效果
				'autoCancelSelected'=>false,//禁止配合 Ctrl 键进行取消节点选择的操作
				'dblClickExpand'=>false,//取消默认双击展开父节点的功能
				'showIcon'=>true,//设置 zTree 不显示图标
				'showTitle'=>true,//设置 zTree 不显示提示信息
			   'showLine'=>true,
		       	'keepParent'=>false,//锁定父节点
		       	'keepLeaf'=>false,//锁定叶子节点       
				'callback'=>array(
                    'OnRightClick'=>"js:function(event,treeId, treeNode) {alert('test');}",
					'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
		       ),
	),
	'data'=>$dataNode
));

?>

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fTheme'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStartDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fEndDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSponsor'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fExecutor'))),
		
		array('title'=>CHtml::encode($sort->resolveLabel('fSchedule'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fPriority'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fWarnFrequency'))),
        		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
        		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fStandardStatus'))),
        ),
        'columnsModel'=>array(
		array('name'=>'fTheme'),
		array('name'=>'fCatalogueNo'),
		array('name'=>'fStartDate'),
		array('name'=>'fEndDate'),
		array('name'=>'fSponsor'),
		array('name'=>'fExecutor'),
		array('name'=>'fSchedule'),
		array('name'=>'fStatus'),
		array('name'=>'fPriority'),
		array('name'=>'fWarnFrequency'),
        array('name'=>'fCreateUser'),
        array('name'=>'fCreateDate'),
		array('name'=>'fUpdateUser'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fStandardStatus'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
			array('title'=>$sort->link('fTheme')),
			array('title'=>$sort->link('fCatalogueNo')),
			array('title'=>$sort->link('fStartDate')),
			array('title'=>$sort->link('fEndDate')),
			array('title'=>$sort->link('fSponsor')),
			array('title'=>$sort->link('fExecutor')),		
			array('title'=>$sort->link('fSchedule')),
			array('title'=>$sort->link('fStatus')),
			array('title'=>$sort->link('fPriority')),
			array('title'=>$sort->link('fWarnFrequency')),
			array('title'=>$sort->link('fCreateUser')),
			array('title'=>$sort->link('fCreateDate')),
			array('title'=>$sort->link('fUpdateUser')),
			array('title'=>$sort->link('fUpdateDate')),
			array('title'=>$sort->link('fStandardStatus')),
	        ),
       'sortname'=>'fTaskNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/task/gridData',$_GET),
        'modulename'=>'Task',
    )); ?>
</div>