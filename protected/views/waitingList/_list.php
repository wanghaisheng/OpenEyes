<div id="waitingList">
<?php

if (empty($operations)) { ?>
<h2 class="theatre"><?php echo Yii::t('strings','Waiting list empty')?>.</h2>
<?php
} else {
?>
					<div id="waitingList" class="grid-view">
					    <table>
					    <tbody>

					    	<tr>
								<th><?php echo Yii::t('strings','Letter status')?></th>
						        <th><?php echo Yii::t('strings','Hospital #')?></th>
						        <th><?php echo Yii::t('strings','Patient')?></th>
						        <th><?php echo Yii::t('strings','Procedures')?></th>
						        <th><?php echo Yii::t('strings','Eye')?></th>
						        <th><?php echo Yii::t('strings','Firm')?></th>
						        <th><?php echo Yii::t('strings','Decision Date')?></th>
						        <th><?php echo Yii::t('strings','Book Status')?></th>
					    	</tr>
<?php
	$i = 0;
	foreach ($operations as $id => $operation) {
		$eo = ElementOperation::model()->findByPk($operation['eoid']);
//		$consultant = $eo->event->episode->firm->getConsultant();
//		$user = $consultant->contact->userContactAssignment->user;
?>
    <tr class="<?php echo $i%2 ? 'even' : 'odd' ?>">
<?php
	$letterStatus = $eo->getLetterStatus();

	switch ($letterStatus) {
		case ElementOperation::LETTER_INVITE:
			$letterImage = 'invitation';
			break;
		case ElementOperation::LETTER_REMINDER_1:
			$letterImage = 'letter1';
			break;
		case ElementOperation::LETTER_REMINDER_2:
			$letterImage = 'letter2';
			break;
		case ElementOperation::LETTER_GP:
			$letterImage = 'GP';
			break;
		case ElementOperation::LETTER_REMOVAL:
			$letterImage = 'to-be-removed';
			break;
		default:
			$letterImage = 'invitation';
			break;
	}
?>
	<td class="letterStatus">
	<img src="img/_elements/icons/letters/<?php echo $letterImage ?>.png" alt="<?php echo $letterImage ?>" width="17" height="17" />
	</td>
	<td>
	<?php echo $operation['hos_num'] ?>
	</td>
	<td class="patient">
<?php
	echo CHtml::link(
		$operation['first_name'] . ' ' . $operation['last_name'],
		'/patient/episodes/' . $operation['pid'] . '/event/' . $operation['evid']
	);
?>
	</td>
	<td><?php echo $operation['List'] ?></td>
	<td><?php echo $eo->getEyeText() ?></td>
	<td><?php echo $eo->event->episode->firm->name ?> (<?php echo $eo->event->episode->firm->serviceSpecialtyAssignment->specialty->name ?>)</td>
	<td><?php echo $eo->convertDate($eo->decision_date) ?></td>
	<td><?php echo $eo->getStatusText() ?></td>
</tr>
<?php
		$i++;
	}
?>
</table>
<?php
}
?>
</tbody>

</table>

</div> <!-- #waitingList -->
