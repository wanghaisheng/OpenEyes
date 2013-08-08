<?php

class m130806_132333_element_type_priority_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('element_type_priority','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('element_type_priority',array('created_user_id'=>1));
		$this->addForeignKey('element_type_priority_created_user_id_fk','element_type_priority','created_user_id','user','id');

		$this->addColumn('element_type_priority','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('element_type_priority',array('last_modified_user_id'=>1));
		$this->addForeignKey('element_type_priority_last_modified_user_id_fk','element_type_priority','last_modified_user_id','user','id');

		$this->addColumn('element_type_priority','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('element_type_priority','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
	}

	public function down()
	{
		$this->dropColumn('element_type_priority','created_date');
		$this->dropColumn('element_type_priority','last_modified_date');
		$this->dropForeignKey('element_type_priority_last_modified_user_id_fk','element_type_priority');
		$this->dropColumn('element_type_priority','last_modified_user_id');
		$this->dropForeignKey('element_type_priority_created_user_id_fk','element_type_priority');
		$this->dropColumn('element_type_priority','created_user_id');
	}
}
