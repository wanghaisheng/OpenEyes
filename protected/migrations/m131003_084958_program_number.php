<?php

class m131003_084958_program_number extends CDbMigration
{
	public function up()
	{
		$this->addColumn('episode','program_number','varchar(32) collate utf8_bin not null');
	}

	public function down()
	{
		$this->dropColumn('episode','program_number');
	}
}
