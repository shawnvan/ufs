<div class="content-head underline">
   			<h2><?php Yii::t('app','languageName');?></h2>

			<div class="content-action">
			<ul class="submenu">
			<?php $this->menu=array(
	array('label'=>'Create Setting', 'url'=>array('create')),
	array('label'=>'Manage Setting', 'url'=>array('admin')),
);?>
				<li class="current"><a href="">添加用户</a></li>
				<li><a href="">修改用户</a></li>
				<li><a href="">复制用户</a></li><li><a href="">查看用户</a></li>
			</ul>
			</div>
   			
   		</div>