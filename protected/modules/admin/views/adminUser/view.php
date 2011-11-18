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

$this->breadcrumbs=array(
	Yii::t('strings','Users')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('strings','List User'), 'url'=>array('index')),
	array('label'=>Yii::t('strings','Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('strings','Update User'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('strings','Manage User'), 'url'=>array('admin')),
	array('label'=>Yii::t('strings','User Rights'), 'url'=>array('rights', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t('strings','View User')?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'first_name',
		'last_name',
		'email',
		array(
			'name' => 'active',
			'value' => CHtml::encode($model->getActiveText())
		),
		array(
			'name' => 'global_firm_rights',
			'value' => CHtml::encode($model->getGlobalFirmRightsText())
		),
	),
));
?>
<table class="detail-view" id="rights">
<tr class="even"><th><?php echo Yii::t('strings','Rights')?></th><td>
<b><?php echo Yii::t('strings','Services')?></b>
<br />
<?php
	foreach ($rights as $service) {
		if ($service['checked']) {
			echo $service['name'] . "<br />\n";
		}
	}
?>
<br />
<b><?php echo Yii::t('strings','Firms')?></b>
<br />
<?php
	foreach ($rights as $service) {
		foreach ($service['firms'] as $firm) {
			if ($firm['checked']) {
				echo $firm['name'] . ' (' . $service['name'] . ")<br />\n";
			}
								}
				}
?>
</td></tr>
</table>
