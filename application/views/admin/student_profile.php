<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Student Data | School Management system</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>css/images/book.ico" />
        <?php $this->load->view('common/header_links'); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/layout.css?ga" />
    </head>
    <body class="app">
        <div id="wrap">
            <div class="header animation_setting bounceInDown">
                <div class="logo_inner p_a"></div>
                <div class="p_a app_title">School Management</div>
                <div class="p_a app_interaction">
                    <a class="f_l chat first tf_animation">Chat</a>
                    <a class="f_l chgpass tf_animation">Change Password</a>
                    <a class="f_l logged_user tf_animation">Admin</a>
                    <a class="f_l logout last">logout</a>
                </div>
            </div>
            <div class="contentarea p_r">
                <div class="leftNav p_f tf_animation animation_setting bounceInLeft">
                    
                    <?php $this->load->view('common/left_nav'); ?>
                </div>
                <div class="rightNav">
                    <div class="rightNav_head">Header</div>
                    <div class="rightNav_cnt">
                        
                        
                        
                        <form id="appl_form" action="/admin/student_data">
                            <input id="" name="rel" class="text" type="hidden" value="check_stu_prof"/>
                            <ol>
                                <li>
                                    <label for="number">Student Number:* </label>
                                    <input id="number" name="number" class="text"/>
                                </li>
                                <li>
                                        OR
                                        <br/>
                                    <div class="clearboth"></div>
                                </li>
                                <li>
                                    <label for="name">Student Name:* </label>
                                    <input id="name" name="name" class="text"/>
                                </li>
                                <li>
                                    <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit button gblue" value="Give In" />
                                    <div class="clr"></div>
                                </li>
                            </ol>
                        </form>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>    
        <div id="footer"></div>    
    </body>
    <script type="text/javascript">

        $(document).ready(function(){

        });

    </script>
</html>