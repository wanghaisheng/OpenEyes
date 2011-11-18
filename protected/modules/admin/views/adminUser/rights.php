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
	Yii::t('strings','Users')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('strings','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('strings','List User'), 'url'=>array('index')),
	array('label'=>Yii::t('strings','Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('strings','View User'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('strings','Manage User'), 'url'=>array('admin')),
	array('label'=>Yii::t('strings','User Rights'), 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t('strings','User Rights for')?> <?php echo $model->last_name; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('strings','Fields with')?> <span class="required">*</span> <?php echo Yii::t('strings','are required')?>.</p>

	<?php echo $form->errorSummary($model); ?>

<?php

	foreach ($rights as $service) {
?>
	<div class="row">
		<?php echo CHtml::label($service['name'], $service['label']); ?>
		<?php echo CHtml::checkBox($service['label'], $service['checked']); ?>
		<br />
<?php
		foreach ($service['firms'] as $firm) {
?>
&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo CHtml::label($firm['name'], $firm['label']); ?>
			<?php echo CHtml::checkBox($firm['label'], $firm['checked']); ?>
<?php
		}
?>
	</div>
	<br />
<?php
	}
?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('strings','Update Rights')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
