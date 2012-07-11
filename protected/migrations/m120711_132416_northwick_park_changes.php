<?php

class m120711_132416_northwick_park_changes extends CDbMigration
{
	public function up()
	{
		$this->update('theatre',array('name'=>'Northwick park theatre'),'id=14');
		$this->update('ward',array('name'=>'Northwick Park Day care, Ground floor'),'id=7');
	}

	public function down()
	{
		$this->update('ward',array('name'=>'VanGuard Mobile Operating Theatre'),'id=7');
		$this->update('theatre',array('name'=>'Theatre Seven'),'id=14');
	}
}
