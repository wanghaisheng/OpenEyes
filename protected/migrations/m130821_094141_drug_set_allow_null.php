<?php

class m130821_094141_drug_set_allow_null extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('drug_set','subspecialty_id','INT(10) UNSIGNED NULL');
	}

	public function down()
	{
        $this->alterColumn('drug_set','subspecialty_id','INT(10) UNSIGNED NOT NULL');
	}

}