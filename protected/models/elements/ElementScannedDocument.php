<?php /**
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

class ElementScannedDocument extends BaseEventTypeElement
{
	public $service;

	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, asset_id, ', 'safe'),
			array('asset_id, ', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, asset_id, ', 'safe', 'on' => 'search'),
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'asset' => array(self::BELONGS_TO, 'Asset', 'asset_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'asset_id' => 'Asset',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('asset_id', $this->asset_id);
		
		return new CActiveDataProvider(get_class($this), array(
				'criteria' => $criteria,
			));
	}

	public function getScans($mimetypes=false) {
		$scans = array();

		$dir = Yii::app()->params['scans_directory'];

		$assetPath = Yii::getPathOfAlias('application.modules.'.Yii::app()->getController()->getModule()->name.'.assets');

		if (!file_exists("$assetPath/img/scans")) {
			@mkdir("$assetPath/img/scans",0755);
		}

		foreach (Asset::get_files_by_modified_date($dir,$mimetypes) as $file) {
			$scans[] = $file;

			$thumbnail = Asset::create_thumbnail($dir,$file);
			$preview = Asset::create_preview($dir,$file);

			if (!file_exists("$assetPath/img/scans/$thumbnail")) {
				@copy("$dir/$thumbnail","$assetPath/img/scans/$thumbnail");
			}

			if (!file_exists("$assetPath/img/scans/$preview")) {
				@copy("$dir/$preview","$assetPath/img/scans/$preview");
			}
		}

		return $scans;
	}

	public function beforeSave() {
		$dest_path = Yii::app()->basePath."/../".Yii::app()->params['asset_path'];

		if (!file_exists($dest_path)) {
			throw new Exception("Asset path does not exist: $dest_path");
		}

		if (!file_exists($dest_path."/preview")) {
			throw new Exception("Asset preview path does not exist: $dest_path/preview");
		}

		if (!file_exists($dest_path."/thumbnail")) {
			throw new Exception("Asset thumbnail path does not exist: $dest_path/thumbnail");
		}

		$path = Yii::app()->params['scans_directory'].'/'.$_POST[get_class($this)]['asset_id'];

		if (!file_exists($path)) {
			throw new Exception("File doesn't exist: ".$path);
		}

		$asset = new Asset;
		$asset->name = $_POST[get_class($this)]['asset_id'];
		$asset->title = $_POST[get_class($this)]['title'];
		$asset->description = $_POST[get_class($this)]['description'];
		$asset->mimetype = mime_content_type($path);
		$asset->filesize = filesize($path);

		if (!$asset->save()) {
			throw new Exception("Unable to save asset: ".print_r($asset->getErrors(),true));
		}

		preg_match('/\.([a-zA-Z0-9]+)$/',$asset->name,$m);

		if (!@copy($path,"$dest_path/$asset->id.{$m[1]}")) {
			throw new Exception("Unable to copy asset into place ([$path] => [$dest_path/$asset->id.{$m[1]}])");
		}

		if (!@unlink($path)) {
			throw new Exception("Unable to delete file: ".$path);
		}

		if (!@copy($path.'.preview.jpg',"$dest_path/preview/$asset->id.jpg")) {
			throw new Exception("Unable to copy asset preview into place ([$path.preview.jpg] => [$dest_path/preview/$asset->id.jpg])");
		}

		if (!@copy($path.'.thumbnail.jpg',"$dest_path/thumbnail/$asset->id.jpg")) {
			throw new Exception("Unable to copy asset thumbnail into place ([$path.thumbnail.jpg] => [$dest_path/thumbnail/$asset->id.jpg])");
		}

		$_POST[get_class($this)]['asset_id'] = $asset->id;

		return parent::beforeSave();
	}
}
?>
