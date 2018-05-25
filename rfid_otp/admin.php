<?php
include_once 'register.inc.php';
include_once 'functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/pos.png" type="image/png">

  <title>Login</title>

  <link href="css/style.default.css" rel="stylesheet">
  <script type="text/JavaScript" src="js/sha512.js"></script>
  <script type="text/JavaScript" src="js/forms.js"></script>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    <div class="signinpanel">

        <div class="row">

            <div class="col-md-7">

                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> RFID OTP <span>]</span></h1>
                    </div><!-- logopanel -->

                    <div class="mb20"></div>

                    <h5><strong>Selamat Datang!</strong></h5>
                    <div class="mb20"></div>
                <!--    <strong>Not a member? <a href="signup.html">Sign Up</a></strong> -->
                </div><!-- signin0-info -->

            </div><!-- col-sm-7 -->

            <div class="col-md-5">

                 <form id="loginform" role="form" action="process_login.php" method="post" name="login_form">
                    <h4 class="nomargin">Masuk</h4>
                    <p class="mt5 mb20">Untuk mengakses halaman input data.</p>

                    <input type="email" name="email" placeholder="Email" class="form-control uname"/>
                    <input type="password" name="password" class="form-control pword" placeholder="Password" />
                    <a href="#"><small>Lupa Password?</small></a>
 <input type="submit" id="login-btn" class="btn btn-success btn-block" value="Login" onclick="formhash(this.form, this.form.password);"/>
                </form>
            </div><!-- col-sm-5 -->

        </div><!-- row -->

        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2018. All Rights Reserved. RFID OTP
            </div>
        </div>

    </div><!-- signin -->

</section>


<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/retina.min.js"></script>

<script src="js/custom.js"></script>

</body>
</html>
