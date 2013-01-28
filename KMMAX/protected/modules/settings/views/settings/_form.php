
<h3>Create parameter</h3>
    <div class="Input">
        <label for="Page_Name">Name</label>
        <?php  echo CHtml::activeTextField($param,'fName'); ?>
    </div>
    <div class="Input">
        <label for="Page_Label">Label</label>
        <?php echo CHtml::activeTextField($param,'fLabel'); ?>
    </div>
    <div class="Input">
        <label for="Page_Value">Value</label>
        <?php echo CHtml::activeTextField($param,'fValue'); ?>
    </div>
    <div class="Input">
        <label for="Page_Description">Description</label>
        <?php echo CHtml::activeTextField($param,'fDescription'); ?>
    </div>
    <div class="Input">
        <label for="Page_GroupName">GroupName</label>
        <?php echo CHtml::activeTextField($param, 'fGroupName'); ?>
    </div>
    <div class="Input">
        <label for="Page_Visible">Visible</label>
        <?php echo CHtml::activeDropDownList($param, 'fVisible', array('1'=>'True', '0'=>'False')); ?>
    </div>
    <div class="Input">
        <label for="Page_Module">Module</label>
        <?php // echo CHtml::dropDownList('Setting[Module]', $param->fModule, CHtml::listData($modules, 'fName', 'fName')); ?>
    </div>
    
    <div class="Action">
        <?php echo CHtml::submitButton('Save'); ?>
        <?php //echo CHtml::link('Cancel', array('/BackOffice/admin/setting')); ?>
    </div>
    