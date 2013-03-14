					<div class="eventDetail">
						<div class="label"><?php echo CHtml::encode($element->getAttributeLabel($field))?>:</div>
						<div class="data">
							<?php echo CHtml::dropDownList('dob_day',substr($value,8,2),$days,array('empty'=>'day'))?>
							<?php echo CHtml::dropDownList('dob_mon',substr($value,5,2),$months,array('empty'=>'month'))?>
							<?php echo CHtml::dropDownList('dob_year',substr($value,0,4),$years,array('empty'=>'year'))?>
							<?php echo CHtml::hiddenField(get_class($element).'['.$field.']','')?>
						</div>
					</div>
