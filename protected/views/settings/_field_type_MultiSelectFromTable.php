<?php
$model = $key->metadata1;
$this->widget('application.widgets.MultiSelectList',array(
	'basic' => true,
	'field' => 'select_'.$key->name,
	'selected_ids' => $key->formValue,
	'options' => CHtml::listData($model::model()->findAll(array('order'=>$key->metadata2)),'id',$key->metadata2),
	'htmlOptions' => array(
		'label' => '',
		'empty' => '- Select -',
	),
	'disabled' => !Config::has($key->name),
))?>
