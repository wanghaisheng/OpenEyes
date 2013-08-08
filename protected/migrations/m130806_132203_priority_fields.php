<?php

class m130806_132203_priority_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('priority','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('priority',array('created_user_id'=>1));
		$this->addForeignKey('priority_created_user_id_fk','priority','created_user_id','user','id');

		$this->addColumn('priority','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('priority',array('last_modified_user_id'=>1));
		$this->addForeignKey('priority_last_modified_user_id_fk','priority','last_modified_user_id','user','id');

		$this->addColumn('priority','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('priority','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
	}

	public function down()
	{
		$this->dropColumn('priority','created_date');
		$this->dropColumn('priority','last_modified_date');
		$this->dropForeignKey('priority_last_modified_user_id_fk','priority');
		$this->dropColumn('priority','last_modified_user_id');
		$this->dropForeignKey('priority_created_user_id_fk','priority');
		$this->dropColumn('priority','created_user_id');
	}
}
