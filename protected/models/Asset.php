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
 * This is the model class for table "asset".
 *
 * The followings are the available columns in table 'asset':
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $mimetype
 * @property integer $filesize
 */
class Asset extends BaseActiveRecord
{
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
		return 'asset';
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

	static public function get_files_by_modified_date($dir,$mimetypes=false) {
		$files = array();

		$dh = opendir($dir);

		while ($file = readdir($dh)) {
			if (!preg_match('/^\.\.?$/',$file) && !preg_match('/\.thumbnail\.jpg$/',$file) && !preg_match('/\.preview\.jpg$/',$file)) {
				if (is_file("$dir/$file")) {
					$mimetype = mime_content_type("$dir/$file");

					if (!$mimetypes || (is_array($mimetypes) && in_array($mimetype,$mimetypes))) {
						$stat = stat("$dir/$file");

						while (isset($files[$stat['mtime']])) {
							$stat['mtime']++;
						}

						$files[$stat['mtime']] = $file;
					}
				}
			}
		}

		closedir($dh);

		ksort($files);

		return array_reverse($files);
	}

	static public function create_thumbnail($dir,$file) {
		$escaped = escapeshellarg("$dir/$file");

		if (!file_exists("$dir/$file.thumbnail.jpg")) { 
			`convert -flatten -antialias -scale 150x150 -raise 3 $escaped $escaped.thumbnail.jpg`;
		}

		return $file.'.thumbnail.jpg';
	}

	static public function create_preview($dir,$file) {
		$escaped = escapeshellarg("$dir/$file");

		if (!file_exists("$dir/$file.preview.jpg")) { 
			`convert -flatten -antialias -scale 800x800 -raise 3 $escaped $escaped.preview.jpg`;
		}

		return $file.'.preview.jpg';
	}
}
