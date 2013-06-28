$(document).ready(function() {
	$('#settings input[name^="enabled_"]').click(function() {
		if ($(this).is(':checked')) {
			$(this).next('span').removeClass('notset');
			$(this).next('span').next('span.field').children().removeAttr('disabled');
		} else {
			$(this).next('span').addClass('notset');
			$(this).next('span').next('span.field').children().attr('disabled','disabled');

			var key = $(this).attr('name').replace(/^enabled_/,'');
			var field = $(this).next('span').next('span.field');

			if ($(this).next('span').hasClass('notsetorig')) {
				$.ajax({
					'type': 'GET',
					'url': baseUrl+'/settings/reloadField?key='+key+'&module='+OE_settings_module,
					'success': function(html) {
						field.html(html);
					}
				});
			}
		}
	});
});
