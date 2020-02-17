<?php



if(isset($_GET['page'])){
	switch ($_GET['page']) {
	case 'contact':
	$contact = new ContactController();
	$contact->index();
	break;
	case 'product':
		$product = new ProductController();
		$product->index();
		break;
	case 'home':
	$home = new HomeController();
	$home->index();
	break;
	}
}else{
	$home = new HomeController();
	$home->index();
}