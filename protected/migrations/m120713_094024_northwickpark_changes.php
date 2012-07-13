<?php

class m120713_094024_northwickpark_changes extends CDbMigration
{
	public function up()
	{
    $this->update('theatre',array('name'=>'Northwick Park Theatre'),'id=14');
    $this->update('ward',array('name'=>'Northwick Park Day Care, Ground floor'),'id=7');
	}

	public function down()
	{
    $this->update('ward',array('name'=>'VanGuard Mobile Operating Theatre'),'id=7');
    $this->update('theatre',array('name'=>'Theatre Seven'),'id=14');
	}
}
