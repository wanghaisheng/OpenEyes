<?php

class m120914_100923_add_user_and_date_fields_to_drug_type_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('drug_type','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('drug_type','last_modified_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
		$this->addForeignKey('drug_type_last_modified_user_id_fk','drug_type','last_modified_user_id','user','id');
		$this->addColumn('drug_type','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('drug_type_created_user_id_fk','drug_type','created_user_id','user','id');
		$this->addColumn('drug_type','created_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
	}

	public function down()
	{
		$this->dropForeignKey('drug_type_created_user_id_fk','drug_type');
		$this->dropForeignKey('drug_type_last_modified_user_id_fk','drug_type');
		$this->dropColumn('drug_type','created_date');
		$this->dropColumn('drug_type','created_user_id');
		$this->dropColumn('drug_type','last_modified_date');
		$this->dropColumn('drug_type','last_modified_user_id');
	}
}
