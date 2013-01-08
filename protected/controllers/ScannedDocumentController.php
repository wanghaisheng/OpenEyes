<?php

class ScannedDocumentController extends BaseEventTypeController {
	public function actionCreate() {
		parent::actionCreate();
		$this->assetPath = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.'.Yii::app()->getController()->getModule()->name.'.assets'));
	}

	public function actionUpdate($id) {
		parent::actionUpdate($id);
	}

	public function actionView($id) {
		parent::actionView($id);
	}

	public function actionPrint($id) {
		parent::actionPrint($id);
	}
}
