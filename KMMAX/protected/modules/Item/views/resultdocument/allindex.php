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
$('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/resultdocument/delete/id')."/'+$(this).attr('rel'),
				  type:'POST',
				  success: function(data){
				   var urlindex='".Yii::app()->createUrl('Item/resultdocument/gridData')."';
					 var url=urlindex +'/id/'+jQuery('#hiddenpkey').val() +'/cno/'+jQuery('#treeid').val();
					gridReload(url);
				  }
			 });		
    	}
  		return false;
     });

$('.UFSGrid-row-applyknowledge').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('knowledge/knowledge/applyknowledge')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'80%', height:'100%',onClosed: function (message) {}});
  		return false;
     });
   $('.UFSGrid-row-confirm').live('click',function(){ 
		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/resultdocument/confirm/id')."/'+$(this).attr('rel'),
				  type:'POST',
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('Item/resultdocument/allGridData')."';
				    var url=urlindex +'/id/'+jQuery('#hiddenpkey').val() +'/cno/'+jQuery('#treeid').val();
					gridReload(url);
				  }
			 });		
  		return false;
  });
$('.UFSGrid-row-attach').live('click',function(){ 
		var url =	'".Yii::app()->createUrl('Item/attachment/view')."/id/'+$(this).attr('rel');
	    $(this).attr('href',url);
	    $(this).colorbox({iframe:true, width:'100%', height:'100%',onClosed: function (message) {}});
  		return false;
     });				    						    		
");
?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','Resultdocuments')?></h2>
<input type="hidden" value="" id="hiddenpkey" name="hiddenpkey" />
<input type="hidden" value="" id="treeid" name="hiddenpkey" />
	<div class="content-action">
	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Index')),				
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.resultdocument.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form advanced_search">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
         <?php 
     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
array('title'=>CHtml::encode($sort->resolveLabel('fItemNo'))),
            		 array('title'=>CHtml::encode($sort->resolveLabel('fTaskNo'))),
			  			array('title'=>CHtml::encode($sort->resolveLabel('fCatalogueNo'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fAttachmentNo'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultSubmitDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fResultConfirmDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
						array('title'=>CHtml::encode($sort->resolveLabel('fDocumentStatus'))),
        ),
        'columnsModel'=>array(
array('name'=>'fItemNo','frozen'=>true),
 					array('name'=>'fTaskNo'),
						array('name'=>'fCatalogueNo'),
						array('name'=>'fAttachmentNo'),
						array('name'=>'fResultSubmitUser'),
						array('name'=>'fResultSubmitDate'),
						array('name'=>'fResultConfirmUser'),
						array('name'=>'fResultConfirmDate'),
						array('name'=>'fCreateUser'),
						array('name'=>'fCreateDate'),
						array('name'=>'fStatus'),
						array('name'=>'fDocumentStatus')
		 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
array('title'=>$sort->link('fItemNo')),
          array('title'=>$sort->link('fTaskNo')),
		array('title'=>$sort->link('fCatalogueNo')),
		array('title'=>$sort->link('fAttachmentNo')),
		array('title'=>$sort->link('fResultSubmitUser')),
		array('title'=>$sort->link('fResultSubmitDate')),
		array('title'=>$sort->link('fResultConfirmUser')),
		array('title'=>$sort->link('fResultConfirmDate')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fStatus')),
        array('title'=>$sort->link('fDocumentStatus')),
	
        ),
       'sortname'=>'fTaskNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/resultdocument/allgridData',$_GET),
        'modulename'=>'Resultdocument',
    )); ?>
</div>