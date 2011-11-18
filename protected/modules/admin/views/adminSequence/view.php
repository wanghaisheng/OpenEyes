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

$this->breadcrumbs=array(
	Yii::t('strings','Sequences')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('strings','List Sequence'), 'url'=>array('index')),
	array('label'=>Yii::t('strings','Create Sequence'), 'url'=>array('create')),
	array('label'=>Yii::t('strings','Update Sequence'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('strings','Delete Sequence'), 'url'=>'#', 'visible' => ($model->getAssociatedBookings() == 0),
		  'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('strings','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('strings','Manage Sequence'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('strings','View Sequence')?> #<?php echo $model->id; ?></h1>

<?php
if ($model->getAssociatedBookings() > 0) { ?>
<div class="flash-notice"><?php echo Yii::t('strings','This sequence cannot be deleted as it has associated bookings')?>.</div>
<?php
}
	?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label' => Yii::t('strings','Firm'),
			'value' => $model->getFirmName()
		),
		array(
			'label' => Yii::t('strings','Theatre'),
			'value' => $model->theatre->site->name . ' - ' . $model->theatre->name
		),
		array(
			'label' => Yii::t('strings','Start Date'),
			'value' => $model->start_date . ' (' . date('l', strtotime($model->start_date)) . ')'
		),
		array(
			'label' => Yii::t('strings','Start Time'),
			'value' => substr($model->start_time, 0, 5)
		),
		array(
			'label' => Yii::t('strings','End Time'),
			'value' => substr($model->end_time, 0, 5)
		),
		'end_date',
		array(
			'label' => Yii::t('strings','Occurrence'),
			'value' => !empty($model->week_selection) ? $model->getWeekText() : $model->getFrequencyText(),
		),
	),
));
