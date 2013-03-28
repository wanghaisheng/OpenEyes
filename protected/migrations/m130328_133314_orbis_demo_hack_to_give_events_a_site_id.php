<?php

class m130328_133314_orbis_demo_hack_to_give_events_a_site_id extends CDbMigration
{
	public function up()
	{
		$this->addColumn('event','site_id','int(10) unsigned DEFAULT NULL');
		$this->createIndex('event_site_id_fk','event','site_id');
		$this->addForeignKey('event_site_id_fk','event','site_id','site','id');
	}

	public function down()
	{
		$this->dropForeignKey('event_site_id_fk','event');
		$this->dropIndex('event_site_id_fk','event');
		$this->dropColumn('event','site_id');
	}
}
