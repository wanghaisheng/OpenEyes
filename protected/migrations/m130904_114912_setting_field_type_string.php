<?php

class m130904_114912_setting_field_type_string extends CDbMigration
{
	public function up()
	{
		$this->insert('setting_field_type',array('name'=>'String'));
	}

	public function down()
	{
		$this->delete('setting_field_type',"name='String'");
	}
}
