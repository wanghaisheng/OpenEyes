<?php

class m130116_150902_episode_hash extends CDbMigration
{
	public function up()
	{
		$this->addColumn('episode','hash','varchar(44) COLLATE utf8_bin NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('episode','hash');
	}
}
