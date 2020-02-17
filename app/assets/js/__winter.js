const URL = 'http://localhost/php-winter-project';

$(document).ready(function () {

	$('#btnSignUp').click(function () {

		var rePassword = /^[A-z0-9]{6,20}$/;
		var reUsername = /^[A-z0-9\_]{4,15}$/;
		var reEmail = /^[a-z\.\-\_0-9]+@([a-z]+\.){1,}[a-z]{2,}$/;

		function getData() {
			var formData = {
				"email": $('#email').val(),
				"username": $('#username').val(),
				"password": $('#password').val(),
				"send": "carbon"
			}
			return formData;
		}

		function callAjax(obj) {
			$.ajax({
				url: URL + '/app/modules/register.php',
				method: 'post',
				data: obj,
				dataType: 'json',
				success: function (data, xhr) {
					console.log(data);
					console.log(xhr);
					console.log("uspesno");
					$('#err-msg').html("<h3>User registered successfully.</h3>");
					// $('#err-msg').html("<h4>An activation e-mail has been sent to you.</h4>");
				},
				error: function (xhr, status, error) {
					var msg = "An error occured.";

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
						fillList(errors);
					}
				}
			});
		}

		var errors = [];

		var userData = getData();

		if (!userData['username']) {
			errors.push("Username must be filled in. client")
		} else if (!reUsername.test(userData['username'])) {
			errors.push("Username in the wrong format. client")
		}
		if (!userData['password']) {
			errors.push("Password must be filled in.  client")
		} else if (!rePassword.test(userData['password'])) {
			errors.push("Password in the wrong format. client")
		}
		if (!userData['email']) {
			errors.push("Email must be filled in. client")
		} else if (!reEmail.test(userData['email'])) {
			errors.push("Email in the wrong format. client")
		}

		if (errors.length > 0) {
			fillList(errors);
		} else {
			console.log('OK');
			$('#err-msg').html('');
			callAjax(userData);
		}
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

	function fillList(arr) {
		$('#err-msg').html("")
		$('#err-msg').append('<ul class="unordered-list">')
		for (let index = 0; index < arr.length; index++) {
			const element = arr[index];
			$('#err-msg').append("<li>" + element + "</li>");
		}
		$('#err-msg').append("</ul>")
	}
});