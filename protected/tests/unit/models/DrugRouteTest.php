<?php

/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
class DrugRouteTest extends CDbTestCase {

	   /**
	    * @var DrugRoute
	    */
	   protected $model;
	   public $fixtures = array(
		    'drugroutes' => 'DrugRoute',
	   );

	   /**
	    * Sets up the fixture, for example, opens a network connection.
	    * This method is called before a test is executed.
	    */
	   protected function setUp() {
		      parent::setUp();
		      $this->model = new DrugRoute;
	   }

	   /**
	    * Tears down the fixture, for example, closes a network connection.
	    * This method is called after a test is executed.
	    */
	   protected function tearDown() {

	   }

	   /**
	    * @covers DrugForm::model
	    * @todo   Implement testModel().
	    */
	   public function testModel() {

		      $this->assertEquals('DrugRoute', get_class(DrugRoute::model()), 'Class name should match model.');
	   }

	   /**
	    * @covers DrugForm::tableName
	    * @todo   Implement testTableName().
	    */
	   public function testTableName() {

		      $this->assertEquals('drug_route', $this->model->tableName());
	   }

	   /**
	    * @covers DrugForm::rules
	    * @todo   Implement testRules().
	    */
	   public function testRules() {

		      $this->assertTrue($this->drugroutes('drugroute1')->validate());
		      $this->assertEmpty($this->drugroutes('drugroute2')->errors);
	   }

	   /**
	    * @covers DrugRoute::relations
	    * @todo   Implement testRelations().
	    */
	   public function testRelations() {
		      // Remove the following lines when you implement this test.
		      $this->markTestIncomplete(
		                'This test has not been implemented yet.'
		      );
	   }

	   /**
	    * @covers DrugRoute::attributeLabels
	    * @todo   Implement testAttributeLabels().
	    */
	   public function testAttributeLabels() {

		      $expected = array();

		      $this->assertEquals($expected, $this->model->attributeLabels());
	   }

	   /**
	    * @covers DrugRoute::search
	    * @todo   Implement testSearch().
	    */
	   public function testSearch() {
		      
		      $this->model->setAttributes($this->drugroutes('drugroute1')->getAttributes());
		      $results = $this->model->search();
		      $data = $results->getData();

		      $expectedKeys = array('drugroute1');
		      $expectedResults = array();
		      if (!empty($expectedKeys)) {
			         foreach ($expectedKeys as $key) {
				            $expectedResults[] = $this->drugroutes($key);
			         }
		      }
		      $this->assertEquals(1, $results->getItemCount());
		      $this->assertEquals($expectedResults, $data);
	   }

}
