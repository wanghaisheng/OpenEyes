<?php
$model = $key->metadata1;
echo CHtml::textField($key->name,$key->formValue,array('size'=>10,'disabled'=>!Config::has($key->name)));
