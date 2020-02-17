const URL = 'http://localhost/php-winter-project';

$(document).ready(function () {
	// alert('TU');

	$('#btnSignUp').click(function () {
		var formData = {
			"email": $('#email').val(),
			"username": $('#username').val(),
			"password": $('#password').val(),
			"send": "carbon"
		}

		var msg = "";
		var errors = new Array();

		$.ajax({
			url: URL + '/app/modules/register.php',
			method: 'post',
			data: formData,
			dataType: 'json',
			success: function (data, xhr) {
				console.log(data);
				console.log(xhr);
				console.log("uspesno");
				$('#err-msg').html("<h4>An activation e-mail has been sent to you.</h4>");
			},
			error: function (xhr, status, error) {
				// console.log(xhr);
				console.log(xhr.status + " " + xhr.statusText);
				console.log(status);
				msg = "An error occured.";
				console.log(xhr['responseText']);

				if (isJson(xhr['responseText'])) {
					errors = JSON.parse(xhr['responseText']);
				}

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
				if (errors.length > 0) {
					$('#err-msg').append("<ul>")
					for (let index = 0; index < errors.length; index++) {
						const element = errors[index];
						$('#err-msg').append("<li>" + element + "</li>");
					}
					$('#err-msg').append("</ul>")
				}
			}
		});

		$('#err-msg').html('');
	})

	function isJson(item) {
		item = typeof item !== "string"
			? JSON.stringify(item)
			: item;

		try {
			item = JSON.parse(item);
		} catch (e) {
			return false;
		}

		if (typeof item === "object" && item !== null) {
			return true;
		}

		return false;
	}


});