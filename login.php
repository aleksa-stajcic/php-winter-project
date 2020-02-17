<?php 

session_start();
require_once "app/config/database.php";
require_once "app/Models/DB.php";
$db = new DB();

http_response_code(200);

if (isset($_SESSION['user'])) {
	header("Location: " . SELF);
} else {
	if (isset($_POST['btnLogin'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$msg = "";
	
	try {
		$user = $db->execute_select_one('SELECT * FROM users WHERE username = ? AND password = ?', [$username, $password]);

		if($user){
			// $msg = "Successfully logged in";
			$_SESSION['user'] = $user;

		}else{
			http_response_code(404);
			$msg = "User doesnt exist.";
		}

	} catch (\PDOException $ex) {
		$msg = $ex->getMessage();
	}
}
}


include "app/views/shared/head.php";
include "app/views/shared/nav.php";

?>

<!--================login_part Area =================-->
    <section class="login_part section_padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>New to our Shop?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <a href="<?= SELF ?>/register.php" class="btn_3">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                                Please Sign in now</h3>
                            <form class="row contact_form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" novalidate="novalidate" autocomplete="off">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="username" name="username" value=""
                                        placeholder="Username">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value=""
                                        placeholder="Password">
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" value="submit" class="btn_3" name="btnLogin" id="btnLogin">
                                        log in
                                    </button>
                                    <a class="lost_pass" href="#">forget password?</a>
                                </div>
                            </form>
							<?php if(isset($msg)): ?>
								<p><?= $msg ?></p>
							<?php endif; ?>
							<!-- <div id="error-msg"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->

<?php include "app/views/shared/footer.php";