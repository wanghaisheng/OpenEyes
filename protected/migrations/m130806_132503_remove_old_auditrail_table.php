<?php

class m130806_132503_remove_old_auditrail_table extends CDbMigration
{
	public function up()
	{
		$this->dropTable('tbl_audit_trail');
	}

	public function down()
	{
		$this->createTable('tbl_audit_trail',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'old_value' => 'text',
				'new_value' => 'text',
				'action' => 'varchar(255) NOT NULL',
				'model' => 'varchar(255) NOT NULL',
				'field' => 'varchar(255) NOT NULL',
				'stamp' => 'datetime NOT NULL',
				'user_id' => 'int(10) DEFAULT NULL',
				'model_id' => 'int(10) NOT NULL',
				'PRIMARY KEY (`id`)',
				'KEY `idx_audit_trail_user_id` (`user_id`)',
				'KEY `idx_audit_trail_model_id` (`model_id`)',
				'KEY `idx_audit_trail_model` (`model`)',
				'KEY `idx_audit_trail_field` (`field`)',
				'KEY `idx_audit_trail_action` (`action`)',
				'KEY `idx_audit_trail_stamp` (`stamp`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);
	}
}
