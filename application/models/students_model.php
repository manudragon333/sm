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
	//new function added by surya on 20th aug 13
	function get_smsstudents_by_ids($inputarray=array())
	{
		$sql = "select * from student_records where id in(".implode(',',$inputarray).")";	
		//log_message('error', 'get_smsstudents_by_ids '.$sql);		
		$res = $this->db->query($sql);
        return $res->result();
	}
    //new function added by surya on 19th aug 13
	function get_smsstudents($inputarray=array())
	{
		$college_id = isset($inputarray['college_id'])?$inputarray['college_id']:''; 
		$course_id = isset($inputarray['course_id'])?$inputarray['course_id']:''; 
		$branch_id = isset($inputarray['branch_id'])?$inputarray['branch_id']:'';  
		$semister_id = isset($inputarray['semister_id'])?$inputarray['semister_id']:''; 
		$section_id = isset($inputarray['section_id'])?$inputarray['section_id']:''; 
		$religion = isset($inputarray['religion'])?strtolower($inputarray['religion']):'';  
		
        $sql=" select sr.*, users.users_type_id, users.username, users.`password` , users.email, users.id as users_id ,users.status
			 from users
			 inner join student_records as sr on sr.user_id=users.id
			 inner join student_semisters as ss on ss.user_id=sr.user_id
			 where users.users_type_id='1' and users.status='1' and ss.is_current='1'  and sr.college_id = '".$college_id."' 
			 and sr.course_id = '".$course_id."'  and sr.branch_id = '".$branch_id."'  and ss.semister_id = '".$semister_id."'
			 and sr.section_id='".$section_id."' ";
			 if(!empty($religion))
			 {
				$sql .= " and sr.religion='".$religion."' ";
			 }
			 
			 $sql .= " ORDER BY username  ";
 
        $res = $this->db->query($sql);
        return $res->result();
    }
	//new function added by surya on 19th aug 13
	function send_sms_or_email($inputarray1=array(),$inputarray2=array(),$insert=1,$update=0,$from_modaration=0)
	{		
		$choice1 = isset($inputarray1['choice'])?$inputarray1['choice']:'';		
		$message_id = isset($inputarray1['message_id'])?$inputarray1['message_id']:'';				
		$smsto = isset($inputarray1['smsto'])?$inputarray1['smsto']:'';
		$message = isset($inputarray1['message'])?$inputarray1['message']:'';
		
		$name = isset($inputarray2->name)?$inputarray2->name:'';		
		$fatheremail = isset($inputarray2->father_email)?$inputarray2->father_email:'';
		$fatheremobile = isset($inputarray2->father_mobile)?$inputarray2->father_mobile:'';
		$email = isset($inputarray2->email)?$inputarray2->email:'';
		$mobile = isset($inputarray2->mobile)?$inputarray2->mobile:'';		
		$db_students_number = isset($inputarray2->students_number)?$inputarray2->students_number:'';	
		$db_user_name = isset($inputarray2->name)?$inputarray2->name:'';		
		
		//chcking string replace starts here
		//first prepare array of the possible place holders
		$vars = array('%sname%'=>$name);
		$message = str_replace(array_keys($vars), $vars, $message);	
		//log_message('error', 'composed message: '.$message);			
		//chcking string replace ends here
		
		$requireddata = array();
		$requireddata['message'] =  $message;
		
		
		//insert the data in student_messages table
		$db_messagetype = '';
		$db_student_id= isset($inputarray2->user_id)?$inputarray2->user_id:'';
		$db_status = '';
		if(IS_MODARATION_REQUIRES == TRUE && $from_modaration==0)
		{			
			$db_status = 'modaration';
		}
		
		
		$db_sentto = '';
		$db_message_error = 'no_error';
		if($choice1==1)
		{
			$db_messagetype = 'email';
			//email
			//now check for parent or student
			if($smsto == 'parent')
			{
				//now take parent email
				$requireddata['contactpoint'] = $fatheremail;
				$db_sentto = $personval = 'parent';
				
			}
			else if($smsto == 'student')
			{
				//now take student email
				$requireddata['contactpoint'] = $email;
				$db_sentto = $personval = 'student';
			}
			else
			{
				return;
			}
			
			 if(!empty($requireddata['contactpoint']))
			 {
				if($db_status=='')
				{
					$db_status = 'sent';
					$this->load->library('my_email_lib');
					$this->my_email_lib->html_email($requireddata['contactpoint'],$message);
					//now send email
					//log_message('error', 'email sending to'.$requireddata['contactpoint']);
				}				
				
			 }
			 else
			 {
			 				
				//if($db_status=='')
				//{
					$db_status = 'failed';
				//}
				
				if($personval=='student')
				{
					$db_message_error  = 'stu_email';
				}
				else
				{
					$db_message_error  = 'parent_email';
				}
				log_message('error', 'no email present for '.$personval);
			 }
			//now send email using email library
		}
		else if($choice1==2)
		{
			$db_messagetype = 'sms';
			//now check for parent or student
			if($smsto == 'parent')
			{
				//now take parent mobile number
				$requireddata['contactpoint'] = $fatheremobile;
				$db_sentto = $personval = 'parent';
			}
			else if($smsto == 'student')
			{
				//now take student mobile
				$requireddata['contactpoint'] = $mobile;
				$db_sentto = $personval = 'student';
			}
			else
			{
				return;
			}
			
			//now send sms using sms library			
			 if(!empty($requireddata['contactpoint']))
			 {
				if($db_status=='')
				{
					$db_status = 'sent';
					//now send sms
					//log_message('error', 'sms sending to'.$requireddata['contactpoint']);
					$this->load->library('sms_lib');
					$this->sms_lib->send_sms($requireddata['contactpoint'],$message);
				}
				
			 }
			 else
			 {
				//if($db_status=='')
				//{
					$db_status = 'failed';
				//}
				if($personval=='student')
				{
					$db_message_error  = 'stu_mobile';
				}
				else
				{
					$db_message_error  = 'parent_mobile';
				}
				log_message('error', 'no mobile number present for '.$personval);
			 }
		}
		else
		{			
			return; 
		}
			if($insert==1)
			{
				$insertqstr = "insert into student_messages(user_id,student_number,user_name,message,message_type,status,sent_to,message_error,more_info) 
				values('".$db_student_id."','".$db_students_number."','".$db_user_name."','".addslashes($message)."','".$db_messagetype."','".$db_status."','".$db_sentto."','".$db_message_error."','".serialize($inputarray2)."')";
				//log_message('error', 'insert str '.$insertqstr);
				$this->db->query($insertqstr);
			}
			
			if($update==1 && $message_id!='')
			{				
				$updatestr = "update student_messages set sent_date='".date('Y-m-d H:i:s')."',status='".$db_status."' where id=".$message_id;
				$this->db->query($updatestr);
			}
		
		
	}//function ends here
	

} // model ends here


