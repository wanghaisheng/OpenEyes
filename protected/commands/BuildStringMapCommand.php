<?php
/*
_____________________________________________________________________________
(C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
(C) OpenEyes Foundation, 2011
This file is part of OpenEyes.
OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
_____________________________________________________________________________
http://www.openeyes.org.uk   info@openeyes.org.uk
--
*/

class BuildStringMapCommand extends CConsoleCommand
{
	private $ignore = array(
		'.',
		'..',
		'.git',
		'BuildStringMapCommand.php'
	);
	private $strings = array();

	public function getName()
	{
		return 'BuildStringMapCommand';
	}

	public function getHelp()
	{
		return Yii::t('strings','Greps through the codebase for all i18n string references and dumps them into a template as protected/messages/strings.sample.php').'.';
	}

	public function run($args)
	{
		$this->scan(dirname(__FILE__)."/../../");

		if (!file_exists(dirname(__FILE__)."/../messages")) {
			@mkdir(dirname(__FILE__)."/../messages",0755);
		}

		$fp = fopen(dirname(__FILE__)."/../messages/strings.sample.php","w");

		fwrite($fp,"<?\n\$strings = array(\n");

		foreach ($this->strings as $string) {
			fwrite($fp,"\t'$string' => '',\n");
		}

		fwrite($fp,");\n?>");
		fclose($fp);

		echo "Generated protected/messages/strings.sample.php\n";
	}

	public function scan($dir) {
		$dh = opendir($dir);

		while ($file = readdir($dh)) {
			if (!in_array($file,$this->ignore)) {
				if (is_file($dir."/".$file)) {
					$this->process($dir."/".$file);
				} else if (is_dir($dir."/".$file)) {
					$this->scan($dir."/".$file);
				}
			}
		}

		closedir($dh);
	}

	public function process($file) {
		foreach (@file($file) as $line) {
			$line = substr($line,0,strlen($line)-1);

			if (preg_match_all('/Yii::t\(\'strings\',\'(.*?)\'\)/',$line,$m)) {
				foreach ($m[1] as $string) {
					if (!in_array($string,$this->strings)) {
						$this->strings[] = $string;
					}
				}
			}
		}
	}
}
