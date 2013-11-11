<?php

class m131108_155946_remove_pedigree_tables extends OEMigration
{
	public function up()
	{
		$this->dropTable('pedigree');
		$this->dropTable('pedigree_gene');
		$this->dropTable('pedigree_inheritance');
	}

	public function down()
	{
		$this->createTable('pedigree_inheritance',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) collate utf8_bin NOT NULL',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `pedigree_inheritance_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `pedigree_inheritance_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `pedigree_inheritance_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `pedigree_inheritance_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->createTable('pedigree_gene',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) collate utf8_bin NOT NULL',
				'location' => 'varchar(16) collate utf8_bin NOT NULL',
				'priority' => 'tinyint(1) unsigned NOT NULL',
				'description' => 'varchar(2048) collate utf8_bin NOT NULL',
				'details' => 'varchar(2048) collate utf8_bin NOT NULL',
				'refs' => 'varchar(1024) collate utf8_bin NOT NULL',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `pedigree_gene_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `pedigree_gene_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `pedigree_gene_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `pedigree_gene_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->createTable('pedigree',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'inheritance_id' => 'int(10) unsigned NOT NULL',
				'comments' => 'text collate utf8_bin not null',
				'consanguinity' => 'tinyint(1) unsigned NOT NULL',
				'gene_id' => 'int(10) unsigned NULL',
				'base_change' => 'varchar(50) collate utf8_bin not null',
				'amino_acid_change' => 'varchar(50) collate utf8_bin not null',
				'disorder_id' => 'int(10) unsigned NULL',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `pedigree_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `pedigree_created_user_id_fk` (`created_user_id`)',
				'KEY `pedigree_inheritance_id_fk` (`inheritance_id`)',
				'KEY `pedigree_gene_id_fk` (`gene_id`)',
				'KEY `pedigree_disorder_id_fk` (`disorder_id`)',
				'CONSTRAINT `pedigree_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `pedigree_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `pedigree_inheritance_id_fk` FOREIGN KEY (`inheritance_id`) REFERENCES `pedigree_inheritance` (`id`)',
				'CONSTRAINT `pedigree_gene_id_fk` FOREIGN KEY (`gene_id`) REFERENCES `pedigree_gene` (`id`)',
				'CONSTRAINT `pedigree_disorder_id_fk` FOREIGN KEY (`disorder_id`) REFERENCES `disorder` (`id`)',
			), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);

		$this->initialiseData(dirname(__FILE__));
	}
}
