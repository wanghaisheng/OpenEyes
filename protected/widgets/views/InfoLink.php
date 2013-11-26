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
?>

<div class="info-link" style="display:inline-block">
<span class="info-link-icon"><img src="/img/info.png" style="height:20px" /></span>
		<div class="info-link-preview" style="display: none;">
			<?php echo $preview?>
</div>
<div class="info-link-content" style="display: none;">
			<?php echo $content?>
</div>
</div>

<script type="text/javascript">

	$('.info-link').each(function(){
		var quick = $(this).find('.info-link-preview');
		var iconHover = $(this).find('.info-link-icon');

		iconHover.hover(function(e){
			var infoWrap = $('<div class="quicklook"></div>');
			infoWrap.appendTo('body');
			infoWrap.html(quick.html());

			var offsetPos = $(this).offset();
			var top = offsetPos.top;
			var left = offsetPos.left + 25;

			top = top - (infoWrap.height()/2) + 8;

			if (left + infoWrap.width() > 1150) left = left - infoWrap.width() - 40;
			infoWrap.css({'position': 'absolute', 'top': top + "px", 'left': left + "px"});
			infoWrap.fadeIn('fast');
		},function(e){
			$('body > div:last').remove();
		});
	});

	$(".info-link").find(".info-link-content").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 500
	});

	$('.info-link').delegate('.info-link-icon', 'click', function(e) {
		$('.info-link-content').dialog('open');
		// remove hovering:
		$(this).trigger('mouseleave');
		e.preventDefault();
	});
</script>
