<div class="sync">
	<a href="<?php echo Yii::app()->createUrl('/sync/index')?>" id="sync_link">
		<img src="<?php echo Yii::app()->createUrl('/img/sync.png')?>" />
	</a>
</div>
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
	'target'=>'#sync_link',
	'config'=>array()
	));
?>
