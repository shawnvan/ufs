<?php
    $this->ActiveMenu = 'page/managePage';
    $cs = Yii::app()->ClientScript;
    $cs->registerScriptFile(Yii::app()->theme->BaseUrl.'/scripts/common.js', CClientScript::POS_BEGIN);
    $cs->registerScriptFile(Yii::app()->request->getBaseUrl(true).'/themes/global/scripts/jquery.tablesorter.js', CClientScript::POS_BEGIN);
    $cs->registerScriptFile(Yii::app()->request->getBaseUrl(true).'/themes/global/scripts/jquery-ui-1.7.2.interaction.min.js', CClientScript::POS_BEGIN);
?>
    
<h3><?php echo $module . " Parameters"; ?></h3>

<?php
$output = XHtml::beginForm('', 'post', array('id'=>'frmModule'));
$output .= "<span>Select module to see setting param</span> ";
$output .= "<select name='module' id='lsModules'>";
foreach($modules as $m):
    if (empty($m['Module'])) $m['Module'] = 'System';
    $output .= "<option value='" . $m['Module'] . "' " . ($m['Module'] == $module ? "selected='selected'" : "") . ">" . $m['Module'] . "</option>";
endforeach;
$output .= "</select>";
$output .= XHtml::endForm();
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
                    <th class="LeftAlign" >Name</th>
                    <th>Label</th>
                    <th>Value</th>
                    <th nowrap="nowrap" class="Last"><a>Action</a></th>            
                </tr>
            </thead>
            <tbody>
                <?php foreach ($params[$group] as $param): ?>
                <tr class="ItemRow" id='<?php echo json_encode(array("Name"=>$param->Name, "GroupName"=>$param->GroupName, "Module"=>$param->Module)); ?>'>
                    
                    <td class="LeftAlign">
                        <?php echo $param->Name; ?>
                    </td>  
                    
                    <td><?php echo $param->Label; ?></td>
                    
                    <td><?php echo Utility::getFirstWordsFromString(htmlentities($param->Value), 5); ?></td>
                    
                    <td class="action" nowrap="nowrap">                
                        <a href="<?php echo $this->createUrl('admin/settings/edit', array('Module'=>urlencode($param->Module), 'Name'=>urlencode($param->Name))) ?>" class="editJob">
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

<script type="text/javascript" src="<?php echo Yii::app()->request->BaseUrl; ?>/themes/global/scripts/setting.list.js"></script>
<script type="text/javascript">
    var totalGroups = <?php echo count($groups); ?>;
</script>
<style>
#mainContent h2.title {
    height: 20px;
    padding-left: 5px;
}
</style>