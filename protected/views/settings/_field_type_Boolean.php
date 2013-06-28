<?php
echo CHtml::radioButton($key->name,$key->formValue,array('disabled'=>!Config::has($key->name)))?> <span>Yes</span>
<?php echo CHtml::radioButton($key->name,!$key->formValue,array('disabled'=>!Config::has($key->name)))?> <span>No</span>
