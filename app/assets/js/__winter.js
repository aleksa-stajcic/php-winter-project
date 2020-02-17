$(document).ready(function () {
	// alert('TU');

	$('#btnSignUp').click(function () {
		var formData = {
			"email": $('#email').val(),
			"username": $('#username').val(),
			"password": $('#password').val(),
			"send": "carbon"
		}

		$.ajax({
			url: 'http://localhost/winter-php2/register?r=1',
			method: 'post',
			data: formData,
			success: function (data, xhr) {
				console.log(data);
				console.log(xhr);
				console.log("uspesno");
				$('#err-msg').html("<h4>An activation e-mail has been sent to you.</h4>");
			},
			error: function (xhr, status, error) {
				// console.log(xhr);
				console.log(xhr.status);
				console.log(status);
				// console.log(xhr.responseText);
				// console.log(xhr['responseText']);
				switch (xhr.status) {
					case 404:
						msg = "Page not found.";
						break;
					case 409:
						msg = "Username or e-mail already exists.";
						break;
					case 422:
						msg = "Invalid information.";
						break;
					case 500:
						msg = "Error.";
						break;
				}
				$('#err-msg').html(msg);
			}
		});

		$('#err-msg').html('');
	})
});