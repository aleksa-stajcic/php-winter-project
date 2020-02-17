<?php
	if(isset($_GET['c'])){
		$products = $db->execute_param_query('SELECT * FROM products as p WHERE p.category_id = ?', [$_GET['c']]);
	}else{
		$products = $db->execute_query('SELECT * FROM products');
	}

	$categories = $db->execute_query('SELECT * FROM categories');
	$brands = $db->execute_query('SELECT * FROM brands');

	if (isset($_GET['c'])) {
		$x = $_GET['c'];
		$category = null;
		foreach ($categories as $c) {
			$category = $c->id == $_GET['c'] ? $c->name : null;
			if($category)
				break;
		}
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
                                        <a href="index.php?page=products&c=<?=  $c->id ?>"><?= $c->name ?></a>
                                    </li>
								<?php
									endforeach;
								?> 
                                </ul>
                            </div>
                        </aside>

                        <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                            <div class="l_w_title">
                                <h3>Product filters</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <p>Brands</p>
                                    <?php 
									foreach ($brands as $b):
								?>
                                    <li>
                                        <input type="radio" name="rbnBrands" aria-label="Radio button for following text input">
                                        <a href="#"><?= $b->name ?></a>
                                    </li>
								<?php
									endforeach;
								?> 
                                </ul>
                                <ul class="list">
                                    <p>color</p>
                                    <li>
                                        <input type="radio" aria-label="Radio button for following text input">
                                        <a href="#">Black</a>
                                    </li>
                                    <li>
                                        <input type="radio" aria-label="Radio button for following text input">
                                        <a href="#">Black Leather</a>
                                    </li>
                                    <li>
                                        <input type="radio" aria-label="Radio button for following text input">
                                        <a href="#">Black with red</a>
                                    </li>
                                    <li>
                                        <input type="radio" aria-label="Radio button for following text input">
                                        <a href="#">Gold</a>
                                    </li>
                                    <li>
                                        <input type="radio" aria-label="Radio button for following text input">
                                        <a href="#">Spacegrey</a>
                                    </li>
                                </ul>
                            </div>
                        </aside>

                        <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow">
                            <div class="l_w_title">
                                <h3>Price Filter</h3>
                            </div>
                            <div class="widgets_inner">
                                <div class="range_item">
                                    <!-- <div id="slider-range"></div> -->
                                    <input type="text" class="js-range-slider" value="" />
                                    <div class="d-flex align-items-center">
                                        <div class="price_text">
                                            <p>Price :</p>
                                        </div>
                                        <div class="price_value d-flex justify-content-center">
                                            <input type="text" class="js-input-from" id="amount" readonly />
                                            <span>to</span>
                                            <!-- <input type="text" class="js-input-to" id="amount" readonly /> -->
                                        </div>
                                    </div>
                                </div>
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
											}else{
												echo "Products";
											}
										?>
									(<?= count($products) ?>)</h2>
                                </div>
                                <div class="product_top_bar_iner product_bar_item d-flex">
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
                                </div>
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

                        <div class="col-lg-12 text-center">
                            <a href="#" class="btn_2">More Items</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->