<div class="page">
   <div class="actionmenu">
    <?php
		$this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
				'activeCssClass'=>'active',
				'activateItems'=>true,
				'activateParents'=>true,
				'items' =>array(
						array('title'=>'项目初始化', 'url'=>array('/msg/Msgfrom/create') ,'linkOptions'=>array('class'=>'icon-plus UFSGrid-row-add'))					
					),
				));
	?>
  </div>
  
  <div class="search-box">
    <div class="search-box-panel">
		
    </div>
    <div class="clear"></div>
    <div class="search-box-toggler">

    </div>
   <?php
    $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
    Yii::app()->clientScript->registerScript('search', "
						
     $('.UFSGrid-row-add').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('msg/Msgfrom/create')."';
	    $(this).attr('href',url);
	    $(this).colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {
			   var urlindex='".Yii::app()->createUrl('msg/Msgfrom/gridData')."';
			   gridReload(urlindex);
        }});
  		return false;
     });

     $('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('msg/Msgfrom/delete/id')."/'+$(this).attr('rel'),
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('msg/Msgfrom/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });

	$('.UFSGrid-row-view').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('msg/Msgfrom/view/id')."/'+$(this).attr('rel');
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
			array('title'=>CHtml::encode($sort->resolveLabel('fSendFromTheme'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fSendFromDate'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fSendToName'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fSendFromStatus'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fSendFromTheme','frozen'=>true),
            array('name'=>'fSendFromDate'),
			array('name'=>'fSendToName'),
			array('name'=>'fSendFromStatus'),	
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
			array('title'=>$sort->link('fSendFromTheme')),
            array('title'=>$sort->link('fSendFromDate')),
			array('title'=>$sort->link('fSendToName')),
			array('title'=>$sort->link('fSendFromStatus')),
        ),
        'sortname'=>'fTypeName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('msg/Msgfrom/gridData',$_GET),
    )); ?>
    </div>
 </div>

	
