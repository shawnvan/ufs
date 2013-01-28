<?php
$this->breadcrumbs=array(
	'Templates'=>array('index'),
	$model->fTemplateNo,
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyTemplate').attr('href',$('#CopyTemplate').attr('href')+'/id/".$keyid."');
$('#UpdateTemplate').attr('href',$('#UpdateTemplate').attr('href')+'/id/".$keyid."');
		
$('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('admin/templetstandardtask/deletetask')."/tno/'+$(this).attr('rel')+'/id/'+jQuery('#hiddenpkey').val(),
				  success: function(data){
        		    if(data!='') alert(data);
				     var urlindex='".Yii::app()->createUrl('admin/templetstandardtask/taskData')."/id/'+jQuery('#hiddenpkey').val()+'/cno/'+jQuery('#treeid').val();
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });

function zTreeClickNode(treeId,treeParentId, treeName) {
				jQuery.ajax({
				  cache: false,
				  success: function(data){
					var urlindex='".Yii::app()->createUrl('admin/templetstandardtask/taskData')."';
					var url=urlindex +'/cNo/'+treeId +'/id/'+jQuery('#hiddenpkey').val();
					gridDoubleReload(url,jQuery('#cataloguetask'));
				  }
				});		
			}
");

?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Templates') ?></h2>
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'visible'=>Yii::app()->user->checkAccess('admin.template.Index')),
						array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('admin.template.Create')),					
						array('label'=>Yii::t('label','Copy'), 'linkOptions'=>array('id'=>'CopyTemplate'),'id'=>$model->fTemplateNo,'url'=>array('copy'),'visible'=>Yii::app()->user->checkAccess('admin.template.Copy')),
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateTemplate'),'id'=>$model->fTemplateNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.template.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fTemplateNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('admin.template.View')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('admin.template.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	  <div class="input-group">
	      <?php echo $form->labelEx($model,'fTemplateName'); ?>
	      <div class="inputs">
	         <?php echo $form->textField($model,'fTemplateName',array('size'=>50,'maxlength'=>50)); ?>
	          <?php echo $form->error($model,'fTemplateName'); ?>
	      </div>

     </div>
     <div class="input-group">
	       <?php echo $form->labelEx($model,'fTemplateType'); ?>
	       <div class="inputs">
	       <?php echo $form->textField($model,'fTemplateType',array('size'=>50,'maxlength'=>50)); ?>
	          <?php echo $form->error($model,'fTemplateType'); ?>
	          </div>
     </div>
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreate',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreate'); ?>
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdate',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpdate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
   
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus'); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
      	</div>
      </div>
<?php $this->endWidget(); ?>
<div class="content">
  <div class="el-finder-nav ui-resizable ui-resizable-autohide">
          <ul id="treeDemo" class="tree el-finder-tree"></ul>
          <?php 
		       $this->widget('application.extensions.ztree.zTree',array(
			  'treeNodeNameKey'=>'name',
			  'treeNodeKey'=>'id',
			  'htmlOptions'=>array('id'=>''),
			  'treeNodeParentKey'=>'pId',
			  'options'=>array(
				'expandSpeed'=>"",
				'showLine'=>true,
				'expandSpeed'=>'slow',//设置为慢速显示动画效果
				'autoCancelSelected'=>false,//禁止配合 Ctrl 键进行取消节点选择的操作
				'dblClickExpand'=>false,//取消默认双击展开父节点的功能
				'showIcon'=>true,//设置 zTree 不显示图标
				'showLine'=>true,//设置 zTree 不显示节点之间的连线
				'showTitle'=>true,//设置 zTree 不显示提示信息
				'callback'=>array(
					'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.id,treeNode.pId,treeNode.name); }",
				),
				//'beforeClick'=> zTreeBeforeClick,
			),
			'data'=>$dataNode
		));

		?>
        </div>
<div>
          <?php
		     $this->widget('application.modules.UFSBase.utils.WGrid',array(
                'gridId'=>'cataloguetask',
		        'columns'=>array(
					array('title'=>CHtml::encode($sort->resolveLabel('fTheme'))),
		            array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
					array('title'=>CHtml::encode($sort->resolveLabel('fAttachName'))),
					array('title'=>CHtml::encode($sort->resolveLabel('fSubmitUser'))),
					array('title'=>CHtml::encode($sort->resolveLabel('fSubmitDate'))),
					array('title'=>CHtml::encode($sort->resolveLabel('fConfirmUser'))),
					array('title'=>CHtml::encode($sort->resolveLabel('fConfirmDate'))),
					array('title'=>CHtml::encode($sort->resolveLabel('fTaskType'))),
		        ),
		        'columnsModel'=>array(
					array('name'=>'fTheme'),
		            array('name'=>'fCatalogueNo'), 		 
					array('name'=>'fAttachName'),
					array('name'=>'fSubmitUser'),
					array('name'=>'fSubmitDate'),
					array('name'=>'fConfirmUser'),
					array('name'=>'fConfirmDate'),
					array('name'=>'fTaskType'),
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
		        ),
		        'sortname'=>'fCatalogueNo',
		        'sortorder'=>'asc',
		        'url'=>Yii::app()->createUrl('admin/templetstandardtask/taskData',$_GET),
		    )); ?>
     </div>        
</div>



</div><!-- form -->