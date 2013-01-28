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
<?php $colModel="{name:'colModel',width:99}"; ?>
<?php endif; /*end if count columnsModel*/ ?>
<?php 
Yii::app()->getClientScript()->registerScript('grid['.$gridId.']',"

$.jgrid.formatter.integer.thousandsSeparator = ',';
$.jgrid.formatter.number.thousandsSeparator = ',';
$.jgrid.formatter.currency.thousandsSeparator = ',';

var grid = jQuery('#".$gridId."'),
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

cm=[".$colModel."],
numberSearchOptions = ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'nu', 'nn', 'in', 'ni'],
numberTemplate = {formatter: 'number', align: 'right', sorttype: 'number',
	searchoptions: { sopt: numberSearchOptions }},
   saveObjectInLocalStorage = function (storageItemName, object) {
	if (typeof window.localStorage !== 'undefined') {
		window.localStorage.setItem(storageItemName, JSON.stringify(object));
		jQuery.post(
			'".Yii::app()->createUrl('users/UserProfile/create')."',{myColumnStateName:myColumnStateName,columnsState:JSON.stringify(object),modulename:'".$modulename."'}
		);

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
	var colModel = this.jqGrid('getGridParam', 'colModel'), i, l = cm.length, colItem, cmName,
		postData = this.jqGrid('getGridParam', 'postData'),
		columnsState = {
			search: this.jqGrid('getGridParam', 'search'),
			page: this.jqGrid('getGridParam', 'page'),
			sortname: this.jqGrid('getGridParam', 'sortname'),
			sortorder: this.jqGrid('getGridParam', 'sortorder'),
			lastsort: this.jqGrid('getGridParam', 'lastsort'),
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
firstLoad = true,
gridsearch = true;

myColumnsState = restoreColumnState(cm);
isColState = typeof (myColumnsState) !== 'undefined' && myColumnsState !== null;


grid.removeClass('w3-hidden');
jQuery('#".$gridPagerId."').removeClass('w3-hidden');
grid.jqGrid({
	url:'".$url."',
    datatype: '".$datatype."',
    mtype: '".$mtype."',
    colNames: [".$colNames."],
    colModel: cm,
    pager: '#".$gridPagerId."',
    rowNum: ".$rowNum.",
    rowList: ".$rowList.",
	autowidth: true,
	rownumbers:".$rownumbers.",
	sortname: isColState ? myColumnsState.sortname : '".$sortname."',
	sortorder: isColState ? myColumnsState.sortorder : '".$sortname."',
	ShowToolTip:false,
    viewrecords: ".($viewrecords===false?'false':'true').",".($displayTitlebar ? "
    caption: '".$title."'," : '')."
    shrinkToFit: true,
    multiselect: ".($multiselect===null || $multiselect===false?'false':'true').",										
	height: ".$height.",
	grouping:".$grouping.",
	groupingView : {
   		groupField : ['".$groupField."'],
   	},
    gridComplete: function(){".($displaySGrid===true ? "
        if(jQuery('#".$sGridWrapperId."').css('display') != 'none'){
            jQuery('#".$sGridWrapperId."').hide();" : '')."
		}
		jQuery('#".$gridId." tr:nth-child(even)').addClass('jqgrow evenTableRow');
		jQuery('#".$gridId." tr:nth-child(odd)').addClass('jqgrow oddTableRow');		
    },
    loadComplete: function(){".(($displaySGrid===true && $hasLinkIcon===true) ? '
        '.ClientScriptUtil::registerScript('linkIcon',array('box'=>'w3-ig'),true) . ($registerGridLinkIcon?'
        '.ClientScriptUtil::registerScript('gridLinkIcon',array('controllerId'=>$controllerId,'gridId'=>$gridId),true):'') : '').";
// 		if (firstLoad) {
//			firstLoad = false;
//			
//		};
		if (isColState) {
		    $(this).jqGrid('remapColumns', myColumnsState.permutation, true);
		    if(myColumnsState.lastsort > -1)
		      $(this).jqGrid('setGridParam', { lastsort: myColumnsState.lastsort });
		  }
		if(gridsearch){
			saveColumnState.call($(this), this.p.remapColumns);
		};
		gridsearch=true;
	},
	ondblClickRow: function(rowid,status){dbClickRow(rowid,status); },
	onSelectRow:function(rowid,e){
		 grid.children('tbody').children('tr').children('td').children('a').hide();
	     jQuery('#'+rowid).children('td').children('a').show();	
		 if(!e){
			grid.resetSelection();
			grid.children('tbody').children('tr').children('td').children('a').hide();
		 }
	},
	resizeStop: function () {
		saveColumnState.call(grid, grid[0].p.remapColumns);
	}
});

//添加滚动条
//grid.closest('.ui-jqgrid-bdiv').css({ 'overflow-y' : 'scroll'});
//添加固定字段
//添加过滤条件
grid.jqGrid('navGrid','#".$gridPagerId."',{edit:false,add:false,del:false},{},{},{},{multipleSearch:true});
//添加键盘上下移动事件
 
grid.jqGrid('bindKeys');

//添加选择显示隐藏字段
grid.jqGrid('navButtonAdd','#".$gridPagerId."',{
    caption: 'Columns',
    title: 'Reorder Columns',
    onClickButton : function (){
		grid.jqGrid('columnChooser', {
			done: function (perm) {
				if (perm) {
					this.jqGrid('remapColumns', perm, true);
					saveColumnState.call(this, perm);
				}
			}
		});
    }
});
grid.jqGrid('navButtonAdd', '#pager', {
	caption: '',
	buttonicon: 'ui-icon-closethick',
	title: 'clear saved grids settings',
	onClickButton: function () {
		removeObjectFromLocalStorage(myColumnStateName);
		window.location.reload();
	}
});
var gridurl;
function gridReload(gridurl){
	gridsearch = false;

	grid.jqGrid('setGridParam',{url:gridurl,page:1}).trigger('reloadGrid');
}
 function gridDoubleReload(gridurl,newgird){
				
	var grid =newgird,	
	gridsearch = false;
	grid.jqGrid('setGridParam',{url:gridurl,page:1}).trigger('reloadGrid');
}
			
");
/* gridComplete is called after most of the grid changes
 * loadComplete is called only after data is loaded*/ ?>
<?php endif; /*end if displayGrid*/ ?>
