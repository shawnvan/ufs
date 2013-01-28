<?php
$this->breadcrumbs=array(
	'Knowledges',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
$('.UFSGrid-row-attach').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('Item/attachment/view')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'100%', height:'100%',onClosed: function (message) {}});
  		return false;
     });	
$('.UFSGrid-row-download').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('Item/attachment/down')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'30%', height:'40%',onClosed: function (message) {}});
  		return false;			 		
     });						
  function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
				var noteid=noteid+'_span';
		        jQuery('#treeid').val(treeId);
				jQuery('#ztree-checked-note').val(noteid);
				jQuery.ajax({				
				  cache: false,
				  success: function(html){
				     var urlindex='".Yii::app()->createUrl('knowledge/knowledge/showgridData')."';
					var url=urlindex +'/cno/'+treeId;
					gridReload(url);
				  }
				});		
			}
");
?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Knowledges') ?></h2>
<?php echo CHtml::hiddenField('treeid','');?>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('knowledge.knowledge.Index')),				
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
 <ul id="treeDemo" class="tree el-finder-tree"></ul>
          <?php 
       $this->widget('application.extensions.ztree.zTree',array(
	  'treeNodeNameKey'=>'name',
	  'treeNodeKey'=>'id',
	  'treeNodeParentKey'=>'pId',
      'htmlOptions'=>array('id'=>'fe'),
	  'options'=>array(
		'showLine'=>true,
				'keepParent'=>false,//锁定父节点
				'keepLeaf'=>false,//锁定叶子节点
				'editable'=> false,//编辑节点
				'expandSpeed'=>'slow',//设置为慢速显示动画效果
				'autoCancelSelected'=>false,//禁止配合 Ctrl 键进行取消节点选择的操作
				'dblClickExpand'=>false,//取消默认双击展开父节点的功能
				'showIcon'=>true,//设置 zTree 不显示图标
				'showLine'=>true,//设置 zTree 不显示节点之间的连线
				'showTitle'=>true,//设置 zTree 不显示提示信息
		'callback'=>array(
			'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
       ),
	),
	'data'=>$dataNode
));

?>

<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fItemNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fTaskNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fKnowledgeName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fAttachmentName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fIsOpen'))),
array('title'=>CHtml::encode($sort->resolveLabel('fSubmitUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fSubmitDate'))),
		
		array('title'=>CHtml::encode($sort->resolveLabel('fConfirmUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fConfirmDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),

        ),
        'columnsModel'=>array(
		array('name'=>'fItemNo'),
		array('name'=>'fTaskNo'),
		array('name'=>'fCatalogueNo'),
		array('name'=>'fKnowledgeName'),
		array('name'=>'fAttachmentName'),
		array('name'=>'fIsOpen'),
array('name'=>'fSubmitUser'),
		array('name'=>'fSubmitDate'),
		
		array('name'=>'fConfirmUser'),
		array('name'=>'fConfirmDate'),
		array('name'=>'fCreate'),
		array('name'=>'fCreateDate'),
		array('name'=>'fUpdateDate'),
		array('name'=>'fUpdateUser'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
		array('title'=>$sort->link('fItemNo')),
		array('title'=>$sort->link('fTaskNo')),
		array('title'=>$sort->link('fCatalogueNo')),
		array('title'=>$sort->link('fKnowledgeName')),
		array('title'=>$sort->link('fAttachmentName')),
		array('title'=>$sort->link('fIsOpen')),
array('title'=>$sort->link('fSubmitUser')),
		array('title'=>$sort->link('fSubmitDate')),
		
		array('title'=>$sort->link('fConfirmUser')),
		array('title'=>$sort->link('fConfirmDate')),
		array('title'=>$sort->link('fCreate')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUpdateDate')),
		array('title'=>$sort->link('fUpdateUser')),

	
        ),
       'sortname'=>'fKnowledgeNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('knowledge/knowledge/showgridData',$_GET),
        'modulename'=>'Knowledge',
    )); ?>
</div>