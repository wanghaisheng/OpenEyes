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

?>
<div class="form">

<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-element-type-form',
	'enableAjaxValidation'=>false,
));

?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
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

		<?php echo $form->hiddenField($model,'possible_element_type_id');?>
	</div>

	<p class="note"><?php echo Yii::t('strings','Fields with')?> <span class="required">*</span> <?php echo Yii::t('strings','are required')?>.</p>
			<p><b><?php echo Yii::t('strings','Display order')?>: </b><?php echo $model->possibleElementType->display_order;?></p>
	<div class="row">
		<?php echo $form->labelEx($model,'view_number'); ?>
		<?php echo $form->dropDownList($model,'view_number',$model->getNumViewsArray()); ?>
		<?php echo $form->error($model,'view_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'required'); ?>
		<?php echo $form->checkBox($model,'required'); ?>
		<?php echo $form->error($model,'required'); ?>
	</div>

	<?php echo $form->hiddenField($model,'first_in_episode');?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('strings','Create') : Yii::t('strings','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
