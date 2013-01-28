<?php $form = $this->beginWidget ( 'CActiveForm', array ('id' => 'item-form','enableAjaxValidation' => false,
		'htmlOptions'=>array('class'=>'form') ) );
?>
<?php echo CHtml::beginForm(); ?>
<div class="line"></div>
 <div class="row buttons">
	 <?php echo CHtml::submitButton($model->isNewRecord ? '保存' : '保存',array('class'=>'submit')); ?>
</div>
<script>
   jQuery(function() {
    	jQuery( ".datepicker" ).datepicker();
    	jQuery('#open').click(function(){
 		   $( "#dialog-user" ).dialog("open");
 	       return false;
 	    });

    	$( "#dialog-user" ).dialog({
    	    autoOpen: false,
    	    height: 500,
    	    width:750,
    	    modal: true,
    	    buttons: {
    	        Ok: function() {
    	            $( this ).dialog( "close" );
    	        }
    	    }
    	});
    });

   function dbClickRow(rowid,status){
		if(rowid){
			var ret = grid.jqGrid('getRowData',rowid);
			$('#Item_fResponsibleCreate').val(ret.fUserName);
			$('#fUserId').val(ret.fUserID);
			$("#dialog-user").dialog( "close" );
		}
	} 
	
</script>
<div id="edit-form">
<table> <tr>
          <td><dl>
              <dd><?php echo $form->labelEx($model,'fItemNum'); ?></dd>
              <dt><?php echo $form->textField($model,'fItemNum',array('size'=>50,'maxlength'=>50,'class'=>'required')); ?></dt>
            </dl><?php echo $form->error($model,'fItemNum'); ?></td>
             <td><dl><dd><?php echo $form->labelEx($model,'fResponsibleCreate'); ?></dd>
            <dt><?php echo $form->textField($model,'fResponsibleCreate',array('size'=>50,'maxlength'=>50,'class'=>'required')); ?>
            <span class="btn-icon-horizontal btn-icon-input btn-icon-user"></span></dt></dl>
              
              <input type="button" class="submit" id="open" value="选择负责人" /><?php echo $form->error($model,'fResponsibleCreate'); ?></td>
           
             <?php echo CHtml::hiddenField('fUserId','fUserId',array('size'=>50,'maxlength'=>50,'class'=>'required')); ?>
        </tr>
        <tr>
          <td><dl>
              <dd><?php echo $form->labelEx($model,'fItemName'); ?></dd>
              <dt><?php echo $form->textField($model,'fItemName',array('size'=>60,'maxlength'=>200,'class'=>'required')); ?></dt>
            </dl>
            <?php echo $form->error($model,'fItemName'); ?></td>
          <td><dl>
              <dd><?php echo $form->labelEx($model,'fItemType'); ?></dd>
              <dt><?php echo CHtml::dropdownList('fItemType', false,$ItemType); ?></dt>
            </dl>
            <?php echo $form->error($model,'fItemType'); ?></td>
        </tr>
        <tr>
          <td><dl>
              <dd><?php echo CHtml::label('项目模板','fTemplateTypeL'); ?></dd>
              <dt><?php echo $form->hiddenField($model,'fTemplateNo',array('size'=>60,'maxlength'=>200,'class'=>'required')); ?>
               <?php echo CHtml::textField('fTemplateTypeName',$Templatename,array('disabled'=>true)); ?></dt>
            </dl>
          </td>
        </tr>
        </table>
        </div>
<?php echo CHtml::endForm(); ?>
<?php echo $form->errorSummary($model); ?>
  <?php $this->endWidget(); ?>
 <div id="dialog-user" title="执行人员" style="display:none;width:100%;height:100%;">
    <?php
     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            array('title'=>CHtml::encode($sort->resolveLabel('fUserID'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fUserName'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fEmail'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fTelephone'))),
            array('title'=>CHtml::encode($sort->resolveLabel('fCreateDate'))),
        ),
        'columnsModel'=>array(
            array('name'=>'fUserID','editrules'=>'{required:true,edithidden:true}', 'hidden'=>true),
            array('name'=>'fUserName','frozen'=>true),
            array('name'=>'fEmail'),
            array('name'=>'fTelephone'),
            array('name'=>'fCreateDate'),   		 		
        ),
        'pages'=>$pages,
        'rowNum'=>Yii::app()->params['pagesize'],
        'rownumbers'=>'true',
        'height'=>'300px',
        'width'=>'720px',
        'rows'=>$gridRows,
        'sColumns'=>array(
            array('title'=>$sort->link('fUserID')),
            array('title'=>$sort->link('fUserName')),
            array('title'=>$sort->link('fEmail')),
            array('title'=>$sort->link('fTelephone')),
            array('title'=>$sort->link('fCreateDate')),
        ),
        'sortname'=>'fCreateDate',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('users/user/commongridData',$_GET),
        'modulename'=>'User',
    )); ?>
  </div>