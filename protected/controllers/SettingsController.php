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

class SettingsController extends BaseController
{
	public $layout = 'settings';
	public $items_per_page = 30;

	public function accessRules() {
		return array(
			array('deny'),
		);
	}

	protected function beforeAction($action) {
		$this->registerCssFile('settings.css', Yii::app()->createUrl("css/settings.css"));
		Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl("js/settings.js"));

		$this->jsVars['items_per_page'] = $this->items_per_page;

		return parent::beforeAction($action);
	}

	public function actionIndex() {
		$this->redirect(array('/settings/general'));
	}

	public function actionGeneral() {
		$this->handleSettingsGroup('General');
	}

	public function actionAdmin() {
		$this->handleSettingsGroup('Admin');
	}

	public function actionAuthentication() {
		$this->handleSettingsGroup('Authentication');
	}

	public function actionDevelopment() {
		$this->handleSettingsGroup('Development');
	}

	public function handleSettingsGroup($name) {
		if (!$group = ConfigGroup::model()->find('name=?',array($name))) {
			throw new Exception("name config group not found: $name");
		}

		if (!empty($_POST)) {
			$this->handleSettingsChange();
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition('config_group_id = :config_group_id');
		$criteria->addCondition('module_name is null');
		$criteria->params[':config_group_id'] = $group->id;
		$criteria->order = 'display_order asc';

		$keys = ConfigKey::model()->findAll($criteria);

		$this->jsVars['OE_settings_module'] = 'core';

		$this->render('/settings/list',array(
			'group' => $group,
			'title' => $group->name,
			'keys' => $keys,
		),false,true);
	}

	public function actionModule($module) {
		if (!isset(Yii::app()->modules[$module])) {
			throw new Exception("Module not enabled: $module");
		}

		$title = $module;
		if ($event_type = EventType::model()->find('class_name=?',array($module))) {
			$title = $event_type->name;
		}

		if (!empty($_POST)) {
			$this->handleSettingsChange();
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition('t.module_name = :module_name');
		$criteria->params[':module_name'] = $module;
		$criteria->order = 'display_order asc';

		$keys = ConfigKey::model()->findAll($criteria);

		$this->jsVars['OE_settings_module'] = $module;

		$this->render('/settings/list',array(
			'module' => $module,
			'title' => $title,
			'keys' => $keys,
		),false,true);
	}

	public function actionReloadField() {
		if (@$_GET['module'] == 'core') {
			if (!$key = ConfigKey::model()->find('module_name is null and name = :name',array(':name'=>@$_GET['key']))) {
				throw new Exception("key not found: ".@$_GET['key']);
			}
		} else {
			if (!isset(Yii::app()->modules[@$_GET['module']])) {
				throw new Exception("Module not enabled: ".@$_GET['module']);
			}
			if (!$key = ConfigKey::model()->find('module_name = :module_name and name = :name',array(':module_name'=>@$_GET['module'],':name'=>@$_GET['key']))) {
				throw new Exception("key not found: ".@$_GET['key']);
			}
		}
		$this->renderPartial('/settings/_field_type_'.$key->configType->name,array('key'=>$key));
	}

	public function handleSettingsChange() {
		foreach ($_POST as $key => $value) {
			if (preg_match('/^enabled_(.*)$/',$key,$m)) {
				if (isset($_POST['group_id'])) {
					$key = ConfigKey::model()->find('config_group_id = ? and module_name is null and name=?',array($_POST['group_id'],$m[1]));
				} else {
					$key = ConfigKey::model()->find('module_name = ? and name = ?',array($_POST['module'],$m[1]));
				}

				if (!$key) {
					throw new Exception("config key not found: {$m[1]}");
				}

				if ($value == '1') {
					switch ($key->configType->name) {
						case 'Boolean':
						case 'Integer':
						case 'String':
						case 'Email':
						case 'Select':
							if (isset($_POST[$m[1]])) {
								$key->setValue($_POST[$m[1]]);
							}
							break;
						case 'StringList':
						case 'MultiSelectFromTable':
						case 'SelectFromTable':
						case 'Menu':
							if (isset($_POST['select_'.$m[1]])) {
								$key->setValue($_POST['select_'.$m[1]]);
							} else {
								$key->setValue(array());
							}
							break;
					}
				} else {
					if ($value = $key->value) {
						if (!$value->delete()) {
							throw new Exception("Unable to delete config value: ".print_r($value->getErrors(),true));
						}
					}
				}
			}
		}
	}

}
