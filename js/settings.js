$(document).ready(function() {
	$('#settings input[name^="enabled_"]').click(function() {
		if ($(this).is(':checked')) {
			$(this).next('span').removeClass('notset');
			$(this).next('span').next('span.field').children().removeAttr('disabled');
		} else {
			$(this).next('span').addClass('notset');
			$(this).next('span').next('span.field').children().attr('disabled','disabled');
		}
	});
});
