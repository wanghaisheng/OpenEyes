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
