<?php

class m130805_140458_sync_hashes extends CDbMigration
{
	public function up()
	{
		$this->addColumn('episode','hash','varchar(40) COLLATE utf8_bin NOT NULL');
		$this->addColumn('episode','original_server_id','int(10) unsigned NULL');
		$this->createIndex('episode_original_server_id_fk','episode','original_server_id');
		$this->addForeignKey('episode_original_server_id_fk','episode','original_server_id','sync_server','id');

		$this->addColumn('event','hash','varchar(40) COLLATE utf8_bin NOT NULL');
		$this->addColumn('event','original_server_id','int(10) unsigned NULL');
		$this->createIndex('event_original_server_id_fk','event','original_server_id');
		$this->addForeignKey('event_original_server_id_fk','event','original_server_id','sync_server','id');

		$this->addColumn('patient','hash','varchar(40) COLLATE utf8_bin NOT NULL');
		$this->addColumn('patient','original_server_id','int(10) unsigned NULL');
		$this->createIndex('patient_original_server_id_fk','patient','original_server_id');
		$this->addForeignKey('patient_original_server_id_fk','patient','original_server_id','sync_server','id');
	}

	public function down()
	{
		$this->dropForeignKey('episode_original_server_id_fk','episode');
		$this->dropIndex('episode_original_server_id_fk','episode');
		$this->dropColumn('episode','original_server_id');
		$this->dropColumn('episode','hash');

		$this->dropForeignKey('event_original_server_id_fk','event');
		$this->dropIndex('event_original_server_id_fk','event');
		$this->dropColumn('event','original_server_id');
		$this->dropColumn('event','hash');

		$this->dropForeignKey('patient_original_server_id_fk','patient');
		$this->dropIndex('patient_original_server_id_fk','patient');
		$this->dropColumn('patient','original_server_id');
		$this->dropColumn('patient','hash');
	}
}
