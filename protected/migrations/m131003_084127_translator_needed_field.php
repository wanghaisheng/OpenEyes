<?php

class m131003_084127_translator_needed_field extends CDbMigration
{
	public function up()
	{
		$this->addColumn('patient','translator_needed','tinyint(1) unsigned NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('patient','translator_needed');
	}
}
