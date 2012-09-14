<?php

class m120914_102200_add_user_and_date_fields_to_event_group_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('event_group','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('event_group','last_modified_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
		$this->addForeignKey('event_group_last_modified_user_id_fk','event_group','last_modified_user_id','user','id');
		$this->addColumn('event_group','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('event_group_created_user_id_fk','event_group','created_user_id','user','id');
		$this->addColumn('event_group','created_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
	}

	public function down()
	{
		$this->dropForeignKey('event_group_created_user_id_fk','event_group');
		$this->dropForeignKey('event_group_last_modified_user_id_fk','event_group');
		$this->dropColumn('event_group','created_date');
		$this->dropColumn('event_group','created_user_id');
		$this->dropColumn('event_group','last_modified_date');
		$this->dropColumn('event_group','last_modified_user_id');
	}
}
