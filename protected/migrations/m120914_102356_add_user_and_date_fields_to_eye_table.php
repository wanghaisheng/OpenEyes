<?php

class m120914_102356_add_user_and_date_fields_to_eye_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('eye','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('eye','last_modified_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
		$this->addForeignKey('eye_last_modified_user_id_fk','eye','last_modified_user_id','user','id');
		$this->addColumn('eye','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('eye_created_user_id_fk','eye','created_user_id','user','id');
		$this->addColumn('eye','created_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
	}

	public function down()
	{
		$this->dropForeignKey('eye_created_user_id_fk','eye');
		$this->dropForeignKey('eye_last_modified_user_id_fk','eye');
		$this->dropColumn('eye','created_date');
		$this->dropColumn('eye','created_user_id');
		$this->dropColumn('eye','last_modified_date');
		$this->dropColumn('eye','last_modified_user_id');
	}
}
