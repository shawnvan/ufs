<div id="rights" class="container">
	<div id="content">
		<?php if( $this->id!=='install' ): ?>
			<div id="menu">
				<?php $this->renderPartial('/_menu'); ?>
			</div>
		<?php endif; ?>
		<?php $this->renderPartial('/_flash'); ?>
		<?php  CHtml::dropDownList('org', 0, array('111'=>'北京'),array('size'=>20))?>
		<?php  CHtml::dropDownList('model', 0, array('111'=>'北京'),array('size'=>20,'width'=>50,'maxlength'=>50))?>
		<?php  CHtml::dropDownList('handle', 0, array('111'=>'北京'),array('size'=>20))?>
		<?php echo $content; ?>
	</div><!-- content -->
</div>
