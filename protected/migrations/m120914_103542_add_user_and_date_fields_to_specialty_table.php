<?php

class m120914_103542_add_user_and_date_fields_to_specialty_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('specialty','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('specialty','last_modified_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
		$this->addForeignKey('specialty_last_modified_user_id_fk','specialty','last_modified_user_id','user','id');
		$this->addColumn('specialty','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('specialty_created_user_id_fk','specialty','created_user_id','user','id');
		$this->addColumn('specialty','created_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
	}

	public function down()
	{
		$this->dropForeignKey('specialty_created_user_id_fk','specialty');
		$this->dropForeignKey('specialty_last_modified_user_id_fk','specialty');
		$this->dropColumn('specialty','created_date');
		$this->dropColumn('specialty','created_user_id');
		$this->dropColumn('specialty','last_modified_date');
		$this->dropColumn('specialty','last_modified_user_id');
	}
}
