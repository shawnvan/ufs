<div class="page">
   <div class="actionmenu">
       <a href='' id='add-user' class='submit'>添加员工</a> | <a href='' id='add-par' class='submit'>合作伙伴工</a>
   </div>
   <?php 
		Yii::app()->getClientScript()->registerScript('template-create',"
		 jQuery('#add-user').click(function(){
		   var urlindex='".Yii::app()->createUrl('Item/Itemuser/usergridData')."';
		   var url=urlindex +'/id/'+jQuery('#itemNo').val();
		   gridDoubleReload(url,jQuery('#userGrid'));
 		   $('#dialog-user').dialog('open');
 	       return false;
 	    });
	    
    	$('#dialog-user').dialog({
    	    autoOpen: false,
    	    height: 500,
    	    width:750,
    	    modal: true,
    	    buttons: {
    	        Ok: function() {
    	        	var selectedRowId=jQuery('#userGrid').jqGrid('getGridParam','selarrrow');
				    var insertStrNo='';
				    var insertStrName='';
              	     for(var i=0;i<selectedRowId.length;i++) {
                  	    var ret = jQuery('#userGrid').jqGrid('getRowData',selectedRowId[i]);
                  	    if(insertStrNo=='') insertStrNo=ret.fUserID;
				        else insertStrNo=insertStrNo+','+ret.fUserID;
				        if(insertStrName=='') insertStrName=ret.fUserName;
				        else insertStrName=insertStrName+','+ret.fUserName;
              	     }
				    InsertUser(insertStrNo,insertStrName);
   		            $( this ).dialog('close');
    	        }
    	    }
    	});

     function InsertUser(strid,strname){
         jQuery.ajax({
				  url:'".Yii::app()->createUrl('Item/Itemuser/insertuser')."/id/'+jQuery('#itemNo').val(),
				  cache: false,
   		          type: 'POST',
				  data: 'inserid='+strid+'&name='+strname,
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('Item/Itemuser/gridData')."';
					var url=urlindex +'/id/'+jQuery('#itemNo').val();
					gridDoubleReload(url,jQuery('#itemuser'));
				  }
		 });		
      }
   		    
      jQuery('#add-par').click(function(){
		   var urlindex='".Yii::app()->createUrl('Item/Itemuser/partenergridData')."';
		   var url=urlindex +'/id/'+jQuery('#itemNo').val();
		   gridDoubleReload(url,jQuery('#partenerGrid'));
 		   $('#dialog-partenter').dialog('open');
 	       return false;
 	    });
							
   	 $('#dialog-partenter').dialog({
		    autoOpen: false,
		    height: 500,
		    width:750,
		    modal: true,
		    buttons: {
		        Ok: function() {
    	        	var selectedRowId=jQuery('#partenerGrid').jqGrid('getGridParam','selarrrow');
				    var insertStrNo='';
				    var insertStrName='';
              	     for(var i=0;i<selectedRowId.length;i++) {
                  	    var ret = jQuery('#partenerGrid').jqGrid('getRowData',selectedRowId[i]);
                  	    if(insertStrNo=='') insertStrNo=ret.fCooperativePartnerID;
				        else insertStrNo=insertStrNo+','+ret.fCooperativePartnerID;
						if(insertStrName=='') insertStrName=ret.fPartnerName;
				        else insertStrName=insertStrName+','+ret.fPartnerName;
              	     }
				    Insertpartener(insertStrNo,insertStrName);
   		            $( this ).dialog('close');
    	        }
		    }
		});

	   function Insertpartener(strid,strname){
         jQuery.ajax({
				  url:'".Yii::app()->createUrl('Item/Itemuser/insertpartener')."/id/'+jQuery('#itemNo').val(),
				  cache: false,
   		          type: 'POST',
				   data: 'inserid='+strid+'&name='+strname,
				  success: function(data){
				    var urlindex='".Yii::app()->createUrl('Item/Itemuser/gridData')."';
					var url=urlindex +'/id/'+jQuery('#itemNo').val();
					gridDoubleReload(url,jQuery('#itemuser'));
				  }
		 });		
      }
				  		
		function dbClickRow(rowid,status){
		if(rowid){
			var ret = grid.jqGrid('getRowData',rowid);
			$('#Task_fExecutor').val(ret.fUser);
			$('#fUserId').val(ret.fUserID);
			$('#dialog-user').dialog('close');
		}
	    } 
   		          		
   		 $('.UFSGrid-row-delete').live('click',function(){ 
        if(confirm('您确定要删除吗？')){
    		jQuery.ajax({				
				  url:'".Yii::app()->createUrl('Item/Itemuser/delete/id')."/'+$(this).attr('rel'),
				  success: function(data){
				   var urlindex='".Yii::app()->createUrl('Item/Itemuser/gridData')."';
					var url=urlindex +'/id/'+jQuery('#itemNo').val();
					gridDoubleReload(url,jQuery('#itemuser'));
				  }
			 });		
    	}
  		return false;
     });
				  		
		");

		?>
   <?php echo CHtml::hiddenField('itemNo',$itemno); ?>
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
        'gridId'=>'itemuser',
        'columns'=>array(
           array('title'=>CHtml::encode($sort->resolveLabel('fItemNo'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fEmployeeNo'))),
array('title'=>CHtml::encode($sort->resolveLabel('fEmployeeName'))),
			array('title'=>CHtml::encode($sort->resolveLabel('fCreateUser'))),
        		array('title'=>CHtml::encode($sort->resolveLabel('fUserType'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fItemNo','frozen'=>true),
			array('name'=>'fEmployeeNo'),
array('name'=>'fEmployeeName'),
			array('name'=>'fCreateUser'),
            array('name'=>'fUserType'),
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
           array('title'=>$sort->link('fItemNo')),
			array('title'=>$sort->link('fEmployeeNo')),
array('title'=>$sort->link('fEmployeeName')),
			array('title'=>$sort->link('fCreateUser')),
            array('title'=>$sort->link('fUserType')),
        ),
        'sortname'=>'fTypeName',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/Itemuser/gridData',$_GET),
    )); ?>
    </div>
 </div>
 
<div id="dialog-user" title="执行人员" style="display:none;width:100%;height:100%;">
    <?php
       $this->widget('application.modules.UFSBase.utils.WGrid',array(
		'gridId'=>'userGrid',
        'columns'=>array(
            array('title'=>CHtml::encode($usersort->resolveLabel('fUserID'))),
            array('title'=>CHtml::encode($usersort->resolveLabel('fUserName'))),
            array('title'=>CHtml::encode($usersort->resolveLabel('fEmail'))),
            array('title'=>CHtml::encode($usersort->resolveLabel('fTelephone'))),
            array('title'=>CHtml::encode($usersort->resolveLabel('fCreateDate'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fUserID','editrules'=>'{required:true,edithidden:true}', 'hidden'=>true),
            array('name'=>'fUserName','frozen'=>true),
            array('name'=>'fEmail'),
            array('name'=>'fTelephone'),
            array('name'=>'fCreateDate'),   		 		
        ),
        'pages'=>$userpages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'height'=>'300px',
        'width'=>'720px',
		'multiselect'=>'true',
        'rows'=>$usergridRows,
        'sColumns'=>array(
            array('title'=>$usersort->link('fUserID')),
            array('title'=>$usersort->link('fUserName')),
            array('title'=>$usersort->link('fEmail')),
            array('title'=>$usersort->link('fTelephone')),
            array('title'=>$usersort->link('fCreateDate')),
        ),
        'sortname'=>'fCreateDate',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('Item/Itemuser/usergridData',$_GET),
        'modulename'=>'User',
    ));   ?>
  </div>
	
<div id="dialog-partenter" title="合作伙伴" style="display:none;width:100%;height:100%;">
 <?php
     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'gridId'=>'partenerGrid',
        'columns'=>array(
         array('title'=>CHtml::encode($sort->resolveLabel('fCooperativePartnerID'))),
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
            array('name'=>'fCooperativePartnerID','editrules'=>'{required:true,edithidden:true}', 'hidden'=>true),
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
		'multiselect'=>'true',
        'sColumns'=>array(
            array('title'=>$sort->link('fCooperativePartnerID')),
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
        'url'=>Yii::app()->createUrl('Item/Itemuser/partenergridData',$_GET),
    )); ?>
</div>