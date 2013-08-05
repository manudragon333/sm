<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Session_check{
    function  __construct() {
        //echo 'MMJ';
    }
    function check_login(){
        // echo 'MMJ';
        $CI =& get_instance();
        // echo $CI->session->userdata('user_id');
        $sessionLess=array('login','student_registration');
        if($CI->session->userdata('user_id')){
            return true;
        }else if(!in_array($CI->uri->segment(1), $sessionLess)){
            // echo $CI->uri->segment(1);
            redirect('login');
        }
    }
}

?>
