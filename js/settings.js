$(document).ready(function() {
	$('#settings input[name^="enabled_"]').click(function() {
		if ($(this).is(':checked')) {
			$(this).next('span').removeClass('notset');
			$(this).next('span').next('span.field').children().removeAttr('disabled');
			var ml = $(this).next('span').next('span.field').children('div.MultiSelectList');
			if (ml.length >0) {
				ml.children('select').removeAttr('disabled');
				ml.children('div.MultiSelectListBasic').children('ul').removeAttr('disabled');
				ml.children('div.MultiSelectListBasic').children('ul').children('li').children('a').removeAttr('disabled');
			}
		} else {
			$(this).next('span').addClass('notset');
			$(this).next('span').next('span.field').children().attr('disabled','disabled');
			var ml = $(this).next('span').next('span.field').children('div.MultiSelectList');
			if (ml.length >0) {
				ml.children('select').attr('disabled','disabled');
				ml.children('div.MultiSelectListBasic').children('ul').attr('disabled','disabled');
				ml.children('div.MultiSelectListBasic').children('ul').children('li').children('a').attr('disabled','disabled');
			}

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

	handleButton($('#et_save'),function(e) {
		e.preventDefault();
		$('#settings').submit();
	});
});
