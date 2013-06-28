<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

?>
<div class="report curvybox white">
	<div class="admin">
		<h3 class="georgia"><?php echo $title?></h3>
		<div>
			<form id="settings" method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
				<?php foreach ($keys as $key) {?>
					<div>
						<?php echo CHtml::checkBox('enabled_'.$key->name,Config::has($key->name))?>
						<span class="label<?php if (!Config::has($key->name)) {?> notset notsetorig<?php }?>"><?php echo $key->label?>:</span>
						<span class="field">
							<?php echo $this->renderPartial('/settings/_field_type_'.$key->configType->name,array('key'=>$key))?>
						</span>
					</div>
				<?php }?>
			</form>
		</div>
	</div>
</div>
<div>
	<?php echo EventAction::button('Save', 'save', array('colour' => 'green'))->toHtml()?>
	&nbsp;&nbsp;&nbsp;
	<?php echo EventAction::button('Reset to defaults', 'reset', array('colour' => 'blue'))->toHtml()?>
</div>
