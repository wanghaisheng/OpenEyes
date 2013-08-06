<?php

class m130806_131616_event_group_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('event_group','created_user_id','int(10) unsigned NOT NULL');
		$this->update('event_group',array('created_user_id'=>1));
		$this->addForeignKey('event_group_created_user_id_fk','event_group','created_user_id','user','id');

		$this->addColumn('event_group','last_modified_user_id','int(10) unsigned NOT NULL');
		$this->update('event_group',array('last_modified_user_id'=>1));
		$this->addForeignKey('event_group_last_modified_user_id_fk','event_group','last_modified_user_id','user','id');

		$this->addColumn('event_group','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('event_group','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
	}

	public function down()
	{
		$this->dropColumn('event_group','created_date');
		$this->dropColumn('event_group','last_modified_date');
		$this->dropForeignKey('event_group_last_modified_user_id_fk','event_group');
		$this->dropColumn('event_group','last_modified_user_id');
		$this->dropForeignKey('event_group_created_user_id_fk','event_group');
		$this->dropColumn('event_group','created_user_id');
	}
}
