<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function sample(){
        $sql="";
        $res = $this->db->query($sql);
        return $res->result_array();
    }


    function get_book_details($unique_number){
        $sql="select lb.*,b.college_id,b.course_id from library_books as lb
                left join branches as b on b.id=lb.branch_id
                where lb.unique_number='$unique_number' and lb.status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function delete_book($id){
        // $sql="delete from library_books where id='$id'";
        $sql="update library_books set status='0' where id='$id'";
        $res = $this->db->query($sql);
    }

    function check_book_reserved($post){
        $sqlx="select * from library_booking where user_id='".$post['user_id']."' and book_id='".$post['id']."' and status='1'";
        $sql="select * from library_booking where book_id='".$post['id']."' and status='1'";
        $res = $this->db->query($sql);
        return $res->num_rows();
    }

    function check_library_returns($user_id){
        $sql="select l.unique_number,l.name,lb.*,datediff(now(),lb.date_booked) as days from library_booking as lb
                left join library_books as l on l.id=lb.book_id
                where lb.user_id='$user_id' and datediff(now(),lb.date_booked)>14 and lb.status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }


    /******** START: PASS ON BOOKS SET **************/

    function get_book_id($book_number){
        $sql="select lb.id from library_books as lb where lb.unique_number='$book_number' and lb.status='1'";
        $res = $this->db->query($sql);
        $result=$res->result_array();
        if(empty($result)){
            return 0;
        }else{
            return $result[0]['id'];
        }
    }

    function get_student_user_id($student_number){
        $sql="select u.id from student_records as sr
                left join users as u on u.id=sr.user_id
                where sr.students_number='$student_number'";
        $res = $this->db->query($sql);
        $result=$res->result_array();
        if(empty($result)){
            return 0;
        }else{
            return $result[0]['id'];
        }
    }

    function is_book_reserved($book_id){
        $sql="select * from library_booking as lbk
                where lbk.book_id='$book_id' and lbk.status='1'";
        $res = $this->db->query($sql);
        $result=$res->result_array();
        if(empty($result)){
            return 0;
        }else{
            return $result[0]['id'];
        }
    }

    function un_reserve_book($book_id){
        $sql="update library_booking set status='0' where id='$book_id'";
        $res = $this->db->query($sql);
    }

    function reserve_book($book_id,$user_id){
        $postP['book_id']=$book_id;
        $postP['user_id']=$user_id;
        $postP['is_dispatched']=1;
        $postP['dispatched_on']=date('Y-m-d');
        $this->my_db_lib->save_record($postP,'library_booking');
    }

    /******** END : PASS ON BOOKS SET **************/

    function get_booking_count($user_id){
        $sql="select book_id from library_booking where user_id='$user_id' and status='1'";
        $res = $this->db->query($sql);
        return $res->num_rows();
    }

    function get_user_booking($user_id){
        $sql="select * from library_booking where user_id='$user_id' and status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function check_if_reserved($book_number){
        $sql="select * from library_booking as lbk
                left join library_books as lb on lb.id=lbk.book_id
                where lb.unique_number='$book_number' and lbk.status='1'";
        $res = $this->db->query($sql);
        $result=$res->result_array();
        if(empty($result)){
            return 0;
        }else{
            return $result[0]['id'];
        }
    }



}

?>
