<?php
include ('connect.php');
session_start();
?>
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>Metronic | Login Page 5</title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="assets/css/pages/login/classic/login-5.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="assets/css/themes/layout/header/base/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/header/menu/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/brand/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/aside/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
				<div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(assets/media/bg/bg-2.jpg);">
					<div class="login-form text-center text-white p-7 position-relative overflow-hidden">
						<!--begin::Login Header-->
						<div class="d-flex flex-center mb-15">
							<a href="#">
								<img src="" class="max-h-75px" alt="" />
							</a>
						</div>
						<!--end::Login Header-->
						<!--begin::Login Sign in form-->
						<div class="login-signin">
							<div class="mb-20">
								<h3 class="opacity-40 font-weight-normal">Login to your account</h3>
							</div>
							<form method="POST" action="login.php">
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Username" name="username" autocomplete="off" />
								</div>
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password" placeholder="Password" name="password" />
								</div>
								<div class="form-group text-center mt-10">
									<button name="btn_signin" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Sign In</button>
								</div>
							</form>

                            <?php
                            if (isset($_POST["btn_signin"])) {
                                $username = $_POST["username"];
                                $password = $_POST["password"];
                                $hash = password_hash($password, PASSWORD_DEFAULT);
                                $username = strip_tags($username);
                                $username = addslashes($username);
                                $password = strip_tags($password);
                                $password = addslashes($password);
                                if ($username == "" || $password =="") {
                                    echo "Tên đăng nhập hoặc mật khẩu không được để trống!";
                                }else{
                                    $stmt = $conn->prepare('select * from tblEmployee where username =:username limit 1');
                                    $stmt->bindParam('username', $username);
                                    $stmt->execute();
                                    $count = $stmt->rowCount();
                                    if($count > 0)
                                    {
                                        $result = $stmt->fetch();

                                        //check password
                                        if (password_verify($_POST["password"], $result['password'])) {
                                            $_SESSION["username"] = $_POST["username"];
                                            $_SESSION["role"] = $result['e_role'];

                                            header("location:index.php");
                                        } else {
                                            echo "Mật khẩu không đúng !";
                                        }
                                    }
                                    else{
                                        echo "Tên đăng nhập không đúng !";
                                    }
                                }
                            }
                            ?>
						</div>
						<!--end::Login Sign in form-->
					</div>
				</div>
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
		<script src="assets/js/scripts.bundle.js?v=7.0.5"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/custom/login/login-general.js?v=7.0.5"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>