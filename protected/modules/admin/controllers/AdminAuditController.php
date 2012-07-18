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

class AdminAuditController extends BaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',	// allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','sectionindex', 'view', 'auditindex'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny', // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * List all models for the given section
	 *
	 */
	public function actionAuditIndex()
	{
		$sectionId = $_GET['section_id'];
		$sectionName = Section::model()->findByPk($sectionId)->name;

		$criteria=new CDbCriteria;
		$criteria->compare('section_id',$sectionId,false);

		$dataProvider=new CActiveDataProvider('Audit', array(
			'criteria'=>$criteria,
		));

		$this->render('auditindex',array(
			'dataProvider'=>$dataProvider,
			'sectionId'=>$sectionId,
			'sectionName'=>$sectionName
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Audit;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Audit']))
		{
			$model->attributes=$_POST['Audit'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Audit']))
		{
			$model->attributes=$_POST['Audit'];
			if($model->save()) $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */

	public function actionIndex()
	{
		$actions = array();

		foreach (array('add-allergy','associate-contact','change-firm','change-status','create','delete','login-failed','login-successful','logout','print','remove-allergy','reschedule','search-error','search-results','unassociate-contact','update','view') as $field) {
			$actions[$field] = $field;
		}

		$targets = array();

		foreach (array('booking','diary','episode','episode summary','event','login','logout','patient','patient summary','search','session','user','waiting list') as $field) {
			$targets[$field] = $field;
		}

		$this->render('index',array('actions'=>$actions,'targets'=>$targets));
	}

	public function actionSearch() {
		if (isset($_POST['page'])) {
			$data = $this->getData($_POST['page']);
		} else {
			$data = $this->getData();
		}

		Yii::app()->clientScript->registerScriptFile('/js/audit.js');
		$this->renderPartial('_list', array('data' => $data), false, true);
		echo "<!-------------------------->";
		$this->renderPartial('_pagination', array('data' => $data), false, true);
	}

	public function criteria() {
		$criteria = new CDbCriteria;

		if (@$_REQUEST['site_id']) {
			$criteria->addCondition('site_id='.$_REQUEST['site_id']);
		}

		if (@$_REQUEST['firm_id']) {
			$firm = Firm::model()->findByPk($_REQUEST['firm_id']);
			$firm_ids = array();
			foreach (Firm::model()->findAll('name=?',array($firm->name)) as $firm) {
				$firm_ids[] = $firm->id;
			}
			if (!empty($firm_ids)) {
				$criteria->addInCondition('firm_id',$firm_ids);
			}
		}

		if (@$_REQUEST['user_id']) {
			$criteria->addCondition('user_id='.$_REQUEST['user_id']);
		}

		if (@$_REQUEST['action']) {
			$criteria->addCondition("action='".$_REQUEST['action']."'");
		}

		if (@$_REQUEST['target_type']) {
			$criteria->addCondition("target_type='".$_REQUEST['target_type']."'");
		}

		if (@$_REQUEST['date_from']) {
			$date_from = Helper::convertNHS2MySQL($_REQUEST['date_from']).' 00:00:00';
			$criteria->addCondition("created_date >= '$date_from'");
		}

		if (@$_REQUEST['date_to']) {
			$date_to = Helper::convertNHS2MySQL($_REQUEST['date_to']).' 23:59:59';
			$criteria->addCondition("created_date <= '$date_to'");
		}

		if (@$_REQUEST['hos_num']) {
			if ($patient = Patient::model()->find('hos_num=?',array(@$_REQUEST['hos_num']))) {
				$criteria->addCondition('patient_id='.$patient->id);
			} else {
				$criteria->addCondition('patient_id=0');
			}
		}

		return $criteria;
	}

	public function getData($page=1) {
		$criteria = $this->criteria();

		$data = array();

		$data['total_items'] = Audit::model()->count($criteria);

		$criteria->order = 'id desc';
		$criteria->offset = (($page-1) * $this->items_per_page);
		$criteria->limit = $this->items_per_page;

		$data['items'] = Audit::model()->findAll($criteria);
		$data['pages'] = ceil($data['total_items'] / $this->items_per_page);
		$data['page'] = $page;

		return $data;
	}

	public function getDataFromId($id) {
		$criteria = $this->criteria();

		$data = array();

		$data['total_items'] = Audit::model()->count($criteria);

		$criteria->order = 'id desc';
		$criteria->limit = $this->items_per_page;
		$criteria->addCondition('id > '.(integer)$id);

		$data['items'] = Audit::model()->findAll($criteria);
		$data['pages'] = ceil($data['total_items'] / $this->items_per_page);

		return $data;
	}

	public function actionUpdateList() {
		if (!$audit = Audit::model()->findByPk(@$_GET['last_id'])) {
			throw new Exception('Log entry not found: '.@$_GET['last_id']);
		}

		$this->renderPartial('_list_update', array('data' => $this->getDataFromId($audit->id)), false, true);
	}
}
