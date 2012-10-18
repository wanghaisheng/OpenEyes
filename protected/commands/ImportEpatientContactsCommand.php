<?php
class ImportEpatientContactsCommand extends CConsoleCommand {

	public function getName() {
		return 'ImportEpatientContacts';
	}

	public function getHelp() {
		return 'Imports contacts from ePatient as "legacy" contacts
				Usage: ./yiic importepatientcontacts';
	}

	public function run($args) {

		// Connect to ePatient
		$dbe = mssql_connect('epatients2','openeyes','fioeg8924gh9');
		if(!$dbe) {
			die('Could not connect to server: ' . mssql_get_last_message());
		}
		mssql_select_db('epatient', $dbe);

	}

}
