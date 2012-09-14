<?php

class m120914_095946_add_user_and_date_fields_to_drug_form_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('drug_form','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('drug_form','last_modified_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
		$this->addForeignKey('drug_form_last_modified_user_id_fk','drug_form','last_modified_user_id','user','id');
		$this->addColumn('drug_form','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('drug_form_created_user_id_fk','drug_form','created_user_id','user','id');
		$this->addColumn('drug_form','created_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
	}

	public function down()
	{
		$this->dropForeignKey('drug_form_created_user_id_fk','drug_form');
		$this->dropForeignKey('drug_form_last_modified_user_id_fk','drug_form');
		$this->dropColumn('drug_form','created_date');
		$this->dropColumn('drug_form','created_user_id');
		$this->dropColumn('drug_form','last_modified_date');
		$this->dropColumn('drug_form','last_modified_user_id');
	}
}
