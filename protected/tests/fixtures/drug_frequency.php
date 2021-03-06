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
 *+----+----------+-------------------+-----------------------+-----------------+---------------------+---------------------+---------------+
| id | name     | long_name         | last_modified_user_id | created_user_id | last_modified_date  | created_date        | display_order |
+----+----------+-------------------+-----------------------+-----------------+---------------------+---------------------+---------------+
|  1 | 5/day    | five times a day  |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
|  2 | 2 hourly | every two hours   |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
|  3 | bd       | twice a day       |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
|  4 | hourly   | every hour        |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
|  5 | nocte    | nightly           |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
|  6 | od       | once a day        |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
|  7 | prn      | as directed       |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
|  8 | qid      | four times a day  |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
|  9 | tid      | three times a day |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
| 10 | 1/week   | once a week       |                     1 |               1 | 1900-01-01 00:00:00 | 1900-01-01 00:00:00 |             0 |
+----+----------+-------------------+-----------------------+-----------------+---------------------+---------------------+---------------+


 */
return array(
                         'drugfrequency1' => array(
                                                  'id'=> 1,
                                                  'name' => '5/day',
		  'long_name' => 'five times a day',
		  'display_order' => 0
                         ),
                         'drugfrequency2' => array(
                                                  'id'=> 2,
                                                  'name' => '2 hourly' ,
		  'long_name' => 'every two hours',
		  'display_order' => 0
                         ),
                         'drugfrequency3' => array(
                                                  'id'=> 3,
                                                  'name' => 'bd',
		  'long_name' => 'twice a day',
		  'display_order' => 0
                         ),
	  'drugfrequency4' => array(
                                                  'id'=> 4,
                                                  'name' => 'hourly',
		  'long_name' => 'every hour',
		  'display_order' => 0
                         ),
                         'drugfrequency5' => array(
                                                  'id'=> 5,
                                                  'name' => 'nocte' ,
		  'long_name' => 'nightly',
		  'display_order' => 0
                         ),
                         'drugfrequency6' => array(
                                                  'id'=> 6,
                                                  'name' => 'od',
		  'long_name' => 'once a day',
		  'display_order' => 0
                         ),
	 'drugfrequency7' => array(
                                                  'id'=> 7,
                                                  'name' => 'prn',
		  'long_name' => 'as directed',
		  'display_order' => 0
                         ),
                         'drugfrequency8' => array(
                                                  'id'=> 8,
                                                  'name' => 'qid' ,
		  'long_name' => 'four times a day',
		  'display_order' => 0
                         ),
                         'drugfrequency9' => array(
                                                  'id'=> 9,
                                                  'name' => 'tid',
		  'long_name' => 'three times a day',
		  'display_order' => 0
                         ),
	  'drugfrequency10' => array(
                                                  'id'=> 10,
                                                  'name' => '1/week',
		  'long_name' => 'once a week',
		  'display_order' => 0
                         ), 
);