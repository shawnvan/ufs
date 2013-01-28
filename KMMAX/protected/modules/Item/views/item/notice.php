<div class="page"> 
  <div class="search-box">
    <div class="search-box-panel">
		
    </div>
    <div class="clear"></div>
    <div class="search-box-toggler">
      <div class="search-box-inner"> <a href="#" class="close"><span>显示全部分类</span></a> </div>
    </div>
    <?php
    Yii::app()->clientScript->registerScript('search', "
		jQuery('.close').click(function(){
			jQuery('.form-table-search-more').toggle();
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
			array('title'=>CHtml::encode($sort->resolveLabel('fCreate'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fUpdate'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fItemNum','frozen'=>true),
			array('name'=>'fItemName'),
			array('name'=>'fItemType'),
			array('name'=>'fCreate'),
			array('name'=>'fUpdate'),	
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
           array('title'=>$sort->link('fItemNum')),
			array('title'=>$sort->link('fItemName')),
			array('title'=>$sort->link('fItemType')),
			array('title'=>$sort->link('fCreate')),
			array('title'=>$sort->link('fUpdate')),
        ),
        'sortname'=>'fTypeName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/Item/gridData',$_GET),
    )); ?>
    </div>
 </div>

	
