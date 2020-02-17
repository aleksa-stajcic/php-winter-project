<!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-11">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="<?= SELF ?>" > <img src="app/assets/img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="http://localhost/php-winter-project">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= SELF ?>?page=products"> shop</a>
                                </li>
								<?php if(isset($_SESSION['user']) && $_SESSION['user']->role == "admin"): ?>
								<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        admin pages
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                        <a class="dropdown-item" href="<?= SELF ?>/admin/products.php">manage products</a>
                                        <a class="dropdown-item" href="<?= SELF ?>/admin/users.php">manage users</a>
                                    </div>
                                </li>
								<?php endif; ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        account <?= isset($_SESSION['user']) ? '(' . $_SESSION['user']->username .')' : "" ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
									<?php if(!isset($_SESSION['user'])): ?>
                                        <a class="dropdown-item" href="http://localhost/php-winter-project/login.php">login</a>
                                        <a class="dropdown-item" href="http://localhost/php-winter-project?page=register">Register</a>
									<?php else: ?>
										<a class="dropdown-item" href="http://localhost/php-winter-project/logout.php">Logout </a>
                                    <?php endif; ?>
									</div>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="?page=author">Author</a>
                                </li>
								<li class="nav-item">
                                    <a class="nav-link" href="dokumentacija.pdf">Dokumentacija</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->