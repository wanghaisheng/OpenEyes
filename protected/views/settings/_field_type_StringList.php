<?php
$value = $key->formValue;
if (is_array($value)) echo implode(', ',$value);
