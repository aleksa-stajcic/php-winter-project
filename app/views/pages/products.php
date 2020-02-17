<?php
	if(isset($_GET['c'])){
		$brojac = $db->execute_select_one('SELECT COUNT(*) as broj FROM products as p WHERE p.category_id = ?', [$_GET['c']]);
	}else{
		$brojac = $db->execute_select_one('SELECT COUNT(*) as broj FROM products');
	}
	if(isset($_GET['b'])){
		$brojac = $db->execute_select_one('SELECT COUNT(*) as broj FROM products as p WHERE p.brand_id = ?', [$_GET['b']]);
	}else{
		$brojac = $db->execute_select_one('SELECT COUNT(*) as broj FROM products');
	}
	// $brojac = count($products);
	// var_dump($brojac);
	

	$categories = $db->execute_query('SELECT * FROM categories');
	$brands = $db->execute_query('SELECT * FROM brands');

	if (isset($_GET['c'])) {
		$x = $_GET['c'];
		$category = null;
		$c_id = null;
		foreach ($categories as $c) {
			$category = $c->id == $_GET['c'] ? $c->name : null;
			if($category){
				$c_id = $c->id;
				break;
			}
		}
	}
	if (isset($_GET['b'])) {
		$x = $_GET['b'];
		$brand = null;
		$c_id = null;
		foreach ($brands as $b) {
			$brand = $b->id == $_GET['b'] ? $b->name : null;
			if($brand){
				$c_id = $b->id;
				break;
			}
		}
	}

	$per_page = 6;
	$number_of_links = ceil($brojac->broj/$per_page);
	$number = isset($_GET['number']) ? $_GET['number'] : 1;
	$from = $per_page * ($number - 1);

	if(isset($_GET['c'])){
		$products = $db->execute_param_query('SELECT * FROM products as p WHERE p.category_id = ? LIMIT ' . $from . ', ' . $per_page, [$_GET['c']]);
	}else{
		$products = $db->execute_query('SELECT * FROM products LIMIT ' . $from . ', ' . $per_page);
	}
	if(isset($_GET['b'])){
		$products = $db->execute_param_query('SELECT * FROM products WHERE brand_id = ? LIMIT ' . $from . ', ' . $per_page, [$_GET['b']]);
	}else{
		$products = $db->execute_query('SELECT * FROM products LIMIT ' . $from . ', ' . $per_page);
	}
?>

<!--================Category Product Area =================-->
    <section class="cat_product_area section_padding border_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                            <div class="l_w_title">
                                <h3>Browse Categories </h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
								<?php 
									foreach ($categories as $c):
								?>
                                    <li>
                                        <a href="<?= SELF ?>?page=products&c=<?=  $c->id ?>"><?= $c->name ?></a>
                                    </li>
								<?php
									endforeach;
								?> 
                                </ul>
                            </div>
                        </aside>

                        <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                            <div class="l_w_title">
                                <h3>Browse Brands</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <?php 
									foreach ($brands as $b):
								?>
                                    <li>
                                        <a href="<?= SELF ?>?page=products&b=<?=  $b->id ?>"><?= $b->name ?></a>
                                    </li>
								<?php
									endforeach;
								?> 
                                </ul>
                                <ul class="list">
                                    <li><a href="<?= SELF ?>?page=products">Clear filters</a></li>
                                </ul>
                            </div>
                        </aside>

                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                <div class="single_product_menu product_bar_item">
									<h2><?php 
											if (isset($category)) {
												echo $category;
											}else if(isset($brand)){
												echo $brand;
											}else{
												echo "Products";
											}
										?>
									(<?= $brojac->broj ?>)</h2>
                                </div>
                                <!-- <div class="product_top_bar_iner product_bar_item d-flex">
                                    <div class="product_bar_single">
                                        <select class="wide">
                                            <option data-display="Default sorting">Default sorting</option>
                                            <option value="1">Some option</option>
                                            <option value="2">Another option</option>
                                            <option value="3">Potato</option>
                                        </select>
                                    </div>
                                    <div class="product_bar_single">
                                        <select>
                                            <option data-display="Show 12">Show 12</option>
                                            <option value="1">Show 20</option>
                                            <option value="2">Show 30</option>
                                        </select>
                                    </div>
                                </div> -->
                            </div>
                        </div>
						<?php

						foreach ($products as $p):

						?>
						<!-- Single product -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_category_product">
                                <div class="single_category_img">
                                    <img src="app/assets/<?= $p->image ?>" alt="">
                                    <div class="category_social_icon">
                                        <ul>
                                            <li><a href="#"><i class="ti-heart"></i></a></li>
                                            <li><a href="#"><i class="ti-bag"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="category_product_text">
                                        <a href="<?= SELF ?>/product.php?id=<?= $p->id ?>"><h5><?= $p->name ?></h5></a>
                                        <p>$<?= $p->price ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single product -->

						<?php
						endforeach;
						?>

                        
						
                    </div>
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item">
							<a class="page-link" href="index.php?page=products<?= isset($_GET['c']) ? "&c=". $c_id : "" ?>&number=<?= $number-1 == 0 ? 1 : $number-1  ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
								<span class="sr-only">Previous</span>
							</a>
							</li>
							<?php for($i = 0; $i < $number_of_links; $i++): ?>
								<li class="page-item"><a class="page-link" href="index.php?page=products<?= isset($_GET['c']) ? "&c=". $c_id : "" ?>&number=<?= $i+1?>"><?= $i+1 ?></a></li>
							<?php endfor; ?>
							
							<li class="page-item">
							<a class="page-link" href="index.php?page=products<?= isset($_GET['c']) ? "&c=". $c_id : "" ?>&number=<?= $number+1 > $number_of_links ? $number : $number+1 ?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
								<span class="sr-only">Next</span>
							</a>
							</li>
						</ul>
					</nav>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->