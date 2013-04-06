<?php

class m130406_224636_episode_site_id_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('episode','last_modified_site_id','int(10) unsigned DEFAULT NULL');
		$this->createIndex('episode_last_modified_site_id_fk','episode','last_modified_site_id');
		$this->addForeignKey('episode_last_modified_site_id_fk','episode','last_modified_site_id','site','id');
		$this->addColumn('episode','created_site_id','int(10) unsigned DEFAULT NULL');
		$this->createIndex('episode_created_site_id_fk','episode','created_site_id');
		$this->addForeignKey('episode_created_site_id_fk','episode','created_site_id','site','id');
	}

	public function down()
	{
		$this->dropForeignKey('episode_last_modified_site_id_fk','episode');
		$this->dropIndex('episode_last_modified_site_id_fk','episode');
		$this->dropColumn('episode','last_modified_site_id');
		$this->dropForeignKey('episode_created_site_id_fk','episode');
		$this->dropIndex('episode_created_site_id_fk','episode');
		$this->dropColumn('episode','created_site_id');
	}
}
