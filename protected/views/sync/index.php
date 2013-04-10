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
<div class="overlaybox dropshadow syncconsole clearfix" id="sync-console">
	<h3>Remote Sync Console</h3>
	<table class="subtle white valignmiddle">
		<tbody>
			<tr>
				<td><span class="small bold">Server</span></td>
				<td><?php echo $server->hostname?></td>
			</tr>
			<tr>
				<td><span class="small bold">Server status</span></td>
				<td class="status"><img src="<?php echo Yii::app()->createUrl('/img/ajax-loader.gif')?>" /></td>
			</tr>
			<tr>
				<td><span class="small bold">Last Sync</span></td>
				<td><?php echo date('jS F Y, H:i',strtotime($server->last_sync))?></td>
			</tr>
			<tr>
				<td><span class="small bold">In sync</span></td>
				<td class="syncstatus <?php echo $server->in_sync ? "in_sync" : "out_of_sync"?>"><?php echo $server->in_sync ? 'Yes' : 'No'?></td>
			</tr>
			<?php /*
			<tr>
				<td><span class="small bold">Messages</span></td>
				<td>Ready</td>
			</tr>
			*/?>
		</tbody>
	</table>
	
	<div class="curvybox blueborder singleline white"><img class="syncimage clickable" src="<?php echo Yii::app()->createUrl('/img/_elements/icons/sync/syncbtn_blue.png')?>" width="25px" height="25px" data-rotation="0" data-rotating="false" /><strong><span class="sync_message">Please wait ...</span></strong></div>
	
	<?php /*
	<div class="curvybox blueborder singleline white"><img id="j-spin-sync" data-rotate="0" style="margin-right:20px; position:relative; top:-2px;" src="<?php echo Yii::app()->createUrl('/img/_elements/icons/sync/syncspin_white.png')?>" width="25px" height="25px"><b>Syncing... please wait</b></div>
	
	<div class="curvybox blueborder singleline white"><img style="margin-right:20px; position:relative; top:-2px;" src="<?php echo Yii::app()->createUrl('/img/_elements/icons/sync/syncbtn_green.png')?>" width="25px" height="25px"><b>Sync was successful</b></div>
	
	<div class="curvybox blueborder singleline white"><img style="margin-right:20px; position:relative; top:-2px;" src="<?php echo Yii::app()->createUrl('/img/_elements/icons/sync/syncbtn_orange.png')?>" width="25px" height="25px"><b class="red">Sync failed</b></div>
	*/?>

	<div class="btngroup right padtop">
		<button id="cancel-sync-console" class="classy blue mini" type="submit"><span class="btn blue">Close</span></button>
	</div>
</div>

