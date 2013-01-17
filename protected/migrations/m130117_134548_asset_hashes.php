<?php

class m130117_134548_asset_hashes extends CDbMigration
{
	public function up()
	{
		$this->addColumn('asset','hash','varchar(44) COLLATE utf8_bin NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('asset','hash');
	}
}
