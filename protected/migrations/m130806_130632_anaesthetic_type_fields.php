<?php

class m130806_130632_anaesthetic_type_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('anaesthetic_type','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('anaesthetic_type',array('created_user_id'=>1));
		$this->addForeignKey('anaesthetic_type_created_user_id_fk','anaesthetic_type','created_user_id','user','id');

		$this->addColumn('anaesthetic_type','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('anaesthetic_type',array('last_modified_user_id'=>1));
		$this->addForeignKey('anaesthetic_type_last_modified_user_id_fk','anaesthetic_type','last_modified_user_id','user','id');

		$this->addColumn('anaesthetic_type','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('anaesthetic_type','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
	}

	public function down()
	{
		$this->dropColumn('anaesthetic_type','created_date');
		$this->dropColumn('anaesthetic_type','last_modified_date');
		$this->dropForeignKey('anaesthetic_type_last_modified_user_id_fk','anaesthetic_type');
		$this->dropColumn('anaesthetic_type','last_modified_user_id');
		$this->dropForeignKey('anaesthetic_type_created_user_id_fk','anaesthetic_type');
		$this->dropColumn('anaesthetic_type','created_user_id');
	}
}
