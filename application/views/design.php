<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Login | School Management system</title>
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
                    <a class="f_l logged_user tf_animation p_r">
                        <span class="usr_ico icon p_a tf_animation"></span>Admin
                    </a>
                    <a class="f_l logout last">logout</a>
                    <div class="c_b"></div>
                </div>
            </div>
            <div class="contentarea p_r">
                <div class="leftNav p_f tf_animation animation_setting bounceInLeft">
                    <ul class="nav_emt">
                        <li><a href="" class="active">Home</a></li>
                        <li><a href="">Student Data</a></li>
                        <li><a href="">User Accounts</a></li>
                        <li><a href="">College Updates</a></li>
                        <li><a href="">Polls</a></li>
                        <li><a href="" class="collapse">College Administration</a></li>
                        <ul class="lft_sub_menu">
                            <li>
                               <a href=""> College management </a>
                            </li>
                            <li>
                                <a href=""> Course management </a>
                            </li>
                            <li>
                                <a href=""> Branch management </a>
                            </li>
                            <li>
                                <a href=""> Semester management </a>
                            </li>
                            <li>
                                <a href=""> Subject management </a>
                            </li>
                            <li>
                                <a href=""> Period Cycle management </a>
                            </li>
                            <li>
                                <a href=""> Attendance management </a>
                            </li>
                            <li>
                                <a href=""> Teaching Years </a>
                            </li>
                            <li>
                                <a href=""> Section management </a>
                            </li>
                            <li>
                                <a href=""> Batch No management </a>
                            </li>
                            <li>
                                <a href=""> Calendar Items </a>
                            </li>
                            <li>
                               <a href=""> Academic Calendar </a>
                            </li>
                            <li>
                               <a href=""> Send Message </a>
                            </li>
                        </ul>
                        <li><a href="">Email</a></li>

                    </ul>
                </div>
                <div class="rightNav">
                    <div class="rightNav_head">Header</div>
                    <div class="rightNav_cnt">
                        
                        <div class="alert_info">A Warning Alert</div>
                        <div class="alert_warning">A Warning Alert</div>
                        <div class="alert_error">An Error Message</div>
                        <div class="alert_success">A Success Message</div>

                        <br />

                        <table class="table_view">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Savings</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>January</td>
                                <td>$100</td>
                            </tr>
                        </table>

                         <br />

                         <a class="button grey">Grey</a>
                         <a class="button red">red</a>
                         <a class="button blue">blue</a>
                         <a class="button green">green</a>
                         <a class="button black">black</a>
                         <a class="button yellow">yellow</a>
                         <a class="button purple">purple</a>
                         <a class="button gblue">gblue</a>


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