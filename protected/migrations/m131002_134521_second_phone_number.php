<?php

class m131002_134521_second_phone_number extends CDbMigration
{
	public function up()
	{
		$this->addColumn('contact','secondary_phone','varchar(20) COLLATE utf8_bin DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('contact','secondary_phone');
	}
}
