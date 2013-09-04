<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
<div class="whiteBox patientDetails" id="personal_details">
	<div class="patient_actions">
		<span class="aBtn"><a class="sprite showhide" href="#"><span class="hide"></span></a></span>
	</div>
	<h4>Personal Details:</h4>
	<div class="data_row">
		<div class="data_label">First name(s):</div>
		<div class="data_value"><?php echo $this->patient->first_name?></div>
	</div>
	<div class="data_row">
		<div class="data_label">Last name:</div>
		<div class="data_value"><?php echo $this->patient->last_name?></div>
	</div>
	<div class="data_row">
		<div class="data_label">Address:</div>
		<div class="data_value"><?php echo $this->patient->getSummaryAddress()?></div>
	</div>
	<div class="data_row">
		<div class="data_label">Date of Birth:</div>
		<div class="data_value">
			<?php echo ($this->patient->dob) ? $this->patient->NHSDate('dob') : 'Unknown' ?>
		</div>
	</div>
	<div class="data_row">
		<?php if ($this->patient->date_of_death) { ?>
		<div class="data_label">Date of Death:</div>
		<div class="data_value"><?php echo $this->patient->NHSDate('date_of_death') . ' (Age '.$this->patient->getAge().')' ?></div>
		<?php } else {?>
		<div class="data_label">Age:</div>
		<div class="data_value"><?php echo $this->patient->getAge()?></div>
		<?php }?>
	</div>
	<div class="data_row">
		<div class="data_label">Gender:</div>
		<div class="data_value"><?php echo $this->patient->getGenderString() ?></div>
	</div>
	<div class="data_row">
		<div class="data_label">Ethnic Group:</div>
		<div class="data_value"><?php echo $this->patient->getEthnicGroupString() ?></div>
	</div>
</div>

<div class="whiteBox patientDetails" id="personal_details">
	<div class="patient_actions">
		<span class="aBtn"><a class="sprite showhide" href="#"><span class="hide"></span></a></span>
	</div>
	<h4>Research:</h4>
	<div class="data_row">
		<div class="data_label"><input type="checkbox" name="vehicle" value="Bike" checked="true"> Agreed to be approached about relevant research</div>
			<div class="data_value">&nbsp</div>
	</div>
</div>

<?php
if (!empty(Yii::app()->session['research']))
{
	Yii::app()->session['research']=null;
		?>
<script>
	$(document).ready(function() {




			console.log('here');
			var dialog=new OpenEyes.Dialog.Confirm({
				modal: true,
				width: 400,
				minHeight: 'auto',
				title: 'Research Opportunity',
				content: 'The patient is eligible for the E-342 research trial which is currently recruiting.<BR><BR>Is <?php echo $this->patient->first_name;?> <?php echo $this->patient->last_name;?> interested in hearing more?',
				dialogClass: 'dialog confirm',
				okButton: 'Yes',
				cancelButton: 'No'
			}).on('ok',function(){

					var jqxhr = $.get('<?php echo $this->createURL('patient/EmailTim/'.$this->patient->hos_num);?>', function() {

					})

					new OpenEyes.Dialog.Alert({
						title: 'Dr Elliott alerted',
						content: 'A text message has been sent to the research coordinator for this trial, Dr Elliott. If he does not arrive in ten minutes, please ring the following number: 011 1111 111'
					}).open();

				}).open();
			enableButtons();









	});
</script>
	<?php
}
?>


