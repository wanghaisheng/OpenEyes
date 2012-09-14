<?php

class m120914_103121_add_user_and_date_fields_to_priority_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('priority','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('priority','last_modified_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
		$this->addForeignKey('priority_last_modified_user_id_fk','priority','last_modified_user_id','user','id');
		$this->addColumn('priority','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('priority_created_user_id_fk','priority','created_user_id','user','id');
		$this->addColumn('priority','created_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
	}

	public function down()
	{
		$this->dropForeignKey('priority_created_user_id_fk','priority');
		$this->dropForeignKey('priority_last_modified_user_id_fk','priority');
		$this->dropColumn('priority','created_date');
		$this->dropColumn('priority','created_user_id');
		$this->dropColumn('priority','last_modified_date');
		$this->dropColumn('priority','last_modified_user_id');
	}
}
