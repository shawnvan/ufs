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
						array('label'=>Yii::t('label','Update'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fTemplateNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('admin.template.Update')),				
                    ),
                ));
    ?>
	</div>
</div>

<div class="content">

<input type="hidden" value="<?php echo $model->fTemplateNo?>" id="hiddenpkey" name="hiddenpkey" />
<input type="hidden" id="treeid" name="hiddenpkey" />
<input type="hidden" id="tid" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'horizontal-form'),
)); ?>
	<?php echo $form->errorSummary($model); ?>
	  <div class="input-group">
	   <?php echo $form->labelEx($model,'fTemplateName'); ?>
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateName',array('size'=>50,'maxlength'=>50,'disabled' => 'disabled')); ?>
          <?php echo $form->error($model,'fTemplateName'); ?>
      	</div>
      </div>
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateType'); ?>
     
          <div class="inputs">
         <?php echo $form->dropdownList($model,'fTemplateType',$fTemplateTypeRows,array('disabled' => 'disabled')); ?>
          <?php echo $form->error($model,'fTemplateType'); ?>
        
      	</div>
      </div>
	  <div class="form-submit">
	    <?php echo CHtml::submitButton(Yii::t('label','Edit'), array('id'=>'edit_btn','class' =>'btn-icon submit no-margin edit_btn')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Save'), array('id'=>'save_btn','class' =>'btn-icon submit no-margin save_btn','disabled' => 'disabled')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','Cancel'), array('id'=>'cancel_btn','class' =>'btn-icon submit no-margin cancel_btn','disabled' => 'disabled')); ?>
	  </div>
