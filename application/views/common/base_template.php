<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by http://www.MyCollege.org
-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>MyCollege.org</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>css/images/book.ico" />

        <?php $this->load->view('common/header_links'); ?>

    </head>
    
    <?php $userData = $this->session->userdata('user_details'); // echo '<pre>'; print_r($userData); echo '</pre>';  ?>

    <body class="app">
        <div id="wrap">
            <div class="header animation_setting bounceInDown">
                <div class="logo_inner p_a"></div>
                <div class="p_a app_title">School Management</div>
                <div class="p_a app_interaction">
                    <a class="f_l chat first tf_animation" href="<?php echo site_url('chat'); ?>">Chat</a>
                    <a class="f_l chgpass tf_animation" href="javascript:void(0)" onclick="javascript:change_password();">Change Password</a>
                    
                    <?php if ($userData->users_type_id == 1) { ?>
                        <a class="f_l logged_user tf_animation p_r" href="<?php echo site_url('students/my_record'); ?>"><span class="usr_ico icon p_a"></span><?php echo $userData->username; ?></a>
                    <?php
                        }else if ($userData->users_type_id == 2 || $userData->users_type_id == 3) {
                    ?>
                        <a class="f_l logged_user tf_animation p_r" href="<?php echo site_url('staff/profile'); ?>"><span class="usr_ico icon p_a"></span><?php echo $userData->username; ?></a>
                    <?php } else{ ?>
                        <a class="f_l logged_user tf_animation p_r">
                            <span class="usr_ico icon p_a"></span><?php echo $userData->username; ?>
                        </a>
                    <?php }  ?>
                    
                    <a class="f_l logout last" href="<?php echo site_url('logout'); ?>">logout</a>
                    <div class="c_b"></div>
                </div>
            </div>
            <div class="contentarea p_r">
                <div class="leftNav p_f tf_animation animation_setting bounceInLeft">
                    
                    <?php $this->load->view('common/left_nav'); ?>
                </div>
                <div class="rightNav">
                    <div class="rightNav_head">...</div>
                    <div class="rightNav_cnt">
                        <div id="notofication_wrapper" class="reset_alert">
                            <?php
                                if($this->session->flashdata('error_msg')){     echo showBigError($this->session->flashdata('error_msg'));      }
                                if($this->session->flashdata('info_msg')){      echo showBigInfo($this->session->flashdata('info_msg'));        }
                                if($this->session->flashdata('success_msg')){   echo showBigSuccess($this->session->flashdata('success_msg'));  }
                                if($this->session->flashdata('warning_msg')){   echo showWarning($this->session->flashdata('warning_msg'));  }
                            ?>
                        </div>
                        
                        <div class="article" id="main_content">
                        
                        <?php if (isset($content_page)) {
                            $this->load->view($content_page);
                        } ?>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <div id="footer"></div>    
    </body>
    
    
</html>
