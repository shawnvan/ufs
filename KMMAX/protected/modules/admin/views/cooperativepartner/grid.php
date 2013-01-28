<div class="page">
<div class="actionMenu">
    <?php
		$this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
				'activeCssClass'=>'active',
				'activateItems'=>true,
				'activateParents'=>true,
				'items' =>array(
						array('title'=>'新建信息', 'url'=>array('/admin/Cooperativepartner/create') ,'linkOptions'=>array('class'=>'icon-plus UFSGrid-row-add')))
				));
	?></div>

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
	    var url =	'".Yii::app()->createUrl('admin/Cooperativepartner/create')."';
	    $(this).attr('href',url);
	    $(this).colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {
			   var urlindex='".Yii::app()->createUrl('admin/Cooperativepartner/gridData')."';
			   gridReload(urlindex);
        }});
  		return false;
     });
    		
    $('.UFSGrid-row-update').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('admin/Cooperativepartner/update/id')."/'+$(this).attr('rel');
	    $(this).children('span').attr('href',url);
	    $(this).children('span').colorbox({
			iframe:true, 
			width:'80%', 
			height:'100%',
			onClosed: function (data) {
			   var urlindex='".Yii::app()->createUrl('admin/Cooperativepartner/gridData')."';
			   gridReload(urlindex);
        }});
  		return false;
     });

     $('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Cooperativepartner/delete/id')."/'+$(this).attr('rel'),
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('admin/Cooperativepartner/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });

	$('.UFSGrid-row-view').live('click',function(){ 
	    var url =	'".Yii::app()->createUrl('admin/Cooperativepartner/view/id')."/'+$(this).attr('rel');
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
          array('title'=>CHtml::encode($sort->resolveLabel('fPartnerName'))),
          array('title'=>CHtml::encode($sort->resolveLabel('fRole'))),
		  array('title'=>CHtml::encode($sort->resolveLabel('fBirthday'))),
		  array('title'=>CHtml::encode($sort->resolveLabel('fPosition'))),
		  array('title'=>CHtml::encode($sort->resolveLabel('fSex'))),
		  array('title'=>CHtml::encode($sort->resolveLabel('fCellphone'))),
		  array('title'=>CHtml::encode($sort->resolveLabel('fEmail'))),
          array('title'=>CHtml::encode($sort->resolveLabel('fEducationalLevel'))),
          array('title'=>CHtml::encode($sort->resolveLabel('fHomeAddress'))),
          array('title'=>CHtml::encode($sort->resolveLabel('fQq'))),
          array('title'=>CHtml::encode($sort->resolveLabel('fPhoto'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fPartnerName','frozen'=>true),
            array('name'=>'fRole'),
			array('name'=>'fBirthday'),
			array('name'=>'fPosition'),
			array('name'=>'fSex'),
			array('name'=>'fCellphone'),
			array('name'=>'fEmail'),
			array('name'=>'fEducationalLevel'),
			array('name'=>'fHomeAddress'),
			array('name'=>'fQq'),
			array('name'=>'fPhoto'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
	        array('title'=>$sort->link('fPartnerName')),
	        array('title'=>$sort->link('fRole')),
			array('title'=>$sort->link('fBirthday')),
			array('title'=>$sort->link('fPosition')),
			array('title'=>$sort->link('fSex')),
			array('title'=>$sort->link('fCellphone')),
			array('title'=>$sort->link('fEmail')),
			array('title'=>$sort->link('fEducationalLevel')),
			array('title'=>$sort->link('fHomeAddress')),
			array('title'=>$sort->link('fQq')),
			array('title'=>$sort->link('fPhoto')),
        ),
        'sortname'=>'fPartnerName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/Cooperativepartner/gridData',$_GET),
    )); ?>
    </div>
 </div>