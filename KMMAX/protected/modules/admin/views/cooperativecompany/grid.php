<div class="page">
   <div class="actionmenu">
    <?php
		$this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
				'activeCssClass'=>'active',
				'activateItems'=>true,
				'activateParents'=>true,
				'items' =>array(
						array('title'=>'新建公司', 'url'=>array('/admin/Cooperativecompany/create') ,'linkOptions'=>array('class'=>'icon-plus UFSGrid-row-add'))					
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
		jQuery('.close').click(function(){
			jQuery('.form-table-search-more').toggle();
		});
    		
     $('.UFSGrid-row-add').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('admin/Cooperativecompany/create')."';
	    $(this).attr('href',url);
	    $(this).colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {
			   var urlindex='".Yii::app()->createUrl('admin/Cooperativecompany/gridData')."';
			   gridReload(urlindex);
        }});
  		return false;
     });
    		
    $('.UFSGrid-row-update').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('admin/Cooperativecompany/update/id')."/'+$(this).attr('rel');
	    $(this).children('span').attr('href',url);
	    $(this).children('span').colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {
			   var urlindex='".Yii::app()->createUrl('admin/Cooperativecompany/gridData')."';
			   gridReload(urlindex);
        }});
  		return false;
     });

     $('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Cooperativecompany/delete/id')."/'+$(this).attr('rel'),
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('admin/Cooperativecompany/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });

	$('.UFSGrid-row-view').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('admin/Cooperativecompany/view/id')."/'+$(this).attr('rel');
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
     	'gridId'=>'company',
        'columns'=>array(
        	array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyID'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyName'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fCooperativeCompanyShortName'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fStarLevel'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fType'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fKeyContacts'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fIndustry'))),
        	array('title'=>CHtml::encode($sort->resolveLabel('fMainProduct'))),
        ),
        'columnsModel'=>array(
			array('name'=>'fCooperativeCompanyID','editrules'=>'{required:true,edithidden:true}', 'hidden'=>true),
            array('name'=>'fCooperativeCompanyName','frozen'=>true),
			array('name'=>'fCooperativeCompanyShortName'),
            array('name'=>'fStarLevel'),
			array('name'=>'fType'),
			array('name'=>'fKeyContacts'),	
            array('name'=>'fIndustry'),
        	array('name'=>'fMainProduct'),
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
     	'height'=>'250%',
        'rows'=>$gridRows,
        'sColumns'=>array(
           array('title'=>$sort->link('fCooperativeCompanyID')),
           array('title'=>$sort->link('fCooperativeCompanyName')),
			array('title'=>$sort->link('fCooperativeCompanyShortName')),
			array('title'=>$sort->link('fStarLevel')),
            array('title'=>$sort->link('fType')),
			array('title'=>$sort->link('fKeyContacts')),
			array('title'=>$sort->link('fIndustry')),
            array('title'=>$sort->link('fMainProduct')),
        ),
        'sortname'=>'fCooperativeCompanyName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/Cooperativecompany/gridData',$_GET),
    )); ?>
    </div>
    <br/>
 </div>

	
