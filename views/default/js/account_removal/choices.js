define('account_removal/choices', ['jquery', 'elgg'], function($, elgg) {
	
	$(document).on('submit', '.elgg-form-account-removal-choices', function() {
		
		var type = $(this).find('input[name="type"],select[name="type"]').val();
		
		if (!confirm(elgg.echo('account_removal:forms:user:js:confirm:' + type))) {
			return false;
		}
		
		return undefined;
	});
	
});
