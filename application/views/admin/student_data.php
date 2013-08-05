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
                    <a class="f_l logged_user tf_animation">Admin</a>
                    <a class="f_l logout last">logout</a>
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
                        
                        
                        
                        <form action="/students/conduct_certificate" id="appl_form" suc_msg="Submited Successfully." err_msg="">
                            <input id="" name="rel" class="text" type="hidden" value="add_stu_details"/>
                            <div align="right" style="position: relative;">
                                <img src="pic/logo.png" id="photo" width="100" height="100" align="center" title="pic" style="position: absolute; top:0px; right:-20px;"/>
                                <div class="clr"></div>
                            </div>
                            <ol><li>
            
                                    <label for="name">Student Name:*</label>
                                    <input id="name" name="name" class="text"/>
                                </li><li>
                                    <label for="student_number">Student Number:* </label>
                                    <input id="student_number" name="student_number" class="text"/>
                                </li><li>
                                    <label for="uname">User Name:* </label>
                                    <input id="uname" name="uname" class="text"/>
                                </li><li>
                                    <label for="pwd"> Password:* </label>
                                    <input type="password" id="pwd" name="pwd" class="text"/>
                                </li><li>
                                    <label for="fname">Father Name: </label>
                                    <input id="fname" name="fname" class="text"/>
                                </li><li>
                                    <label for="branch">Branch:*</label>
                                    <select id="branch" name="branch" class="text">
                                        <option value="">Select</option>
                                        <?php echo load_select('branches'); ?>
                                    </select>
                            <!--        <input id="course" name="course" class="text"/>-->
                                </li><li>
                                    <label for="course">Course:*</label>
                                    <select id="course" name="course" class="text">
                                        <option value="">Select</option>
                                        <?php echo load_select('courses'); ?>
                                    </select>
                            <!--        <input id="course" name="course" class="text"/>-->
                                </li><li>
                                    <label for="doj">Date of Join:</label>
                                    <input id="doj" name="doj" class="text apply_datepicker" readonly="readonly"/>
                                </li><li>
                                    <label for="doc">Date of Completion:</label>
                                    <input id="doc" name="doc" class="text apply_datepicker" readonly="readonly"/>
                                </li><li>
                                    <label for="dob">Date of Birth:* </label>
                                    <input id="dob" name="dob" class="text apply_datepicker" readonly="readonly"/>
                                </li><li>
                                    <label for="mobile">Mobile:* </label>
                                    <input id="mobile" name="mobile" class="text"/>
                                </li><li>
                                    <label for="email">Email:* </label>
                                    <input id="email" name="email" class="text"/>
                                </li><li>
                                    <label for="bus">Bus Pass: </label>
                                    <input id="bus" name="bus" class="text"/>
                                </li><li>
                                    <label for="idc">Id Card: </label>
                                    <input id="idc" name="idc" class="text"/>
                                </li><li>
                                    <label for="addr">Address: </label>
                                    <textarea id="addr" name="addr" rows="8" cols="50"></textarea>
                                </li><li>
                                    <label for="pyear">Present Studying Year: </label>
                                    <input id="pyear" name="pyear" class="text"/>
                                </li><li>
                                    <label for="fee">Fee Details: </label>
                                    <input id="fee" name="fee" class="text"/>
                                </li><li>
                                    <label for="account">Account Status: </label>
                                    <input id="account" name="account" class="text"/>
                                </li><li>
                                    <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save"/>
                                    <div class="clr"></div>
                                </li></ol>
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