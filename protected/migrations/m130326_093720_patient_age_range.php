<?php

class m130326_093720_patient_age_range extends CDbMigration
{
	public function up()
	{
		$this->addColumn('patient','age_range','varchar(64) COLLATE utf8_bin NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('patient','age_range');
	}
}
