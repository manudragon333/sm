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

    function send_smsbk($receipientno=0, $msgtxt=0,$smsgateway=1) {
		$CI = & get_instance();
		//fetch the sms gateway data from db based on sms gate way id
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
            $CI->db->query("insert into debug (name) values ('" . $receipientno . "__" . $msgtxt . "__NO Buffer')");
        } else {
            // echo $buffer;         
            $CI->db->query("insert into debug (name) values ('" . $receipientno . "__" . $msgtxt . "__" . $buffer . "')");
        }
        curl_close($ch);
    }
	//gateway function for sending sms
	function send_sms($receipientno=0, $msgtxt=0,$smsgatewayid=1) 
	{
		log_message('error', 'sms sending from sms lib to this no:'.$receipientno.'and for this msg:'.$msgtxt);
		$CI = & get_instance();
		$smsqstr = "select * from sms_gateways where id=".$smsgatewayid;		
		$res = $CI->db->query($smsqstr);
        $smsdatares = $res->result();
		
		if(!empty($smsdatares))
		{			
			
			//fetch the sms gateway data from db based on sms gate way id
			$senderID = $smsdatares[0]->sender_id;
			$user = $smsdatares[0]->username;
			$cid = 0;

			$ch = curl_init();	
			$url = $smsdatares[0]->url;			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&dcs=0&msgtxt=$msgtxt&state=4");
			$buffer = curl_exec($ch);
			if (empty($buffer)) { 
				return false;				
			} else {
				return true; 				
			}
			curl_close($ch);
		}
		else
		{			
			return false;
		}
    }

}

?>
