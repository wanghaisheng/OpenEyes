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

class ConvertAllTimestampsToUTCCommand extends CConsoleCommand {
	public $last = 0;
	public $ignore_tables = array('tbl_migration','user_session');

	public function run($args) {
		$total = 0;
		foreach (Yii::app()->db->getSchema()->getTables() as $table) {
			if (in_array($table->name,$this->ignore_tables)) continue;
			$row = Yii::app()->db->createCommand("select count(*) as count from `$table->name`")->queryRow();
			$total += (integer)$row['count'];
		}

		$i = 0;

		foreach (Yii::app()->db->getSchema()->getTables() as $table) {
			if (in_array($table->name,$this->ignore_tables)) continue;

			foreach (Yii::app()->db->createCommand("select * from `$table->name`")->queryAll() as $row) {
				if (!isset($row['created_date'])) {
					echo $table->name."\n";
					exit;
				}
				if ($table->name == 'authassignment') {
					Yii::app()->db->createCommand("update `$table->name` set created_date='".$this->toUTC($row['created_date'])."', last_modified_date='".$this->toUTC($row['last_modified_date'])."' where itemname='{$row['itemname']}' and userid='{$row['userid']}' and bizrule='{$row['bizrule']}' and data='{$row['data']}'")->query();
				} else if ($table->name == 'authitem') {
					Yii::app()->db->createCommand("update `$table->name` set created_date='".$this->toUTC($row['created_date'])."', last_modified_date='".$this->toUTC($row['last_modified_date'])."' where name='{$row['name']}' and description='{$row['description']}' and bizrule='{$row['bizrule']}' and data='{$row['data']}'")->query();
				} else if ($table->name == 'authitemchild') {
					Yii::app()->db->createCommand("update `$table->name` set created_date='".$this->toUTC($row['created_date'])."', last_modified_date='".$this->toUTC($row['last_modified_date'])."' where parent='{$row['parent']}' and child='{$row['child']}'")->query();
				} else if ($table->name == 'et_ophtroperationnote_procedurelist_procedure_assignment') {
					Yii::app()->db->createCommand("update `$table->name` set created_date='".$this->toUTC($row['created_date'])."', last_modified_date='".$this->toUTC($row['last_modified_date'])."' where procedurelist_id = {$row['procedurelist_id']} and proc_id = {$row['proc_id']} and display_order = {$row['display_order']}")->query();
				} else if ($table->name == 'operation_procedure_assignment') {
					Yii::app()->db->createCommand("update `$table->name` set created_date='".$this->toUTC($row['created_date'])."', last_modified_date='".$this->toUTC($row['last_modified_date'])."' where operation_id = {$row['operation_id']} and proc_id = {$row['proc_id']} and display_order = {$row['display_order']}")->query();
				} else if ($table->name == 'proc_opcs_assignment') {
					Yii::app()->db->createCommand("update `$table->name` set created_date='".$this->toUTC($row['created_date'])."', last_modified_date='".$this->toUTC($row['last_modified_date'])."' where proc_id = {$row['proc_id']} and opcs_code_id = {$row['opcs_code_id']}")->query();
				} else {
					if (!isset($row['id'])) {
						die($table->name."\n");
					}
					if (!ctype_digit($row['id'])) {
						echo $table->name."\n";
						print_r($row);
					}
					Yii::app()->db->createCommand("update `$table->name` set created_date='".$this->toUTC($row['created_date'])."', last_modified_date='".$this->toUTC($row['last_modified_date'])."' where id = '".$row['id']."'")->query();
				}

				$i++;

				$this->output("$i/$total ");

			}
		}

		echo "\n";
	}

	public function output($string) {
		for ($i=0; $i<$this->last;$i++) echo chr(8);
		for ($i=0; $i<$this->last;$i++) echo ' ';
		for ($i=0; $i<$this->last;$i++) echo chr(8);

		echo $string;

		$this->last = strlen($string);
	}

	public function toUTC($timestamp) {
		$ts = strtotime($timestamp);
		ini_set('date.timezone','UTC');
		$timestamp = date('Y-m-d H:i:s',$ts);
		ini_set('date.timezone','Europe/London');
		return $timestamp;
	}
}
