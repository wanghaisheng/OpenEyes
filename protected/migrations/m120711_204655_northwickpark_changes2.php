<?php

class m120711_204655_northwickpark_changes2 extends CDbMigration
{
	public function up()
	{
		$this->update('theatre',array('name'=>'Northwick Park Theatre'),'id=14');
		$this->update('ward',array('name'=>'Northwick Park Day Care, Ground floor'),'id=7');
	}

	public function down() {
		$this->update('theatre',array('name'=>'Northwick park theatre'),'id=14');
		$this->update('ward',array('name'=>'Northwick Park Day care, Ground floor'),'id=7');
	}
}
