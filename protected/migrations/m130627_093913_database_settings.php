<?php

class m130627_093913_database_settings extends CDbMigration
{
	public function up()
	{
		$this->createTable('config_group',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `config_group_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `config_group_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `config_group_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `config_group_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->insert('config_group',array('id'=>1,'name'=>'General','display_order'=>10));
		$this->insert('config_group',array('id'=>2,'name'=>'Admin','display_order'=>20));
		$this->insert('config_group',array('id'=>3,'name'=>'Authentication','display_order'=>30));
		$this->insert('config_group',array('id'=>4,'name'=>'Development','display_order'=>40));

		$this->createTable('config_type',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'values' => 'text COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `config_type_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `config_type_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `config_type_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `config_type_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->insert('config_type',array('id'=>1,'name'=>'Boolean'));
		$this->insert('config_type',array('id'=>2,'name'=>'Integer'));
		$this->insert('config_type',array('id'=>3,'name'=>'String'));
		$this->insert('config_type',array('id'=>4,'name'=>'Email'));
		$this->insert('config_type',array('id'=>5,'name'=>'Select'));
		$this->insert('config_type',array('id'=>6,'name'=>'StringList'));
		$this->insert('config_type',array('id'=>7,'name'=>'MultiSelectFromTable'));
		$this->insert('config_type',array('id'=>8,'name'=>'SelectFromTable'));
		$this->insert('config_type',array('id'=>9,'name'=>'Menu'));

		$this->createTable('config_key',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'config_group_id' => 'int(10) unsigned NOT NULL',
				'module_name' => 'varchar(64) COLLATE utf8_bin NULL',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'label' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'config_type_id' => 'int(10) unsigned NOT NULL',
				'default_value' => 'text COLLATE utf8_bin NOT NULL',
				'values' => 'text COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(1) unsigned NOT NULL',
				'relates_to_id' => 'int(10) unsigned NULL',
				'relates_to_condition' => 'varchar(255) COLLATE utf8_bin NOT NULL',
				'sortable' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'metadata1' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'metadata2' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `config_key_config_group_id_fk` (`config_group_id`)',
				'KEY `config_key_config_type_id_fk` (`config_type_id`)',
				'KEY `config_key_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `config_key_created_user_id_fk` (`created_user_id`)',
				'KEY `config_key_relates_to_id_fk` (`relates_to_id`)',
				'CONSTRAINT `config_key_config_group_id_fk` FOREIGN KEY (`config_group_id`) REFERENCES `config_group` (`id`)',
				'CONSTRAINT `config_key_config_type_id_fk` FOREIGN KEY (`config_type_id`) REFERENCES `config_type` (`id`)',
				'CONSTRAINT `config_key_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `config_key_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `config_key_relates_to_id_fk` FOREIGN KEY (`relates_to_id`) REFERENCES `config_key` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->createTable('config',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'config_key_id' => 'int(10) unsigned NOT NULL',
				'module_name' => 'varchar(64) COLLATE utf8_bin NULL',
				'value' => 'text COLLATE utf8_bin NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `config_config_key_id_fk` (`config_key_id`)',
				'KEY `config_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `config_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `config_config_key_id_fk` FOREIGN KEY (`config_key_id`) REFERENCES `config_key` (`id`)',
				'CONSTRAINT `config_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `config_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		/* GENERAL */

		$this->insert('config_key',array(
			'config_group_id' => 1,
			'name' => 'institution',
			'label' => 'Institution',
			'config_type_id' => 8,
			'default_value' => '1',
			'display_order' => 10,
			'metadata1' => 'Institution',
			'metadata2' => 'name',
		));

		$this->insert('config_key',array(
			'config_group_id' => 1,
			'name' => 'institution_specialty',
			'label' => 'Institution specialty',
			'config_type_id' => 8,
			'default_value' => '109',
			'display_order' => 15,
			'metadata1' => 'Specialty',
			'metadata2' => 'name',
		));

		$this->insert('config_key',array(
			'config_group_id' => 1,
			'name' => 'default_site',
			'label' => 'Default site',
			'config_type_id' => 8,
			'default_value' => '1',
			'display_order' => 20,
			'metadata1' => 'Site',
			'metadata2' => 'name',
		));

		$this->insert('config_key',array(
			'config_group_id' => 1,
			'name' => 'erod_lead_time_weeks',
			'label' => 'EROD lead time (weeks)',
			'config_type_id' => 2,
			'default_value' => '3',
			'display_order' => 30,
		));

		$this->insert('config_key',array(
			'config_group_id' => 1,
			'name' => 'specialties',
			'label' => 'Specialties',
			'config_type_id' => 7,
			'default_value' => serialize(array()),
			'display_order' => 40,
			'sortable' => true,
		));

		$this->insert('config_key',array(
			'config_group_id' => 1,
			'name' => 'fife',
			'label' => 'Fife-specific customisations',
			'config_type_id' => 1,
			'default_value' => '0',
			'display_order' => 50,
		));

		/* ADMIN */

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'alerts_email',
			'label' => 'Alerts email',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 10,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'adminEmail',
			'label' => 'Admin email',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 20,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'helpdesk_email',
			'label' => 'Helpdesk email',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 30,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'helpdesk_phone',
			'label' => 'Helpdesk phone',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 40,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'watermark',
			'label' => 'Watermark',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 50,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'watermark_admin',
			'label' => 'Admin watermark',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 60,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'watermark_description',
			'label' => 'Watermark subheading',
			'config_type_id' => 3,
			'default_value' => 'You are logged in as admin.',
			'display_order' => 70,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'profile_user_can_edit',
			'label' => 'Users can edit their profile',
			'config_type_id' => 1,
			'default_value' => '1',
			'display_order' => 80,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'profile_user_can_change_password',
			'label' => 'Users can change their password',
			'config_type_id' => 1,
			'default_value' => '1',
			'display_order' => 90,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'restrict_email_domains',
			'label' => 'Restrict email domains',
			'config_type_id' => 6,
			'default_value' => '',
			'display_order' => 100,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'modules_disabled',
			'label' => 'Disabled modules',
			'config_type_id' => 7,
			'default_value' => serialize(array()),
			'display_order' => 110,
			'metadata1' => 'EventType',
			'metadata2' => 'name',
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'required_user_agent',
			'label' => 'Restrict by user agent regex',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 120,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'required_user_agent_message',
			'label' => 'Restrict by user agent message',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 130,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'contact_labels',
			'label' => 'Patient summary contact labels',
			'config_type_id' => 6,
			'default_value' => serialize(array()),
			'display_order' => 140,
			'sortable' => 1,
		));

		$this->insert('config_key',array(
			'config_group_id' => 2,
			'name' => 'child_age_limit',
			'label' => 'Child age limit',
			'config_type_id' => 2,
			'default_value' => '16',
			'display_order' => 150,
		));

		/* AUTHENTICATION */

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'auth_source',
			'label' => 'Authentication method',
			'config_type_id' => 5,
			'default_value' => 'BASIC',
			'values' => serialize(array(
				'BASIC',
				'LDAP',
			)),
			'display_order' => 10,
		));

