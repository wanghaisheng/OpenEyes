<?php
echo CHtml::textField($key->name,$key->formValue,array('size'=>70,'disabled'=>!Config::has($key->name)));
