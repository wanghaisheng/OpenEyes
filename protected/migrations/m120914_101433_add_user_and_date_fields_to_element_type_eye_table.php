<?php

class m120914_101433_add_user_and_date_fields_to_element_type_eye_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('element_type_eye','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('element_type_eye','last_modified_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
		$this->addForeignKey('element_type_eye_last_modified_user_id_fk','element_type_eye','last_modified_user_id','user','id');
		$this->addColumn('element_type_eye','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('element_type_eye_created_user_id_fk','element_type_eye','created_user_id','user','id');
		$this->addColumn('element_type_eye','created_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
	}

	public function down()
	{
		$this->dropForeignKey('element_type_eye_created_user_id_fk','element_type_eye');
		$this->dropForeignKey('element_type_eye_last_modified_user_id_fk','element_type_eye');
		$this->dropColumn('element_type_eye','created_date');
		$this->dropColumn('element_type_eye','created_user_id');
		$this->dropColumn('element_type_eye','last_modified_date');
		$this->dropColumn('element_type_eye','last_modified_user_id');
	}
}
