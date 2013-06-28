$(document).ready(function() {
	$('a.StringListRemove').die('click').live('click',function(e) {
		e.preventDefault();
		$(this).parent().remove();
	});

	$('button.StringListAdd').die('click').live('click',function(e) {
		e.preventDefault();

		var text = $(this).prev('input').val();

		if (text.length <1) return;

		var alreadyInList = false;

		$(this).parent().parent().children('li').children('input[type="hidden"]').map(function() {
			if ($(this).val() == text) {
				alert("The entered string is already in the list.");
				alreadyInList = true;
				return;
			}
		});

		if (!alreadyInList) {
			var field = $(this).parent().parent().prev('input').attr('name');
			var newItem = "<li>"+text+" (<a href=\"#\" class=\"StringListRemove\">remove</a>)<input type=\"hidden\" value=\""+text+"\" name=\""+field+"[]\" /></li>";

			$(this).parent().before(newItem);
			$(this).prev('input').val('');
			$(this).prev('input').focus();
		}
	});

	$('input.StringListAddText').die('keypress').live('keypress',function(e) {
		if (e.keyCode == 13) {
			$(this).next('button').click();
			return false;
		}

		return true;
	});
});
