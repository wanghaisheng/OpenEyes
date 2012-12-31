<?php

class m121228_124441_stats_tables extends CDbMigration
{
	public function up()
	{
		$this->createTable('stats',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'key' => 'varchar(64) NOT NULL',
				'value_raw' => 'int(10) unsigned NOT NULL',
				'value_total' => 'int(10) unsigned NOT NULL',
				'value_percent' => 'float(5,2) NOT NULL',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `stats_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `stats_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `stats_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `stats_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->createTable('stats_event',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_type_id' => 'int(10) unsigned NOT NULL',
				'key' => 'varchar(64) NOT NULL',
				'value_raw' => 'int(10) unsigned NOT NULL',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `stats_event_event_type_id_fk` (`event_type_id`)',
				'KEY `stats_event_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `stats_event_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `stats_event_event_type_id_fk` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`)',
				'CONSTRAINT `stats_event_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `stats_event_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->createTable('stats_complication',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_type_id' => 'int(10) unsigned NOT NULL',
				'element_type_id' => 'int(10) unsigned NOT NULL',
				'complication_id' => 'int(10) unsigned NULL',
				'value_raw' => 'int(10) unsigned NOT NULL',
				'value_total' => 'int(10) unsigned NOT NULL',
				'value_percent' => 'float(5,2) NOT NULL',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `stats_complication_event_type_id_fk` (`event_type_id`)',
				'KEY `stats_complication_element_type_id_fk` (`element_type_id`)',
				'KEY `stats_complication_complication_id_fk` (`complication_id`)',
				'KEY `stats_complication_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `stats_complication_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `stats_complication_event_type_id_fk` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`)',
				'CONSTRAINT `stats_complication_element_type_id_fk` FOREIGN KEY (`element_type_id`) REFERENCES `element_type` (`id`)',
				'CONSTRAINT `stats_complication_complication_id_fk` FOREIGN KEY (`complication_id`) REFERENCES `et_ophtroperationnote_cataract_complications` (`id`)',
				'CONSTRAINT `stats_complication_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `stats_complication_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->createTable('stats_complication_site',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_type_id' => 'int(10) unsigned NOT NULL',
				'element_type_id' => 'int(10) unsigned NOT NULL',
				'site_id' => 'int(10) unsigned NOT NULL',
				'complication_id' => 'int(10) unsigned NULL',
				'value_raw' => 'int(10) unsigned NOT NULL',
				'value_total' => 'int(10) unsigned NOT NULL',
				'value_percent' => 'float(5,2) NOT NULL',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `stats_complication_site_event_type_id_fk` (`event_type_id`)',
				'KEY `stats_complication_site_element_type_id_fk` (`element_type_id`)',
				'KEY `stats_complication_site_site_id_fk` (`site_id`)',
				'KEY `stats_complication_site_complication_id_fk` (`complication_id`)',
				'KEY `stats_complication_site_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `stats_complication_site_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `stats_complication_site_event_type_id_fk` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`)',
				'CONSTRAINT `stats_complication_site_element_type_id_fk` FOREIGN KEY (`element_type_id`) REFERENCES `element_type` (`id`)',
				'CONSTRAINT `stats_complication_site_site_id_fk` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`)',
				'CONSTRAINT `stats_complication_site_complication_id_fk` FOREIGN KEY (`complication_id`) REFERENCES `et_ophtroperationnote_cataract_complications` (`id`)',
				'CONSTRAINT `stats_complication_site_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `stats_complication_site_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->createTable('stats_complication_surgeon',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'surgeon_id' => 'int(10) unsigned NOT NULL',
				'event_type_id' => 'int(10) unsigned NOT NULL',
				'element_type_id' => 'int(10) unsigned NOT NULL',
				'complication_id' => 'int(10) unsigned NULL',
				'value_raw' => 'int(10) unsigned NOT NULL',
				'value_total' => 'int(10) unsigned NOT NULL',
				'value_percent' => 'float(5,2) NOT NULL',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `stats_complication_surgeon_event_type_id_fk` (`event_type_id`)',
				'KEY `stats_complication_surgeon_element_type_id_fk` (`element_type_id`)',
				'KEY `stats_complication_surgeon_surgeon_id_fk` (`surgeon_id`)',
				'KEY `stats_complication_surgeon_complication_id_fk` (`complication_id`)',
				'KEY `stats_complication_surgeon_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `stats_complication_surgeon_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `stats_complication_surgeon_event_type_id_fk` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`)',
				'CONSTRAINT `stats_complication_surgeon_element_type_id_fk` FOREIGN KEY (`element_type_id`) REFERENCES `element_type` (`id`)',
				'CONSTRAINT `stats_complication_surgeon_surgeon_id_fk` FOREIGN KEY (`surgeon_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `stats_complication_surgeon_complication_id_fk` FOREIGN KEY (`complication_id`) REFERENCES `et_ophtroperationnote_cataract_complications` (`id`)',
				'CONSTRAINT `stats_complication_surgeon_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `stats_complication_surgeon_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);
	}

	public function down()
	{
		$this->dropTable('stats_complication_surgeon');
		$this->dropTable('stats_complication_site');
		$this->dropTable('stats_complication');
		$this->dropTable('stats_event');
		$this->dropTable('stats');
	}
}
