<?php 
	if(!isset($_GET['id'])){
    	header('Location: index.php?page=products');
	}else{
    	$id = $_GET['id'];
	}

	require_once "app/config/database.php";
	require_once "app/Models/DB.php";
	$db = new DB();

	include "app/views/shared/head.php";
	include "app/views/shared/nav.php";

	$product = $db->execute_param_query('SELECT p.*, c.name as category_name FROM products as p JOIN categories as c ON p.category_id = c.id WHERE p.id = ?', [$id])[0];

?>
<!--================Single Product Area =================-->
  <div class="product_image_area section_padding">
    <div class="container">
      <div class="row s_product_inner">
        <div class="col-lg-5">
          <div class="product_slider_img">
            <div id="vertical">
              <div data-thumb="" >
                <img style="width: 350px; height:450px" id="" src="app/assets/<?= $product->image ?>"  />
              </div>
              <!-- <div data-thumb="app/assets/img/product_details/prodect_details_2.png">
                <img src="app/assets/img/product_details/prodect_details_2.png"/>
              </div>
              <div data-thumb="app/assets/img/product_details/prodect_details_3.png">
                <img src="app/assets/img/product_details/prodect_details_3.png" />
              </div>
              <div data-thumb="app/assets/img/product_details/prodect_details_4.png">
                <img src="app/assets/img/product_details/prodect_details_4.png" />
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-lg-5 offset-lg-1">
          <div class="s_product_text">
            <h3><?= $product->name ?></h3>
            <h2>$<?= $product->price ?></h2>
            <ul class="list">
              <li>
                <a class="active" href="#">
                  <span>Category</span> : <?= $product->category_name ?></a>
              </li>
              <li>
                <a href="#"> <span>Availibility</span> : In Stock</a>
              </li>
            </ul>
            <p>
                <?= $product->description ?>
            </p>
            <div class="card_area">
              <div class="product_count d-inline-block">
                <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                <input class="input-number" type="text" value="1" min="0" max="10">
                <span class="number-increment"> <i class="ti-plus"></i></span>
              </div>
              <div class="add_to_cart">
                  <a href="#" class="btn_3">add to cart</a>
                  <a href="#" class="like_us"> <i class="ti-heart"></i> </a>
              </div>
              <div class="social_icon">
                  <a href="#" class="fb"><i class="ti-facebook"></i></a>
                  <a href="#" class="tw"><i class="ti-twitter-alt"></i></a>
                  <a href="#" class="li"><i class="ti-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
  <section class="product_description_area">
    <div class="container">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true">Description</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Specification</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
			<p>
            	<?= $product->description ?>
			</p>
        </div>
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>
                    <h5>Width</h5>
                  </td>
                  <td>
                    <h5><?= $product->width ?> cm</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Height</h5>
                  </td>
                  <td>
                    <h5><?= $product->height ?> cm</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Depth</h5>
                  </td>
                  <td>
                    <h5><?= $product->depth ?> cm</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Weight</h5>
                  </td>
                  <td>
                    <h5><?= $product->weight ?> kg</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Quality checking</h5>
                  </td>
                  <td>
                    <h5>yes</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Freshness Duration</h5>
                  </td>
                  <td>
                    <h5>03days</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>When packeting</h5>
                  </td>
                  <td>
                    <h5>Without touch of hand</h5>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Each Box contains</h5>
                  </td>
                  <td>
                    <h5>60pcs</h5>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Product Description Area =================-->

<?php
include "app/views/shared/footer.php";