</div>
<footer class="iq-bg-dark">
    <div class="footer-top">
      <div class="container-fluid">
        <div class="row footer-standard">
          <div class="col-lg-5">
            <div class="widget text-left">
              <div>
                <ul class="menu p-0">
                  <li><a href="#">Terms of Use</a></li>
                  <li><a href="#">Privacy-Policy</a></li>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">Watch List</a></li>
                </ul>
              </div>
            </div>
            <div class="widget text-left">
              <div class="textwidget">
                <p><small>This is Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, quo tempore. Quasi rem rerum est in nulla atque quibusdam illo. this is footer and simple tsesxij is writen jkd. fsek hello how are you. please like and subscribe. footer ends .</small></p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <h6 class="footer-link-title">
              Follow Us:
            </h6>
            <ul class="info-share">
              <li>
                <a href="#">
                  <i>
                  <fa class="fa fa-facebook"></fa>
                </a>
              </li>
              <li>
                <a href="#">
                  <i>
                  <fa class="fa fa-youtube"></fa>
                </a>
              </li>
              <li>
                <a href="#">
                  <i>
                  <fa class="fa fa-instagram"></fa>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <div class="widget text-left">
              <div class="textwidget">
                <h6 class="footer-link-title">
                <a href="index.html" class="navbar-brand">
                <img src="images/logo-no-background.png" class="img-fluid logo" alt="" />
                </a>
                </h6>
                <div class="d-flex align-items-center">
                  <a href="#"><img src="images/footer/01.jpg" alt=""></a>
                  <br>
                  <a href="#" class="ml-3"><img src="images/footer/02.jpg" alt=""></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- js files  -->
  <script src="./user_assets/js/jquery-3.4.1.min.js"></script>
  <script src="./user_assets/js/popper.min.js"></script>
  <script src="./user_assets/js/bootstrap.min.js"></script>
  <script src="./user_assets/js/slick.min.js"></script>
  <script src="./user_assets/js/owl.carousel.min.js"></script>
  <script src="./user_assets/js/select2.min.js"></script>
  <script src="./user_assets/js/jquery.magnific-popup.min.js"></script>
  <script src="./user_assets/js/slick-animation.min.js"></script>
  <script src="./user_assets/main.js"></script>


  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <script>
    alertify.set('notifier','position', 'top-right');
    <?php 
    if(isset($_SESSION['message'])) 
    {
      ?>        
        alertify.success('<?= $_SESSION['message'] ?>');
      <?php
        unset($_SESSION['message']);
    } 
   ?>
  </script>
</body>

</html>