<script src="assets/js/jquery-3.6.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/perfect-scrollbar.min.js"></script>
<script src="assets/js/smooth-scrollbar.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="assets/js/index.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="assets/js/custom.js"></script>
  
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
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
   <style>
        .alertify-notifier .ajs-success {
            color: white;
        }
    </style>    