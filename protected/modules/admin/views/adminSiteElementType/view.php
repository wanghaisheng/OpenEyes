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
	Yii::t('strings','Site Element Types')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('strings','List SiteElementType'), 'url'=>array('index')),
	array('label'=>Yii::t('strings','Update SiteElementType'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('strings','Manage SiteElementType'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('strings','View Site Element Type for')?>:</h1>

<div class="view">

                <table>
                        <tr>
                                <td><?php echo Yii::t('strings','Event type')?></td><td><?php echo $model->possibleElementType->eventType->name;?></td>
                        </tr>
                        <tr>
                                <td><?php echo Yii::t('strings','Element type')?></td><td><?php echo $model->possibleElementType->elementType->name;?></td>
                        </tr>
                        <tr>
                                <td><?php echo Yii::t('strings','Specialty')?></td><td><?php echo $model->specialty->name;?></td>
                        </tr>
                        <tr>
                                <td><?php echo Yii::t('strings','First in episode')?></td><td><?php if ($model->first_in_episode) {echo Yii::t('strings','Yes');} else {echo Yii::t('strings','No');} ?></td>
                        </tr>
                </table>
</div>

<div class="view">
        <b><?php echo CHtml::encode($model->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($model->id), array('view', 'id'=>$model->id)); ?>
        <br />

        <b><?php echo CHtml::encode($model->getAttributeLabel('possible_element_type_id')); ?>:</b>
        <?php echo CHtml::encode($model->possible_element_type_id); ?>
        <br />

        <b><?php echo CHtml::encode($model->getAttributeLabel('specialty_id')); ?>:</b>
        <?php echo CHtml::encode($model->specialty->name); ?>
        <br />

        <b><?php echo CHtml::encode($model->getAttributeLabel('view_number')); ?>:</b>
        <?php echo CHtml::encode($model->view_number); ?>
        <br />

        <b><?php echo CHtml::encode($model->getAttributeLabel('required')); ?>:</b>
        <?php if ($model->required) {echo Yii::t('strings','Yes');} else {echo Yii::t('strings','No');} ?>
        <br />

        <b><?php echo CHtml::encode($model->getAttributeLabel('first_in_episode')); ?>:</b>
        <?php if ($model->first_in_episode) {echo Yii::t('strings','Yes');} else {echo Yii::t('strings','No');} ?>
        <br />
</div>

