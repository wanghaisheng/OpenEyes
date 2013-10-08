<?php

class m131008_123509_patient_hos_num_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('patient_hos_num', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'patient_id' => 'int(10) unsigned NOT NULL',
				'hos_num' => 'varchar(40) COLLATE utf8_bin NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `patient_hos_num_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `patient_hos_num_created_user_id_fk` (`created_user_id`)',
				'KEY `patient_hos_num_patient_id_fk` (`patient_id`)',
				'CONSTRAINT `patient_hos_num_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `patient_hos_num_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `patient_hos_num_patient_id_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`)',
		), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('patient_hos_num');
	}
}
