<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login | School Management system</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>css/images/book.ico" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/facebox.css"/>

    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/cssua.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/facebox.js" language="javascript"></script>

    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/login.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css3-buttons.css" />
    <script type="text/javascript" src="<?php echo base_url();?>js/login.js"></script>
</head>
<body class="app">
	<div id="wrap">
		<div id="band"><!--This adds the background band--></div>
		<div id="login_input">
        	<div class="ivie_nw_lg"></div>
			<div id="app_logo">       <!--This adds the Sams logo-->
			</div>   
            <form action="<?php echo site_url('login'); ?>" name="userlogin" method="POST" id="userlogin" > 
            	
            <div id="login_fail_msg" class="invalid_usr" style=""> 
                <?php if(isset($error_msg)){ ?>
                <?php echo $error_msg; ?>
                <?php } ?> 
            </div>		
            <ul class="login_info">
                <li class="width260">
                    <label for="username">Username:</label>
                    <input type="text" id="username" class="text" name="uname" value="" /> 
                    <!--<div id="username_err_mess" class="error">Please enter Username</div>-->            
                </li>
                <li class="width250">
                      <ul> 
                         <li>
                            <label for="password">Password:</label>
                           <input type="password"  style="width:200px;" id="password" class="text psdwrd" name="psw" value="" />
                     		<!--<div id="password_err_mess" class="error">Please Enter Password...</div>-->
                         </li>
                         <li class="frgot_sd">
                            <a href="#log" class="forgot" rel="facebox" id="forgot_password">Forgot Password?</a>
                        </li>
                      </ul>
                </li>
                <li class="btn_aln">
                    <a id="login_bt" href="#" class="button green">Login</a>
                    <img src="css/images/login_spinner.gif" class="loginspin hide" id="login_spinner"/>
                </li>
            </ul>
            </form>		
        </div>
        
        <div style="display:none"> <!--Start@@code for Facebox -->
            <div id="log">
            	<div id="pwd_msg" style="display:block">Please enter your Username, we'll send your login details to your Email.</div>
            	<br/>
                <form action="<?php echo site_url('login/forgot'); ?>" method="POST" class="forgot_psw_form">
                <!--<div class="err response_msg" >Please Enter the UserName</div>-->
                <ul class="forg_pass" style="padding-top:10px; border-top:1px dotted #eee;">
                    <li><label class="usr_lbl">Username:</label><input type="text" name="uname" class="fac_inp"  /></li>
                    <li class="log_fbbut"><input name="submit" type="submit" class="loginbtn" value=" Submit " /></li>
                </ul>
                </form>
            </div>
        </div><!--End@@code for Facebox -->

	</div>    
    <div id="footer"></div>    
</body>
<script type="text/javascript">
    $(document).ready(function(){
    	$("#username").focus();
    	//validation plugin facebox is used here for validations
    	jQuery('a[rel*=facebox]').facebox();
        $(document).bind('reveal.facebox', function() { 
            $('.forgot_psw_form:last').validate({
                rules:{
                    uname:{
                        required:true
                    }
                },
                messages:{
                    uname:{
                        required:'Please enter your username'
                    }
                }
            });
        });
    });
</script>
</html>