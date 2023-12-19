<?php
if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "You are already logged in";
    header('Location: ../index.php');
    exit();
}
include('header.php');
?>

<?php
include('./Template/_breadcumb.php');
?>

 <!-- Login Section Begin -->
 <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Login</h3>                        
                        <form action="../auth/auth_user.php" method="POST" role="form">
                            <div class="input__item">
                                <input type="email" required name="email" class="form-control" placeholder="Email">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" required name="password" class="form-control" placeholder="Password">
                                <span class="icon_lock"></span>                               
                            </div>
                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                                <label class="form-check-label mb-0 ms-3 text-white" for="rememberMe">Remember me</label>
                            </div>
                            <button type="submit" name = "login_btn" class="site-btn">Login Now</button>
                        </form>
                        <a href="#" class="forget_pass">Forgot Your Password?</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>Dont’t Have An Account?</h3>
                        <a href="signup.php" class="primary-btn">Register Now</a>
                    </div>
                </div>
            </div>
            <div class="login__social">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="login__social__links">
                            <span>or</span>
                            <ul>
                                <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With
                                Facebook</a></li>
                                <li><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a></li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->
<?php
include('footer.php');
?>