<?php

class m130812_114134_sync_remap extends CDbMigration
{
	public function up()
	{
		$this->createTable('sync_remap', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'old_episode_id' => 'int(10) unsigned NOT NULL',
				'new_episode_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `sync_remap_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `sync_remap_created_user_id_fk` (`created_user_id`)',
				'KEY `sync_remap_old_episode_id_fk` (`old_episode_id`)',
				'KEY `sync_remap_new_episode_id_fk` (`new_episode_id`)',
				'CONSTRAINT `sync_remap_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `sync_remap_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `sync_remap_old_episode_id_fk` FOREIGN KEY (`old_episode_id`) REFERENCES `episode` (`id`)',
				'CONSTRAINT `sync_remap_new_episode_id_fk` FOREIGN KEY (`new_episode_id`) REFERENCES `episode` (`id`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('sync_remap');
	}
}
