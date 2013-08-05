<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by http://www.MyCollege.org
-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>MyCollege.org</title>
        <?php $this->load->view('common/links'); ?>
    </head>
    <body>
        <div class="main">
            <?php $this->load->view('common/header'); ?>
            <div class="clr"></div>
            <div id="system_notification" class="header_resize">
                <div id="notofication_wrapper">
                <?php
                    if($this->session->flashdata('error_msg')){     echo showBigError($this->session->flashdata('error_msg'));      }
                    if($this->session->flashdata('info_msg')){      echo showBigInfo($this->session->flashdata('info_msg'));        }
                    if($this->session->flashdata('success_msg')){   echo showBigSuccess($this->session->flashdata('success_msg'));  }
                ?>
                </div>
            </div>
            <div class="clr"></div>
            <div class="content">
                <div class="content_resize">
                    <div class="mainbar">
                        <div class="article" id="main_content">

                            <?php if (isset($content_page)) {
                                $this->load->view($content_page);
                            } ?>

                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
            <!-- Footer -->
            <div class="footer">
                <p class="lr">&nbsp;<a href="#"></a>.</p>
                <p class="lf" style="background: url('<?php echo base_url();  ?>/css/images/first_fruit.jpg') center left no-repeat; padding:21px 0px 21px 57px;">Powered By <a href="" class="footer_highlight">First Fruit Consulting.</a></p>
                <div class="clr"></div>
                <div>
                    Licensed to : Kits<br/>
                    Version: (v1.0)<br/>
                    Renewal date : N/A<br/>
                </div>
            </div>
        </div>
    </body>
</html>
