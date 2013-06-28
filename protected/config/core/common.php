<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

return array(
	'name' => 'OpenEyes',

	// Preloading 'log' component
	'preload' => array('log'),

	// Autoloading model and component classes
	'import' => array(
		'application.vendors.*',
		'application.modules.*',
		'application.models.*',
		'application.models.elements.*',
		'application.components.*',
		'application.components.summaryWidgets.*',
		'application.extensions.tcpdf.*',
		'application.services.*',
		'application.modules.*',
		'application.commands.*',
		'application.commands.shell.*',
		'application.behaviors.*',
		'application.widgets.*',
		'application.controllers.*',
		'application.helpers.*',
		'application.gii.*',
		'system.gii.generators.module.*',
	),

	'modules' => array(
		// Gii tool
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'openeyes',
			'ipFilters'=> array('*')
		),
		'oldadmin',
	),

	// Application components
	'components' => array(
		'mailer' => array(
			'class' => 'Mailer',
			'mode' => 'sendmail',
		),
		'moduleAPI' => array(
			'class' => 'ModuleAPI',
		),
		'request' => array(
			'enableCsrfValidation' => true,
		),
		'event' => array(
			'class' => 'OEEventManager',
			'observers' => array(),
		),
		'clientScript' => array(
			'class' => 'ClientScript',
		),
		'user' => array(
			'class' => 'WebUser',
			// Enable cookie-based authentication
			'allowAutoLogin' => true,
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'' => 'site/index',
				'patient/viewpas/<pas_key:\d+>' => 'patient/viewpas',
				'file/view/<id:\d+>/<dimensions:\d+(x\d+)?>/<name:\w+\.\w+>' => 'protectedFile/thumbnail',
				'file/view/<id:\d+>/<name:\w+\.\w+>' => 'protectedFile/view',
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<hospital_num:\d+>' => 'patient/results',
				'settings/module/<module:\w+>' => 'settings/module',
			),
		),
		'db' => array(
			'class' => 'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=openeyes',
			'emulatePrepare' => true,
			'username' => 'oe',
			'password' => '_OE_PASSWORD_',
			'charset' => 'utf8',
			'schemaCachingDuration' => 300,
		),
		'authManager' => array(
			'class' => 'CDbAuthManager',
			'connectionID' => 'db',
		),
		'cache' => array(
			'class' => 'system.caching.CFileCache',
			'cachePath' => 'cache',
			'directoryLevel' => 1
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'FlushableLogRouter',
			'autoFlush' => 1,
			'routes' => array(
				// Normal logging
				'application' => array(
					'class' => 'CFileLogRoute',
					'levels' => 'info, warning, error',
					'logFile' => 'application.log',
					'maxLogFiles' => 30,
				),
				// Action log
				'action' => array(
					'class' => 'CFileLogRoute',
					'levels' => 'info, warning, error',
					'categories' => 'application.action.*',
					'logFile' => 'action.log',
					'maxLogFiles' => 30,
				),
				// Development logging (application only)
				'debug' => array(
					'class' => 'CFileLogRoute',
					'levels' => 'trace, info, warning, error',
					'categories' => 'application.*',
					'logFile' => 'debug.log',
					'maxLogFiles' => 30,
				),
			),
		),
		'session' => array(
			'class' => 'application.components.CDbHttpSession',
			'connectionID' => 'db',
			'sessionTableName' => 'user_session',
			'autoCreateSessionTable' => false
			/*'cookieParams' => array(
				'lifetime' => 300,
			),*/
		),
	),
);
