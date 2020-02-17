<!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Category</h4>
                        <ul class="list-unstyled">
						<?php 
							$cats = $db->execute_query("SELECT * FROM categories");
							foreach ($cats as $c):
						?>
                            <li><a href="<?= SELF ?>/?page=products&c=<?= $c->id ?>"><?= $c->name ?></a></li>
						<?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Brands</h4>
                        <ul class="list-unstyled">
						<?php 
							$brands = $db->execute_query("SELECT * FROM brands");
							foreach ($brands as $b):
						?>
                            <li><a href="<?= SELF ?>/?page=products&c=<?= $b->id ?>"><?= $b->name ?></a></li>
						<?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="copyright_text">
                        <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
    <script src="app/assets/js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="app/assets/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="app/assets/js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="app/assets/js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="app/assets/js/swiper.min.js"></script>
    <!-- swiper js -->
	<script src="app/assets/js/mixitup.min.js"></script>
	<script src="app/assets/js/price_rangs.js"></script>
	<script src="app/assets/js/lightslider.min.js"></script>
    <!-- particles js -->
    <script src="app/assets/js/owl.carousel.min.js"></script>
    <script src="app/assets/js/jquery.nice-select.min.js"></script>
    <!-- slick js -->
    <script src="app/assets/js/slick.min.js"></script>
    <script src="app/assets/js/jquery.counterup.min.js"></script>
    <script src="app/assets/js/waypoints.min.js"></script>
    <script src="app/assets/js/contact.js"></script>
    <script src="app/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="app/assets/js/jquery.form.js"></script>
    <script src="app/assets/js/jquery.validate.min.js"></script>
    <script src="app/assets/js/mail-script.js"></script>
    <!-- custom js -->
    <script src="app/assets/js/custom.js"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
    <script src="app/assets/js/__winter.js"></script>
</body>

</html>