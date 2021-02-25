<html lang="en" class="perfect-scrollbar-off">
  <head>
    <?php
      include './functions/dbconn.php';
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport">
    <link href="assets/css/material-icons.css" rel="stylesheet" >
    <link href="assets/css/material-dashboard.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-select.min.css">
    <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
      <script src="assets/js/custom.js" type="text/javascript" ></script>
    <script src="assets/js/plugins/bootstrap-notify.js"></script>
    <?php
      date_default_timezone_set("Asia/Kolkata");
      ?>
  </head>
  <body class="off-canvas-sidebar" cz-shortcut-listen="true">        
    <div class="wrapper wrapper-full-page">
      <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('assets/img/login.jpg'); background-size: cover; background-position: top center;">
          <div class="container">
            <div class="col-lg-4 col-md-6 col-sm-6 ml-auto mr-auto">
              <form class="form" method="POST" action="login_verify.php">
                <div class="card card-login">
                  <div class="card-header card-header-rose text-center">
                    <h3 class="card-title"> Login </h3>
                    <div class="social-line">
                        <i class="material-icons md-36" style="margin-left: 38px;">fingerprints</i>
                    </div>
                  </div>
                  <div class="card-body ">
                    <p class="card-description text-center">Or Be Classical</p>
                    <span class="bmd-form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">face</i>
                          </span>
                        </div>
                        <input type="text" name="name" class="form-control" autofocus="" required="" placeholder="Username">
                      </div>
                    </span>
                    <span class="bmd-form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">lock_outline</i>
                          </span>
                        </div>
                        <input type="password" name="pass" class="form-control" required="" placeholder="Password">
                      </div>
                    </span>
                    <span class="bmd-form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">my_location</i>
                          </span>
                        </div>
                       <select name="loc" required="" class="selectpicker" data-style="select-with-transition" title="Select Location">
                        <?php
                          $query = "SELECT * FROM loc";
                          $res = mysqli_query($conn, $query) or die("Invalid Query:".mysqli_error());
                          while($row=mysqli_fetch_array($res)){
                            echo "<option>".$row['1']."</option>";
                          }
                        ?>
                        <option value="Master">Master</option>
                       </select> 
                      </div>
                    </span>
                  </div>
                  <div class="card-footer justify-content-center">
                    <input type="submit" value="Login" name="submit" class="btn btn-rose btn-link btn-lg">
                  </div>
                </div>
              </form>
              <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_GffqOJ4TsFX8hN" async> </script> </form>
            </div>
          </div>
          <footer class="footer">
            <div class="container">
              <nav class="float-left footer-menu">
                <ul>
                  <li>
                    <a href="https://github.com/omkar2403/inout/">In Out System</a>
                  </li>
                  <li>
                    <a href="https://www.koha-community.org/">Powered By KOHA Community</a>
                  </li>
                </ul>
              </nav>
              <div class="copyright float-right">©
                <script>document.write(new Date().getFullYear())</script>, made with <i class="material-icons">favorite</i> by
                  <a href="https://omkar2403.github.io/its_me/" target="_blank">Omkar Kakeru</a> for a better web.
              </div>
            </div>
          </footer>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
    <script src="assets/js/material-dashboard.min.js?v=2.0.2" type="text/javascript"></script>
    <?php
    if($_GET['msg']==1){
      echo "<script type='text/javascript'>showNotification('top','right','Wrong Username/Password.', 'danger');</script>";
    }
    if($_GET['msg']==2){
      echo "<script type='text/javascript'>showNotification('top','right','Successfully Logout.', 'info');</script>";
    }
    if($_GET['msg']==3){
      echo "<script type='text/javascript'>showNotification('top','right','User Deactivated. Contact Administrator.', 'warning');</script>";
    }
    ?>
    
  </body>
</html>