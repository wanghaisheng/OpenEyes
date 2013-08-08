<?php

class m130808_081034_delete_log_event_id extends CDbMigration
{
	public function up()
	{
		$this->addColumn('delete_log','event_id','int(10) unsigned NULL');
		$this->addForeignKey('delete_log_event_id_fk','delete_log','event_id','event','id');
	}

	public function down()
	{
		$this->dropForeignKey('delete_log_event_id_fk','delete_log');
		$this->dropColumn('delete_log','event_id');
	}
}
