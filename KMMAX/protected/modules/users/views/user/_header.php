
<div class="content-head underline">
	<h2></h2>

	<div class="content-action">

	<?php        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
        		'htmlOptions'=>array('class'=>'submenu'),
                'activeCssClass'=>'current',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                		array('label'=>Yii::t('label','List User'), 'url'=>array('index')),
						array('label'=>Yii::t('label','Create User'), 'url'=>array('create')),						
						array('label'=>Yii::t('label','View User'), 'url'=>array('view', 'id'=>$model->fUserID)),
						array('label'=>Yii::t('label','Copy User'), 'url'=>array('copy', 'id'=>$model->fUserID)),
						array('label'=>Yii::t('label','Manage User'), 'url'=>array('admin')),					
                    ),
                ));
    ?>
	</div>
</div>