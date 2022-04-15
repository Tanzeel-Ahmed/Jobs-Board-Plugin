jQuery(document).ready(function(){
	jQuery("#application-export-button").click(function(){
		var data = {
			'action': 'export_all_posts',
		};
		jQuery.post(
			ajaxurl, 
			data, 
			function(response) {
			console.log(response);
			window.open(response);
			return false;
		});
	})
})