<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function load_select($table,$selected_val=0,$where=array('status'=>'1')){
    $CI =& get_instance();
    $CI->db->where($where);
    $res=$CI->db->get($table);
    $data=$res->result();
    $html='';
    //print_r($data); return true;
    foreach($data as $k=>$v){
        $html.="<option value='$v->id'";
        if($selected_val==$v->id){ $html.=" selected='selected' "; }
        $html.=">$v->name</option>";
    }
    return $html;
}
function load_select_section($table,$selected_val=0,$where=array('status'=>'1')){
    $CI =& get_instance();
    $CI->db->where($where);
    $res=$CI->db->get($table);
    $data=$res->result();
    $html='';
    //print_r($data); return true;
    foreach($data as $k=>$v){
        $html.="<option value='$v->id'";
        if($selected_val==$v->id){ $html.=" selected='selected' "; }
        $html.=">$v->section</option>";
    }
    return $html;
}

function load_select_numbers($table,$selected_val=0,$where=array('status'=>'1')){
   
    $CI =& get_instance();
    $CI->db->select('users.id as user_id,users.username');
    $CI->db->from('users');
    $CI->db->join('student_records', 'student_records.user_id = users.id');
    $CI->db->join('student_semisters', 'student_semisters.user_id = users.id');
    $CI->db->where($where);
    $CI->db->order_by("users.username", "asc"); 
    $res=$CI->db->get();
    $data=$res->result();
    $html='';
    //print_r($data); return true;
    foreach($data as $k=>$v){
        $html.="<option value='$v->user_id'";
        if($selected_val==$v->user_id){ $html.=" selected='selected' "; }
        $html.=">$v->username</option>";
    }
    return $html;
}

//
function load_select_academicyears($table,$selected_val=0,$where=array('status'=>'1')){
    $CI =& get_instance();
    $CI->db->select('estd');
    $CI->db->from($table);
    $CI->db->where($where);
    $res=$CI->db->get();
    $data=$res->result();
    $html='';
    //print_r($data); return true;
    foreach($data as $k=>$v){
        $estd = $v->estd;
        for($i=$estd;$i<($estd + 20);$i++)
        {
        	$html.="<option value='$i'";
        	if($selected_val==$i){ $html.=" selected='selected' "; }
        	$html.=">$i</option>";
        }
    }
    return $html;
}

function get_select_name($id,$table){
    $CI=& get_instance();
    $CI->db->where('id',$id);
    $res=$CI->db->get($table);
    $data=$res->result();
    return $data[0]->name;
}


function year_select($selected_year=0,$no_future=false){
    $html='';
    $limit=($no_future)?date('Y'):date('Y')+5;

    for($i=date('Y')-4;$i<=$limit;$i++){
        $html.="<option value='$i'";
        if($selected_year==$i){ $html.=" selected='selected' "; }
        $html.=">$i</option>";
    }
    return $html;
}

function dateFormat($db_date_time,$format='Y-m-d'){
    $str_time=strtotime($db_date_time);
    return date($format,$str_time);
}

function get_graduation_json($ids){
    $CI=& get_instance();
    $sql="select * from branches where id not in($ids)";
    $res=$CI->db->query($sql);
    $data=$res->result();
    return json_encode($data); //$data[0]->name;
}


function get_post_graduation_json($ids){
    $CI=& get_instance();
    $sql="select * from branches where id in($ids)";
    $res=$CI->db->query($sql);
    $data=$res->result();
    return json_encode($data); //$data[0]->name;
}


function showBigError($message='There was a error. Please try again.'){
    $result='<div class="alert_error">'.$message.'</div>';
    return $result;
}

function showBigInfo($message='Info.'){
    $result='<div class="alert_info">'.$message.'</div>';
    return $result;
}

function showBigSuccess($message='Success.'){
    $result='<div class="alert_success">'.$message.'</div>';
    return $result;
}

function showWarning($message='Warning...'){
    $result='<div class="alert_warning">'.$message.'</div>';
    return $result;
}

function pinBoardMsg($messageArr=array()){
    $result = '<ul class="collegeUpdates">';
    if (!empty($messageArr)) {
        
        foreach ($messageArr as $k => $v) {
            $result.='<li>
                        <img src="'.base_url().'/css/images/pushpin_pink.png" class="upd_std" alt="user">
                        '.$v->message.'<div class="post_date p_a"><span>Posted on: </span> '.((!empty($v->date_added))?dateFormat($v->date_added, 'd-M-y'):'').' </div>
                    </li>';
        }
        
    }else{
        $result.='<li>
                    <img src="'.base_url().'/css/images/pushpin_pink.png" class="upd_std" alt="user">
                    No Messages<div class="post_date p_a"><span>Posted on: </span> '.((!empty($v->date_added))?dateFormat($v->date_added, 'd-M-y'):'').' </div>
                </li>';
    }
    $result.=' </ul>';
    return $result;
}

function urlsafe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
}

function urlsafe_b64decode($string) {
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

?>
