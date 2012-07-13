<?php

class m120713_074329_martin_watson_firm_session_changes extends CDbMigration
{
	public function up()
	{
		$this->insert('firm',array(
			'service_subspecialty_assignment_id' => 5,
			'pas_code' => 'WATM',
			'name' => 'Watson Martin',
		));

		$firm = $this->dbConnection->createCommand()->select('id')->from('firm')->where("pas_code = 'WATM'")->queryRow();
		$user = $this->dbConnection->createCommand()->select('id')->from('user')->where("code = 'MUUID003038'")->queryRow();

		$this->insert('firm_user_assignment',array('firm_id'=>$firm['id'],'user_id'=>$user['id']));

		$this->insert('contact',array(
			'nick_name' => 'Martin',
			'title' => 'Mr',
			'first_name' => 'Martin',
			'last_name' => 'Watson',
		));

		$contact = $this->dbConnection->createCommand()->select('id')->from('contact')->where("first_name = 'Martin' and last_name = 'Watson'")->queryRow();

		$this->insert('user_contact_assignment',array('user_id'=>$user['id'],'contact_id'=>$contact['id']));

		$this->delete('sequence_firm_assignment','sequence_id=91');
		$this->insert('sequence_firm_assignment',array('sequence_id'=>91,'firm_id'=>$firm['id']));

		$this->delete('sequence_firm_assignment','sequence_id=92');
		$this->insert('sequence_firm_assignment',array('sequence_id'=>92,'firm_id'=>$firm['id']));

		$this->delete('sequence_firm_assignment','sequence_id=93');
		$this->insert('sequence_firm_assignment',array('sequence_id'=>93,'firm_id'=>$firm['id']));

		// Update all matching sessions from 1st may onwards
		foreach ($this->dbConnection->createCommand()->select('id')->from('session')->where("sequence_id in (91,92,93) and date >= '2012-05-01'")->queryAll() as $session) {
			$this->delete('session_firm_assignment','session_id='.$session['id']);
			$this->insert('session_firm_assignment',array('session_id'=>$session['id'],'firm_id'=>$firm['id']));
		}
	}

	public function down()
	{
		$old_firm = $this->dbConnection->createCommand()->select('id')->from('firm')->where("service_subspecialty_assignment_id = 5 and pas_code = 'WILM'")->queryRow();

		$this->delete('sequence_firm_assignment','sequence_id=91');
		$this->insert('sequence_firm_assignment',array('sequence_id'=>91,'firm_id'=>$old_firm['id']));

		$this->delete('sequence_firm_assignment','sequence_id=92');
		$this->insert('sequence_firm_assignment',array('sequence_id'=>92,'firm_id'=>$old_firm['id']));

		$this->delete('sequence_firm_assignment','sequence_id=93');
		$this->insert('sequence_firm_assignment',array('sequence_id'=>93,'firm_id'=>$old_firm['id']));

		// Update all matching sessions from 1st may onwards
		foreach ($this->dbConnection->createCommand()->select('id')->from('session')->where("sequence_id in (91,92,93) and date >= '2012-05-01'")->queryAll() as $session) {
			$this->delete('session_firm_assignment','session_id='.$session['id']);
			$this->insert('session_firm_assignment',array('session_id'=>$session['id'],'firm_id'=>$old_firm['id']));
		}

		$contact = $this->dbConnection->createCommand()->select('id')->from('contact')->where("first_name = 'Martin' and last_name = 'Watson'")->queryRow();

		$this->delete('user_contact_assignment','contact_id='.$contact['id']);
		$this->delete('contact','id='.$contact['id']);

		$firm = $this->dbConnection->createCommand()->select('id')->from('firm')->where("pas_code = 'WATM'")->queryRow();
		$user = $this->dbConnection->createCommand()->select('id')->from('user')->where("code = 'MUUID003038'")->queryRow();

		$this->delete('firm_user_assignment','firm_id='.$firm['id']);

		$this->delete('firm','id='.$firm['id']);
	}
}
