$(document).ready(function () {
	// alert("tu");
	$('.delete-user').click(function () {
		var id = $(this).data('id');
		alert(id)
		$.ajax({
			method: 'post',
			url: 'http://localhost/php-winter-project/admin/views/users/delete.php',
			dataType: 'json',
			data: {
				id: id
			},
			success: function (data) {
				alert("Korisnik uspesno obrisan.");
				setTimeout(
					function () {
						location.reload();
					}, 0001);
			},
			error: function (xhr, statusTxt, error) {
				var status = xhr.status;
				switch (status) {
					case 500:
						alert("Greska na serveru. Trenutno nije moguce izbrisati korisnika.");
						break;
					case 404:
						alert("Stranica nije pronadjena.");
						break;
					default:
						alert("Greska: " + status + " - " + statusTxt);
						break;
				}
			}
		});

	});

	$('.delete-product').click(function () {
		var id = $(this).data('id');
		alert(id)
		$.ajax({
			method: 'post',
			url: 'http://localhost/php-winter-project/admin/views/products/delete.php',
			data: {
				id: id
			},
			success: function (data) {
				alert("Proizvod uspesno obrisan.");
				console.log(data);

				setTimeout(
					function () {
						location.reload();
					}, 0001);
			},
			error: function (xhr, statusTxt, error) {
				var status = xhr.status;

				switch (status) {
					case 500:
						alert("Greska na serveru. Trenutno nije moguce izbrisati proizvod. - " + statusTxt);
						break;
					case 404:
						alert("Stranica nije pronadjena.");
						break;
					default:
						alert("Greska: " + status + " - " + statusTxt);
						break;
				}
			}
		});
	});
});