<?php

class m131113_162130_patient_maiden_name_and_yob_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('contact','maiden_name','varchar(100) COLLATE utf8_bin NOT NULL');
		$this->addColumn('patient','yob','int(2) unsigned NULL');
	}

	public function down()
	{
		$this->dropColumn('patient','yob');
		$this->dropColumn('contact','maiden_name');
	}
}
