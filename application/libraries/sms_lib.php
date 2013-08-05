<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms_lib {

    function send_sms_x($mobile=0, $message=0) {
        if (!empty($mobile) && !empty($message)) {
            return true;
        }
    }

    function send_sms_OLD($receipientno=0, $msgtxt=0) {
        $senderID = 'TEST SMS';
        $user = 'firstfruitconsulting@gmail.com:kiran20';
        $cid = 0;

        $ch = curl_init();
//$url="http://api.mVaayoo.com/mvaayooapi/MessageCompose?user=(username:password)&senderID=(SA)&receipientno=(DA&msgtype=7&dcs=240&msgtxt=(message)&state=(1,2,3,4)";
        echo $url = "http://api.mVaayoo.com/mvaayooapi/MessageCompose";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&cid=$cid&msgtxt=$msgtxt&state=");
        $buffer = curl_exec($ch);
        if (empty($buffer)) { //echo " buffer is empty ";
        } else {
            echo $buffer;
        }
        curl_close($ch);
    }

    function send_sms($receipientno=0, $msgtxt=0) {
	
        $senderID = 'TEST SMS';
        $user = 'firstfruitconsulting@gmail.com:kiran20';
        $cid = 0;

        $ch = curl_init();
//$url="http://api.mVaayoo.com/mvaayooapi/MessageCompose?user=(username:password)&senderID=(SA)&receipientno=(DA&msgtype=7&dcs=240&msgtxt=(message)&state=(1,2,3,4)";
        $url = "http://api.mVaayoo.com/mvaayooapi/MessageCompose";
        //?user=$user&senderID=$senderID&receipientno=$receipientno&cid=$cid&msgtxt=$msgtxt&state=4";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&dcs=0&msgtxt=$msgtxt&state=4");
        $buffer = curl_exec($ch);
        if (empty($buffer)) { //echo " buffer is empty ";
            $CI = & get_instance();
            $CI->db->query("insert into debug (name) values ('" . $receipientno . "__" . $msgtxt . "__NO Buffer')");
        } else {
            // echo $buffer;
            $CI = & get_instance();
            $CI->db->query("insert into debug (name) values ('" . $receipientno . "__" . $msgtxt . "__" . $buffer . "')");
        }
        curl_close($ch);
    }

}

?>
