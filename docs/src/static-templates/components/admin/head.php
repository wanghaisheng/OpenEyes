<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>OpenEyes</title>

<meta name="viewport" content="width=device-width" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="/favicon.ico"/>
<?php
$assets_app_root_path = '../assets/';
$assets_docs_root_path = '../assets/';
if (strpos($_SERVER['REQUEST_URI'],'src/') !== false) {
	$assets_app_root_path = '../../../';
}
include '../fragments/admin/assets.php';
?>