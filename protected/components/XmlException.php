<?php
/**
 * (C) OpenEyes Foundation, 2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (C) 2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * Exceptions with added error information from libxml
 *
 * You must call libxml_use_internal_errors(true) first for this class
 * to do anything useful.
 */
class XmlException extends Exception
{
	/**
	 * @param string $message
	 * @param Exception $previous
	 */
	static public function generate($message, Exception $previous = null)
	{
		$errors = libxml_get_errors();
		if ($errors) {
			$messages = array();
			foreach ($errors as $error) {
				$messages[] = trim($error->message);
			}
			$message .= ' (' . implode(", ", $messages) . ')';
		}
		libxml_clear_errors();

		return new self($message, 0, $previous, $errors);
	}

	protected $errors;

	/**
	 * @param string $message
	 * @param int $code
	 * @param Exception $previous
	 * @param array $errors
	 */
	public function __construct($message, $code = 0, Exception $previous = null, array $errors)
	{
		parent::__construct($message, $code, $previous);
		$this->errors = $errors;
	}
}