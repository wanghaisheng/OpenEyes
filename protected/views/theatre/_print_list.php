<?php
/*
_____________________________________________________________________________
(C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
(C) OpenEyes Foundation, 2011
This file is part of OpenEyes.
OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
_____________________________________________________________________________
http://www.openeyes.org.uk	 info@openeyes.org.uk
--
*/

?>

<!-- ================================================ -->
<!-- * * * * * * * * * *   DIARY  * * * * * * * * * * -->
<!-- ================================================ -->

<div id="diaryTemplate">
<div id="d_title"><?php echo Yii::t('strings','OPERATION LIST FORM')?></div>

<?php

$previousSequenceId = '';

$firstTheatreShown = false;
foreach ($theatres as $name => $dates) {
	$firstTheatreShown = true;
	foreach ($dates as $date => $sessions) {
		$timestamp = strtotime($date);
		foreach ($sessions as $session) {
			if ($previousSequenceId != $session['sequenceId']) {
				if ($previousSequenceId != '') {
?>
</table>
<div style="page-break-after:always"></div>
<?php
				}
?>
<table class="d_overview">
<tbody><tr><td>
<?php echo Yii::t('strings','THEATRE NO')?>:
</td><td colspan="2">
<?php echo(htmlspecialchars($name, ENT_QUOTES)) ?>
</td></tr>
<tr><td>
<?php echo Yii::t('strings','SESSION')?>:
</td><td>
<?php echo substr($session['startTime'], 0, 5)?> - <?php echo substr($session['endTime'], 0, 5) ?>
</td><td>
<?php echo Yii::t('strings','NHS')?>
</td></tr>
</tbody></table>

<table class="d_overview">
<tbody><tr><td>
<?php echo Yii::t('strings','SURGICAL FIRM')?>: <?php echo empty($session['firm_name']) ? Yii::t('strings','Emergency list') : htmlspecialchars($session['firm_name'], ENT_QUOTES) ?>
</td><td>
<?php echo Yii::t('strings','ANAESTHETIST')?>:
</td><td>
&nbsp;
</td><td>
<?php echo Yii::t('strings','DATE')?>:
</td><td>
<?php echo date('d M Y') ?>
</td></tr>
</tbody></table>

<table class="d_data">
<tbody>
<tr>
<th><?php echo Yii::t('strings','HOSPT NO')?></th>
<th><?php echo Yii::t('strings','PATIENT')?></th>
<th><?php echo Yii::t('strings','AGE')?></th>
<th><?php echo Yii::t('strings','WARD')?></th>
<th><?php echo Yii::t('strings','GA or LA')?></th>
<th><?php echo Yii::t('strings','PROCEDURES AND COMMENTS')?></th>
<th><?php echo Yii::t('strings','ADMISSION TIME')?></th>
</tr>
<?php
				}

								$previousSequenceId = $session['sequenceId'];

				if (!empty($session['patientId'])) {
?>
<tr>
<td><?php echo $session['patientHosNum'] ?></td>
<td><?php echo htmlspecialchars($session['patientName']) ?></td>
<td><?php echo htmlspecialchars($session['patientAge']) ?></td>
<td><?php echo htmlspecialchars($session['ward']) ?></td>
<td><?php echo htmlspecialchars($session['anaesthetic']) ?></td>
<td>
<?php echo !empty($session['procedures']) ? '['.$session['eye'].'] '.htmlspecialchars($session['procedures']) : Yii::t('strings','No procedures')?><br />
<?php echo htmlspecialchars($session['operationComments']) ?>
<td><?php echo $session['admissionTime'] ?></td>
</td></tr>
<?php
			}
		}
	}
}
?>
</table>
</div> <!-- #diaryTemplate -->
<!-- ================================================ -->

<!-- * * * * * * * * end of DIARY  * * * * * * * * * -->
<!-- ================================================ -->
