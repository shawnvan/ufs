<?php
$this->breadcrumbs=array(
	'Itemusers',
);
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});

 $('#Confrim').click(function(){
		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('Item/itemcatalogue/selectname')."/id/'+$('#treeid').val(),
		           type:'POST',
		           data:'cno='+jQuery('#treeid').val()+'&id='+jQuery('#hiddenpkey').val(),
				   success: function(data){
		          		parent.$('#Task_fCatalogueNo').val(jQuery('#treeid').val());
						parent.$('#Resultdocument_fCatalogueNo').val(jQuery('#treeid').val());
		           		parent.$('#Task_fExecutor').val(data.fExecutorUser);
						parent.$('#fCatalogueName').val(jQuery('#textField').val());
				  }
			 });	
	   
	   parent.$('.SelectCatalogue').colorbox.close('保存成功');
     return false;
  }); 		
		
 function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
    jQuery('#textField').val(treeName);
	jQuery('#treeid').val(treeId);
}			
");
?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','Itemcatalogues')?></h2>
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
<input type="hidden"  id="treeid" name="hiddenpkey" />
</div>
<div class="content">
<ul id="treeDemo" class="tree el-finder-tree"></ul>
          <?php 
          echo CHtml::textField('textField');
		       $this->widget('application.extensions.ztree.zTree',array(
			  'treeNodeNameKey'=>'name',
			  'treeNodeKey'=>'id',
			  'treeNodeParentKey'=>'pId',
		      'htmlOptions'=>array('id'=>'fe'),
			  'options'=>array(
			   'expandSpeed'=>"",
			  'showLine'=>true,
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

?>
</div>