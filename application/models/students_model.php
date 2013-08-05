<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_notice_board(){
        $sql="select * from students_notice_board where status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function check_conduct($user_id){
        $sql="select * from conduct_applications where user_id='".$user_id."' and is_issued!='1'";
        $res = $this->db->query($sql);
        return $res->num_rows();
    }

    function save_conduct($post){
        $return=$this->my_db_lib->save_record($post,'conduct_applications');
        return $return;
    }

    function check_tc($user_id){
        $sql="select * from tc_applications where user_id='".$user_id."' and is_issued!='1'";
        $res = $this->db->query($sql);
        return $res->num_rows();
    }
    
    function save_tc($post){
        $return=$this->my_db_lib->save_record($post,'tc_applications');
        return $return;
    }

    function check_no_due($user_id){
        $sql="select * from nodue_applications where user_id='".$user_id."' and is_issued!='1'";
        $res = $this->db->query($sql);
        return $res->num_rows();
    }

    function save_no_due($post){
        $return=$this->my_db_lib->save_record($post,'nodue_applications');
        return $return;
    }

    function send_approval_requests($post){
        $return=$this->my_db_lib->save_record($post,'nodue_approvals');
        return $return;
    }

    function get_branch_hods($branch_id){
        $sql="select u.* from users as u
                left join users_type as ut on ut.id=u.users_type_id
                left join staff_records as sr on sr.user_id=u.id
                where u.users_type_id='3' and sr.branch_id='$branch_id' and u.status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }


    function get_users_of_type($user_type_id){
        $sql="select u.* from users as u
                left join users_type as ut on ut.id=u.users_type_id
                where u.users_type_id='$user_type_id' and u.status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_no_due($user_id){
        $sql="select * from nodue_applications where user_id='".$user_id."' and is_issued!='1'";
        $sql="select n.*,u.username as name,ut.name as user_type,nda.approver_status from nodue_applications n
                left join nodue_approvals as nda on nda.application_id=n.id
                left join users as u on u.id=nda.approver_id
                left join users_type as ut on ut.id=u.users_type_id
                where user_id='".$user_id."' and is_issued!='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_user_details($user_id){
        $sqlx="select * from student_records where user_id='".$user_id."' and status='1'";
        $sql="select sr.*,ss.semister_id as sem_id,b.name as branch_name, ifnull(sf.fee1,'-') as fee1,ifnull(sf.fee2,'-') as fee2,ifnull(sf.fee3,'-') as fee3,ifnull(sf.fee4,'-') as fee4
                from student_records as sr
                left join student_fees as sf on sf.user_id=sr.user_id
                left join branches as b on b.id=sr.branch_id
                left join student_semisters as ss on ss.user_id=sr.user_id and ss.is_current='1'
                where sr.user_id='".$user_id."' and sr.status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_placement_news(){
        $sql="select * from placement_cell_news where status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_branches(){
        $sql="select * from branches where status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_student_details($students_number){
        $sql="select * from student_records where students_number='".$students_number."' and status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_students_by_year($year){
        $sql="select * from student_records where present_year='".$year."' and status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_student_semesters($user_id){
        $sql="select s.name as sname,s.id  from  student_semisters ss
                inner join semisters s on ss.semister_id=s.id where user_id='$user_id' order by s.id";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_student_marks($user_id,$semester_id){
        $sqlBKUP="select sm.marks ,u.id,u.username,s.name as subjects_name,se.name as sname,mt.name as marks_type_name,IFNULL(sm.max_marks,100)as max_marks,sm.marks_type_id from student_marks sm
                inner join users u on sm.student_id=u.id
                inner join marks_type mt on sm.marks_type_id=mt.id
                inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id
                inner join subjects s on bss.subject_id=s.id
                inner join semisters se on bss.semister_id=se.id
                inner join branches b on bss.branch_id=b.id
                inner join courses c on b.course_id=c.id
                where sm.student_id='$user_id' and bss.semister_id='$semester_id' order by sm.create_date
                ";
        $sql="select sm.* ,u.id,u.username,s.name as subjects_name,se.name as sname,se.id as sem_id,mt.name as marks_type_name,IFNULL(sm.max_marks,100)as max_marks from student_marks sm
                inner join users u on sm.student_id=u.id
                inner join marks_type mt on sm.marks_type_id=mt.id
                inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id
                inner join subjects s on bss.subject_id=s.id
                inner join semisters se on bss.semister_id=se.id
                inner join branches b on bss.branch_id=b.id
                inner join courses c on b.course_id=c.id
                where sm.student_id='$user_id' and bss.semister_id='$semester_id' order by sm.create_date";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_student_marks_history($user_id,$semester_id){
        $sqlBKUP="select sm.marks ,u.id,u.username,s.name as subjects_name,se.name as sname,se.id as sem_id,mt.name as marks_type_name,IFNULL(sm.max_marks,100)as max_marks,sm.marks_type_id from student_marks sm
                inner join users u on sm.student_id=u.id
                inner join marks_type mt on sm.marks_type_id=mt.id
                inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id
                inner join subjects s on bss.subject_id=s.id
                inner join semisters se on bss.semister_id=se.id
                inner join branches b on bss.branch_id=b.id
                inner join courses c on b.course_id=c.id
                where sm.student_id='$user_id' order by sm.create_date
                ";
        $sql="select sm.*, sm.id as sm_id ,u.id as uid,u.username,s.name as subjects_name,se.name as sname,se.id as sem_id,mt.name as marks_type_name,IFNULL(sm.max_marks,100)as max_marks from student_marks sm
                inner join users u on sm.student_id=u.id
                inner join marks_type mt on sm.marks_type_id=mt.id
                inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id
                inner join subjects s on bss.subject_id=s.id
                inner join semisters se on bss.semister_id=se.id
                inner join branches b on bss.branch_id=b.id
                inner join courses c on b.course_id=c.id
                where sm.student_id='$user_id' order by sm.create_date";
        $res = $this->db->query($sql);
        return $res->result();
    }


    function get_student_attendance($user_id,$semester_id){
        $sql="select * from student_attendence st
                where st.semister_id='$semester_id' and st.user_id='$user_id' order by st.create_date
                ";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_library_pdfs_discussions($id){
        $sql="select lpd.*,IFNULL(sr.name,staffr.name) as commented_by from library_pdf_discussions lpd
                left join student_records as sr on sr.user_id=lpd.user_id
                left join staff_records as staffr on staffr.user_id=lpd.user_id
                where lpd.library_pdf_id='$id' and lpd.status='1' ";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_videos(){
        $sql="select * from videos where status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }
    

}

?>