<script type="text/javascript">
	ping(<?php echo $server->id?>,false);

	function ping(server_id, sync) {
		var target = $('td.status');

		var insync = $('td.syncstatus');
		var syncImage = $('img.syncimage');

		target.html('<img src="<?php echo Yii::app()->createUrl('/img/ajax-loader.gif')?>" />');
		$('span.sync_message').text('Pinging <?php echo $server->hostname?> ...');

		$.ajax({
			'type': 'GET',
			'url': baseUrl+'/sync/ping/'+server_id,
			'success': function(s) {
				if (s == 'UP') {
					target.attr('class','status sync_up');
				} else {
					target.attr('class','status sync_down');
				}
				target.text(s);

				if (s == 'UP') {
					$('span.sync_message').text('Ready');

					if (insync.hasClass('in_sync')) {
						$.ajax({
							'type': 'GET',
							'url': baseUrl+'/sync/status/'+server_id,
							'success': function(response) {
								if (response == "INSYNC") {
									insync.text("Yes");
								} else {
									insync.removeClass('in_sync').addClass('out_of_sync');
									insync.text("No");
								}
							}
						});
					} else {
						insync.removeClass('in_sync').addClass('out_of_sync');
						insync.text("No");
					}

					if (sync) {
						$('.syncimage').click();
					}

				} else {
					insync.removeClass('in_sync').addClass('out_of_sync');
					insync.text("Unknown");
					syncImage.attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_orange.png');
					$('span.sync_message').text('Unable to sync, server is unreachable');
				}
			}
		});
	}

	$('.syncimage').click(function(e) {
		e.preventDefault();

		var server_id = <?php echo $server->id?>;

		if ($('span.sync_message').text().match(/unreachable/)) {
			ping(server_id, true);
		} else {
			if ($(this).attr('data-rotating') == 'false') {
				$('span.sync_message').text('Syncing ...');
				$('img.syncimage').attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_blue.png');
				animate($(this));
				sync(server_id);
			}
		}
	});

	function sync(server_id) {
		$.ajax({
			'type': 'GET',
			'url': baseUrl+'/sync/go/'+server_id,
			'dataType': 'json',
			'success': function(response) {
				if (response["status"] == "OK") {
					$('td.out_of_sync').removeClass('out_of_sync').addClass('in_sync').text('Yes');
					$('.syncimage').attr('data-status','succeeded');
					$('.syncimage').attr('data-rotating','stopping');
				} else {
					$('td.in_sync').removeClass('in_sync').addClass('out_of_sync').text('No');
					$('.syncimage').attr('data-status','failed');
					$('.syncimage').attr('data-rotating','stopping');
				}

				$('span.sync_message').text(response["message"]);
			},
			'error': function(er) {
				$('td.in_sync').removeClass('in_sync').addClass('out_of_sync').text('No');
				$('span.sync_message').text("Sync failed (HTTP500 error)");
				$('.syncimage').attr('data-status','failed');
				$('.syncimage').attr('data-rotating','stopping');
			}
		});
	}

	function animate(img) {
		if (img.attr('data-rotating') == 'false') {
			img.attr('data-rotating','true');
		}

		if (img.attr('data-rotating') == 'stopping') {
			var rotation = parseInt(img.attr('data-rotation')) + 5;
			if (rotation >= 360) {
				rotation -= 360;
			}
			img.rotate(rotation);
			img.attr('data-rotation',rotation);

			if (rotation != 0 && rotation != 180) {
				setTimeout(function(){ animate(img);},30);
			} else {
				img.attr('data-rotating','false');
				if (img.attr('data-status') == 'failed') {
					img.attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_orange.png');
				} else {
					img.attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_green.png');
				}
			}
		} else {
			var rotation = parseInt(img.attr('data-rotation')) + 5;
			if (rotation >= 360) {
				rotation -= 360;
			}
			img.rotate(rotation);
			img.attr('data-rotation',rotation);
			setTimeout(function(){ animate(img);},20);
		}
	}
</script>

