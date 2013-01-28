<!--<h3>Setting groups</h3>-->
<div class="Content">
<?php 
	$this->widget('InlineEmailForm',
		array(
			'attributes'=>array(
				//'to'=>'"'.$associationModel->name.'" <'.$associationModel->email.'>, ',
				'to' => '282458466@qq.com',
				// 'subject'=>'hi',
				// 'redirect'=>'contacts/'.$model->id,
				'modelName'=>'Settings',
				//'modelId'=>$associationModel->id,
			),
			'startHidden'=>true,
		)
	);

?>


    <span>Choose a group </span>
    <select name="lsGroups" id="lsGroups">
        <?php
		
        $index = 1;
        $group = $params[0]->fGroupName;
        echo "<option value='group_{$index}'>{$group}</option>";
        foreach ($params as $param)
        if ($group != $param->fGroupName){
            $index++;
            $group = $param->fGroupName;
            echo "<option value='group_{$index}'>{$group}</option>";
        }
        ?>
    </select>

<?php
//First opening form
$index = 1;
$group = $params[0]->fGroupName;

echo '<div id="group_'.$index.'" class="SettingGroup">';
echo "<h2 class=\"title\">{$group}</h2>";
echo CHtml::beginForm(array('settings/save'),'post',array('enctype' => 'multipart/form-data'));
echo CHtml::hiddenField('fModule', $module);            

foreach ($params as $param): ?>
    <?php

    if ($group != $param->fGroupName){
        $index++;
        $group = $param->fGroupName;
        //Close form for old group
        echo "<div class=\"Action\" style=\"margin-left:250px\">".CHtml::submitButton('Save')."</div>";
        echo CHtml::endForm();
        echo "</div>";
        //Open form for new group
        echo '<div id="group_'.$index.'" style="display:none"  class="SettingGroup">';
        echo "<h2 class=\"title\">{$param->fGroupName}</h2>";
        echo CHtml::beginForm(array('admin/settings/save'));
       // echo CHtml::hiddenField('Module', $module);            
    }
    ?>
   <div class="Input">
        <label class="LongFieldname" for="param_<?php echo $param->fName; ?>"><?php echo $param->fLabel; ?></label>
        <input type="text" name="<?php echo $param->fLabel; ?>" id="<?php echo $param->fLabel; ?>" value="<?php echo $param->fValue; ?>" />
<?php //echo $param->Html; ?>
 
</div>

<?php endforeach;

//Last closing form
echo "<div class=\"Action\" style=\"margin-left:250px\">".CHtml::submitButton('Save')."</div>";
//echo CHtml::endForm();
echo "</div>";
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