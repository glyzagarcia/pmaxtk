<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Log in</title>
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
      <!-- <input type=hidden value="<?php echo $password; ?>"/> -->
      <div class="login-logo">
        <!-- <a href="../../index2.html"> -->Password <b>Change</b> <!--</a> -->
      </div><!-- /.login-logo -->
      <div class="login-box-body">

        <p class="login-box-msg">This is your first sign in<br><b>PRESS ENTER AFTER INPUT</b></p>
        <?php echo form_open('User_management/ChangePassword','id="changePasswordform"'); ?>
        
        <input id="thisIDnumber" name="thisIDnumber" type="hidden" value="<?php echo $IDnumber; ?>" />
        <input id="hiddenPassword" name="hiddenPassword" type="hidden" value="<?php echo $password; ?>"/>
        
          <div class="form-group has-feedback">
            <label>Current Password:</label>
            <input type="password" class="form-control" name="CurrentPassword" id="CurrentPassword" placeholder="~Your default password~" >
            <span id="currentPasswordFieldGlyphicon" class="glyphicon glyphicon-edit form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>New Password:</label>
            <input type="password" class="form-control" name="NewPassword" id="ChangedPassword" placeholder="~Input 8 to 30 alphabets/numbers~" maxlength=30  >
            <span id="newPasswordFieldGlyphicon" class="glyphicon glyphicon-edit form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>Confirm Password:</label>
            <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" placeholder="~Must match your new password~" maxlength=30 >
            <span id="confirmPasswordFieldGlyphicon" class="glyphicon glyphicon-edit form-control-feedback"></span>
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
              <button type='submit'  id="CONTINUEbutton" class="btn btn-primary btn-block btn-flat" >CONTINUE</button>
            </div><!-- /.col -->
          </div>
        
        
        <?php echo form_close(); ?>
      <      <!-- 
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <i>Your new password is fixed...</i><br>
        <bold>PLEASE DON'T FORGET IT.</bold>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('');?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('');?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('');?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url('');?>assets/other/passwordChangeJQuery.js" type="text/javascript"></script>
  </body>
  <script>
    var hidden1 = $('#thisIDnumber').val();
    var hidden2 = $('#hiddenPassword').val();
	
	function verifyForm(){
		
		var message = "";
		if($("#CurrentPassword").val() == "")
			message += "Current Password is required";
		if($("#ChangedPassword").val() == "")
			message += "New Password is required";
		if($("#ConfirmPassword").val() == "")
			message += "Confirm Password is required";
		
		if(message != ""){
			alert(message);	
			return false;
		}
		else
			return true;
			// $('#changePasswordform').submit();
		
	}
  </script>
</html>