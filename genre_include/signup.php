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
 <!-- Signup Section Begin -->
 <section class="signup spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Sign Up</h3>
                        <form action="../auth/auth_user.php" method="POST" role="form">
                            <div class="input__item">
                               <input type="text" required name="name" placeholder="Name"class="form-control">
                               <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input type="number" required name="phone" placeholder="Phone number" class="form-control">
                                <span class="icon_phone"></span>
                            </div>
                            <div class="input__item">
                                <input type="email" required name="email" placeholder="Email" class="form-control">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" required name="password" placeholder="Password"class="form-control">
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" required name="cpassword" placeholder="Confirm password" class="form-control">   
                                <span class="icon_lock"></span>
                            </div>
                            <div class="form-check form-check-info text-start ps-0">
                                <input class="form-check-input"  required type="checkbox" value="" id="flexCheckDefault" checked>
                                <label class="form-check-label text-primary font-weight-bolder" for="flexCheckDefault">
                                    I agree the <a href="javascript:;" class="text-white font-weight-bolder">Terms and Conditions</a>
                                </label>
                            </div>
                            <button type="submit" name="register_btn" class="site-btn">Sign Up Now</button>
                        </form>
                        <h5>Already have an account? <a href="#">Log In!</a></h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__social__links">
                        <h3>Login With:</h3>
                        <ul>
                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Sign in With Facebook</a>
                            </li>
                            <li><a href="#" class="google"><i class="fa fa-google"></i> Sign in With Google</a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Sign in With Twitter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup Section End -->
<?php
include('footer.php');
?>