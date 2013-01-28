
<h3><?php echo $module . " Parameters"; ?></h3>

<?php
$output = CHtml::beginForm('', 'post', array('id'=>'frmModule'));
$output .= "<span>Select module to see setting param</span> ";
$output .= "<select name='module' id='lsModules'>";
foreach($modules as $m):
    if (empty($m['fModule'])) $m['fModule'] = 'System';
    $output .= "<option value='" . $m['fModule'] . "' " . ($m['fModule'] == $module ? "selected='selected'" : "") . ">" . $m['fModule'] . "</option>";
endforeach;
$output .= "</select>";
$output .= CHtml::endForm();
echo $output;
?>

<?php
if (count($params)):
    $groups = array_keys($params);
    $i = 0;
    foreach($groups as $group):
?>
        <h2 class="title"><?php echo $group; ?></h2>
        <table id="itemList_<?php echo $i; ?>" cellpadding="0" cellspacing="0" width="100%" class="view">
            <thead>
                <tr>
                    <th class="LeftAlign" >fName</th>
                    <th>fLabel</th>
                    <th>fValue</th>
                    <th nowrap="nowrap" class="Last"><a>Action</a></th>            
                </tr>
            </thead>
            <tbody>
                <?php foreach ($params[$group] as $param): ?>
                <tr class="ItemRow" id='<?php echo json_encode(array("fName"=>$param->fName, "fGroupName"=>$param->fGroupName, "fModule"=>$param->fModule)); ?>'>
                    
                    <td class="LeftAlign">
                        <?php echo $param->fName; ?>
                    </td>  
                    
                    <td><?php echo $param->fLabel; ?></td>
                     <td><?php echo $param->fValue; ?></td>
                    <td><?php //echo Utility::getFirstWordsFromString(htmlentities($param->fValue), 5); ?></td>
                    
                    <td class="action" nowrap="nowrap">                
                        <a href="<?php echo $this->createUrl('admin/settings/edit', array('fModule'=>urlencode($param->fModule), 'fName'=>urlencode($param->fName))) ?>" class="editJob">
                            <img alt="icon edit" src="<?php echo Yii::app()->theme->BaseUrl; ?>/images/ico-edit.gif" />
                        </a>
                        <a href="#" class="deleteItem"><img src="<?php echo Yii::app()->theme->BaseUrl ?>/images/ico-delete.gif" alt="icon delete" /></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<?php
        $i++;
    endforeach;
endif;
?>
<?php
    Yii::app()->clientScript->registerScript('select-module', "
		
		    jQuery('#lsModules').bind('change', function(){
		        jQuery('#frmModule').submit();
		    });
		    

	");
    ?>

<style>
#mainContent h2.title {
    height: 20px;
    padding-left: 5px;
}
</style>