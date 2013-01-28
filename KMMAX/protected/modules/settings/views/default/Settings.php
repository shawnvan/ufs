<!--<h3>Setting groups</h3>-->
<div class="Content">
<?php 
if (count($params)):
?>
    <span>Choose a group </span>
    <select name="lsGroups" id="lsGroups">
        <?php
        $index = 1;
        $group = $params[0]->GroupName;
        echo "<option value='group_{$index}'>{$group}</option>";
        foreach ($params as $param)
        if ($group != $param->GroupName){
            $index++;
            $group = $param->GroupName;
            echo "<option value='group_{$index}'>{$group}</option>";
        }
        ?>
    </select>
<?php endif; ?>
</div>

<?php if ($module !== ''): ?>
    <div class="Section">
        <a href="<?php echo $this->createUrl("/BackOffice/admin/modules/dashboard", array('module' => $module)) ?>">&laquo; Back to <?php echo $module ?> dashboard</a>
    </div>            
<?php endif; ?>

<h3><?php echo $module == '' ? 'System' : $module; ?> settings</h3>            

<?php
if (count($params)):?>

<?php
//First opening form
$index = 1;
$group = $params[0]->GroupName;
echo '<div id="group_'.$index.'" class="SettingGroup">';
echo "<h2 class=\"title\">{$group}</h2>";
echo XHtml::beginForm(array('admin/settings/save'),'post',array('enctype' => 'multipart/form-data'));
echo XHtml::hiddenField('Module', $module);            

foreach ($params as $param): ?>
    <?php
    if ($group != $param->GroupName){
        $index++;
        $group = $param->GroupName;
        //Close form for old group
        echo "<div class=\"Action\" style=\"margin-left:250px\">".XHtml::submitButton('Save')."</div>";
        echo XHtml::endForm();
        echo "</div>";
        //Open form for new group
        echo '<div id="group_'.$index.'" style="display:none"  class="SettingGroup">';
        echo "<h2 class=\"title\">{$param->GroupName}</h2>";
        echo XHtml::beginForm(array('admin/settings/save'));
        echo XHtml::hiddenField('Module', $module);            
    }
    ?>
    <div class="Input">
        <label class="LongFieldname" for="param_<?php echo $param->Name ?>"><?php echo $param->Label ?></label>
        <?php echo $param->Html; ?>
    </div>
<?php endforeach;

//Last closing form
echo "<div class=\"Action\" style=\"margin-left:250px\">".XHtml::submitButton('Save')."</div>";
echo XHtml::endForm();
echo "</div>";
?>
<?php
$cs = Yii::app()->ClientScript;
$cs->registerScriptFile(Yii::app()->theme->BaseUrl.'/scripts/common.js', CClientScript::POS_BEGIN);

endif;  //If count ($params)
?>

<script>
function showSettingGroup(id){
    $('.SettingGroup').hide();
    $('#'+id).show();
}
$("#lsGroups").change(function(){
    showSettingGroup($("#lsGroups").val());
});
</script>

<style>
#mainContent h2.title {
    height:20px;
    padding-left:5px;
}
</style>