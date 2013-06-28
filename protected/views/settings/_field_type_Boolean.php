<?php
echo CHtml::radioButton($key->name,$key->formValue,array('value'=>'1','disabled'=>!Config::has($key->name)))?> <span>Yes</span>
<?php echo CHtml::radioButton($key->name,!$key->formValue,array('value'=>'0','disabled'=>!Config::has($key->name)))?> <span>No</span>
