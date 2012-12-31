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

class GenerateStatsCommand extends CConsoleCommand {
	public function run($args) {
		Stats::add(array(
			'key' => 'Logins since 1.1 training',
			'value_raw' => Yii::app()->db->createCommand()->select("count(distinct ucase(data))")->from("audit")->where("action = 'login-successful' and created_date > '2012-09-04 05:00:00'")->queryScalar(),
		));

		Stats::add(array(
			'key' => 'All logins',
			'value_raw' => Yii::app()->db->createCommand()->select("count(distinct ucase(data))")->from("audit")->where("action = 'login-successful'")->queryScalar(),
		));

		foreach (EventType::model()->findAll() as $event_type) {
			if (file_exists(getcwd()."/modules/".$event_type->class_name)) {
				StatsEvent::add(array(
					'event_type_id' => $event_type->id,
					'key' => 'total',
					'value_raw' => $this->countEventsByType($event_type->id),
				));
			}
		}

		$opnote = EventType::model()->find('class_name=?',array('OphTrOperationnote'));
		$cataract = ElementType::model()->find('event_type_id=? and class_name=?',array($opnote->id,'ElementCataract'));

		$total = Yii::app()->db->createCommand()
			->select("count(event.id)")
			->from("event")
			->join("episode","event.episode_id = episode.id")
			->join("et_ophtroperationnote_cataract","et_ophtroperationnote_cataract.event_id = event.id")
			->where("event_type_id = 4 and event.deleted = 0 and episode.deleted = 0")
			->queryScalar();

		$total_complications = Yii::app()->db->createCommand()
			->select("count(event.id)")
			->from("event")
			->join("episode","event.episode_id = episode.id")
			->join("et_ophtroperationnote_cataract","et_ophtroperationnote_cataract.event_id = event.id")
			->join("et_ophtroperationnote_cataract_complication","et_ophtroperationnote_cataract_complication.cataract_id = et_ophtroperationnote_cataract.id")
			->where("event_type_id = 4 and event.deleted = 0 and episode.deleted = 0")
			->queryScalar();

		StatsComplication::add(array(
			'event_type_id' => $opnote->id,
			'element_type_id' => $cataract->id,
			'complication_id' => null,
			'value_raw' => $total_complications,
			'value_total' => $total,
			'value_percent' => ($total >0) ? number_format($total_complications/($total/100),2) : 0,
		));

		foreach (CataractComplications::model()->findAll(array('order'=>'display_order')) as $cc) {
			$count = Yii::app()->db->createCommand()
				->select("count(event.id)")
				->from("event")
				->join("episode","event.episode_id = episode.id")
				->join("et_ophtroperationnote_cataract","et_ophtroperationnote_cataract.event_id = event.id")
				->join("et_ophtroperationnote_cataract_complication","et_ophtroperationnote_cataract_complication.cataract_id = et_ophtroperationnote_cataract.id")
				->where("event_type_id = 4 and event.deleted = 0 and episode.deleted = 0 and et_ophtroperationnote_cataract_complication.complication_id = $cc->id")
				->queryScalar();

			StatsComplication::add(array(
				'event_type_id' => $opnote->id,
				'element_type_id' => $cataract->id,
				'complication_id' => $cc->id,
				'value_raw' => $count,
				'value_total' => $total,
				'value_percent' => ($total >0) ? number_format($count/($total/100),2) : 0,
			));
		}

		$criteria = new CDbCriteria;
		$criteria->compare('institution_id',1);
		$criteria->order = 'name asc';

		foreach (Site::model()->findAll($criteria) as $site) {
			$total = Yii::app()->db->createCommand()
				->select("count(event.id)")
				->from("event")
				->join("episode","event.episode_id = episode.id")
				->join("et_ophtroperationnote_cataract","et_ophtroperationnote_cataract.event_id = event.id")
				->join("et_ophtroperationnote_procedurelist","et_ophtroperationnote_procedurelist.event_id = event.id")
				->join("element_operation","et_ophtroperationnote_procedurelist.element_operation_id = element_operation.id")
				->join("booking","booking.element_operation_id = element_operation.id")
				->join("session","booking.session_id = session.id")
				->join("theatre","session.theatre_id = theatre.id")
				->where("event_type_id = 4 and event.deleted = 0 and episode.deleted = 0 and theatre.site_id = $site->id")
				->queryScalar();

			$total_complications = Yii::app()->db->createCommand()
				->select("count(event.id)")
				->from("event")
				->join("episode","event.episode_id = episode.id")
				->join("et_ophtroperationnote_cataract","et_ophtroperationnote_cataract.event_id = event.id")
				->join("et_ophtroperationnote_procedurelist","et_ophtroperationnote_procedurelist.event_id = event.id")
				->join("et_ophtroperationnote_cataract_complication","et_ophtroperationnote_cataract_complication.cataract_id = et_ophtroperationnote_cataract.id")
				->join("element_operation","et_ophtroperationnote_procedurelist.element_operation_id = element_operation.id")
				->join("booking","booking.element_operation_id = element_operation.id")
				->join("session","booking.session_id = session.id")
				->join("theatre","session.theatre_id = theatre.id")
				->where("event_type_id = 4 and event.deleted = 0 and episode.deleted = 0 and theatre.site_id = $site->id")
				->queryScalar();

			StatsComplicationSite::add(array(
				'site_id' => $site->id,
				'event_type_id' => $opnote->id,
				'element_type_id' => $cataract->id,
				'complication_id' => null,
				'value_raw' => $total_complications,
				'value_total' => $total,
				'value_percent' => ($total >0) ? number_format($total_complications/($total/100),2) : 0,
			));

			foreach (CataractComplications::model()->findAll(array('order'=>'display_order')) as $cc) {
				$count = Yii::app()->db->createCommand()
					->select("count(event.id)")
					->from("event")
					->join("episode","event.episode_id = episode.id")
					->join("et_ophtroperationnote_cataract","et_ophtroperationnote_cataract.event_id = event.id")
					->join("et_ophtroperationnote_cataract_complication","et_ophtroperationnote_cataract_complication.cataract_id = et_ophtroperationnote_cataract.id")
					->join("et_ophtroperationnote_procedurelist","et_ophtroperationnote_procedurelist.event_id = event.id")
					->join("element_operation","et_ophtroperationnote_procedurelist.element_operation_id = element_operation.id")
					->join("booking","booking.element_operation_id = element_operation.id")
					->join("session","booking.session_id = session.id")
					->join("theatre","session.theatre_id = theatre.id")
					->where("event_type_id = 4 and event.deleted = 0 and episode.deleted = 0 and et_ophtroperationnote_cataract_complication.complication_id = $cc->id and theatre.site_id = $site->id")
					->queryScalar();

				StatsComplicationSite::add(array(
					'site_id' => $site->id,
					'event_type_id' => $opnote->id,
					'element_type_id' => $cataract->id,
					'complication_id' => $cc->id,
					'value_raw' => $count,
					'value_total' => $total,
					'value_percent' => ($total >0) ? number_format($count/($total/100),2) : 0,
				));
			}
		}

		foreach (Yii::app()->db->createCommand()
			->selectDistinct("u.id, u.first_name, u.last_name")
			->from("user u")
			->join("et_ophtroperationnote_surgeon s","s.surgeon_id = u.id")
			->join("event e","e.id = s.event_id and e.event_type_id = 4")
			->join("et_ophtroperationnote_cataract c","c.event_id = e.id")
			->join("episode ep","e.episode_id = ep.id")
			->where("ep.deleted = 0 and e.deleted = 0")
			->order("u.first_name, u.last_name")
			->queryAll() as $surgeon) {

			$total = Yii::app()->db->createCommand()
				->select("count(event.id)")
				->from("event")
				->join("episode","event.episode_id = episode.id")
				->join("et_ophtroperationnote_cataract","et_ophtroperationnote_cataract.event_id = event.id")
				->join("et_ophtroperationnote_procedurelist","et_ophtroperationnote_procedurelist.event_id = event.id")
				->join("et_ophtroperationnote_surgeon","et_ophtroperationnote_surgeon.event_id = event.id")
				->where("event_type_id = 4 and event.deleted = 0 and episode.deleted = 0 and et_ophtroperationnote_surgeon.surgeon_id = {$surgeon['id']}")
				->queryScalar();

			$total_complications = Yii::app()->db->createCommand()
				->select("count(event.id)")
				->from("event")
				->join("episode","event.episode_id = episode.id")
				->join("et_ophtroperationnote_cataract","et_ophtroperationnote_cataract.event_id = event.id")
				->join("et_ophtroperationnote_procedurelist","et_ophtroperationnote_procedurelist.event_id = event.id")
				->join("et_ophtroperationnote_surgeon","et_ophtroperationnote_surgeon.event_id = event.id")
				->join("et_ophtroperationnote_cataract_complication","et_ophtroperationnote_cataract_complication.cataract_id = et_ophtroperationnote_cataract.id")
				->where("event_type_id = 4 and event.deleted = 0 and episode.deleted = 0 and et_ophtroperationnote_surgeon.surgeon_id = {$surgeon['id']}")
				->queryScalar();

			StatsComplicationSurgeon::add(array(
				'surgeon_id' => $surgeon['id'],
				'event_type_id' => $opnote->id,
				'element_type_id' => $cataract->id,
				'complication_id' => null,
				'value_raw' => $total_complications,
				'value_total' => $total,
				'value_percent' => ($total >0) ? number_format($total_complications/($total/100),2) : 0,
			));

			foreach (CataractComplications::model()->findAll(array('order'=>'display_order')) as $cc) {
				$count = Yii::app()->db->createCommand()
					->select("count(event.id)")
					->from("event")
					->join("episode","event.episode_id = episode.id")
					->join("et_ophtroperationnote_cataract","et_ophtroperationnote_cataract.event_id = event.id")
					->join("et_ophtroperationnote_cataract_complication","et_ophtroperationnote_cataract_complication.cataract_id = et_ophtroperationnote_cataract.id")
					->join("et_ophtroperationnote_surgeon","et_ophtroperationnote_surgeon.event_id = event.id")
					->join("et_ophtroperationnote_procedurelist","et_ophtroperationnote_procedurelist.event_id = event.id")
					->where("event_type_id = 4 and event.deleted = 0 and episode.deleted = 0 and et_ophtroperationnote_cataract_complication.complication_id = $cc->id and et_ophtroperationnote_surgeon.surgeon_id = {$surgeon['id']}")
					->queryScalar();

				StatsComplicationSurgeon::add(array(
					'surgeon_id' => $surgeon['id'],
					'event_type_id' => $opnote->id,
					'element_type_id' => $cataract->id,
					'complication_id' => $cc->id,
					'value_raw' => $count,
					'value_total' => $total,
					'value_percent' => ($total >0) ? number_format($count/($total/100),2) : 0,
				));
			}
		}
	}

	public function countEventsByType($event_type_id) {
		return Yii::app()->db->createCommand()
			->select("count(event.id)")
			->from("event")
			->join("episode","event.episode_id = episode.id")
			->where("event.event_type_id = $event_type_id and episode.deleted = 0 and event.deleted = 0")
			->queryScalar();
	}
}
