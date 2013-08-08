<?php

class m130806_131324_specialty_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('specialty','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('specialty',array('created_user_id'=>1));
		$this->addForeignKey('specialty_created_user_id_fk','specialty','created_user_id','user','id');

		$this->addColumn('specialty','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('specialty',array('last_modified_user_id'=>1));
		$this->addForeignKey('specialty_last_modified_user_id_fk','specialty','last_modified_user_id','user','id');

		$this->addColumn('specialty','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('specialty','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
	}

	public function down()
	{
		$this->dropColumn('specialty','created_date');
		$this->dropColumn('specialty','last_modified_date');
		$this->dropForeignKey('specialty_last_modified_user_id_fk','specialty');
		$this->dropColumn('specialty','last_modified_user_id');
		$this->dropForeignKey('specialty_created_user_id_fk','specialty');
		$this->dropColumn('specialty','created_user_id');
	}
}
