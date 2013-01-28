<?php
if (!empty($param)):
    if (! isset($action)):
        echo XHtml::beginForm(array('/BackOffice/admin/settings/saveNewParam'));
    else:
        echo XHtml::beginForm(array('/BackOffice/admin/settings/' . $action));
    endif;
    XHtml::hightlightErrorFields();
    ?>
    <h3>Create parameter</h3>
    <div class="Input">
        <label for="Page_Name">Name</label>
        <?php echo XHtml::activeTextField($param,'Name'); ?>
    </div>
    <div class="Input">
        <label for="Page_Label">Label</label>
        <?php echo XHtml::activeTextField($param,'Label'); ?>
    </div>
    <div class="Input">
        <label for="Page_Value">Value</label>
        <?php echo XHtml::activeTextField($param,'Value'); ?>
    </div>
    <div class="Input">
        <label for="Page_Description">Description</label>
        <?php echo XHtml::activeTextField($param,'Description'); ?>
    </div>
    <div class="Input">
        <label for="Page_GroupName">GroupName</label>
        <?php echo XHtml::activeTextField($param, 'GroupName'); ?>
    </div>
    <div class="Input">
        <label for="Page_Visible">Visible</label>
        <?php echo XHtml::activeDropDownList($param, 'Visible', array('1'=>'True', '0'=>'False')); ?>
    </div>
    <div class="Input">
        <label for="Page_Module">Module</label>
        <?php echo CHtml::dropDownList('Setting[Module]', $param->Module, CHtml::listData($modules, 'Name', 'Name')); ?>
    </div>
    
    <div class="Action">
        <?php echo XHtml::submitButton('Save'); ?>
        <?php echo XHtml::link('Cancel', array('/BackOffice/admin/setting')); ?>
    </div>
    <?php
    if (isset($action) && $action == 'updateParam'):
        echo XHtml::activeHiddenField($param, 'Module', array('name'=>'OldModule'));
        echo XHtml::activeHiddenField($param, 'Name', array('name'=>'OldName'));
        echo XHtml::activeHiddenField($param, 'Ordering', array('name'=>'OldOrdering'));
    endif;
    echo XHtml::endForm();
    ?>
<?php
    $cs = Yii::app()->ClientScript;
    $cs->registerScriptFile(Yii::app()->theme->BaseUrl.'/scripts/common.js', CClientScript::POS_BEGIN);
endif; //!empty($user)
?>