<div class="page">
<div class="form">

<div class="widgetbox">
  <h3 class=""><span>知识库目录结构</span></h3>
    <div id="fileManager" class="el-finder">
      <div class="el-finder-workzone">
        <div class="el-finder-nav ui-resizable ui-resizable-autohide">
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
       	'keepParent'=>false,//锁定父节点
       	'keepLeaf'=>false,//锁定叶子节点       
		//'editable'=> true,//编辑节点
		//'checkable'=> true,//选择
		'callback'=>array(
			'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
       ),
	),
	'data'=>$dataNode
));

?>

<?php 
		Yii::app()->getClientScript()->registerScript('itemcatalogue-update',"
			function updateEditForm(target_id) {
				var  id=$.fn.yiiGridView.getSelection(target_id);		
				jQuery('#fTypeNo').val(id);		
				jQuery('#save_btn').attr('disabled', false);
				jQuery('#add_btn').attr('disabled', true);
				jQuery.getJSON('".Yii::app()->createUrl('admin/Dropdowntype/inputData')."/fTypeNo/'+id,
					function(data) {
						jQuery('#fTypeName').val(data.fTypeName);
						jQuery('#fStatus').val(data.fStatus);
					});
			}

			function formSaved(data, textStatus, XMLHttpRequest) {
				jQuery('#fCatalogueName').attr('disabled', false);	
				if(textStatus){//如果插入数据并返回结果成功则修改节点
					jQuery('#fCatalogueName').val(data.fCatalogueName);					
					var changeNotename=jQuery('#ztree-checked-note').val();
				    jQuery('#'+changeNotename).html(data.fCatalogueName);//重新给节点赋值					
				}
				
			}

            function agree(tno){
          		if(confirm('您确定同意此次申请吗？')){
          		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Standardtask/agree')."/id/'+tno,
				  cache: false,
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('admin/Standardtask/griddata')."';
					gridReload(url);
				  }
				});		
			  }
 			}
          	
          	function refuse(tno){
             if(confirm('您确定拒绝此次申请吗？')){
			 jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Standardtask/refuse')."/id/'+tno,
				  cache: false,
				  success: function(data){
				     var urlindex='".Yii::app()->createUrl('admin/Standardtask/griddata')."';
					gridReload(url);
				  }
				});		
					}
            }
          	
		    //刷新Grid
			function getGridURL(){
					var urlindex=\"<?php echo Yii::app()->createUrl('admin/Standardtask/griddata'); ?>\";
					var fUserv=jQuery('#User_fUser').val();
					var fUserNamev=jQuery('#User_fUserName').val();
					var fIsActivev=jQuery('#User_fIsActive').val();
					var url=urlindex +'/fUser/'+fUserv +'/fUserName/'+fUserNamev +'/fIsActive/'+fIsActivev+'/type/search';
					gridReload(url);
			}
		
			function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
				var noteid=noteid+'_span';
				jQuery('#ztree-checked-note').val(noteid);
				jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Standardtask/grid')."/cno/'+treeId,
				  cache: false,
				  success: function(html){
				     var urlindex='".Yii::app()->createUrl('admin/Standardtask/griddata')."';
					var url=urlindex +'/cno/'+treeId +'/id/'+jQuery('#ino').val();
					gridReload(url);
				  }
				});		
			}
		");

		?>

        </div>
        <?php echo CHtml::hiddenField('ztree-checked-note','');?>
        <?php echo CHtml::beginForm();?>
	        <div class="el-finder-cwd ui-selectable" unselectable="on">
	      	<div class="tree-edit-form">
			 <div class="datagrid-box">
			   <?php
				     $this->widget('application.modules.UFSBase.utils.WGrid',array(
				        'columns'=>array(
				        	array('title'=>CHtml::encode($sort->resolveLabel('fTheme'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fAttachName'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fSubmitUser'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fSubmitDate'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fConfirmUser'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fConfirmDate'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fTaskType'))),
							array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
				        ),
				        'columnsModel'=>array(
							array('name'=>'fTheme','frozen'=>true),
							array('name'=>'fCatalogueNo'),
				            array('name'=>'fAttachName'),
							array('name'=>'fSubmitUser'),
							array('name'=>'fSubmitDate'),
							array('name'=>'fConfirmUser'),
							array('name'=>'fConfirmDate'),
							array('name'=>'fTaskType'),
							array('name'=>'fStatus'),
				        ),
				        'pages'=>$pages,
				        'rowNum'=>Yii::app()->params['pagesize'],
				        'rownumbers'=>'true',
				        'rows'=>$gridRows,
				        'sColumns'=>array(
							array('title'=>$sort->link('fTheme')),
							array('title'=>$sort->link('fCatalogueNo')),
							array('title'=>$sort->link('fAttachName')),
							array('title'=>$sort->link('fSubmitUser')),
							array('title'=>$sort->link('fSubmitDate')),
							array('title'=>$sort->link('fConfirmUser')),
							array('title'=>$sort->link('fConfirmDate')),
							array('title'=>$sort->link('fTaskType')),
							array('title'=>$sort->link('fStatus')),
				        ),
				        'sortname'=>'fAttachName',
				        'sortorder'=>'asc',
				        'url'=>Yii::app()->createUrl('admin/Standardtask/gridData',$_GET),
				    )); ?>
			    </div>
						</div>
				       </div>
			        
			        
			        <?php echo CHtml::endForm();?>
			        <div class="el-finder-spinner" style="display: none; "></div>
			        <div style="clear:both"></div>
			      </div>
			    </div>
			</div>
</div><!-- form -->
</div>
