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

function handleButton(button, callback) {
	button.click(function(e) {
		if (!button.hasClass('inactive')) {
			disableButtons();
			if (callback) {
				callback(e,button);
			}
		} else {
			e.preventDefault();
			console.log('canceled');
		}
	});
}

/**
 * This method prevents click event handlers from being called on disabled *link* buttons,
 * for example: <a href="#" class="button disabled">
 */
function preventClickOnDisabledButton() {
	// Remove, then bind the disable click handler.
	$(this)
	.off('click.disable')
	.on('click.disable', function(e) {
		e.stopImmediatePropagation(); // Prevent other click handlers from being executed.
		e.stopPropagation();          // Prevent the event from bubbling.
		e.preventDefault();           // Prevent the default action (when using a link button)
	});

	// Arrange the events so that the disable handler is always executed first.
	var events = $._data(this, 'events').click
	events.unshift(events.pop()); // Move the last event to the start of the event stack.
}

function disableButtons() {

	$('button,.button')
	.not('.cancel')
	.addClass('inactive')
	.attr('disabled', true)
	.each(preventClickOnDisabledButton);

	$('.loader').show();
}

function enableButtons() {

	$('button,.button')
	.not('.cancel')
	.removeClass('inactive')
	.removeAttr('disabled')
	.off('click.disable');

	$('.loader').hide();
}

$(document).ready(function() {
	$('button.auto').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();
			return true;
		}
		return false;
	});
});
