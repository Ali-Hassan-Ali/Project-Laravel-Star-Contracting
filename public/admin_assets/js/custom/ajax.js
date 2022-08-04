$(document).ready(function() {

	$(document).on('change', '#equipment-countrey', function(e) {
		e.preventDefault();
		
		var url    = $(this).find(':selected').data('url');
		var method = 'post';
		
		$.ajax({
			url: url,
			method: method,
			success: function (data) {
				
				$('#equipment-city').empty('');

				$.each(data, function(index,item) {

                    var html = `<option value="${item.id}">${item.name}</option>`;

                    $('#equipment-city').append(html);

                });//end of each

			}//end of success
		});

	});//end of countrey

	$(document).on('change', '#equipment-city', function(e) {
		e.preventDefault();
		
		var id     = $(this).find(':selected').val();
		var url    = "/admin/ajax/city/"+id;
		var method = 'post';
		
		$.ajax({
			url: url,
			method: method,
			success: function (data) {

				console.log(data);
				
				$('#equipment-man').empty('');

				$.each(data, function(index,item) {

                    var html = `<option value="${item.id}">${item.name}</option>`;

                    $('#equipment-man').append(html);

                });//end of each

			}//end of success
		});

	});//end of countrey
	
});//end of redy function