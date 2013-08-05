<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by http://www.MyCollege.org
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MyCollege.org</title>
<?php $this->load->view('common/links'); ?>
<script type="text/javascript" rel="javascript">
    $(function(){
       $('[name=uname]:visible').focus();
    });
</script>
</head>
<body>
<div class="main">
    <div class="login_wrap">
        <div id="powered_by" style="position: absolute; bottom: 0px;right: 0px;background: url('<?php echo base_url();  ?>/css/images/first_fruit.jpg') center left no-repeat; padding:21px 0px 21px 57px;"><b>Powered By First Fruit Consulting.</b></div>
        <div id="login_band">
            <div id="bang_bg"></div>
            <div class="left_part">
                <span id="logo"></span>
            </div>
            <div class="login_form" id="login_form_wrap">
                <form action="<?php echo site_url('login'); ?>" method="POST">
                <div style="margin-top:35px;">
                    <label> Username: </label>
                    <input type="text" value="" name="uname"/>
                </div>
                <div>
                    <label> Password: </label>
                    <input type="password" value="" name="psw"/>
                </div>
                <div>
                    <input type="submit" name="submit" value="Login" id="login_btn"/> <a onclick="document.getElementById('psw_wrap').style.display='block';document.getElementById('login_form_wrap').style.display='none'; " href="javascript:void(0)" style="margin-left:30px;color:#eef1f3;">Forgot Password?</a>
                </div>
                </form>
            </div>
            <div class="login_form" id="psw_wrap" style="display:none;">
                <form action="<?php echo site_url('login/forgot'); ?>" method="POST">
                <div style="margin-top:35px;">
                    <label> Username: </label>
                    <input type="text" value="" name="uname"/>
                </div>
                <div>
                    <input type="submit" name="submit" value="Submit" id="login_btn"/> <a onclick="document.getElementById('login_form_wrap').style.display='block';document.getElementById('psw_wrap').style.display='none'; " href="javascript:void(0)" style="margin-left:30px;color:#eef1f3;">Back to Login?</a>
                </div>
                </form>
            </div>
            <?php if(isset($error_msg)){ ?>
            <?php echo $error_msg; ?>
            <?php } ?>
            <div class="clr"></div>
        </div>
    </div>
  <div class="clr"></div>
</div>
</body>
</html>
