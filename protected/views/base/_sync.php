<div id="oesync" class="oesync">
	<a id="sync_link" class="syncbtn" href="<?php echo Yii::app()->createUrl("/sync/index")?>">
		<img src="<?php echo Yii::app()->createUrl("/img/_elements/icons/sync/syncbtn_blue.png")?>" />
	</a>
</div>
<script type="text/javascript">
	$('a.syncbtn').click(function(e) {
		e.preventDefault();
		var dim = $('<div class="dimcontent"></div>');
		var wrap = $('<div class="overlay"></div>');

		wrap.appendTo('body');
		wrap.load(baseUrl+'/sync/index').hide().addClass("position syncconsole").fadeIn();
		dim.appendTo('body').click(function(){ clearSyncOverlay(); });
	});

	function clearOverlay()
	{
		$('div.overlay').removeClass("position syncconsole");
		$('div.overlay').remove();
		$('div.dimcontent').remove();
	}

	$('#cancel-sync-console').live('click',function(){
		clearOverlay();
	});
</script>