<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>
	<?php echo $form->errorSummary($tempcatalogue); ?>
	  <div class="input-group">
          <?php echo $form->labelEx($tempcatalogue,'fCatalogueName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($tempcatalogue,'fCatalogueName',array('size'=>60,'maxlength'=>100)); ?>       
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($tempcatalogue,'fWarnRate'); ?>
          <div class="inputs">
          <?php echo $form->dropdownList($tempcatalogue,'fWarnRate',$fWarnRate); ?>
          <?php echo $form->error($tempcatalogue,'fWarnRate'); ?>
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($tempcatalogue,'fIsActive'); ?>
     
          <div class="inputs">
           <?php echo $form->dropdownList($tempcatalogue,'fIsActive',$fIsActive); ?>
          <?php echo $form->error($tempcatalogue,'fIsActive'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($tempcatalogue,'fFatherCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($tempcatalogue,'fFatherCatalogueNo',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($tempcatalogue,'fFatherCatalogueNo'); ?>
        
      	</div>
      </div>

	 <div class="form-submit">
	    <?php echo CHtml::submitButton(Yii::t('label','AddStandardTask'), array('id'=>'AddStandardTask','class' =>'btn-icon submit no-margin')); ?>
	    <?php echo CHtml::submitButton(Yii::t('label','UpdateCatalogue'), array('id'=>'UpdateCatalogue','class' =>'btn-icon submit no-margin')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','DeleteCatalogue'), array('id'=>'DeleteCatalogue','class' =>'btn-icon submit no-margin')); ?>
		<?php echo CHtml::submitButton(Yii::t('label','AddCatalogue'), array('id'=>'AddCatalogue','class' =>'btn-icon submit no-margin')); ?>
	</div>
<?php $this->endWidget(); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'add-template-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form','style'=>'display:none'),
)); ?>
	<?php echo $form->errorSummary($tempcatalogue); ?>
	  <div class="input-group">
          <?php echo $form->labelEx($tempcatalogue,'fCatalogueName'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('fCatalogueName','',array('size'=>50,'maxlength'=>50)); ?>
          <?php echo $form->error($tempcatalogue,'fCatalogueName'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($tempcatalogue,'fWarnRate'); ?>
          <div class="inputs">
           <?php echo CHtml::dropDownList('fWarnRate','',$fWarnRate); ?>
          <?php echo $form->error($tempcatalogue,'fWarnRate'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($tempcatalogue,'fIsActive'); ?>
     
          <div class="inputs">
         <?php echo CHtml::dropDownList('fIsActive','',$fIsActive); ?>
          <?php echo $form->error($tempcatalogue,'fIsActive'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($tempcatalogue,'fFatherCatalogueNo'); ?>
     
          <div class="inputs">
          <?php echo CHtml::textField('fFatherCatalogueName','',array('size'=>50,'maxlength'=>50,'disabled'=>'disabled')); ?>
   
          <?php echo $form->error($tempcatalogue,'fFatherCatalogueNo'); ?>
        
      	</div>
      </div>
      <div class="form-submit">
	    <?php echo CHtml::submitButton(Yii::t('label','Save'), array('id'=>'SaveNode','class' =>'btn-icon submit no-margin')); ?>
	     <?php echo CHtml::submitButton(Yii::t('label','SaveCreate'), array('id'=>'SaveNodeCreate','class' =>'btn-icon submit no-margin')); ?>
	      <?php echo CHtml::submitButton(Yii::t('label','Cancel'), array('id'=>'Cancel','class' =>'btn-icon submit no-margin')); ?>
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
					'beforeClick'=> "js:function(treeId, treeNode) {zTreeClickNode(treeNode.tId,treeNode.id,treeNode.pId,treeNode.name); }",
				),
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
<?php
$this->breadcrumbs=array(
	'Templates'=>array('index'),
	$model->fTemplateNo=>array('view','id'=>$model->fTemplateNo),
	'Update',
);
$colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
	
$('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
		           url:'".Yii::app()->createUrl('admin/templetstandardtask/deletetask')."/tno/'+$(this).attr('rel')+'/id/'+jQuery('#hiddenpkey').val(),
				   success: function(data){
        		    if(data!='') alert(data);
				    var urlindex='".Yii::app()->createUrl('admin/templetstandardtask/taskData')."/id/'+jQuery('#hiddenpkey').val()+'/cno/'+jQuery('#treeid').val();
					gridReload(urlindex);
					$('#info').html(data.msg);
				  }
			 });		
    	}
  		return false;
     });
				    		
     function zTreeClickNode(tid,treeId,treeParentId, treeName) {
			 jQuery('#Templatecatalogue_fCatalogueName').val(treeName);
		     jQuery('#fFatherCatalogueName').val(treeName);
			 jQuery('#tid').val(tid); 
			 jQuery('#treeid').val(treeId); 
				jQuery.ajax({
				  url:'".Yii::app()->createUrl('admin/templatecatalogue/select')."/cNo/'+treeId+'/tNo/'+jQuery('#hiddenpkey').val(),
				  cache: false,
				  success: function(data){
					var urlindex='".Yii::app()->createUrl('admin/templetstandardtask/taskData')."';
					var url=urlindex +'/cNo/'+treeId +'/id/'+jQuery('#hiddenpkey').val();
					gridDoubleReload(url,jQuery('#cataloguetask'));
					jQuery('#Templatecatalogue_fFatherCatalogueNo').attr('value',data.fathername);
					jQuery('#Templatecatalogue_fWarnRate').val(data.fWarnRate);
					jQuery('#Templatecatalogue_fIsActive').val(data.fIsActive);
				  }
				});	
    		 }
							
        jQuery('#edit_btn').click(function(){ 
			jQuery('#Template_fTemplateName').removeAttr('disabled');
			jQuery('#Template_fTemplateType').removeAttr('disabled');
			jQuery('#save_btn').removeAttr('disabled');
            jQuery('#cancel_btn').removeAttr('disabled');
            jQuery('#edit_btn').attr('disabled',true);
			return false;
         });
	    
		 jQuery('#cancel_btn').click(function(){
			jQuery('#Template_fTemplateName').attr('disabled');
			jQuery('#Template_fTemplateType').attr('disabled');
			jQuery('#edit_btn').removeAttr('disabled');
	        jQuery('#save_btn').attr('disabled',true);
		    jQuery('#cancel_btn').attr('disabled',true);
			return false;
         });
							
		 $('#save_btn').click(function(){ 
		    jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Template/updatename')."',
		    	  type: 'post',
		    	  data: 'id='+jQuery('#hiddenpkey').val()+'&name='+jQuery('#Template_fTemplateName').val()+'&type='+jQuery('#Template_fTemplateType').val(),
				  success: function(data){
        		    jQuery('#edit_btn').removeAttr('disabled');
				 	jQuery('#Template_fTemplateName').attr('disabled');
					jQuery('#Template_fTemplateType').attr('disabled');
			        jQuery('#save_btn').attr('disabled',true);
				    jQuery('#cancel_btn').attr('disabled',true);
				    $('#info').html(data.msg);
				  }
			 });
			return false;		
         });	

	$('#AddStandardTask').live('click',function(){
        var url ='".Yii::app()->createUrl('admin/standardtask/popgrid')."'+'/cNo/'+jQuery('#treeid').val()+'/id/'+jQuery('#hiddenpkey').val();
        $(this).attr('href',url);
	    $(this).colorbox({
			iframe:true, 
			width:'100%', 
			height:'100%',
			onClosed: function (data) {
			    var urlindex='".Yii::app()->createUrl('admin/templetstandardtask/taskData')."';
				var url=urlindex +'/cNo/'+jQuery('#treeid').val() +'/id/'+jQuery('#hiddenpkey').val();
				gridDoubleReload(url,jQuery('#cataloguetask'));
        }});
		    return false;
         });

	jQuery('#UpdateCatalogue').click(function(){
			if(jQuery('#treeid').val()=='') alert('请选择节点');
            jQuery.ajax({
				  url:'".Yii::app()->createUrl('admin/templatecatalogue/updatenode')."',
				  cache: false,
				  type: 'post',
				  data: 'cno='+jQuery('#treeid').val()+'&tno='+jQuery('#hiddenpkey').val()+'&name='+jQuery('#Templatecatalogue_fCatalogueName').val()+'&WarnRate='+jQuery('#Templatecatalogue_fWarnRate').val()+'&status='+jQuery('#Templatecatalogue_fIsActive').val(),
				  success: function(data){
          		    var node=zTree_Treeobject.getNodeByTId(jQuery('#tid').val());
			        node.name= jQuery('#Templatecatalogue_fCatalogueName').val();	
				    zTree_Treeobject.updateNode(node);	
          	        $('#info').html(data.msg);	
				  }
				});			    		
		    return false;
         });
	jQuery('#DeleteCatalogue').click(function(){
			if(jQuery('#treeid').val()=='') alert('请选择节点');
			if(confirm('您确定要删除吗?')){
			jQuery.ajax({
				  url:'".Yii::app()->createUrl('admin/templatecatalogue/deleteTree')."',
				  cache: false,
				  type: 'post',
				  data: 'cno='+jQuery('#treeid').val()+'&tno='+jQuery('#hiddenpkey').val(),
				  success: function(data){
				  		var node=zTree_Treeobject.getNodeByTId(jQuery('#tid').val());
				        zTree_Treeobject.removeNode(node);
		                $('#info').html(data.msg);
			       }
				});		
		   }
		  return false;
         });
	jQuery('#AddCatalogue').click(function(){
		   if(jQuery('#treeid').val()=='') {alert('请选择节点');return false;}
			jQuery('#add-template-form').removeAttr('style');
		    return false;
         });
   jQuery('#SaveNode').click(function(){
		   if(jQuery('#treeid').val()=='') alert('请选择节点');
			jQuery.ajax({
				  url:'".Yii::app()->createUrl('admin/templatecatalogue/insert')."',
				  cache: false,
				  type: 'post',
				  data: 'cno='+jQuery('#treeid').val()+'&tno='+jQuery('#hiddenpkey').val()+'&name='+jQuery('#fCatalogueName').val()+'&WarnRate='+jQuery('#fWarnRate').val()+'&status='+jQuery('#fIsActive').val(),
				  success: function(data){
          		  var newNode = {name:data.fCatalogueName,id:data.fCatalogueNo,pid:data.fFatherNo}; 
          		   zTree_Treeobject.addNodes(zTree_Treeobject.getNodeByTId(jQuery('#tid').val()), newNode);
				   jQuery('#fCatalogueName').val('');
				   jQuery('#fWarnRate').val('');
				   jQuery('#fIsActive').val('');
				   jQuery('#add-template-form').attr('style', 'display:none');
           		   $('#info').html(data.msg);
				  }
				});	
		    return false;
         });
   jQuery('#SaveNodeCreate').click(function(){
		  if(jQuery('#treeid').val()=='') alert('请选择节点');
			jQuery.ajax({
				  url:'".Yii::app()->createUrl('admin/templatecatalogue/insert')."',
				  cache: false,
				  type: 'post',
				  data: 'cno='+jQuery('#treeid').val()+'&tno='+jQuery('#hiddenpkey').val()+'&name='+jQuery('#fCatalogueName').val()+'&WarnRate='+jQuery('#fWarnRate').val()+'&status='+jQuery('#fIsActive').val(),
				  success: function(data){
				   var newNode = {name:data.fCatalogueName,id:data.fCatalogueNo,pid:data.fFatherNo}; 
          		   zTree_Treeobject.addNodes(zTree_Treeobject.getNodeByTId(jQuery('#tid').val()), newNode);
				   jQuery('#fCatalogueName').val('');
				   jQuery('#fWarnRate').val('');
				   jQuery('#fIsActive').val('');
	    		   $('#info').html(data.msg);
				  }
				});		
		    return false;
         });
      			
    jQuery('#Cancel').click(function(){
		 jQuery('#fCatalogueName').val('');
		 jQuery('#fWarnRate').val('');
		jQuery('#fIsActive').val('');
      		jQuery('#add-template-form').attr('style', 'display:none');
		    return false;
         });      			

");
?>
