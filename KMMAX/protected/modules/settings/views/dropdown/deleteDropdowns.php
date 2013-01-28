<h3>Delete A Custom Dropdown</h3>
<br /> <span style="color:red;"><b><?php echo Yii::t('admin','WARNING');?>:</b> <?php echo Yii::t('admin','this operation is not reversible, and will create issues with any forms using the deleted dropdown.');?></span>
<form name="deleteDropdowns" action="deleteDropdown" method="POST">
	<br />
	<select name="dropdown">
		<?php foreach($dropdowns as $dropdown) echo "<option value='$dropdown->id'>$dropdown->name</option>"; ?>
	</select>
	<br /><br />
	<input class="x2-button" type="submit" value="<?php echo Yii::t('admin','Delete');?>" />
</form>