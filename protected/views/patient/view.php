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
http://www.openeyes.org.uk   info@openeyes.org.uk
--
*/

Yii::app()->clientScript->scriptMap['jquery.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.fancybox-1.3.4.pack.js'] = false;
Yii::app()->clientScript->scriptMap['jquery.mousewheel-3.0.4.pack.js'] = false;

$patientName = $model->first_name . ' ' . $model->last_name;
$this->breadcrumbs=array(
	"{$patientName} ({$model->hos_num})",
);
$this->widget('application.extensions.fancybox.EFancyBox', array(
	'target'=>'button.fancybox',
	'config'=>array()
	));

$address_str = '';

// For some horrible reason Yii sometimes doesn't recognise the relationship between the patient and the address even though
//	the address_id is valid!
$address = Address::model()->findByPk($model->address_id);

if (!empty($address)) {
	$fields = array(
		'address1' => $address->address1,
		'address2' => $address->address2,
		'city' => $address->city,
		'county' => $address->county,
		'postcode' => $address->postcode);
	$addressList = array_filter($fields, 'filter_nulls');

	$numLines = 1;
	foreach ($addressList as $name => $string) {
		if ($name === 'postcode') {
			$string = strtoupper($string);
		}
		if ($name != 'email') {
			$address_str .= $string;
		}
		if (!empty($string) && $string != end($addressList)) {
			$address_str .= '<br />';
		}
		$numLines++;
	}
	// display extra blank lines if needed for padding
	for ($numLines; $numLines <= 5; $numLines++) {
		$address_str .= '<br />';
	}
} else {
	$address_str .= Yii::t('strings','Unknown');
} ?>
		<h2><?php echo Yii::t('strings','Patient Summary')?></h2>
			<div class="wrapTwo clearfix">
				<div class="halfColumnLeft">
 
					<!-- double re-enforcement of mode change not currently required, but might be needed in the future
					<div class="patientBox withIcon">
						<img class="boxIcon" src="/img/_elements/icons/patient.png" alt="patient" width="36" height="35" />
						<div id="patientHeader"><h3>Mrs Lucinda Smith <span class="normal">(1008504)</span></h3></div>
					</div>
					-->

					<div class="whiteBox" id="personal_details">
						<h4><?php echo Yii::t('strings','Personal Details')?>:</h4>
						<div class="data_row">
							<div class="data_label"><?php echo Yii::t('strings','First name(s)')?>:</div>
							<div class="data_value"><?php echo $model->first_name?></div>
						</div>
						<div class="data_row">
							<div class="data_label"><?php echo Yii::t('strings','Last name')?>:</div>
							<div class="data_value"><?php echo $model->last_name?></div>
						</div>
						<div class="data_row">
							<div class="data_label"><?php echo Yii::t('strings','Address')?>:</div>
							<div class="data_value"><?php echo $address_str?></div>
						</div>
						<div class="data_row">
							<div class="data_label"><?php echo Yii::t('strings','Date of Birth')?>:</div>
							<div class="data_value"><?php echo date('d M Y', strtotime($model->dob)).' ('.Yii::t('strings','Age').' '.$model->getAge().')'?></div>
						</div>
						<div class="data_row">
							<div class="data_label"><?php echo Yii::t('strings','Gender')?>:</div>
							<div class="data_value"><?php echo $model->gender == 'F' ? Yii::t('strings','Female') : Yii::t('strings','Male')?></div>
						</div>
					</div> <!-- #personal_details -->
					<div class="whiteBox" id="contact_details">
						<h4><?php echo Yii::t('strings','Contact Details')?>:</h4>
						<div class="data_row">
							<div class="data_label"><?php echo Yii::t('strings','Telephone')?>:</div>
							<div class="data_value"><?php echo !empty($model->primary_phone) ? $model->primary_phone : Yii::t('strings','Unknown')?></div>
						</div>
						<div class="data_row">
							<div class="data_label"><?php echo Yii::t('strings','Email')?>:</div>
							<div class="data_value"><?php echo !empty($address->email) ? $address->email : Yii::t('strings','Unknown')?></div>

						</div>
						<div class="data_row">
							<div class="data_label"><?php echo Yii::t('strings','Next of Kin')?>:</div>
							<div class="data_value"><?php echo Yii::t('strings','Unknown')?></div>
						</div>
					</div>
				</div>	<!-- .halfColumn -->

				<div class="halfColumnRight">
					<div class="blueBox">
						<h5><?php echo Yii::t('strings','All Episodes')?><span style="float:right;">&nbsp; <?php echo Yii::t('strings','open')?> <?php echo $episodes_open?> &nbsp;|&nbsp;<span style="font-weight:normal;"><?php echo Yii::t('strings','closed')?> <?php echo $episodes_closed?></span></span></h5>
						<div id="yw0" class="grid-view">
							<?php if (empty($episodes)) {?>
								<div class="summary"><?php echo Yii::t('strings','No episodes')?></div>
							<?php }else{?>
								<table class="items">
									<thead>
										<tr><th id="yw0_c0"><?php echo Yii::t('strings','Start  Date')?></th><th id="yw0_c1"><?php echo Yii::t('strings','End  Date')?></th><th id="yw0_c2"><?php echo Yii::t('strings','Firm')?></th><th id="yw0_c3"><?php echo Yii::t('strings','Specialty')?></th><th id="yw0_c4"><?php echo Yii::t('strings','Eye')?></th><th id="yw0_c5"><?php echo Yii::t('strings','Diagnosis')?></th></tr>
									</thead>
									<tbody>
										<?php foreach ($episodes as $i => $episode) {?>
											<tr id="<?php echo $episode->id?>" class="all-episode <?php if ($i %2 == 0){?>even<?php }else{?>odd<?php }?><?php if ($episode->end_date !== null){?> closed<?php }?>">
												<td><?php echo date('d M Y', strtotime($episode->start_date))?></td>
												<td><?php echo $episode->end_date !== null ? date('d M Y', strtotime($episode->end_date)) : ''?></td>
												<td><?php echo CHtml::encode($episode->firm->name)?></td>
												<td><?php echo CHtml::encode($episode->firm->serviceSpecialtyAssignment->specialty->name)?></td>
												<?php $diagnosis = $episode->getPrincipalDiagnosis() ?>
												<td><?php echo !empty($diagnosis) ? $diagnosis->getEyeText() : Yii::t('strings','No diagnosis')?></td>
												<td><?php echo !empty($diagnosis) ? $diagnosis->disorder->term : Yii::t('strings','No diagnosis')?></td>
											</tr>
										<?php }?>
									</tbody>
								</table>
								<div class="table_endRow"></div>
							<?php }?>
						</div> <!-- .grid-view -->
					</div>	<!-- .blueBox -->
					<p><a href="/patient/episodes/<?php echo $model->id?>"><span class="aPush"><?php echo Yii::t('strings','View all Episodes, Summaries and Events')?></span></a></p>
				</div> <!-- .halfColumn -->
			</div><!-- .wrapTwo -->
			<script type="text/javascript">
				$('tr.all-episode').unbind('click').click(function() {
					window.location.href = '/patient/episodes/<?php echo $model->id?>/episode/'+$(this).attr('id');
					return false;
				});
			</script>
<?php
function filter_nulls($data) {
        return $data !== null;
}
