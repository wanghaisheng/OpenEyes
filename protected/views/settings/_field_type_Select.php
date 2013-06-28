<?php
foreach (unserialize($key->values) as $option) {
	echo CHtml::radioButton($key->name,($key->formValue == $option),array('disabled'=>!Config::has($key->name))).' '.$option?>&nbsp;&nbsp;<?php
}
