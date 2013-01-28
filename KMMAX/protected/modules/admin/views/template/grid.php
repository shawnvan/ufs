<div class="page">
<div class="dialog-box">
    <div id="template-create-box">
   <?php
   $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
    Yii::app()->clientScript->registerScript('search', "
	  $('.UFSGrid-row-add').click(function(){ 
	     $('#dialog-template').dialog('open');
  		return false;
     });
    
    
     $('#save_btn').click(function(){ 
  		 jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Template/inputData')."',
				  cache: false,
  		 		  type: 'post',
  		 		  data: 'name='+jQuery('#fTemplateName').val()+'&type='+jQuery('#fTemplateType').val(),
				  success: function(data){
     		        $('#dialog-template').dialog('close');
     				window.location = '".Yii::app()->createUrl('admin/Template/create')."/tNo/'+data;
				  }
		 });		
     });
    
     $('#dialog-template').dialog({
		    	    autoOpen: false,
		    	    height: 500,
		    	    width:550,
		    	    modal: true,
		    	    buttons: {
		    	        Ok: function() {
		    	            $( this ).dialog('close');
		    	        }
		    	    }
		    	});
     		         		
     $('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('admin/Template/delete/tno')."/'+$(this).attr('rel'),
				  success: function(data){
        		    if(data!='') alert(data);
				    var urlindex='".Yii::app()->createUrl('admin/Template/gridData')."';
					gridReload(urlindex);
				  }
			 });		
    	}
  		return false;
     });

     $('.UFSGrid-row-viewItem').live('click',function(){ 
	    var url ='".Yii::app()->createUrl('Item/item/commongrid/tno')."/'+$(this).attr('rel');
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

   <div class="actionmenu">
    <ul><li><a href="#" class="icon-plus UFSGrid-row-add"></a></li></ul>
  </div>
  
  <div class="search-box">
    <div class="search-box-panel">
    </div>
  </div>
  
  <!-- search-box -->
    <div class="datagrid-box">
    <?php
     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
			array('title'=>CHtml::encode($sort->resolveLabel('fTemplateName'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fTemplateType'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fStatus'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fCreate'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fUpdate'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fUpdateDate'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fTemplateName'), 		 
            array('name'=>'fTemplateType'),	
			array('name'=>'fStatus'),
			array('name'=>'fCreate'),
			array('name'=>'fCreateDate'),
			array('name'=>'fUpdate'),
			array('name'=>'fUpdateDate'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            array('title'=>$sort->link('fTemplateName')),
            array('title'=>$sort->link('fTemplateType')),
			array('title'=>$sort->link('fStatus')),
			array('title'=>$sort->link('fCreate')),
			array('title'=>$sort->link('fCreateDate')),
			array('title'=>$sort->link('fUpdate')),
			array('title'=>$sort->link('fUpdateDate')),
        ),
        'sortname'=>'fTemplateType',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('admin/Template/gridData',$_GET),
    )); ?>
    </div>
 </div>
</div>
<div id="dialog-template" title="添加标准任务" style="display:none;width:100%;height:100%;">
     <ul class="form-table-search">
    	<li>
        	<dl>
                <dd><?php echo CHtml::label('模板名称','fTemplateNameL'); ?></dd>
                <dt><?php echo CHtml::textField('fTemplateName','',array('size'=>60,'maxlength'=>1000)); ?></dt>					
            </dl>
        </li>
    	<li>
        	<dl>
                <dd><?php echo CHtml::label('模板类型','fTemplateTypeL'); ?></dd>
                <dt><?php echo CHtml::dropdownList('fTemplateType', false,$DropdowndetailRows); ?></dt>					
            </dl>
        </li>
    	<li>
        	<dl>
                <dd> 
                    <?php echo CHtml::button('保存', array('disabled'=>"", 'id'=>'save_btn','class'=>'submit')); ?>
                    <?php echo CHtml::button('取消', array('disabled'=>"disabled", 'id'=>'cancel_btn','class'=>'submit')); ?>
                     	
               </dd>
            </dl>
        </li>
    </ul>
 </div>