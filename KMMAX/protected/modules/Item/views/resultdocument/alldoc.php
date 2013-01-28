
<?php
$this->breadcrumbs=array(
	'Resultdocuments',
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
	$('#batchdownload').attr('href',$('#batchdownload').attr('href')+'/id/"."');
    $('.UFSGrid-row-attach').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('Item/attachment/view')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'100%', height:'100%',onClosed: function (message) {}});
  		return false;
     });
	function zTreeClickNode(treeId,treeParentId, treeName,noteid) {
		var noteid=noteid+'_span';
		 jQuery('#treeid').val(treeId)
		jQuery('#ztree-checked-note').val(noteid);
		jQuery.ajax({				
		  url:'".Yii::app()->createUrl('Item/resultdocument/docGridData')."/cno/'+treeId+'/id/'+jQuery('#ino').val(),
		  cache: false,
		  success: function(html){
		  	 var urlindex='".Yii::app()->createUrl('Item/resultdocument/docGridData')."';
			 var url=urlindex +'/cno/'+treeId +'/id/'+jQuery('#ino').val();
			 gridReload(url);
		  }
		});		
	}
				  	 		
	$('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/resultdocument/delete/id')."/'+$(this).attr('rel'),
				  type:'POST',
				  success: function(data){
				     var urlindex='".Yii::app()->createUrl('Item/resultdocument/alldocGridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });
				     			
	$('.UFSGrid-row-agree').live('click',function(){ 
        if(confirm('您确定同意了吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/resultdocument/agree/id')."/'+$(this).attr('rel'),
				  type:'POST',
				  success: function(data){
				     var urlindex='".Yii::app()->createUrl('Item/resultdocument/alldocGridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });	
	
	$('.applyknowledge').live('click',function(){ 
	   var url =	'".Yii::app()->createUrl('knowledge/knowledge/applyknowledge')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
		$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {
           var urlindex='".Yii::app()->createUrl('Item/resultdocument/alldocGridData')."';
			gridReload(urlindex);
      }});
  		return false;
     });
           						
	$('.batchdownload').live('click',function(){ 
	   var url = '".Yii::app()->createUrl('Item/resultdocument/batchdownload')."/';
	    $(this).attr('href',url);
		$(this).colorbox({iframe:true, width:'100%', height:'100%',onClosed: function (message) {}});
  		return false;
     });
           					     			     				     		
	$('.UFSGrid-row-refuse').live('click',function(){ 
        if(confirm('您要拒绝文档入库？')){
		    $('#reason').dialog('open');
    	}
		$('#resultNo').val($(this).attr('rel'));     		
  		return false;
     });		
    	$('#reason').dialog({
    	    autoOpen: false,
    	    height: 250,
    	    width:300,
    	    modal: true,
    	    buttons: {
    	        Ok: function() {
	    	       jQuery.ajax({				
					  url:'".Yii::app()->createUrl('Item/resultdocument/refuse/id')."/'+$('#resultNo').val(),
					  type:'POST',
					  data:'memo='+jQuery('#txa_reason').val(),
					  success: function(data){
					  	 $('#reason').dialog('close');
					     var urlindex='".Yii::app()->createUrl('Item/resultdocument/docGridData')."';
						 var url=urlindex +'/cno/'+jQuery('#treeid').val() +'/id/'+jQuery('#hiddenpkey').val();
					      gridReload(url);
					  }
					 });		
    	        }
    	    }
    	});
");
?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','Documents')?></h2>
<input type="hidden"  id="hiddenpkey" name="hiddenpkey" />
<input type="hidden" value="" id="treeid" name="hiddenpkey" />
<input type="hidden" value="" id="resultNo" name="resultNo" />
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Index')),
                        array('label'=>Yii::t('label','Create'), 'url'=>array('create'),'linkOptions'=>array('id'=>'CreateDoc'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Create')),
						array('label'=>Yii::t('label','BatchDownLoad'), 'url'=>array('batchdownload'),'linkOptions'=>array('id'=>'batchdownload','class'=>'batchdownload'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Batchdownload')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_searchDoc',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
         <?php 

	     $this->widget('application.modules.UFSBase.utils.WGrid',array(
			        'columns'=>array(
array('title'=>CHtml::encode($sort->resolveLabel('fItemNo'))),
			  			array('title'=>CHtml::encode($sort->resolveLabel('fAttachmentNo'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fApplyArchiveUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fApplyArchiveDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fArchiveUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fArchiveDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fDocumentStatus')))
			        ),
			        'columnsModel'=>array(
array('name'=>'fItemNo','frozen'=>true),
						array('name'=>'fAttachmentNo'),
						array('name'=>'fCatalogueNo'),
						array('name'=>'fResultSubmitUser'),
						array('name'=>'fResultSubmitDate'),
						array('name'=>'fResultConfirmUser'),
						array('name'=>'fResultConfirmDate'),
						array('name'=>'fApplyArchiveUser'),
						array('name'=>'fApplyArchiveDate'),
						array('name'=>'fArchiveUser'),
						array('name'=>'fArchiveDate'),
						array('name'=>'fDocumentStatus'),
			        ),
			        'pages'=>$pages,
			        'rowNum'=>Yii::app()->params['pagesize'],
			        'rownumbers'=>'true',
			        'rows'=>$gridRows,
			        'sColumns'=>array(
array('title'=>$sort->link('fItemNo')),
						array('title'=>$sort->link('fAttachmentNo')),
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
			        'sortname'=>'fDocumentStatus',
			        'sortorder'=>'asc',
			        'url'=>Yii::app()->createUrl('Item/resultdocument/alldocGridData',$_GET),
					'modulename'=>'Resultdocument',
			    )); ?>
</div>
<div id="reason" title="请填写拒绝理由" style="display:none;width:100%;height:100%;">
        <label for="username">请填写拒绝理由</label>
        <div class="inputs">
          <?php echo CHtml::textArea('txa_reason')?>
        </div>
 </div>
