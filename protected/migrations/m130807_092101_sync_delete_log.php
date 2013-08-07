<?php

class m130807_092101_sync_delete_log extends CDbMigration
{
	public function up()
	{
		$this->createTable('delete_log', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'item_table' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'item_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `delete_log_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `delete_log_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `delete_log_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `delete_log_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('delete_log');
	}
}
