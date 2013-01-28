<div class="page">
   <div class="actionmenu">
    <?php
		$this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
				'activeCssClass'=>'active',
				'activateItems'=>true,
				'activateParents'=>true,
				'items' =>array(
						array('title'=>'项目初始化', 'url'=>array('/Item/item/initcreate') ,'linkOptions'=>array('class'=>'icon-plus UFSGrid-row-add'))					
					),
				));
	?>
  </div>
  
  <div class="search-box">
    <div class="search-box-panel">
		
    </div>
    <div class="clear"></div>
    <div class="search-box-toggler">
      <div class="search-box-inner"> <a href="#" class="close"><span>显示全部分类</span></a> </div>
    </div>
    <?php
    $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
    Yii::app()->clientScript->registerScript('search', "
		jQuery('.close').click(function(){
			jQuery('.form-table-search-more').toggle();
		});
    		
     $('.UFSGrid-row-add').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('Item/item/initcreate')."';
	    $(this).attr('href',url);
	    $(this).colorbox({
			overlayClose:false,
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {
			   var urlindex='".Yii::app()->createUrl('Item/item/gridData')."';
			   gridReload(urlindex);
        }});
  		return false;
     });
    		
    $('.UFSGrid-row-update').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('Item/item/initupdate/id')."/'+$(this).attr('rel');
	    $(this).children('span').attr('href',url);
	    $(this).children('span').colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {
			   var urlindex='".Yii::app()->createUrl('Item/item/gridData')."';
			   gridReload(urlindex);
        }});
  		return false;
     });

     $('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/item/delete/id')."/'+$(this).attr('rel'),
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('Item/item/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });

	$('.UFSGrid-row-view').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('Item/item/view/id')."/'+$(this).attr('rel');
	    $(this).children('span').attr('href',url);
	    $(this).children('span').colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {}});
  		return false;
     });

	");
    ?>
  </div>
  
  <!-- search-box -->
    <div class="datagrid-box">
    <?php
     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
           array('title'=>CHtml::encode($sort->resolveLabel('fItemNum'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fItemName'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fItemType'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fResponsibleCreate'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fUpdateUser'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fItemNum','frozen'=>true),
			array('name'=>'fItemName'),
			array('name'=>'fItemType'),
            array('name'=>'fResponsibleCreate'),
			array('name'=>'fCreateUser'),
        	array('name'=>'fCreateDate'),
			array('name'=>'fUpdateUser'),	
        	array('name'=>'fCreateDate'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
           array('title'=>$sort->link('fItemNum')),
			array('title'=>$sort->link('fItemName')),
			array('title'=>$sort->link('fItemType')),
            array('title'=>$sort->link('fResponsibleCreate')),
			array('title'=>$sort->link('fCreateUser')),
			array('title'=>$sort->link('fCreateDate')),
        	array('title'=>$sort->link('fUpdateUser')),
        	array('title'=>$sort->link('fCreateDate')),
        ),
        'sortname'=>'fTypeName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/Item/gridData',$_GET),
    )); ?>
    </div>
 </div>

	
