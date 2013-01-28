<div class="page-header">
  <div class="page-header-title">
    <h1>View User</h1>
  </div>
  <div class="actionmenu">
    <?php
        $this->widget ( 'zii.widgets.CMenu', array ('id'=>'',
                'activeCssClass'=>'active',
                'activateItems'=>true,
                'activateParents'=>true,
                'items' =>array(
                        array('label'=>'用户列表', 'url'=>array('/users/user/grid') ,'linkOptions'=>array('class'=>'skin-black')),
                        array('label'=>'添加用户', 'url'=>array('/users/user/create') ,'linkOptions'=>array('class'=>'skin-blueopal')),
                        array('label'=>'复制用户', 'url'=>array('/users/user/create') ,'linkOptions'=>array('class'=>'skin-default')),
                        array('label'=>'添加用户', 'url'=>array('/users/user/create') ,'linkOptions'=>array('class'=>'skin-metro'))						
                    ),
                ));
    ?>
  </div>

</div>
