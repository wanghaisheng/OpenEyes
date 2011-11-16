<?php
if (!empty(Yii::app()->session['user'])) {
	$user = Yii::app()->session['user'];
} else {
	$user = User::model()->findByPk(Yii::app()->user->id);
}
$firm = Firm::model()->findByPk($this->selectedFirmId);

if (file_exists("/etc/hostname")) {
	$hostname = trim(file_get_contents("/etc/hostname"));
} else {
	$hostname = trim(`hostname`);
}

if (is_object($user)) {
	$username = "$user->username ($user->id)";
	$firm = "$firm->name ($firm->id)";
} else {
	$username = $firm = Yii::t('strings','Not logged in');
}

$commit = preg_replace('/[\s\t].*$/s','',@file_get_contents(@$_SERVER['DOCUMENT_ROOT']."/.git/FETCH_HEAD"));
$branch = array_pop(explode('/',file_get_contents(".git/HEAD")));
?>
<div id="debug-info-modal">
	<code>
		<strong><?php echo Yii::t('strings','This information is provided to assist the helpdesk in diagnosing any problems')?></strong><br />
		<?php echo Yii::t('strings','Served, with love, by')?>: <?php echo $hostname?><br />
		<?php echo Yii::t('strings','Docroot')?>: <?php echo @$_SERVER['DOCUMENT_ROOT']?><br />
		<?php echo Yii::t('strings','Date')?>: <?php echo date('d.m.Y H:i:s')?><br />
		<?php echo Yii::t('strings','Commit')?>: <?php echo $commit?><br />
		<?php echo Yii::t('strings','Branch')?>: <?php echo $branch?><br/>
		<?php echo Yii::t('strings','User agent')?>: <?php echo wordwrap(@$_SERVER['HTTP_USER_AGENT'], 80, "<br />\n");?>
		<?php echo Yii::t('strings','Client IP')?>: <?php echo @$_SERVER['REMOTE_ADDR']?><br />
		<?php echo Yii::t('strings','Username')?>: <?php echo $username?><br />
		<?php echo Yii::t('strings','Firm')?>: <?php echo $firm?><br />
		
	</code>
</div>
