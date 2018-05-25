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
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">
  <script type="text/JavaScript" src="js/sha512.js"></script> 
  <script type="text/JavaScript" src="js/forms.js"></script> 
  <title>Daftar Admin</title>

  <link href="css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">
<?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
?> 
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
    <div class="signuppanel">
        
        <div class="row">
            
            <div class="col-md-6">           
                <div class="signup-info">
                    <div class="logopanel">
                        <h1><span>[</span> Pendaftaran admin <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>Silahkan melakukan pendaftaran admin</strong></h5>
                
                </div><!-- signup-info -->
            
            </div><!-- col-sm-6 -->
            
            <div class="col-md-6">
                
              		<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form"> 
                    
                    <h3 class="nomargin">Daftar</h3>
                    <p class="mt5 mb20">Sudah terdaftar? <a href="admin.php"><strong>Masuk</strong></a></p>
                                 
                    <div class="mb10">
                        <label class="control-label">Nama pengguna</label>
                        <input type="text" class="form-control" name='username'  id='username' placeholder="Nama pengguna"/>
                    </div>                  
                    
                    <div class="mb10">
                        <label class="control-label">Alamat email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="email"/>
                    </div>
                    
                    <div class="mb10">
                        <label class="control-label">Kata sandi</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Kata sandi"/>
                    </div>
                    
                    <div class="mb10">
                        <label class="control-label">Ketik ulang kata sandi</label>
                        <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" placeholder="Ketik ulang kata sandi"/>
                    </div>
                        
					<input class="btn btn-success btn-block" type="submit" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email,this.form.password, this.form.confirmpwd);" />
                </form>
            </div><!-- col-sm-6 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2018. All Rights Reserved. RFID OTP
            </div>
        </div>
        
    </div><!-- signuppanel -->
  
</section>


<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/retina.min.js"></script>

<script src="js/chosen.jquery.min.js"></script>

<script src="js/custom.js"></script>
<script>
    jQuery(document).ready(function(){
        
        // Chosen Select
        jQuery(".chosen-select").chosen({
            'width':'100%',
            'white-space':'nowrap',
            disable_search_threshold: 10
        });
        
    });
</script>

</body>
</html>
