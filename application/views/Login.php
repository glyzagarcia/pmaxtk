<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PMAXGlobal | TimeKeeper</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url('');?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url('');?>assets/other/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('');?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('');?>assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <!-- <a href="../../index2.html"> --><img src="<?php echo base_url('');?>assets/dist/img/Logo-Header-Trans.png" width="330px"><br><b>Time</b>Keeper <!--</a> -->
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your shift</p>
        <?php echo form_open('User_Authentication/sign_in'); ?>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="IDnumber"  placeholder="ID Number (must be 4 digits)" maxlength=4 />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="Password" placeholder="Password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div> -->                       
            </div><!-- /.col -->
            <div class="col-xs-4">
              <center><button type="submit" class="btn btn-primary btn-block btn-flat" onClick="">SIGN IN</button></center>
            </div><!-- /.col -->
          </div>
        <?php echo form_close(); ?>
      <!-- 
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->
        <br>
        <center><h3><bold>WORK IN PROGRESS</bold></h3></center><br>
        <i>Working out the kinks :)</i> 

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('');?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('');?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('');?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      var  modal = document.getElementById('successModal');
      //function NewWindow(){
      //window.open('http://10.1.241.40/TimeInMotionBETA/User_Authentication/sign_in', '_blank','status=0,toolbar=0,menubar=0,fullscreen=1,height=100000,width=100000,resizable=0,location=0,titlebar=0');
    //}
      //$(document).ready(function(){
        //$('#successModalContinueButton').click(function(){
        //modal.style.display = 'none';
        //  });
      //});
    </script>

  </body>
</html>