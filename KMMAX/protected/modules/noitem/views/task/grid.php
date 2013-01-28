<div class="page">
<div class="actionmenu">
    <?php
		$this->widget ('zii.widgets.CMenu', array ('id'=>'',
				'activeCssClass'=>'active',
				'activateItems'=>true,
				'activateParents'=>true,
				'items' =>array(
						array('title'=>'新建任务', 'url'=>array('/Item/task/create/id/'.$itemno) 
								,'linkOptions'=>array('class'=>'icon-plus UFSGrid-row-add'))			
					),
				));
	?>
  </div>
  <?php
    $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
    Yii::app()->clientScript->registerScript('search', "
						
     $('.UFSGrid-row-add').click(function(){ 
	   url:'".Yii::app()->createUrl('Item/task/create/id')."/'+jQuery('#ino').val(),
	    $(this).attr('href',url);
	    $(this).colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {
			    var urlindex='".Yii::app()->createUrl('Item/task/griddata')."';
				var url=urlindex +'/id/'+jQuery('#ino').val();
				gridReload(url);
        }});
  		return false;
     });

     $('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('msg/Msgfrom/delete/id')."/'+$(this).attr('rel'),
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('Item/task/griddata')."';
					var url=urlindex +'/cno/'+treeId +'/id/'+jQuery('#ino').val();
					gridReload(url);
				  }
			 });		
    	}
  		return false;
     });
			    		
   $('.UFSGrid-row-history').live('click',function(){ 
	    url:'".Yii::app()->createUrl('Item/task/taskhistory/id')."/'+$(this).attr('rel'),
	    $(this).children('span').attr('href',url);
	    $(this).children('span').colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {
			    var urlindex='".Yii::app()->createUrl('Item/task/griddata')."';
				var url=urlindex +'/id/'+jQuery('#ino').val();
				gridReload(url);
        }});
  		return false;
     });

	$('.UFSGrid-row-view').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('msg/Msgfrom/view/id')."/'+$(this).attr('rel');
	    $(this).children('span').children('span').attr('href',url);
	    $(this).children('span').children('span').colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {}});
  		return false;
     });

			function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
				var noteid=noteid+'_span';
				jQuery('#ztree-checked-note').val(noteid);
				jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/task/grid')."/cno/'+treeId+'/id/'+jQuery('#ino').val(),
				  cache: false,
				  success: function(html){
				    var urlindex='".Yii::app()->createUrl('Item/task/griddata')."';
					var url=urlindex +'/cno/'+treeId +'/id/'+jQuery('#ino').val();
					gridReload(url);
				  }
				});		
			}

	");
    ?>
<div class="form">
 
<input type='hidden' id='ino' value="<?php echo $itemno ?> ">
<div class="widgetbox">
  <h3 class=""><span>尽职调查表目录结构</span></h3>
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
                    'OnRightClick'=>"js:function(event,treeId, treeNode) {alert('test');}",
					'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
		       ),
	),
	'data'=>$dataNode
));

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
						array('title'=>CHtml::encode($sort->resolveLabel('fStartDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fEndDate'))),
			            array('title'=>CHtml::encode($sort->resolveLabel('fSponsor'))),
			        	array('title'=>CHtml::encode($sort->resolveLabel('fExecutor'))),
			        	array('title'=>CHtml::encode($sort->resolveLabel('fTaskType'))),
			        	 array('title'=>CHtml::encode($sort->resolveLabel('fSchedule'))),
			        	 array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
			        	 array('title'=>CHtml::encode($sort->resolveLabel('fPriority'))),
			        	 array('title'=>CHtml::encode($sort->resolveLabel('fWarnFrequency'))),
			        	 array('title'=>CHtml::encode($sort->resolveLabel('fLatestAffixId'))),     	
			        ),
			        'columnsModel'=>array(
						array('name'=>'fTheme','frozen'=>true),
			            array('name'=>'fCatalogueNo'),
						array('name'=>'fStartDate'),
						array('name'=>'fEndDate'),
						array('name'=>'fSponsor'),
						array('name'=>'fExecutor'),
						array('name'=>'fTaskType'),
						array('name'=>'fSchedule'),
						array('name'=>'fStatus'),
						array('name'=>'fPriority'),
						array('name'=>'fWarnFrequency'),
						array('name'=>'fLatestAffixId'),
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
						array('title'=>$sort->link('fTaskType')),
						array('title'=>$sort->link('fSchedule')),
						array('title'=>$sort->link('fStatus')),
						array('title'=>$sort->link('fPriority')),
						array('title'=>$sort->link('fWarnFrequency')),
						array('title'=>$sort->link('fLatestAffixId')),
			        ),
			        'sortname'=>'fTheme',
			        'sortorder'=>'asc',
			        'url'=>Yii::app()->createUrl('Item/task/gridData',$_GET),
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
