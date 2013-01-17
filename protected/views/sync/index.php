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
					<td id="message<?php echo $server->id?>">Ready</td>
					<td><a href="#" class="sync" rel="<?php echo $server->id?>"><img src="<?php echo Yii::app()->createUrl('/img/sync.png')?>" /></a></td>
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
				} else {
					insync.removeClass('in_sync').addClass('out_of_sync');
					insync.text("Unknown");
				}
			}
		});
	});

	$('a.sync').click(function() {
		var element = $(this);
		var server_id = $(this).attr('rel');

		element.parent().prev('td').text('Syncing...');

		$.ajax({
			'type': 'GET',
			'url': baseUrl+'/sync/go/'+server_id,
			'dataType': 'json',
			'success': function(response) {
				if (response["status"] == "OK") {
					$('td.out_of_sync').removeClass('out_of_sync').addClass('in_sync').text('Yes');
				} else {
					$('td.in_sync').removeClass('in_sync').addClass('out_of_sync').text('No');
				}

				element.parent().prev('td').text(response["message"]);
			}
		});
	});
</script>
