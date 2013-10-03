<?php

class m131003_150006_missing_laser_procs extends CDbMigration
{
	public $procs = array(
		array('Cycloablation', 'Cycloablation', 20, 397537003, 'Laser cycloablation'),
		array('Fill in panretinal photocoagulation', 'Fill in PRP', 20, 312713003, 'Panretinal photocoagulation'),
		array('Focal laser photocoagulation', 'Focal laser', '15', '397538008', 'Focal laser photocoagulation of retina'),
		array('Laser demarcation', 'Demarcation', 20, 85231002, 'Repair of retinal detachment by laser photocoagulation'),
		array('Laser gonioplasty', 'Laser gonioplasty', 10, 404638008, 'Laser gonioplasty'),
		array('Laser hyaloidotomy', 'Hyaloidotomy', 10, 82627009, 'Discission of vitreous strands by anterior approach'),
		array('Laser iridoplasty', 'Laser iridoplasty', 20, 424830006, 'Laser iridoplasty'),
		array('Laser to chorioretinal lesion', 'Laser to CR lesion', 30, 446107007, 'Focal photocoagulation of chorioretinal lesion using laser'),
		array('Laser vitreolysis', 'Vitreolysis', '15', '439522009', 'Lysis of adhesions of vitreous'),
		array('Macular grid', 'Grid', 10, 397539000, 'Grid retinal photocoagulation'),
		array('Selective laser trabeculoplasty', 'Selective laser trab', 20, 392028003, 'Selective laser trabeculoplasty'),
		array('Suture lysis', 'Lysis', 10, 35631009, 'Laser surgery'),
		array('Argon laser trabeculoplasty', 'ALT', 15, '404636007', 'Argon laser trabeculoplasty'),
	);

	public function up()
	{
		foreach ($this->procs as $proc) {
			if (!$_proc = Yii::app()->db->createCommand()->select("*")->from("proc")->where("term = :term",array(":term"=>$proc[0]))->queryRow()) {
				$this->insert('proc',array('term'=>$proc[0],'short_format' => $proc[1],'default_duration'=>$proc[2],'snomed_code'=>$proc[3],'snomed_term'=>$proc[4]));
			}
		}
	}

	public function down()
	{
	}
}
