<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function user_types(){
        $query = $this->db->get('users_type');
        return $query->result();
    }

    function validate_user($post){
        $sql="select u.id from users as u left join users_type as ut on u.users_type_id=ut.id where u.username='".$post['uname']."' and u.password='".$post['psw']."' and u.status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function validate_user2($post){
        $sql="select u.id from users as u left join users_type as ut on u.users_type_id=ut.id where u.username='".$post['uname']."'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function user_details($user_id){
        $sql="select u.*,ut.name as users_type from users as u
                left join users_type as ut on u.users_type_id=ut.id
                where u.id='".$user_id."'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function set_loggedin($user_id=0,$flag=0){
        $sql="update users set is_loggedin='$flag' where id='$user_id'";
        $res = $this->db->query($sql);
        return true;
    }

    function get_loggedin_users($user_id=0){
        $sql="select u.*,ut.name as user_type from users as u
            left join users_type as ut on ut.id=u.users_type_id
            where u.id!='".$user_id."' and u.is_loggedin='1' and u.status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_user_email_mobile($user_id=0,$user_type_id=0){
        if($user_id==0){ $user_id=$this->session->userdata('user_id'); }
               if($user_type_id==0){ $user_details=$this->user_details($user_id); /*print_r($user_details);*/
		 if(!empty($user_details)) $user_type_id=$user_details[0]->users_type_id; }

	    if($user_type_id==1){
            $sql="select sr.email, sr.mobile
                    from student_records as sr
                    left join users as u on u.id=sr.user_id
                    where sr.user_id='".$user_id."' and u.status='1'";
        }else if($user_type_id==2 || $user_type_id==3){
            $sql="select sr.email, sr.mobile
                    from staff_records as sr
                    left join users as u on u.id=sr.user_id
                    where sr.user_id='".$user_id."' and u.status='1'";
        }else{
            return array('email'=>0,'mobile'=>0);
        }
        
        $res = $this->db->query($sql);
        $result= $res->result_array();
        if(isset($result[0]))
            return $result[0];
        else
            return array('email'=>0,'mobile'=>0);
    }
function confirm_office_pass($pass){
        $sql="select u.id from users as u left join users_type as ut on u.users_type_id=ut.id where u.username='office' and u.password='".$pass."' and u.status='1'";
        $res = $this->db->query($sql);
 if($res->num_rows()==1)
        return true;
else return false;
    }

}

?>