<?php

class m120914_094542_add_created_and_last_modified_fields_to_anaesthetic_type_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('anaesthetic_type','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('anaesthetic_type','last_modified_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
		$this->addForeignKey('anaesthetic_type_last_modified_user_id_fk','anaesthetic_type','last_modified_user_id','user','id');
		$this->addColumn('anaesthetic_type','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('anaesthetic_type_created_user_id_fk','anaesthetic_type','created_user_id','user','id');
		$this->addColumn('anaesthetic_type','created_date','datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'');
	}

	public function down()
	{
		$this->dropForeignKey('anaesthetic_type_created_user_id_fk','anaesthetic_type');
		$this->dropForeignKey('anaesthetic_type_last_modified_user_id_fk','anaesthetic_type');
		$this->dropColumn('anaesthetic_type','created_date');
		$this->dropColumn('anaesthetic_type','created_user_id');
		$this->dropColumn('anaesthetic_type','last_modified_date');
		$this->dropColumn('anaesthetic_type','last_modified_user_id');
	}
}
