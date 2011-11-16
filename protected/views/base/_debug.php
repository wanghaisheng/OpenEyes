<!---
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
?>
<?php echo Yii::t('strings','Server')?>: <?php echo $hostname?>

<?php echo Yii::t('strings','Date')?>: <?php echo date('d.m.Y H:i:s')?>

<?php echo Yii::t('strings','Commit')?>: <?php echo $commit?>

<?php echo Yii::t('strings','User agent')?>: <?php echo @$_SERVER['HTTP_USER_AGENT']?>

<?php echo Yii::t('strings','Client IP')?>: <?php echo @$_SERVER['REMOTE_ADDR']?>

<?php echo Yii::t('strings','Username')?>: <?php echo $username?>

<?php echo Yii::t('strings','Firm')?>: <?php echo $firm?>

-->
