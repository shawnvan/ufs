<?php if($displayGrid===true): ?>

<table id="<?php echo $gridId; ?>" class="w3-hidden">
  <tr>
    <td></td>
  </tr>
</table>
<div id="<?php echo $gridPagerId; ?>" class="w3-hidden"></div>
<?php endif; /*end if displayGrid*/ ?>
<?php if($displaySGrid===true): ?>
<?php if($displayButtonClose===true): ?>
<?php ClientScriptUtil::registerScript('gridClose',array('selector'=>'#'.$sGridId)); ?>
<?php endif; ?>
<?php if($hasLinkIcon===true): ?>
<?php ClientScriptUtil::registerScript('linkIcon',array('box'=>'w3-ig')); ?>
<?php endif; ?>
<?php endif; /*end if displaySGrid*/ ?>
<?php if($displayGrid===true): ?>
<?php $colNames=''; ?>
<?php if(count($columns)): ?>
<?php $n=0; ?>
<?php foreach($columns as $row): ?>
<?php $colNames.=($n===0?'':',')."'".$row['title']."'"; ?>
<?php $n++; ?>
<?php endforeach; ?>
<?php else: ?>
<?php $colNames="''"; ?>
<?php endif; /*end if count columns*/ ?>
<?php $colModel=''; ?>
<?php if(count($columnsModel)): ?>
<?php $n=0; ?>
<?php foreach($columnsModel as $row): ?>
<?php $colModel.=($n===0?'':',')."
      {"; ?>
<?php $i=0; ?>
<?php foreach($row as $k=>$v): ?>
<?php $colModel.=($i===0?'':',').$k.':'.(is_string($v)?"'".$v."'":($v===true?'true':($v===false?'false':$v))); ?>
<?php $i++; ?>
<?php endforeach; ?>
<?php $colModel.="}"; ?>
<?php $n++; ?>
<?php endforeach; /*end foreach row*/ ?>
<?php else: ?>
<?php $colModel="
      {name:'colModel',width:99}"; ?>
<?php endif; /*end if count columnsModel*/ ?>
<?php 

Yii::app()->getClientScript()->registerScript('grid['.$gridId.']',"


jQuery('#".$gridId."').removeClass('w3-hidden');
jQuery('#".$gridPagerId."').removeClass('w3-hidden');

jQuery.jgrid.formatter.integer.thousandsSeparator = ',';
jQuery.jgrid.formatter.number.thousandsSeparator = ',';
jQuery.jgrid.formatter.currency.thousandsSeparator = ',';
$grid = jQuery('#".$gridId."'),
initDateSearch = function (elem) {
	setTimeout(function () {
		jQuery(elem).datepicker({
			dateFormat: 'dd-M-yy',
			autoSize: true,
			//showOn: 'button', // it dosn't work in searching dialog
			changeYear: true,
			changeMonth: true,
			showButtonPanel: true,
			showWeek: true,
			onSelect: function () {
				var that = this;
				if (this.id.substr(0, 3) === 'gs_') {
					setTimeout(function () {
						that.triggerToolbar();
					}, 50);
				} else {
					// to refresh the filter
					$(this).trigger('change');
				}
			}
		});
	}, 100);
},
numberSearchOptions = ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'nu', 'nn', 'in', 'ni'],
numberTemplate = {formatter: 'number', align: 'right', sorttype: 'number',
	searchoptions: { sopt: numberSearchOptions }},
cm=[".$colModel."],
saveObjectInLocalStorage = function (storageItemName, object) {
	if (typeof window.localStorage !== 'undefined') {
		window.localStorage.setItem(storageItemName, JSON.stringify(object));
	}
},
removeObjectFromLocalStorage = function (storageItemName) {
	if (typeof window.localStorage !== 'undefined') {
		window.localStorage.removeItem(storageItemName);
	}
},
getObjectFromLocalStorage = function (storageItemName) {
	if (typeof window.localStorage !== 'undefined') {
		return JSON.parse(window.localStorage.getItem(storageItemName));
	}
},
myColumnStateName = 'ColumnChooserAndLocalStorage.colState',
saveColumnState = function (perm) {
	var colModel = this.jqGrid('getGridParam', 'colModel'), i, l = colModel.length, colItem, cmName,
		postData = this.jqGrid('getGridParam', 'postData'),
		columnsState = {
			search: this.jqGrid('getGridParam', 'search'),
			page: this.jqGrid('getGridParam', 'page'),
			sortname: this.jqGrid('getGridParam', 'sortname'),
			sortorder: this.jqGrid('getGridParam', 'sortorder'),
			permutation: perm,
			colStates: {}
		},
		colStates = columnsState.colStates;

	if (typeof (postData.filters) !== 'undefined') {
		columnsState.filters = postData.filters;
	}

	for (i = 0; i < l; i++) {
		colItem = colModel[i];
		cmName = colItem.name;
		if (cmName !== 'rn' && cmName !== 'cb' && cmName !== 'subgrid') {
			colStates[cmName] = {
				width: colItem.width,
				hidden: colItem.hidden
			};
		}
	}
	saveObjectInLocalStorage(myColumnStateName, columnsState);
	
},
myColumnsState,
isColState,
restoreColumnState = function (colModel) {
	var colItem, i, l = colModel.length, colStates, cmName,
		columnsState = getObjectFromLocalStorage(myColumnStateName);

	if (columnsState) {
		colStates = columnsState.colStates;
		for (i = 0; i < l; i++) {
			colItem = colModel[i];
			cmName = colItem.name;
			if (cmName !== 'rn' && cmName !== 'cb' && cmName !== 'subgrid') {
				colModel[i] = $.extend(true, {}, colModel[i], colStates[cmName]);
			}
		}
	}
	return columnsState;
},
firstLoad = true;

myColumnsState = restoreColumnState(cm);
isColState = typeof (myColumnsState) !== 'undefined' && myColumnsState !== null;



$grid.jqGrid({
	url:'".$url."',
    datatype: '".$datatype."',
    mtype: '".$mtype."',
    colNames: [".$colNames."],
    colModel: cm,
    pager: '#".$gridPagerId."',
	page: isColState ? myColumnsState.page : 1,
	
	page: isColState ? myColumnsState.page : 1,
	search: isColState ? myColumnsState.search : false,
	postData: isColState ? { filters: myColumnsState.filters } : {},
	sortname: isColState ? '".$sortname."' : 'invdate',
	sortorder: isColState ? '".$sortname."' : 'desc',

	
	gridview: true,
    rowNum: ".$rowNum.",
    rowList: ".$rowList.",
	autowidth: true,
	rownumbers:".$rownumbers.",
	ShowToolTip:false,
    viewrecords: ".($viewrecords===false?'false':'true').",".($displayTitlebar ? "
    caption: '".$title."'," : '')."
    shrinkToFit: true,
	height: ".$height.",
    gridComplete: function(){".($displaySGrid===true ? "
        if(jQuery('#".$sGridWrapperId."').css('display') != 'none'){
            jQuery('#".$sGridWrapperId."').hide();" : '')."
		}
		jQuery('#".$gridId." tr:nth-child(even)').addClass('jqgrow evenTableRow');
		jQuery('#".$gridId." tr:nth-child(odd)').addClass('jqgrow oddTableRow');
/*		
		jQuery("."div[class='ui-jqgrid ui-widget ui-widget-content ui-corner-all']".").removeClass('width');
		jQuery("."div[class='ui-jqgrid ui-widget ui-widget-content ui-corner-all']".").css('width','100%');
		jQuery("."div[class='ui-jqgrid-view']".").removeClass('width');
		jQuery("."div[class='ui-jqgrid-view']".").css('width','100%');
		jQuery("."div[class='ui-state-default ui-jqgrid-hdiv']".").removeClass('width');
		jQuery("."div[class='ui-state-default ui-jqgrid-hdiv']".").css('width','100%');
		jQuery("."table[class='ui-jqgrid-htable']".").removeClass('width');
		jQuery("."table[class='ui-jqgrid-htable']".").css('width','100%');
		jQuery("."div[class='ui-state-default ui-jqgrid-pager ui-corner-bottom']".").removeClass('width');
		jQuery("."div[class='ui-state-default ui-jqgrid-pager ui-corner-bottom']".").css('width','100%');
		*/

    },
    loadComplete: function(){".(($displaySGrid===true && $hasLinkIcon===true) ? '
        '.ClientScriptUtil::registerScript('linkIcon',array('box'=>'w3-ig'),true) . ($registerGridLinkIcon?'
        '.ClientScriptUtil::registerScript('gridLinkIcon',array('controllerId'=>$controllerId,'gridId'=>$gridId),true):'') : '').",
		if (firstLoad) {
                        firstLoad = false;
                        if (isColState) {
                            $(this).jqGrid('remapColumns', myColumnsState.permutation, true);
                        }
                    }
                    saveColumnState.call($(this), this.p.remapColumns);

    },
	//ondblClickRow: function(rowid,status){  jQuery('#".$gridId."').resetSelection(); }
	onSelectRow:function(rowid,e){
		 jQuery('#".$gridId."').children('tbody').children('tr').children('td').children('a').hide();
	     jQuery('#'+rowid).children('td').children('a').show();	
		 if(!e){
			jQuery('#".$gridId."').resetSelection();
			jQuery('#".$gridId."').children('tbody').children('tr').children('td').children('a').hide();
		 }
	},
	resizeStop: function () {
		saveColumnState.call($grid, $grid[0].p.remapColumns);
	}

});

//添加滚动条
//jQuery('#".$gridId."').closest('.ui-jqgrid-bdiv').css({ 'overflow-y' : 'scroll'});
//添加固定字段
//添加过滤条件
jQuery('#".$gridId."').jqGrid('navGrid','#".$gridPagerId."',{edit:false,add:false,del:false},{},{},{},{multipleSearch:true});
//添加键盘上下移动事件
 
jQuery('#".$gridId."').jqGrid('bindKeys');

//添加选择显示隐藏字段
jQuery('#".$gridId."').jqGrid('navButtonAdd','#".$gridPagerId."',{
    caption: 'Columns',
    title: 'Reorder Columns',
    onClickButton : function (){
		jQuery('#".$gridId."').jqGrid('columnChooser', {
			done: function (perm) {
				if (perm) {
					this.jqGrid('remapColumns', perm, true);
					saveColumnState.call(this, perm);
				}
			}
		});
		removeObjectFromLocalStorage(myColumnStateName);
		window.location.reload();

    }
});
var gridurl;
function gridReload(gridurl){
	jQuery('#".$gridId."').jqGrid('setGridParam',{url:gridurl,page:1}).trigger('reloadGrid');
}
");
/* gridComplete is called after most of the grid changes
 * loadComplete is called only after data is loaded*/ ?>
<?php endif; /*end if displayGrid*/ ?>
