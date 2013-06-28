<?php
$this->widget('application.widgets.StringList',array(
	'field' => 'select_'.$key->name,
	'values' => $key->formValue,
	'disabled' => !Config::has($key->name),
))?>
