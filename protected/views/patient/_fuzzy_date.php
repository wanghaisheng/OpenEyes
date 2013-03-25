<?php 
	if (!@$fuzzy_date) 
	{
		// default to today
		$fuzzy_date = date('Y-m-d');
	}
	$_year = (integer)substr($fuzzy_date,0,4);
	$_month = (integer)substr($fuzzy_date,5,2);
	$_day = (integer)substr($fuzzy_date,8,2);
	?>
							<div class="fuzzy_date <?php echo @$class?>">
								<span class="fuzzy_date_label label">
									Date:
								</span>
								<select name="fuzzy_day" class="fuzzy_date_field">
									<option value="">Day (optional)</option>
									<?php for ($i=1;$i<=31;$i++) {?>
										<option value="<?php echo $i?>"<?php if ($_day == $i) {?> selected="selected"<?php }?>><?php echo $i?></option>
									<?php }?>
								</select>
								<select name="fuzzy_month" class="fuzzy_date_field">
									<option value="">Month (optional)</option>
									<?php foreach (array('January','February','March','April','May','June','July','August','September','October','November','December') as $i => $month) {?>
										<option value="<?php echo $i+1?>"<?php if ($_month == $i+1) {?> selected="selected"<?php }?>><?php echo $month?></option>
									<?php }?>
								</select>
								<select name="fuzzy_year" class="fuzzy_date_field">
									<?php for ($i=date('Y')-50;$i<=date('Y');$i++) {?>
										<option value="<?php echo $i?>"<?php if ($_year == $i) {?> selected="selected"<?php }?>><?php echo $i?></option>
									<?php }?>
								</select>
							</div>
