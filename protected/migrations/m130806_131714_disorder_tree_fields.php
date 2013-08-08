<?php

class m130806_131714_disorder_tree_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('disorder_tree','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('disorder_tree',array('created_user_id'=>1));
		$this->addForeignKey('disorder_tree_created_user_id_fk','disorder_tree','created_user_id','user','id');

		$this->addColumn('disorder_tree','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->update('disorder_tree',array('last_modified_user_id'=>1));
		$this->addForeignKey('disorder_tree_last_modified_user_id_fk','disorder_tree','last_modified_user_id','user','id');

		$this->addColumn('disorder_tree','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('disorder_tree','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
	}

	public function down()
	{
		$this->dropColumn('disorder_tree','created_date');
		$this->dropColumn('disorder_tree','last_modified_date');
		$this->dropForeignKey('disorder_tree_last_modified_user_id_fk','disorder_tree');
		$this->dropColumn('disorder_tree','last_modified_user_id');
		$this->dropForeignKey('disorder_tree_created_user_id_fk','disorder_tree');
		$this->dropColumn('disorder_tree','created_user_id');
	}
}
