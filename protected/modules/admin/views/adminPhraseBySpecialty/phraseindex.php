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
	Yii::t('strings','Phrase By Specialties') => array('/admin/adminPhraseBySpecialty/index'), 
	$sectionName => array('specialtyIndex', 'section_id'=>$sectionId),
	$specialtyName
);
$this->menu=array(
	array('label'=>Yii::t('strings','Create a phrase in section ') . $sectionName . ' for ' . $specialtyName . ' specialty', 'url'=> array('create', 'section_id'=>$sectionId, 'specialty_id'=>$specialtyId)),
	array('label'=>Yii::t('strings','Manage phrases in this section'), 'url'=>array('admin', 'section_id'=>$sectionId)),
);
?>

<h1><?php echo Yii::t('strings','Phrase By Specialties')?></h1>
<h2><?php echo Yii::t('strings','Phrases for the section')?>: <?php echo $sectionName; ?> <?php echo Yii::t('strings','and the specialty')?>: <?php echo $specialtyName; ?></h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view'
)); ?>
