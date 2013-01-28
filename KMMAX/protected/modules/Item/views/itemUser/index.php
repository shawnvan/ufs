<?php
$this->breadcrumbs=array(
	'Itemusers',
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
 $('#CreateUser').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('users/User/multigrid')."/id/'+jQuery('#hiddenpkey').val();
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {
          var urlindex='".Yii::app()->createUrl('Item/itemuser/gridData')."';
		  var url=urlindex +'/id/'+jQuery('#hiddenpkey').val();
	 	  gridReload(url);
       }});
    return false;
 })
 $('#CreatePartner').live('click',function(){ 
	var url =	'".Yii::app()->createUrl('admin/cooperativepartner/multigrid')."/id/'+jQuery('#hiddenpkey').val();
	$(this).attr('href',url);
	$(this).colorbox({iframe:true, width:'80%', height:'80%',onClosed: function (message) {
          var urlindex='".Yii::app()->createUrl('Item/itemuser/gridData')."';
		  var url=urlindex +'/id/'+jQuery('#hiddenpkey').val();
	 	  gridReload(url);
       }});
    return false;
 })

$('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/Itemuser/deleteuser/id')."/'+$(this).attr('rel'),
				  success: function(data){
				   var urlindex='".Yii::app()->createUrl('Item/Itemuser/gridData')."';
					var url=urlindex +'/id/'+jQuery('#hiddenpkey').val();
					gridReload(url);
				  }
			 });		
    	}
  		return false;
     });			
");
?>

<div class="content-head underline">
<h2><?php echo Yii::t('label','Itemusers')?></h2>
<input type="hidden" value="<?php echo $keyid?>" id="hiddenpkey" name="hiddenpkey" />
	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('Item.itemuser.Index')),
                		array('label'=>Yii::t('label','CreateUser'), 'url'=>array('CreateUser'),'linkOptions'=>array('id'=>'CreateUser'),'visible'=>Yii::app()->user->checkAccess('Item.itemuser.Create')),
                		array('label'=>Yii::t('label','CreatePartner'), 'url'=>array('CreatePartner'),'linkOptions'=>array('id'=>'CreatePartner'),'visible'=>Yii::app()->user->checkAccess('Item.itemuser.Create')),
						array('label'=>Yii::t('label','Manage'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('Item.itemuser.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<?php echo CHtml::link(Yii::t('label','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
		array('title'=>CHtml::encode($sort->resolveLabel('fEmployeeName'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fRoleNo'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
		array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
	array('title'=>CHtml::encode($sort->resolveLabel('fUserType'))),
        ),
        'columnsModel'=>array(
		array('name'=>'fEmployeeName'),
		array('name'=>'fRoleNo'),
		array('name'=>'fCreateUser'),
		array('name'=>'fCreateDate'),
	array('name'=>'fUserType'),	 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
		array('title'=>$sort->link('fEmployeeName')),
		array('title'=>$sort->link('fRoleNo')),
		array('title'=>$sort->link('fCreateUser')),
		array('title'=>$sort->link('fCreateDate')),
		array('title'=>$sort->link('fUserType')),	
        ),
       'sortname'=>'fEmployeeNo',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/itemuser/gridData',$_GET),
        'modulename'=>'Itemuser',
    )); ?>
</div>