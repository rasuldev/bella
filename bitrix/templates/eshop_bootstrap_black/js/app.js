$('#registr_form form').submit(function(e){

	e.preventDefault();
	var form = $(this);
	var data = {
		name: form.find('[name="REGISTER[NAME]"]').val(),
		email: form.find('[name="REGISTER[EMAIL]"]').val(),
		password: form.find('[name="REGISTER[PASSWORD]"]').val(),
		confirm_password: form.find('[name="REGISTER[CONFIRM_PASSWORD]"]').val()
	};

	$.ajax({
		url: "/auth/confirm.php",
		type: "POST",
		datatype: "json",
		data: data,
		success: function(response){
			response = JSON.parse(response);
			if (response.TYPE == 'ERROR')
			{
				form.children('.alert').remove();
				form.prepend('<div class="alert alert-danger" role="alert">'+response.MESSAGE+'</div>');
			}
			if (response.TYPE == 'OK')
			{
				form.html('<div class="alert alert-success" role="alert">'+response.MESSAGE+'</div>');
			}
		}
	});
});

$('#auth_form form').submit(function(e){
	e.preventDefault();
	var form = $(this);
	var data = {
		email: form.find('[name="email"]').val(),
		password: form.find('[name="password"]').val()
	};

	$.ajax({
		url: "/auth/login.php",
		type: "POST",
		datatype: "json",
		data: data,
		success: function(response)
		{
			response = JSON.parse(response);
			if (response.TYPE == 'ERROR')
			{
				form.children('.alert').remove();
				form.prepend('<div class="alert alert-danger" role="alert">'+response.MESSAGE+'</div>');
			}

			if (response === true)
			{
				location.href = '/cabinet/';
			}
		}
	});
});

$('.js_buy').click(function(){
	var id = $(this).data('id');
	$.ajax({
		type: 'post',
		url: '/catalog/add.php',
		data: {id: id},
		success: function(data)
		{
			var count = parseInt($('.js-basket-count').val())+1;
			$('.js-basket-count').val(count);
		}
	});
	return false;
});

$('.js_submit').click(function(e){
	e.preventDefault();
	$(this).closest('form').submit();
});