<h2><?php echo Yii::t('admin','Dropdown List');?></h2>
<div style="width:600px;"><?php echo Yii::t('admin','Manage all dropdowns.  These can be linked to fields via Field Management.  Any default dropdowns can also be edited here to change the available options throughout the application.  Deleting default dropdowns may cause issues with pre-existing forms.') ?>
</div><br /><br />
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fields-grid',
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<h2>'.Yii::t('accounts','Dropdowns').'</h2><div class="title-bar">'
		.'{summary}</div>{items}{pager}',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'name',
		'options',
		/*
		'tickerSymbol',
		'employees',
		'associatedContacts',
		'notes',
		*/
	),
)); ?>
<br />
<a href="#" onclick="$('#createDropdown').toggle();$('#deleteDropdown').hide();$('#editDropdown').hide();" class="x2-button">Create Dropdown</a>
<a href="#" onclick="$('#deleteDropdown').toggle();$('#createDropdown').hide();$('#editDropdown').hide();" class="x2-button">Delete Dropdown</a>
<a href="#" onclick="$('#editDropdown').toggle();$('#createDropdown').hide();$('#deleteDropdown').hide();" class="x2-button">Edit Dropdown</a>
<br />
<br />
<div id="createDropdown" style="display:none;">
<?php $this->renderPartial('dropDownEditor',array(
    'model'=>$model,
)); ?>
</div>
<div id="deleteDropdown" style="display:none;">
<?php $this->renderPartial('deleteDropdowns',array(
    'dropdowns'=>$dropdowns,
)); ?>
</div>
<div id="editDropdown" style="display:none;">
<?php $this->renderPartial('editDropdown',array(
    'model'=>$model,
)); ?>
</div>