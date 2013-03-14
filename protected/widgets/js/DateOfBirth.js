$(document).ready(function() {
	$('#dob_day').change(function() {
		update_date_of_birth_dropdowns();
	});
	$('#dob_mon').change(function() {
		update_date_of_birth_dropdowns();
	});
	$('#dob_year').change(function() {
		update_date_of_birth_dropdowns();
	});
});

function update_date_of_birth_dropdowns() {
	var month = parseInt($('#dob_mon').val());
	var year = parseInt($('#dob_year').val());

	switch (month) {
		case 4:
		case 6:
		case 9:
		case 11:
			set_num_days(30);
			break;
		case 2:
			if (year %4 == 0) {
				set_num_days(29);
			} else {
				set_num_days(28);
			}
			break;
		default:
			set_num_days(30);
	}

	var day = parseInt($('#dob_day').val());

	if (day >0 && month >0 && year >0) {
		if (day <10) {
			day = '0'+day;
		}
		if (month <10) {
			month = '0'+month;
		}
		$('#Patient_dob').val(year+'-'+month+'-'+day);
	}
}

function set_num_days(n) {
	var day = parseInt($('#dob_day').val());

	while (day >n) {
		day -= 1;
	}

	var options = '<option value="">day</option>';

	for (var i=1;i<=n;i++) {
		options += '<option value="'+i+'">'+i+'</option>';
	}

	$('#dob_day').html(options);
	$('#dob_day').val(day);
}
