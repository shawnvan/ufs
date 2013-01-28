<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>
Yii::app()->clientScript->registerScript('gethiddenpkey', "
$('.submenu .current').click(function(){
	return false;
});
");
?>

<div class="content-head underline">
	<h2><?php echo $label; ?></h2>

	<div class="content-action">

	<?php echo "<?php"; ?>
        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List <?php echo $this->modelClass; ?>'), 'url'=>array('index'),'linkOptions'=>array('class'=>'current'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Index')),
						array('label'=>Yii::t('label','Create <?php echo $this->modelClass; ?>'), 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Create')),					
						array('label'=>Yii::t('label','Manage <?php echo $this->modelClass; ?>'), 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess('<?php echo $this->ModuleID; ?>.<?php echo $this->ControllerID; ?>.Admin')),					
                    ),
                ));
    ?>
	</div>
</div>
<div class="content">

<?php echo "<?php"; ?>
     $this->widget('application.modules.UFSBase.utils.WGrid',array(
        'columns'=>array(
            <?php
			$count=0;
			foreach($this->tableSchema->columns as $column)
			{
				if(++$count==7)
					echo "\t\t/*\n";
					echo "\t\tarray('title'=>CHtml::encode(\$sort->resolveLabel('".$column->name."'))),\n";
			}
			if($count>=7)
				echo "\t\t*/\n";
			?>
        ),
        'columnsModel'=>array(
 			<?php
			$count=0;
			foreach($this->tableSchema->columns as $column)
			{
				if(++$count==7)
					echo "\t\t/*\n";
					echo "\t\tarray('name'=>'".$column->name."'),\n";
			}
			if($count>=7)
				echo "\t\t*/\n";
			?>		 		
        ),
        'pages'=>$pages,
        'rowNum'=>'5',
        'rownumbers'=>'true',
        'rows'=>$gridRows,
        'sColumns'=>array(
            <?php
			$count=0;
			foreach($this->tableSchema->columns as $column)
			{
				if(++$count==7)
					echo "\t\t/*\n";
					echo "\t\tarray('title'=>\$sort->link('".$column->name."')),\n";
			}
			if($count>=7)
				echo "\t\t*/\n";
			?>	
        ),
       'sortname'=>'<?php echo $this->tableSchema->primaryKey;?>',
        'sortorder'=>'asc',
        'url'=>Yii::app()->createUrl('<?php echo $this->ModuleID; ?>/<?php echo $this->ControllerID; ?>/gridData',$_GET),
        'modulename'=>'<?php echo $this->modelClass; ?>',
    )); ?>
</div>