$(document).ready(function(){
	$('.a1').on('click', function(e){
		e.preventDefault();
		let cat_id = $(this).data('id');
		$.ajax({
			url: 'http://localhost/electro/services/js-service/category-link.php',
			type: 'GET',
			data: {cat_id: cat_id},
			success: function(data) {
				$('#tab1').html(data);
			  },
			  error: function (e) {
				console.log('Error', e);
				console.log('Type', e.name);
				console.log('Stack calls', e.stack);
			}
		})
	})
});