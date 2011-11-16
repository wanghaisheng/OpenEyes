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

Yii::app()->clientScript->scriptMap['jquery.js'] = false; ?>
<div id="box_gradient_top"></div>
<div id="box_gradient_bottom">
<div class="details" id="personal_details">
	<h3><?php echo Yii::t('strings','Personal Details')?>:</h3>
	<div class="data_row">
		<div class="data_label"><?php echo Yii::t('strings','First name(s)')?>:</div>
		<div class="data_value"><?php echo $model->first_name; ?></div>
	</div>
	<div class="data_row">
		<div class="data_label"><?php echo Yii::t('strings','Last name')?>:</div>
		<div class="data_value"><?php echo $model->last_name; ?></div>
	</div>
	<div class="data_row address">
		<div class="data_label"><?php echo Yii::t('strings','Address')?>:</div>
		<div class="data_value">
<?php
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
				echo $string;
			}
			if (!empty($string) && $string != end($addressList)) {
				echo '<br />';
			}
			$numLines++;
		}
		// display extra blank lines if needed for padding
		for ($numLines; $numLines <= 5; $numLines++) {
			echo '<br />';
		}
	} else {
		echo Yii::t('strings','Unknown');
	} ?>
		</div>
	</div>
	<div class="data_row">
		<div class="data_label"><?php echo Yii::t('strings','Date of Birth')?>:</div>
		<div class="data_value"><?php
		$dobTime = strtotime($model->dob);
		echo date('d M Y', $dobTime);
		echo ' ('.Yii::t('strings','Age').' ' . $model->getAge()  . ')';
		?></div>
	</div>
	<div class="data_row row_buffer">
		<div class="data_label"><?php echo Yii::t('strings','Gender')?>:</div>
		<div class="data_value"><?php echo $model->gender == 'F' ? Yii::t('strings','Female') : Yii::t('strings','Male'); ?></div>
	</div>
</div>
<div class="details" id="contact_details">
	<h3><?php echo Yii::t('strings','Contact Details')?>:</h3>
	<div class="data_row telephone">
		<div class="data_label"><?php echo Yii::t('strings','Telephone')?>:</div>
		<div class="data_value"><?php echo !empty($model->primary_phone)
			? $model->primary_phone : Yii::t('strings','Unknown'); ?></div>
	</div>
	<div class="data_row row_buffer">
		<div class="data_label"><?php echo Yii::t('strings','Email')?>:</div>
		<div class="data_value"><?php echo !empty($address->email)
                        ? $address->email : Yii::t('strings','Unknown'); ?></div>

	</div>
	<div class="data_row row_buffer">
		<div class="data_label"><?php echo Yii::t('strings','Next of Kin')?>:</div>
		<div class="data_value"><?php echo Yii::t('strings','Unknown')?></div>
	</div>
</div>
<div class="details" id="recent_episodes">
	<h3><?php echo Yii::t('strings','Recent Episodes')?>:</h3>
	<div id="view_all"></div>
	<div class="clear"></div>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$episodes,
		'columns'=>array(
			array('name'=>Yii::t('strings','Start Date'),'value'=>'date("d M Y", strtotime($data->start_date))'),
			array('name'=>Yii::t('strings','End Date'),'value'=>'!empty($data->end_date) ? date("d M Y", strtotime($data->end_date)) : ""'),
			array('name'=>Yii::t('strings','Firm'), 'value'=>'$data->firm->name'),
			array('name'=>Yii::t('strings','Specialty'), 'value'=>'$data->firm->serviceSpecialtyAssignment->specialty->name'),
			array('name'=>Yii::t('strings','Eye'),'value'=>'$data->getPrincipalDiagnosisEyeText()'), // 'diagnosis.location',
			array('name'=>Yii::t('strings','Diagnosis'),'value'=>'$data->getPrincipalDiagnosisDisorderTerm()'), // 'disorder.name'
//			array('class'=>'CButtonColumn', 'buttons'=>array(
//				'view'=>array(
//					'label'=>'View',
//					'url'=>'"#"',
//					'click'=>'function() {console.log("test");$(".ui-tabs").tabs("select", 1); return false;}',
//					),
//				),
//				'template'=>'{view} View',
//			),
		),
		'enablePagination'=>false,
		'enableSorting'=>false,
		'summaryText'=>'',
		'emptyText'=>Yii::t('strings','No episodes found').'.'
	)); ?>
</div>
</div>
<script type="text/javascript">
	$('#view_all').die('click').live('click', function() {
		$('#patient-tabs').tabs('select', 1);
	});
</script>
<?php
function filter_nulls($data) {
	return $data !== null;
}
