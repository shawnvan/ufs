<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fHistoryNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fHistoryNo), array('view', 'id'=>$data->fHistoryNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fItemNo')); ?>:</b>
	<?php echo CHtml::encode($data->fItemNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fHistoryeVolution')); ?>:</b>
	<?php echo CHtml::encode($data->fHistoryeVolution); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fStockeVolution')); ?>:</b>
	<?php echo CHtml::encode($data->fStockeVolution); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fLatestGreatBusinessRecombination')); ?>:</b>
	<?php echo CHtml::encode($data->fLatestGreatBusinessRecombination); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fLatestCorrelationTrade')); ?>:</b>
	<?php echo CHtml::encode($data->fLatestCorrelationTrade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fPublisherExplain')); ?>:</b>
	<?php echo CHtml::encode($data->fPublisherExplain); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fTeamAppraise')); ?>:</b>
	<?php echo CHtml::encode($data->fTeamAppraise); ?>
	<br />

	*/ ?>

</div>