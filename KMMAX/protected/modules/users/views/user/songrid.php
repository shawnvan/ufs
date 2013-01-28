<div class="page">
  <?php echo $this->renderPartial('_header'); ?>
  <div class="search-box">
  
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
            array('title'=>CHtml::encode($sort->resolveLabel('fUserName'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fEmail'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fTelephone'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fUserName','frozen'=>true),
            array('name'=>'fEmail'),
            array('name'=>'fTelephone'),
            array('name'=>'fCreateDate'),   		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            array('title'=>$sort->link('fUserName')),
            array('title'=>$sort->link('fEmail')),
            array('title'=>$sort->link('fTelephone')),
            array('title'=>$sort->link('fCreateDate')),
        ),
        'sortname'=>'fCreateDate',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('users/user/gridData',$_GET),
        'modulename'=>'User',
    )); ?>
  </div>
</div>