		$auth_type_id = Yii::app()->db->createCommand()->select("id")->from("config_key")->where('config_group_id=? and name=?',array(3,'auth_source'))->queryScalar();

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_server',
			'label' => 'LDAP server',
			'config_type_id' => 3,
			'default_value' => '',
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
			'display_order' => 20,
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_port',
			'label' => 'LDAP port',
			'config_type_id' => 3,
			'default_value' => '',
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
			'display_order' => 30,
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_admin_dn',
			'label' => 'LDAP admin DN',
			'config_type_id' => 3,
			'default_value' => '',
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
			'display_order' => 40,
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_password',
			'label' => 'LDAP password',
			'config_type_id' => 3,
			'default_value' => '',
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
			'display_order' => 50,
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_dn',
			'label' => 'LDAP DN',
			'config_type_id' => 3,
			'default_value' => '',
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
			'display_order' => 60,
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_method',
			'label' => 'LDAP method',
			'config_type_id' => 5,
			'default_value' => 'native',
			'display_order' => 70,
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
			'values' => serialize(array('native','zend')),
		));

		$ldap_method_id = Yii::app()->db->createCommand()->select("id")->from('config_key')->where('config_group_id=? and name=?',array(3,'ldap_method'))->queryScalar();

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_native_timeout',
			'label' => 'LDAP native timeout',
			'config_type_id' => 2,
			'default_value' => '3',
			'display_order' => 80,
			'relates_to_id' => $ldap_method_id,
			'relates_to_condition' => 'native',
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_info_retries',
			'label' => 'LDAP info retries',
			'config_type_id' => 2,
			'default_value' => '3',
			'display_order' => 90,
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_info_retry_delay',
			'label' => 'LDAP info retry delay (seconds)',
			'config_type_id' => 2,
			'default_value' => '1',
			'display_order' => 100,
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_update_name',
			'label' => 'Update names from LDAP',
			'config_type_id' => 1,
			'default_value' => '0',
			'display_order' => 110,
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'ldap_update_email',
			'label' => 'Update email addresses from LDAP',
			'config_type_id' => 2,
			'default_value' => '1',
			'display_order' => 120,
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
		));

		$this->insert('config_key',array(
			'config_group_id' => 3,
			'name' => 'local_users',
			'label' => 'BASIC auth users',
			'config_type_id' => 7,
			'default_value' => serialize(array()),
			'display_order' => 130,
			'relates_to_id' => $auth_type_id,
			'relates_to_condition' => 'LDAP',
			'metadata1' => 'User',
			'metadata2' => 'fullName',
		));

		/* DEVELOPMENT */

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'pseudonymise_patient_details',
			'label' => 'Pseudonymise patient details',
			'config_type_id' => 1,
			'default_value' => '0',
			'display_order' => 10,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'ab_testing',
			'label' => 'AB testing',
			'config_type_id' => 1,
			'default_value' => '0',
			'display_order' => 20,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'environment',
			'label' => 'Environment',
			'config_type_id' => 5,
			'default_value' => 'dev',
			'values' => serialize(array(
				'dev',
				'live',
			)),
			'display_order' => 30,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'google_analytics_account',
			'label' => 'Google Analytics account',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 50,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'log_events',
			'label' => 'Log events',
			'config_type_id' => 1,
			'default_value' => '1',
			'display_order' => 60,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'hos_num_regex',
			'label' => 'Hospital number regex',
			'config_type_id' => 3,
			'default_value' => '/^([0-9]{1,9})$/',
			'display_order' => 70,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'pad_hos_num',
			'label' => 'Pad hospital numbers',
			'config_type_id' => 3,
			'default_value' => '%07s',
			'display_order' => 80,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'menu',
			'label' => 'Menu',
			'config_type_id' => 9,
			'default_value' => serialize(array('home' => array('title' => 'Home','uri' => '','position' => 1),'logout'=>array('title' => 'Logout','uri' => 'site/logout','position' => 9999))),
			'display_order' => 100,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'admin_menu',
			'label' => 'Admin menu',
			'config_type_id' => 9,
			'default_value' => serialize(array()),
			'display_order' => 110,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'gdata_username',
			'label' => 'GData username',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 120,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'gdata_password',
			'label' => 'GData password',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 130,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'cache_buster',
			'label' => 'Cache buster',
			'config_type_id' => 3,
			'default_value' => '',
			'display_order' => 140,
		));

		$this->insert('config_key',array(
			'config_group_id' => 4,
			'name' => 'disable_browser_caching',
			'label' => 'Disable browser caching',
			'config_type_id' => 1,
			'default_value' => '0',
			'display_order' => 150,
		));

		$_key = Yii::app()->db->createCommand()->select("*")->from("config_key")->where('name=:name',array(':name'=>'menu'))->queryRow();
		$this->insert('config',array('config_key_id'=>$_key['id'],'value'=>serialize(array('home' => array('title' => 'Home','uri' => '','position' => 1),'logout'=>array('title' => 'Logout','uri' => 'site/logout','position' => 9999)))));

		$config = require("config/core/common.php");
		$params = $config['params'];

		if (file_exists("config/local/common.php")) {
			$localConfig = require("config/local/common.php");
			$params = array_merge($params,$localConfig['params']);
		}

		foreach ($params as $key => $value) {
			switch ($key) {
				case 'default_site_code':
					if ($site = Site::model()->find('source_id=? and remote_id=?',array(1,$value))) {
						$_key = Yii::app()->db->createCommand()->select("*")->from("config_key")->where('name=:name',array(':name'=>'default_site'))->queryRow();
						$this->insert('config',array('config_key_id'=>$_key['id'],'value'=>$site->id));
					}
					break;
				case 'institution_code':
					if ($institution = Institution::model()->find('source_id=? and remote_id=?',array(1,$value))) {
						$_key = Yii::app()->db->createCommand()->select("*")->from("config_key")->where('name=:name',array(':name'=>'institution'))->queryRow();
						$this->insert('config',array('config_key_id'=>$_key['id'],'value'=>$institution->id));
					}
					break;
				case 'specialty_sort':
					$specialties = array();
					foreach ($value as $code) {
						if ($specialty = Specialty::model()->find('code=?',array($code))) {
							$specialties[] = $specialty->id;
						}
					}
					$_key = Yii::app()->db->createCommand()->select("*")->from("config_key")->where('name=:name',array(':name'=>'specialties'))->queryRow();
					$this->insert('config',array('config_key_id'=>$_key['id'],'value'=>serialize($specialties)));
					break;
				case 'menu_bar_items':
					$_key = Yii::app()->db->createCommand()->select("*")->from("config_key")->where('name=:name',array(':name'=>'menu'))->queryRow();
					$this->insert('config',array('config_key_id'=>$_key['id'],'value'=>serialize($value)));
					break;
				case 'institution_specialty':
					$_key = Yii::app()->db->createCommand()->select("*")->from("config_key")->where('name=:name',array(':name'=>'institution_specialty'))->queryRow();
					if ($specialty = Specialty::model()->find('code=?',array($value))) {
						$this->insert('config',array('config_key_id'=>$_key['id'],'value'=>$specialty->id));
					}
					break;
				default:
					if (!$_key = Yii::app()->db->createCommand()->select("*")->from("config_key")->where('name=:name',array(':name'=>$key))->queryRow()) {
						echo "Warning: config_key not defined: $key\n";
					} else {
						if (is_array($value)) {
							$value = serialize($value);
						}
						$this->insert('config',array('config_key_id'=>$_key['id'],'value'=>$value));
					}
			}
		}
	}

	public function down()
	{
		$this->dropTable('config');
		$this->dropTable('config_key');
		$this->dropTable('config_type');
		$this->dropTable('config_group');
	}
}
