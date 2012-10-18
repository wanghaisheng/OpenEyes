<?php

class m121018_150000_legacy_contacts extends CDbMigration {

	public function up() {
		$this->addColumn('contact', 'source', 'varchar(255) DEFAULT NULL');
		$this->addColumn('contact', 'source_ref', 'varchar(100) DEFAULT NULL');
		$this->addColumn('contact', 'archived', 'tinyint(1) unsigned NOT NULL DEFAULT 0');
	}

	public function down() {
		$this->dropColumn('contact', 'source');
		$this->dropColumn('contact', 'source_ref');
		$this->dropColumn('contact', 'archived');
	}

}