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

/**
 * This is the model class for table "sync_server".
 */
class SyncServer extends BaseActiveRecord
{
	public $processed_events = array();
	public $processed_assets = array();
	public $messages = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Firm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sync_server';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	public function getLastSyncText()
	{
		if ($this->last_sync == '1900-01-01 00:00:00') {
			return 'Never';
		}
		return date('j M Y H:i',strtotime($this->last_sync));
	}

	public function up()
	{
		if (!($ping = trim(`which ping`))) {
			throw new Exception("Unable to find path to the ping binary");
		}

		if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/',$this->hostname)) {
			$ip = $this->hostname;
		} else {
			if (file_exists("/etc/hosts")) {
				foreach (@file("/etc/hosts") as $line) {
					$line = substr($line,0,strlen($line)-1);
					if (preg_match('/^([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})[\s\t]+([a-z][a-zA-Z0-9\.\-_]+)$/',$line,$m)) {
						if (strtolower($m[2]) == strtolower($this->hostname)) {
							$ip = $m[1];
							break;
						}
					}
				}
			}

			if (!isset($ip)) {
				$res = trim(`host -W1 {$this->hostname} |grep 'has address' |head -n1`);
				if (!$res) {
					return false;
				}
				$e = explode(' ',$res);
				$ip = $e[3];
			}
		}

		$platform = trim(`uname`);

		if ($platform == 'Darwin') {
			if (`$ping -t3 -c1 -W3 $ip 2>/dev/null |grep '1 packets received'`) {
				return true;
			} else {
				return false;
			}
		} else if ($platform == 'Linux') {
			if (`$ping -c1 -w3 $ip 2>/dev/null |grep '1 received'`) {
				return true;
			} else {
				return false;
			}
		} else {
			throw new Exception("Unsupported platform: $platform");
		}
	}
}