<?php /*
<div class="syncing">
	<h1>Syncing console</h1>
	<table class="sync_list">
		<thead>
			<th>Server</th>
			<th>Status</th>
			<th>Last sync</th>
			<th>In sync</th>
			<th>Messages</th>
			<th>Actions</th>
		</thead>
		<tbody>
			<?php foreach (SyncServer::model()->findAll(array('order'=>'`order`')) as $server) {?>
				<tr data-server-id="<?php echo $server->id?>">
					<td><?php echo $server->hostname?></td>
					<td class="status"><img src="<?php echo Yii::app()->createUrl('/img/ajax-loader.gif')?>" /></td>
					<td><?php echo $server->lastSyncText?></td>
					<td class="<?php echo $server->in_sync ? "in_sync" : "out_of_sync"?>"><?php echo $server->in_sync ? 'Yes' : 'No'?></td>
					<td id="message<?php echo $server->id?>" style="width: 200px;">Ready</td>
					<td class="syncImage"><a href="#" class="sync" rel="<?php echo $server->id?>"><img src="<?php echo Yii::app()->createUrl($server->in_sync ? '/img/_elements/icons/sync/syncbtn_green.png' : 'img/_elements/icons/sync/syncbtn_orange.png')?>" data-rotation="0" data-rotating="false" /></a></td>
				</tr>
			<?php }?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$('table.sync_list').children('tbody').children('tr').map(function() {
		var server_id = $(this).attr('data-server-id');
		var target = $(this).children('td.status');

		var insync = target.next('td').next('td');
		var syncImage = insync.next('td').children('a').children('img');

		insync.html('<img src="'+baseUrl+'/img/ajax-loader.gif" />');

		$.ajax({
			'type': 'GET',
			'url': baseUrl+'/sync/ping/'+server_id,
			'success': function(s) {
				if (s == 'UP') {
					target.attr('class','sync_up');
				} else {
					target.attr('class','sync_down');
				}
				target.text(s);

				if (s == 'UP') {
					if (insync.hasClass('in_sync')) {
						$.ajax({
							'type': 'GET',
							'url': baseUrl+'/sync/status/'+server_id,
							'success': function(response) {
								if (response == "INSYNC") {
									insync.text("Yes");
									syncImage.attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_green.png');
								} else {
									insync.removeClass('in_sync').addClass('out_of_sync');
									insync.text("No");
									syncImage.attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_orange.png');
								}
							}
						});
					} else {
						insync.removeClass('in_sync').addClass('out_of_sync');
						insync.text("No");
						syncImage.attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_orange.png');
					}
				} else {
					insync.removeClass('in_sync').addClass('out_of_sync');
					insync.text("Unknown");
					syncImage.attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_orange.png');
				}
			}
		});
	});

	$('a.sync').click(function() {
		var element = $(this);
		var server_id = $(this).attr('rel');

		var img = element.children('img');

		if (img.attr('data-rotating') == 'false') {
			element.parent().prev('td').text('Syncing...');
			element.children('img').attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_blue.png');

			animate(img);

			$.ajax({
				'type': 'GET',
				'url': baseUrl+'/sync/go/'+server_id,
				'dataType': 'json',
				'success': function(response) {
					if (response["status"] == "OK") {
						$('td.out_of_sync').removeClass('out_of_sync').addClass('in_sync').text('Yes');
						//element.children('img').attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_green.png');
						img.attr('data-status','succeeded');
						img.attr('data-rotating','stopping');
					} else {
						$('td.in_sync').removeClass('in_sync').addClass('out_of_sync').text('No');
						img.attr('data-status','failed');
						img.attr('data-rotating','stopping');
						//element.children('img').attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_orange.png');
					}

					element.parent().prev('td').text(response["message"]);
				},
				'error': function(er) {
					$('td.in_sync').removeClass('in_sync').addClass('out_of_sync').text('No');
					//element.children('img').attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_orange.png');
					element.parent().prev('td').text("Sync failed (HTTP500 error)");
					img.attr('data-status','failed');
					img.attr('data-rotating','stopping');
				}
			});
		}

		return false;
	});

	function animate(img) {
		if (img.attr('data-rotating') == 'false') {
			img.attr('data-rotating','true');
		}

		if (img.attr('data-rotating') == 'stopping') {
			var rotation = parseInt(img.attr('data-rotation')) + 5;
			if (rotation >= 360) {
				rotation -= 360;
			}
			img.rotate(rotation);
			img.attr('data-rotation',rotation);

			if (rotation != 0 && rotation != 180) {
				setTimeout(function(){ animate(img);},30);
			} else {
				img.attr('data-rotating','false');
				if (img.attr('data-status') == 'failed') {
					img.attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_orange.png');
				} else {
					img.attr('src',baseUrl+'/img/_elements/icons/sync/syncbtn_green.png');
				}
			}
		} else {
			var rotation = parseInt(img.attr('data-rotation')) + 5;
			if (rotation >= 360) {
				rotation -= 360;
			}
			img.rotate(rotation);
			img.attr('data-rotation',rotation);
			setTimeout(function(){ animate(img);},30);
		}
	}
</script>
*/?>
