<?php

class m130805_121452_sync_servers extends CDbMigration
{
	public function up()
	{
		$this->createTable('sync_server',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'hostname' => 'varchar(255) COLLATE utf8_bin NOT NULL',
				'order' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'in_sync' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'last_sync' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'status' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'key' => 'varchar(1024) COLLATE utf8_bin NOT NULL',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `sync_server_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `sync_server_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `sync_server_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `sync_server_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);
	}

	public function down()
	{
		$this->dropTable('sync_server');
	}
}
