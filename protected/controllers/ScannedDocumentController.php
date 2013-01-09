<?php

class ScannedDocumentController extends BaseEventTypeController {
	public function actionCreate() {
		$this->assetPath = $this->publishScans();
		parent::actionCreate();
	}

	public function actionUpdate($id) {
		$this->assetPath = $this->publishScans();
		parent::actionUpdate($id);
	}

	public function actionView($id) {
		parent::actionView($id);
	}

	public function actionPrint($id) {
		parent::actionPrint($id);
	}

	public function actionDownloadAsset($id) {
		if (!$asset = Asset::model()->findByPk($id)) {
			throw new Exception("Asset not found: $id");
		}

		header("Content-Type: $asset->mimetype");
		header("Content-Disposition: attachment; filename=\"$asset->name\"");
		header("Content-Length: ".filesize($asset->path));

		readfile($asset->path);
	}

	public function publishScans() {
		return Yii::app()->getAssetManager()->publish(Yii::app()->params['scans_directory'],false,0,true);
	}
}
