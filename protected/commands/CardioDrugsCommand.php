<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class CardioDrugsCommand extends CConsoleCommand {
	public function run($args) {
		if (!$subspecialty = Subspecialty::model()->find('specialty_id=? and name=?',array(109,'Cardiology'))) {
			$subspecialty = new Subspecialty;
			$subspecialty->specialty_id = 109;
			$subspecialty->name = 'Cardiology';
			$subspecialty->save();
		}

		if (!$service = Service::model()->find('name=?',array('Cardiology'))) {
			$service = new Service;
			$service->name = 'Cardiology';
			$service->save();
		}

		if (!$ssa = ServiceSubspecialtyAssignment::model()->find('service_id=? and subspecialty_id=?',array($service->id,$subspecialty->id))) {
			$ssa = new ServiceSubspecialtyAssignment;
			$ssa->service_id = $service->id;
			$ssa->subspecialty_id = $subspecialty->id;
			$ssa->save();
		}

		if (!$firm = Firm::model()->find('name=? and pas_code=? and service_subspecialty_assignment_id=?',array('Ilsley Charles','CHAR',$ssa->id))) {
			$firm = new Firm;
			$firm->name = 'Ilsley Charles';
			$firm->service_subspecialty_assignment_id = $ssa->id;
			$firm->pas_code = 'CHAR';
			$firm->save();
		}

		foreach (array(
			'Bisoprolol 1.25mg tablets',
			'Bisoprolol 5mg tablets',
			'Clopidogrel 300mg tablets',
			'Clopidogrel 75mg tablets',
			'Aspirin 300mg dispersible tablets',
			'Aspirin 75mg dispersible tablets',
			'Aspirin 75mg enteric-coated tablets',
			'Simvastatin 10mg tablets',
			'Atorvastatin 10mg tablets',
			'Atorvastatin 20mg tablets',
			'Ramipril 1.25mg tablets',
			'Ramipril 5mg capsules',
			'Ramipril 5mg tablets',
			'Glyceryl trinitrate 400 microgram sub-lingual spray',
			'Glyceryl trinitrate 10mg in 24 hours patch',
			'Glyceryl trinitrate 500 microgram sub-lingual tablets',
			'Glyceryl trinitrate 50mg in 10ml injection',
			'Glyceryl trinitrate 5mg in 24 hours patch',
			'Isosorbide dinitrate 10mg tablets',
			'Isosorbide mononitrate 10mg tablets',
			'Isosorbide mononitrate 20mg tablets',
			'Isosorbide mononitrate 60mg modified release tablets',
			'Spironolactone 25mg tablets',
      'Enoxaparin 20mg  2,000 units in 0.2ml syringe',
      'Enoxaparin 40mg  4,000 units in 0.4ml syringe',
      'Diltiazem 120mg modified release tablets',
			'Diltiazem 200mg modified release capsules',
			'Diltiazem 300mg modified release capsules',
			'Diltiazem 60mg modified release capsules',
			'Diltiazem 60mg modified release tablets',
			'Diltiazem 90mg modified release capsules',
			'Diltiazem 90mg modified release tablets',
			'Verapamil 40mg tablets',
			'Verapamil 5mg in 2ml injection',
		) as $drug) {
			if (!$_drug = Drug::model()->find('name=?',array($drug))) {
				echo "Not found: $drug\n";
				exit;
			}

			foreach (Site::model()->findAll('institution_id=?',array(1)) as $site) {
				if (!SiteSubspecialtyDrug::model()->find('drug_id=? and site_id=? and subspecialty_id=?',array($_drug->id,$site->id,$subspecialty->id))) {
					$ssd = new SiteSubspecialtyDrug;
					$ssd->drug_id = $_drug->id;
					$ssd->site_id = $site->id;
					$ssd->subspecialty_id = $subspecialty->id;
					$ssd->save();
				}
			}
		}

		foreach (array(
			'Antiplatelet' => array(
				'Tablet' => array(
					'ticagrelor' => array(
						'doses' => array(
							'90mg',
							'180mg',
						),
						'unit' => 'tablet(s)',
						'default_dose' => 1,
						'route' => 'PO',
					),
					'prasugrel' => array(
						'doses' => array(
							'5mg',
							'10mg',
							'30mg',
						),
						'unit' => 'tablet(s)',
						'default_dose' => 1,
						'route' => 'PO',
					),
				),
			),
			'Glycoprotein IIb/IIIa Inhibitor' => array(
				'Infusion' => array(
					'Abciximab' => array(
						'doses' => array(
							'125ng',
							'250mcg',
						),
						'unit' => 'mcg',
						'default_dose' => 125,
						'route' => 'IV',
					),
				),
			),
		) as $type => $drugdata) {
			foreach ($drugdata as $form => $drugs) {
				$form = DrugForm::model()->find('name=?',array($form));

				if (!$_type = DrugType::model()->find('name=?',array(ucfirst($type)))) {
					$_type = new DrugType;
					$_type->name = ucfirst($type);
					$_type->save();
				}
				foreach ($drugs as $drug => $metadata) {
					$drug = ucfirst($drug);

					if ($route = DrugRoute::model()->find('name=?',array($metadata['route']))) {
						foreach ($metadata['doses'] as $dose) {
							$drugname = $drug.' '.$dose;

							if (!$_drug = Drug::model()->find('name=?',array($drugname))) {
								$_drug = new Drug;
								$_drug->type_id = $_type->id;
								$_drug->form_id = $form->id;
								$_drug->dose_unit = $metadata['unit'];
								$_drug->default_dose = $metadata['default_dose'];
								$_drug->default_route_id = $route->id;
								$_drug->default_frequency_id = 7;
								$_drug->default_frequency = 0;
								$_drug->name = $drugname;
								$_drug->tallman = $drugname;
								$_drug->save();
								echo ".";
							}

							foreach (Site::model()->findAll('institution_id=?',array(1)) as $site) {
								if (!SiteSubspecialtyDrug::model()->find('drug_id=? and site_id=? and subspecialty_id=?',array($_drug->id,$site->id,$subspecialty->id))) {
									$ssd = new SiteSubspecialtyDrug;
									$ssd->drug_id = $_drug->id;
									$ssd->site_id = $site->id;
									$ssd->subspecialty_id = $subspecialty->id;
									$ssd->save();
								}
							}
						}
					}
				}
			}
		}

		if (!$drug_set = DrugSet::model()->find('name=? and subspecialty_id=?',array('Post PCI',$subspecialty->id))) {
			$drug_set = new DrugSet;
			$drug_set->subspecialty_id = $subspecialty->id;
			$drug_set->name = 'Post PCI';
			$drug_set->save();

			foreach (array(
				'Ticagrelor 90mg',
				'Bisoprolol 1.25mg tablets',
				'Aspirin 75mg dispersible tablets',
				'Ramipril 5mg capsules',
				'Atorvastatin 10mg tablets',
			) as $drug) {
				$drug = Drug::model()->find('name=?',array($drug));

				$item = new DrugSetItem;
				$item->drug_set_id = $drug_set->id;
				$item->drug_id = $drug->id;
				$item->default_frequency_id = 3;
				$item->default_duration_id = 2;
				$item->save();
			}
		}

		Yii::import('application.modules.OphTrOperationnote.models.*');

		foreach (array(
			'Clopidogrel 75mg tablets',
			'Clopidogrel 300mg tablets',
			'Aspirin 75mg dispersible tablets',
			'Aspirin 75mg enteric-coated tablets',
			'Aspirin 300mg dispersible tablets',
			'Ticagrelor 90mg',
			'Ticagrelor 180mg',
			'Prasugrel 5mg',
			'Prasugrel 10mg',
			'Prasugrel 30mg',
			'Heparin sodium 1,000 units in 1ml injection',
			'Heparin sodium 5,000 units in 0.2ml injection',
			'Heparin sodium 5,000 units in 1ml injection',
			'Abciximab 125ng',
			'Abciximab 250mcg',
			'Glyceryl trinitrate 400 microgram sub-lingual spray',
			'Glyceryl trinitrate 500 microgram sub-lingual tablets',
			'Glyceryl trinitrate 50mg in 10ml injection',
			'Glyceryl trinitrate 5mg in 24 hours patch',
		) as $drug) {
			if (!$_drug = PostopDrug::model()->find('name=?',array($drug))) {
				$_drug = new PostopDrug;
				$_drug->name = $drug;
				$_drug->save();
			}

			foreach (Site::model()->findAll('institution_id=1') as $site) {
				if (!PostopSiteSubspecialtyDrug::model()->find('subspecialty_id=? and site_id=? and drug_id=?',array($subspecialty->id,$site->id,$_drug->id))) {
					$pssd = new PostopSiteSubspecialtyDrug;
					$pssd->subspecialty_id = $subspecialty->id;
					$pssd->site_id = $site->id;
					$pssd->drug_id = $_drug->id;
					$pssd->save();
				}
			}
		}

		Yii::import('application.modules.OphCiExamination.models.*');

		$history = OphCiExamination_Attribute::model()->find('name=?',array('history'));

		Yii::app()->db->createCommand("delete from ophciexamination_attribute_option where attribute_id = $history->id and subspecialty_id is null")->query();

		foreach (array(
			'chest pain (typical)',
			'chest pain (atypical)',
			'shortness of breath',
			'sweating',
			'sickness',
			'palpitations',
			'dizziness',
			'loss of consciousness',
			'hypertension',
			'hypercholesterolaemia',
			'diabetes',
			'family history of heart disease',
			'previous cardiac history',
		) as $history_item) {
			if (!OphCiExamination_AttributeOption::model()->find('attribute_id=? and value=? and delimiter=? and subspecialty_id=?',array($history->id,$history_item,',',$subspecialty->id))) {
				$o = new OphCiExamination_AttributeOption;
				$o->attribute_id = $history->id;
				$o->value = $history_item;
				$o->delimiter = ',';
				$o->subspecialty_id = $subspecialty->id;
				$o->save();
			}
		}

		echo "\n";
	}
}
