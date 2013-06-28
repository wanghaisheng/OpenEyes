<?php
$model = $key->metadata1;
echo CHtml::dropDownList($key->name,$key->formValue,CHtml::listData($model::model()->findAll(array('order'=>$key->metadata2)),'id','name'),array('empty'=>'- Not set -','disabled'=>!Config::has($key->name)));
