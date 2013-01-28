<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->fItemNo,
);

Yii::app()->clientScript->registerScript('inputdisabled', "
$('input').each(function(){
	$(this).attr('disabled','disabled');
});
$('textarea').each(function(){
	$(this).attr('disabled','disabled');
});
$('.submenu .current').click(function(){
	return false;
});
$('#CopyItem').attr('href',$('#CopyItem').attr('href')+'/id/".$keyid."');
$('#UpdateItem').attr('href',$('#UpdateItem').attr('href')+'/id/".$keyid."');		
var data = [
        {
            label: 'test',
            data: [[1990, 18.9], [1991, 18.7], [1992, 18.4], [1993, 19.3], [1994, 19.5], [1995, 19.3], [1996, 19.4], [1997, 20.2], [1998, 19.8], [1999, 19.9], [2000, 20.4], [2001, 20.1], [2002, 20.0], [2003, 19.8], [2004, 20.4]]
        },
        {
            label: 'test', 
            data: [[1992, 13.4], [1993, 12.2], [1994, 10.6], [1995, 10.2], [1996, 10.1], [1997, 9.7], [1998, 9.5], [1999, 9.7], [2000, 9.9], [2001, 9.9], [2002, 9.9], [2003, 10.3], [2004, 10.5]]
        },
        {
            label: 'tesrt',
            data: [[1990, 10.0], [1991, 11.3], [1992, 9.9], [1993, 9.6], [1994, 9.5], [1995, 9.5], [1996, 9.9], [1997, 9.3], [1998, 9.2], [1999, 9.2], [2000, 9.5], [2001, 9.6], [2002, 9.3], [2003, 9.4], [2004, 9.79]]
        },
        {
            label: 'test',
            data: [[1990, 12.4], [1991, 11.2], [1992, 10.8], [1993, 10.5], [1994, 10.4], [1995, 10.2], [1996, 10.5], [1997, 10.2], [1998, 10.1], [1999, 9.6], [2000, 9.7], [2001, 10.0], [2002, 9.7], [2003, 9.8], [2004, 9.79]]
        },
        {
            label: 'asdf',
 	    data: [[1990, 9.7], [1991, 12.1], [1992, 10.3], [1993, 11.3], [1994, 11.7], [1995, 10.6], [1996, 12.8], [1997, 10.8], [1998, 10.3], [1999, 9.4], [2000, 8.7], [2001, 9.0], [2002, 8.9], [2003, 10.1], [2004, 9.80]]
        },
        {
            label: 'asdf',
            data: [[1990, 5.8], [1991, 6.0], [1992, 5.9], [1993, 5.5], [1994, 5.7], [1995, 5.3], [1996, 6.1], [1997, 5.4], [1998, 5.4], [1999, 5.1], [2000, 5.2], [2001, 5.4], [2002, 6.2], [2003, 5.9], [2004, 5.89]]
        },
        {
            label: 'asdf',
            data: [[1990, 8.3], [1991, 8.3], [1992, 7.8], [1993, 8.3], [1994, 8.4], [1995, 5.9], [1996, 6.4], [1997, 6.7], [1998, 6.9], [1999, 7.6], [2000, 7.4], [2001, 8.1], [2002, 12.5], [2003, 9.9], [2004, 19.0]]
        }
    ];
    var options = {
        series: {
            lines: { show: true },
            points: { show: true }
        },
        legend: { noColumns: 2 },
        xaxis: { tickDecimals: 0 },
        yaxis: { min: 0 },
        selection: { mode: 'x'}
    };
    var placeholder1 = $('#placeholder1');
    placeholder1.bind('plotselected', function (event, ranges) {
        $('#selection').text(ranges.xaxis.from.toFixed(1) + ' to ' + ranges.xaxis.to.toFixed(1));
        var zoom = $('#zoom').attr('checked');
        if (zoom)
            plot = $.plot(placeholder1, data,
                          $.extend(true, {}, options, {
                              xaxis: { min: ranges.xaxis.from, max: ranges.xaxis.to }
                          }));
    });
    placeholder1.bind('plotunselected', function (event) {
        $('#selection').text('');
    });
    var plot = $.plot(placeholder1, data, options);

	//任务图表
    $.plot($('#Tasks_interactive'), ".$taskGraphs.", 
	{
		series: {
			pie: { 
				show: true,
				radius: 3/4,
				label: {
					show: true,
					radius: 3/4,
					formatter: function(label, series){
						return '<div style=\"font-size:8pt;text-align:center;padding:2px;color:white;\">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
					},
					background: { 
						opacity: 0.5,
						color: '#000'
					}
				}
			}
		},
		grid: {
			hoverable: true,
			clickable: true
		}
	});
    		
    // INTERACTIVE
    $.plot($('#Resultdocuments_interactive'), ".$resultGraphs.", 
	{
		series: {
			pie: { 
				show: true,
				radius: 3/4,
				label: {
					show: true,
					radius: 3/4,
					formatter: function(label, series){
						return '<div style=\"font-size:8pt;text-align:center;padding:2px;color:white;\">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
					},
					background: { 
						opacity: 0.5,
						color: '#000'
					}
				}
			}
		},
		grid: {
			hoverable: true,
			clickable: true
		}
	}); 	

    // INTERACTIVE
    $.plot($('#Documents_interactive'), ".$docGraphs.", 
	{
		series: {
			pie: { 
				show: true,
				radius: 3/4,
				label: {
					show: true,
					radius: 3/4,
					formatter: function(label, series){
						return '<div style=\"font-size:8pt;text-align:center;padding:2px;color:white;\">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
					},
					background: { 
						opacity: 0.5,
						color: '#000'
					}
				}
			}
		},
		grid: {
			hoverable: true,
			clickable: true
		}
	});
	$('.interactive').bind(\"plothover\", pieHover);
	$('.interactive').bind(\"plotclick\", pieClick);
    function pieHover(event, pos, obj) 
	{
		if (!obj) return;
		percent = parseFloat(obj.series.percent).toFixed(2);
		$(\"#hover\").html('<span style=\"font-weight: bold; color: '+obj.series.color+'\">'+obj.series.label+' ('+percent+'%)</span>');
	}
	
	function pieClick(event, pos, obj) 
	{
		if (!obj) return;
		percent = parseFloat(obj.series.percent).toFixed(2);
		alert(''+obj.series.label+': '+percent+'%');
	}  

    var d1 = [];   
    d1.push(['1', 20]);
    d1.push(['2', 90]);
    d1.push(['3', 30]);
    var stack = 0, bars = true, lines = false, steps = true;    
    function plotWithOptions() {
        $.plot($(\"#placeholder\"), [ d1], {
            series: {
                stack: stack,
                lines: { show: lines, fill: true, steps: steps },
                bars: { show: bars, barWidth: 0.6 }
            }
        });
    }
    plotWithOptions();    		
");

?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/css/jflot/layout.css" />
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jflot/jquery.flot.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jflot/jquery.flot.selection.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jflot/jquery.flot.pie.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/ufs/js/jflot/jjquery.flot.stack.js"></script> 

<div class="content-head underline">
	<h2><?php echo Yii::t('label','Navigations')?></h2>
	<div class="content-action">
	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                	   array('label'=>Yii::t('label','Update'),'linkOptions'=>array('id'=>'UpdateItem'),'id'=>$model->fItemNo,'url'=>array('update'),'visible'=>Yii::app()->user->checkAccess('Item.item.Update')),
						array('label'=>Yii::t('label','View'),'linkOptions'=>array('class'=>'current'), 'id'=>$model->fItemNo,'url'=>array('view'),'visible'=>Yii::app()->user->checkAccess('Item.item.View')),			
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">
<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'vertical-form'),
)); ?>
	<?php echo $form->errorSummary($model); ?>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemNum'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemNum',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fItemNum'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemName'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemName',array('size'=>60,'maxlength'=>200)); ?>
   
          <?php echo $form->error($model,'fItemName'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fItemType'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fItemType',array('size'=>60,'maxlength'=>100)); ?>
   
          <?php echo $form->error($model,'fItemType'); ?>
        
      	</div>
      </div>
      
	<div class="input-group">
          <?php echo $form->labelEx($model,'fResponsibleCreate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fResponsibleCreate',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fResponsibleCreate'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fTemplateNo'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fTemplateNo',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fTemplateNo'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fStatus'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fStatus'); ?>
   
          <?php echo $form->error($model,'fStatus'); ?>
        
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

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateUser'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateUser',array('size'=>50,'maxlength'=>50)); ?>
   
          <?php echo $form->error($model,'fUpdateUser'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fUpdateDate'); ?>
     
          <div class="inputs">
          <?php echo $form->textField($model,'fUpdateDate'); ?>
   
          <?php echo $form->error($model,'fUpdateDate'); ?>
        
      	</div>
      </div>

	  <div class="input-group">
          <?php echo $form->labelEx($model,'fContent'); ?>
     
          <div class="inputs">
          <?php echo $form->textArea($model,'fContent',array('rows'=>6, 'cols'=>50)); ?>
   
          <?php echo $form->error($model,'fContent'); ?>
        
      	</div>
      </div>
      
      <div class="form-submit">
		<?php echo CHtml::submitButton(Yii::t('label','Save'), array('class' =>'btn-icon submit no-margin' , )); ?>
	  </div>
<?php $this->endWidget(); ?>

<h2><?php echo Yii::t('label','项目任务')?></h2>
<div id="placeholder1" style="width:600px;height:300px"></div>


 <h1>Flot Examples</h1>

    <div id="placeholder" style="width:900px;height:300px;"></div>

<script id="source">
$(function () {
   
});
</script>

<input type="hidden" value="<?php echo $keyid;?>" id="hiddenpkey" name="hiddenpkey" />
 <ul class="widgetlist">
       <li><a href="<?php echo Yii::app()->baseUrl;?>/index.php/Item/item/view/id/<?php echo $keyid;?>"><span><?php echo Yii::t('label','Items') ?></span></a></li>
   <li><a href="<?php echo Yii::app()->baseUrl;?>/index.php/Item/item/catalogue/id/<?php echo $keyid;?>"><span><?php echo Yii::t('label','Itemcatalogues') ?></span></a></li>
    <li><a href="<?php echo Yii::app()->baseUrl;?>/index.php/Item/item/task/id/<?php echo $keyid;?>"><span><?php echo Yii::t('label','Itemusers') ?></span></a></li>
   <li><a href="<?php echo Yii::app()->baseUrl;?>/index.php/Item/task/grid/id/<?php echo $keyid;?>"><span><?php echo Yii::t('label','Tasks') ?></span></a></li>
    <li><a href="<?php echo Yii::app()->baseUrl;?>/index.php/Item/resultdocument/resgrid/id/<?php echo $keyid;?>"><span><?php echo Yii::t('label','Resultdocuments') ?></span></a></li>
    <li><a href="<?php echo Yii::app()->baseUrl;?>/index.php/Item/resultdocument/docgrid/id/<?php echo $keyid;?>"><span><?php echo Yii::t('label','Documents') ?></span></a></li>
    <li><a href="<?php echo Yii::app()->baseUrl;?>/index.php/Item/item/calender/id/<?php echo $keyid;?>"><span><?php echo Yii::t('label','ItemCalendars') ?></span></a></li>
   </ul>
</div><!-- form -->
<?php echo $msg ?>


	<h1><?php echo Yii::t('label','Tasks')?></h1>
	<div id="Tasks_interactive" class="graph interactive"></div>
	<h1><?php echo Yii::t('label','Resultdocuments')?></h1>
	<div id="Resultdocuments_interactive" class="graph interactive"></div>
	<h1><?php echo Yii::t('label','Documents')?></h1>
    <div id="Documents_interactive" class="graph interactive"></div>
	
	
	