<?php
$this->breadcrumbs=array(
	'Resultdocuments',
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
  function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
				jQuery('#treeid').val(treeId)
				var noteid=noteid+'_span';
				jQuery('#ztree-checked-note').val(noteid);
				jQuery.ajax({				
				  cache: false,
				  success: function(html){
				  	 var urlindex='".Yii::app()->createUrl('Item/resultdocument/gridData')."';
					 var url=urlindex +'/cno/'+treeId +'/id/'+jQuery('#hiddenpkey').val();
					 gridReload(url);
				  }
				});		
			}
");
?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','Documents')?></h2>
<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                       
                		array('label'=>Yii::t('label','Confirm'),'url'=>array('Confirm'),'linkOptions'=>array('id'=>'Confrim','class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.standardtask.Index')),											
                    ),
                ));
    ?>
	</div>
<input type="hidden" value="<?php echo $keyid?>" id="hiddenpkey" name="hiddenpkey" />
<input type="hidden" value="" id="treeid" name="hiddenpkey" />
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
			'expandSpeed'=>'slow',//设置为慢速显示动画效果
				'autoCancelSelected'=>false,//禁止配合 Ctrl 键进行取消节点选择的操作
				'dblClickExpand'=>false,//取消默认双击展开父节点的功能
				'showIcon'=>true,//设置 zTree 不显示图标
				'showTitle'=>true,//设置 zTree 不显示提示信息
			   'showLine'=>true,
		       	'keepParent'=>false,//锁定父节点
		       	'keepLeaf'=>false,//锁定叶子节点       
			'callback'=>array(
				'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
	       	),
		  ),
			'data'=>$dataNode
		));

      $this->widget('application.modules.UFSBase.utils.WGrid',array(
		'columns'=>array(
               array('title'=>CHtml::encode($sort->resolveLabel('fAttachmentNo'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fAttachmentName'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitUser'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitDate'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmUser'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmDate'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fApplyArchiveUser'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fApplyArchiveDate'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fArchiveUser'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fArchiveDate'))),
				array('title'=>CHtml::encode($sort->resolveLabel('fDocumentStatus'))),
		),
		'columnsModel'=>array(
                array('name'=>'fAttachmentNo','editrules'=>'{required:true,edithidden:true}', 'hidden'=>true),
				array('name'=>'fAttachmentName','frozen'=>true),
				array('name'=>'fCatalogueNo'),
				array('name'=>'fResultSubmitUser'),
				array('name'=>'fResultSubmitDate'),
				array('name'=>'fResultConfirmUser'),
				array('name'=>'fResultConfirmDate'),
				array('name'=>'fApplyArchiveUser'),
				array('name'=>'fApplyArchiveDate'),
				array('name'=>'fArchiveUser'),
				array('name'=>'fArchiveDate'),
				array('name'=>'fDocumentStatus')
		),
		'pages'=>$pages,
		'rowNum'=>Yii::app()->params['pagesize'],
		'rownumbers'=>'true',
		'multiselect'=>'true',
		'rows'=>$gridRows,
		'sColumns'=>array(
				array('title'=>$sort->link('fAttachmentNo')),
				array('title'=>$sort->link('fAttachmentName')),
				array('title'=>$sort->link('fCatalogueNo')),
				array('title'=>$sort->link('fResultSubmitUser')),
				array('title'=>$sort->link('fResultSubmitDate')),
				array('title'=>$sort->link('fResultConfirmUser')),
				array('title'=>$sort->link('fResultConfirmDate')),
				array('title'=>$sort->link('fApplyArchiveUser')),
				array('title'=>$sort->link('fApplyArchiveDate')),
				array('title'=>$sort->link('fArchiveUser')),
				array('title'=>$sort->link('fArchiveDate')),
				array('title'=>$sort->link('fDocumentStatus')),
		),
		'sortname'=>'fTaskNo',
		'sortorder'=>'asc',
		'url'=>Yii::app()->createUrl('Item/resultdocument/batchGridData',$_GET),
));?>
</div>

 <div id="applydocument" title="入库申请" style="display:none;width:100%;height:100%;">
        <label for="username">备注</label>
        <div class="inputs">
          <?php echo CHtml::textArea('memo')?>
        </div>
 </div>