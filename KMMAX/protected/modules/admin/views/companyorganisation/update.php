<?php
$this->breadcrumbs=array(
	'Knowledgecatalogues',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
 $('.UFSGrid-row-update').live('click',function(){ 
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('admin/companyorganisation/updateNode')."',
		           type:'POST',
		           data:'id='+jQuery('#Companyorganisation_fOrgNo').val()+'&name='+jQuery('#Companyorganisation_fOrgName').val(),
				   success: function(data){
		            var node=zTree_Treeobject.getNodeByTId(jQuery('#tid').val());
			        node.name= jQuery('#Companyorganisation_fOrgName').val();	
				    zTree_Treeobject.updateNode(node);		
		            jQuery('#Companyorganisation_fUpdateUser').val(data.fUpdateUser);
		          	jQuery('#Companyorganisation_fUpdateDate').val(data.fUpdateDate);
		           	 $('#info').html(data.msg);
				  }
			 });		
  		return false;
     });
 $('.UFSGrid-row-create').live('click',function(){ 
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('admin/companyorganisation/insertNode')."',
		           type:'POST',
		           data:'id='+jQuery('#Companyorganisation_fOrgNo').val()+'&name='+jQuery('#Companyorganisation_fOrgName').val(),
				   success: function(data){
		             var newNode = {name:data.fOrgName,id:data.fOrgNo,pid:data.fUpOrgNo}; 
          		     zTree_Treeobject.addNodes(zTree_Treeobject.getNodeByTId(jQuery('#tid').val()), newNode);
		            jQuery('#Companyorganisation_fCreateUser').val(data.fCreateUser);
		          	jQuery('#Companyorganisation_fCreateDate').val(data.fCreateDate);
		          	jQuery('#Companyorganisation_fUpdateUser').val(data.fUpdateUser);
		          	jQuery('#Companyorganisation_fUpdateDate').val(data.fUpdateDate);
		           	$('#info').html(data.msg);
				  }
			 });	
  		return false;
     });
$('.UFSGrid-row-delete').live('click',function(){ 
     if(confirm('您确定要删除吗?')){		           		
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('admin/companyorganisation/deleteNode')."/id/'+$('#Companyorganisation_fOrgNo').val(),
		           type:'POST',
				   success: function(data){
		           	 var node=zTree_Treeobject.getNodeByTId(jQuery('#tid').val());
				     zTree_Treeobject.removeNode(node);
					jQuery('#Companyorganisation_fOrgName').val('');
		            jQuery('#Companyorganisation_fCreateUser').val(data.fCreateUser);
		          	jQuery('#Companyorganisation_fCreateDate').val(data.fCreateDate);
		          	jQuery('#Companyorganisation_fUpdateUser').val(data.fUpdateUser);
		          	jQuery('#Companyorganisation_fUpdateDate').val(data.fUpdateDate);
		           	 $('#info').html(data.msg);
				  }
			 });	
		 }	
  		return false;
     });		           				           				
 function zTreeClickNode(tid,treeId,treeParentId, treeName) {
		  jQuery('#tid').val(tid); 
		         jQuery('#treeid').val(treeId); 
				jQuery.ajax({				
				  cache: false,
		          url:'".Yii::app()->createUrl('admin/companyorganisation/ajaxview/id')."/'+treeId,
				  success: function(data){
		          jQuery('#Companyorganisation_fOrgName').val(treeName);
					jQuery('#Companyorganisation_fOrgNo').val(treeId);
					jQuery('#Companyorganisation_fUpOrgNo').val(treeParentId);
		          	jQuery('#Companyorganisation_fCreateUser').val(data.fCreateUser);
		          	jQuery('#Companyorganisation_fCreateDate').val(data.fCreateDate);
		          	jQuery('#Companyorganisation_fUpdateUser').val(data.fUpdateUser);
		          	jQuery('#Companyorganisation_fUpdateDate').val(data.fUpdateDate);
				    zTree.expandNode(treeId);
				  }
				});		
		
		
	}
");
?>
<div class="content-head underline">
<h2><?php echo Yii::t('label','Companyorganisations')?></h2>
<div class="content-action">
	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Index')),
						array('label'=>Yii::t('label','Update'), 'url'=>array('update'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('admin.companyorganisation.Update')),									
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" id="tid" name="hiddenpkey" />
 <?php 
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
		'editable'=> false,//编辑节点
        'expandSpeed'=>'slow',//设置为慢速显示动画效果
			'autoCancelSelected'=>false,//禁止配合 Ctrl 键进行取消节点选择的操作
			'dblClickExpand'=>false,//取消默认双击展开父节点的功能
			'showIcon'=>true,//设置 zTree 不显示图标
			'showLine'=>true,//设置 zTree 不显示节点之间的连线
			'showTitle'=>true,//设置 zTree 不显示提示信息
		//'checkable'=> true,//选择
		'callback'=>array(
			'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.tId,treeNode.id,treeNode.pId,treeNode.name,treeNode.tId); }",
       ),
	),
	'data'=>$dataNode
));

?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'itemcatalogue-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

     <?php echo $form->hiddenField($model,'fOrgNo',array('size'=>50,'maxlength'=>50)); ?>
     <?php echo $form->hiddenField($model,'fUpOrgNo',array('size'=>50,'maxlength'=>50)); ?>
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fOrgName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fOrgName',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fOrgName'); ?>
        
      	</div>
      </div>
       <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate',array('disabled'=>'disabled')); ?>
   
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>
  
	<div class="form-submit">
	    <?php echo CHtml::submitButton(Yii::t('label','Create'), array('class' =>'btn-icon submit no-margin UFSGrid-row-create' , )); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Update'), array('class' =>'btn-icon submit no-margin UFSGrid-row-update' , )); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Delete'), array('class' =>'btn-icon submit no-margin UFSGrid-row-delete' , )); ?>
	</div>
<?php $this->endWidget(); ?>
</div>