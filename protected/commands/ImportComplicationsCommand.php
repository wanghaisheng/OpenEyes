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

class ImportComplicationsCommand extends CConsoleCommand {
	public function run($args) {
		$fp = fopen("/tmp/complications.csv","r");

		fgetcsv($fp);

		$complications = array();
		$benefits = array();

		while ($data = fgetcsv($fp)) {
			if ($proc = Procedure::model()->find('term=?',array($data[1]))) {
				if (in_array($data[0],array('External','Cornea'))) {
					$data[0] = 'Corneal';
				}
				if ($data[0] == 'Paediatrics') {
					$data[0] = 'Paediatric';
				}
				if ($data[0] == 'Medical retina') {
					$data[0] = 'Medical Retina';
				}
				if ($service = Service::model()->find('name=?',array($data[0].' Service'))) {
					$ssa = ServiceSubspecialtyAssignment::model()->find('service_id=?',array($service->id));
					foreach (preg_split('/,\s*/',$data[2]) as $complication) {
						$complication = trim(lcfirst($complication));
						if ($complication) {
							if (!in_array($complication,$complications)) {
								if (!$_complication = Complication::model()->find('name=?',array($complication))) {
									$_complication = new Complication;
									$_complication->name = $complication;
									$_complication->save();
									$complications[] = $complication;
								}
							}
							if (!ProcedureComplication::model()->find('proc_id=? and complication_id=?',array($proc->id,$_complication->id))) {
								$pc = new ProcedureComplication;
								$pc->proc_id = $proc->id;
								$pc->complication_id = $_complication->id;
								$pc->subspecialty_id = $ssa->subspecialty_id;
								$pc->save();
							}
						}
					}

					foreach (preg_split('/,\s*/',$data[3]) as $benefit) {
						$benefit = trim(lcfirst($benefit));
						if ($benefit) {
							if (!in_array($benefit,$benefits)) {
								if (!$_benefit = Benefit::model()->find('name=?',array($benefit))) {
									$_benefit = new Benefit;
									$_benefit->name = $benefit;
									$_benefit->save();
									$benefits[] = $benefit;
								}
							}
							if (!ProcedureBenefit::model()->find('proc_id=? and benefit_id=?',array($proc->id,$_benefit->id))) {
								$pb = new ProcedureBenefit;
								$pb->proc_id = $proc->id;
								$pb->benefit_id = $_benefit->id;
								$pb->subspecialty_id = $ssa->subspecialty_id;
								$pb->save();
							}
						}
					}
				} else {
					echo "Can't find service: {$data[0]}\n";
				}
			} else {
				echo "Can't find proc: {$data[1]}\n";
			}
		}
	}
}
