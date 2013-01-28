<?php
$this->breadcrumbs=array(
	'Attachments'=>array('index'),
	$model->fAttachmentId,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input:text').each(function(){
	$(this).attr('disabled','disabled');
});
$('#number').removeAttr('disabled');
$('.current').click(function(){
	return false;
});

    var startDocument = 'Paper';
    $('#documentViewer').FlexPaperViewer(
            { config : {
                SWFFile : 'http://localhost:8081/UFS/KMMAX/uploads/swf/".$filename.".swf',
                Scale : 0.6,
                ZoomTransition : 'easeOut',
                ZoomTime : 0.5,
                ZoomInterval : 0.2,
                FitPageOnLoad : true,
                FitWidthOnLoad : false,
                FullScreenAsMaxWindow : false,
                ProgressiveLoading : false,
                MinZoomSize : 0.2,
                MaxZoomSize : 5,
                SearchMatchAll : false,
                InitViewMode : 'Portrait',
                RenderingOrder : 'flash,html',
                StartAtPage : '',
                ViewModeToolsVisible : true,
                ZoomToolsVisible : true,
                NavToolsVisible : true,
                CursorToolsVisible : true,
                SearchToolsVisible : true,
                WMode : 'window',
                localeChain: 'zh_CN'
            }}
    );
   var keyid='';	
  $('.download').click(function(){ 
       $('#down').dialog('open');	    		
       keyid=$(this).attr('rel');				    				
  	   return false;
     });	
   $('#down').dialog({
    	    autoOpen: false,
    	    height: 250,
    	    width:300,
    	    modal: true,
    	    buttons: {
    	        Ok: function() {
                		 $('#download-form').submit();
                		 $('#down').dialog('close');
    	        }
    	    }
    	});			

");

?>

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Attachments')?></h2>
	<div class="content-action">
	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fAttachmentId,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('Item.attachment.View')),
                    ),
                ));
    ?>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/flexpaper.css" />

<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/flexpaper.js"></script>  
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/flexpaper_handlers.js"></script>  
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attachment-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>
<div style="position:absolute;left:10px;top:50px;">
<div id="documentViewer" class="flexpaper_viewer" style="width:850px;height:500px"></div>
<script type="text/javascript">
    
</script>
<div style="width:760px;margin-top:10px;padding-left:10px; padding-top:10px; padding-bottom:10px; font-family:Verdana;font-size:10pt;background-color:#EFEFEF; border:1px solid #999;-webkit-box-shadow: rgba(0, 0, 0, 0.246094) 0px 2px 4px 0px;font-family:'District Thin', helvetica, arial;font-weight:lighter;">
<font style="font-size:15px;font-weight:bold">
<?php echo CHtml::submitButton(Yii::t('label','DownLoad'),array('rel'=>$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit download','rel'=>$keyid,'disabled'=>''));?>
<?php echo CHtml::submitButton(Yii::t('label','GetHref'),array('rel'=>$model->fTaskNo,'align'=>'right','title'=>'edit','class'=>'submit download','disabled'=>''));?>				</font>
<br/>	
	  <div class="input-group">
          <?php echo $form->labelEx($model,'fAttachmentName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fAttachmentName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fAttachmentName'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fDownloadNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fDownloadNum'); ?>
   
          <?php echo $form->error($model,'fDownloadNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fViewNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fViewNum'); ?>
   
          <?php echo $form->error($model,'fViewNum'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fCreateUser'); ?>
        
      	</div>
      </div>


	  <div class="input-group">
          <?php echo $form->labelEx($model,'fCreateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fCreateDate'); ?>
   
          <?php echo $form->error($model,'fCreateDate'); ?>
        
      	</div>
      </div>
 <br/>
  </div>
</div>

<div style="position:absolute;left:820px;height:540px;top:50px;font-size:12pt;background-color:#CACACA;width:300px;border:1px solid #999;-webkit-box-shadow: rgba(0, 0, 0, 0.246094) 0px 2px 4px 0px;min-height:440px;font-family:'District Thin', helvetica, arial;font-weight:lighter;">
    <div style="padding: 5px 5px 5px 5px;font-size:17px;font-weight:bold;text-align:center;margin-top:10px;">
     <div id="tabs" class="tabs">
        <ul>
	        <li><a href="#tabs-0"><?php echo Yii::t('label','查看');?></a></li>
	        <li><a href="#tabs-1"><?php echo Yii::t('label','下载');?></a></li>
	    </ul>
     </div>
    </div>
    <div style="padding: 5px 5px 5px 5px;font-size:13px;text-align:left;margin-bottom:10px;">
    这里可以查看所有的下载
     </div>
</div>

	<?php echo $form->errorSummary($model); ?>

<?php $this->endWidget(); ?>
 <div id="down" title="请输入" style="display:none;width:100%;height:100%;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'download-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>
        <div class="inputs">
          <?php echo CHtml::textField('number','',array('size'=>60,'maxlength'=>200,'class'=>'ui-autocomplete-input')); ?>
        </div>
 <?php $this->endWidget(); ?>
  </div>
</div><!-- form -->

