<div id="oesync" class="oesync">
	<a id="sync_link" class="syncbtn" href="<?php echo Yii::app()->createUrl("/sync/index")?>">
		<img src="<?php echo Yii::app()->createUrl("/img/_elements/icons/sync/syncbtn_blue.png")?>" />
	</a>
</div>
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
	'target'=>'#sync_link',
	'config'=>array()
	));
?>
