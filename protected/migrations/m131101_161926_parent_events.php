<?php

class m131101_161926_parent_events extends CDbMigration
{
	public function up()
	{
		$this->addColumn('event','parent_id','int(10) unsigned NULL');
		$this->createIndex('event_parent_id_fk','event','parent_id');
		$this->addForeignKey('event_parent_id_fk','event','parent_id','event','id');
	}

	public function down()
	{
		$this->dropForeignKey('event_parent_id_fk','event');
		$this->dropIndex('event_parent_id_fk','event');
		$this->dropColumn('event','parent_id');
	}
}
