<?php

class m130405_075241_store_last_modified_site_id_for_events_and_episodes extends CDbMigration
{
	public function up()
	{
		$this->addColumn('event','last_modified_site_id','int(10) unsigned DEFAULT NULL');
		$this->createIndex('event_last_modified_site_id_fk','event','last_modified_site_id');
		$this->addForeignKey('event_last_modified_site_id_fk','event','last_modified_site_id','site','id');
		$this->addColumn('event','created_site_id','int(10) unsigned DEFAULT NULL');
		$this->createIndex('event_created_site_id_fk','event','created_site_id');
		$this->addForeignKey('event_created_site_id_fk','event','created_site_id','site','id');
	}

	public function down()
	{
		$this->dropForeignKey('event_last_modified_site_id_fk','event');
		$this->dropIndex('event_last_modified_site_id_fk','event');
		$this->dropColumn('event','last_modified_site_id');
		$this->dropForeignKey('event_created_site_id_fk','event');
		$this->dropIndex('event_created_site_id_fk','event');
		$this->dropColumn('event','created_site_id');
	}
}
