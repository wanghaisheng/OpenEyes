<?php /**
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
<div class="scan-thumbnails">
	<?php foreach ($element->getScans($filetypes) as $i => $scan) {?>
		<?php if ($i >0 && ($i % 6) == 0) {?>
			</div><div class="scan-thumbnails">
		<?php }?>
		<div class="scan-thumbnail" style="background-image:url('<?php echo $this->assetPath?>/img/scans/<?php echo $scan?>.thumbnail.jpg');<?php if (@$_POST[get_class($element)]['asset_id'] == $scan) {?> border: 2px solid #0b59da;<?php }?>" data-filename="<?php echo $scan?>">
			<div class="scan-thumbnail-select-target"></div>
			<div class="scan-thumbnail-preview-link">
				<a href="<?php echo $this->assetPath?>/img/scans/<?php echo $scan?>.preview.jpg" rel="<?php echo $identifier.$i?>">
					<button type="submit" class="classy blue mini preview-thumbnail"><span class="button-span button-span-blue">Preview</span></button>
				</a>
			</div>
		</div>
	<?php }?>
</div>
<script type="text/javascript">
	$('div.scan-thumbnail-select-target').click(function() {
		$('div.scan-thumbnail').css("border","2px solid #ccc");
		$(this).parent().css("border","2px solid #0b59da");
		$('#<?php echo get_class($element)?>_asset_id').val($(this).parent().attr('data-filename'));
		return false;
	});
</script>
<?php
foreach ($element->getScans($filetypes) as $i => $scan) {
	$this->widget('application.extensions.fancybox.EFancyBox', array(
		'target' => 'a[rel='.$identifier.$i.']',
		'config' => array(),
	));
}
