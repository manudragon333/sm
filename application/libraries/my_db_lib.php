<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_db_lib {

    private $table_rows=array(
        'id_card_applications'=>array('id','user_id','name','stu_number','branch','date_of_join','address','mobile_no','photo','is_staff','is_issued'),
        'study_certi_applications'=>array('id','user_id','name','stu_number','son_of','course','from','to','is_issued'),
        'conduct_applications'=>array('id','user_id','name','stu_number','co','title','course','from_date','to_date','is_issued'),
        'tc_applications'=>array('id','user_id','class_studying','identification_marks','qualified_for','conduct','reason_of_leaving','is_issued'),
        'bus_pass_applications'=>array('id','user_id','student_number','name','start_from','branch','course','photo','is_issued'),
        'nodue_applications'=>array('id','user_id','is_issued'),
        'student_records'=>array('id','user_id','regulation_id','admission_type_id','caste_id',
        'college_id','course_id','branch_id','semister_id','section_id','scholarship','fname','lname','name','fathers_name','students_number','sex','dob','doj',
        'present_year','completing_year','fee_details','email','mobile','father_mobile','address','photo','ssc','inter','other','updated_by'),
        'study_abroad'=>array('id','user_id','name','email','country_interested','exam','mobile','message'),
        'placement_cell_job_alerts'=>array('id','user_id','alert_type','status'),
        'placement_cell_resumes'=>array('id','user_id','resume_link'),
        'staff_records'=>array('id','user_id','name','code','designation_id','branch_id','sex','dob','doj','qualification','email','email2','mobile','address','salary','updated_by'),
        'question_papers'=>array('id','user_id','students_count','branch','year','subject_id','exam_number','doc_link','is_approved','is_principal_approved','to_print','is_printed','section_id'),
        'pay_slip_requests'=>array('id','user_id','from_month','to_month','year','is_issued'),
        'send_student_messages'=>array('id','user_id','choice','choice2','choice3','student_number','message','is_sent','section_id'),
        'library_books'=>array('id','unique_number','name','accesion_no','title','edition_year','pages','volume','publisher_name_addr','isbn_no',
                                'call_no','book_cost','date_of_withdrawl','remarks','author','version','year','branch_id','count'),
        'library_booking'=>array('id','user_id','book_id','msg1_sent','msg2_sent','is_dispatched','dispatched_on'),
        'time_table'=>array('id','user_id','mon_1','mon_2','mon_3','mon_4','tue_1','tue_2','tue_3','tue_4','web_1','wed_2','wed_3','wed_4','thu_1','thu_2','thu_3','thu_4','fri_1','fri_2','fri_3','fri_4','sat_1','sat_2','sat_3','sat_4'),
        'student_time_table'=>array('id','branch_id','year','day_id','sub1','sub2','sub3','sub4','sub5','sub6','sub7','lab1','lab2'),
        'student_fees'=>array('id','user_id','fee1','fee2','fee3','fee4'),
        'users'=>array('id','users_type_id','username','password','email','status'),
        'nodue_approvals'=>array('id','application_id','approver_id','approver_status'),
        'students_notice_board'=>array('id','message','date_added','status'),
        'branch_semister_subject'=>array('id','branch_id','semister_id','subject_id'),
        'student_attendence'=>array('id','user_id','semister_id','attend_days','tot_days','create_date'),
        'assignments'=>array('id','user_id','students_count','instructions','branch_id','sem_id','subject','doc_link','max_marks','last_date','date_added','status','section_id'),
        'assignment_submissions'=>array('id','user_id','assignments_id','student_replies','doc_link','marks_alloted','staff_comments','status'),
        'library_pdfs'=>array('id','user_id','branch_id','sem_id','instructions','doc_link','date_added','status','section_id'),
        'library_pdf_discussions'=>array('id','user_id','library_pdf_id','comment','status'),
        'polls'=>array('id', 'question', 'start_date', 'end_date', 'access', 'status', 'created_by', 'create_date', 'modify_date'),
        'poll_options'=>array('id', 'poll_id', 'label', 'status'),
        'poll_users'=>array('id', 'poll_id', 'poll_option_id', 'user_id', 'poll_date' ),
        'videos'=>array('id','user_id','comments','instructions','embed_code','branch_id','sem_id','date_added','status'),
        'colleges'=>array('id','name','college_address','college_code','estd','college_logo','status'),
        'courses'=>array('id','name','college_id','status'),
        'branches'=>array('id','name','course_id','college_id','status'),
        'semisters'=>array('id','name','year','branch_id','course_id','college_id','status'),
        'subjects'=>array('id','name','semister_id','branch_id','course_id','college_id','subject_type_id','credits','status','academic_year'),
        'period_cycles'=>array('id','name','college_id','no_of_periods','time_period','starting_time','status'),
        'periods'=>array('id','cycles_id','time_label','from','to','period_label','details','status'),
        'staff_cycles_periods'=>array('id','user_id','cycle_id','weekday_id','period_id','subject_id','status','section_id','academic_year_id'),
        'student_periods_attendence'=>array('id','user_id','staff_user_id','cycle_id','weekday_id','period_id','subject_id','status','attendance_id'),
        'leave_letters'=>array('id','staff_name','staff_code','user_id','branch_id','leave_type_id','from','to','purpose','is_approved','date_added','status'),
        'leave_work_adjusts'=>array('id','leave_letter_id','work_adjusted_to','work_adjusted_date','period_id','subject_id','date_added','is_approved','status'),
        'attendance_breach_counter'=>array('id','staff_user_id','period_id','unlocked','date_added'),
        'sections'=>array('id','semister_id','branch_id','course_id','college_id','start_number','end_number','section','student_start','student_end'),
		'regulations'=>array('id','name','status'),
		'debit_vouchers'=>array ('vorefno', 'collegeid', 'vcreationdate', 'debitedto', 'payment_details', 'amount', 'type', 'checkedby', 'createdby'),  
);
    
    private $table_rels=array(
        'id_card'=>'id_card_applications',
        'study_certi'=>'study_certi_applications',
        'cond_certi'=>'conduct_applications',
        'buss_pass'=>'bus_pass_applications',
        'nodue'=>'nodue_applications',
        'my_rec'=>'student_records',
        'study_abr'=>'study_abroad',
        'job_alert'=>'placement_cell_job_alerts',
        'placement_resumes'=>'placement_cell_resumes',
        'payslip'=>'pay_slip_requests',
        'send_msg'=>'send_student_messages'

        
    );

    function get_table_name($rel){
        $rels_array=$this->table_rels;
        if(isset($rels_array[$rel])){
            return $rels_array[$rel];
        }else{
            return 0;
        }
    }

    function filter_table_rows($post, $table_name) {
        $data = array();
        foreach ($post as $k => $v) {
            if (in_array($k, $this->table_rows[$table_name])) {
                $data[$k] = $v;
            }
        }
        return $data;
    }

    function filter_post($post_data, $table_name) {
        if(is_object($post_data)){
            $post=(array) $post_data;
        }else{
            $post=(array) $post_data;
        }
        if (isset($this->table_rows[$table_name])) {
            $data = $this->filter_table_rows($post, $table_name);
            return $data;
        }else{
            return 0;
        }
    }

    function save_record($post_data, $table_name) {
    
        if(is_object($post_data)){
            $post=(array) $post_data;
        }else{
            $post=(array) $post_data;
        }
       //echo  $table_name; exit;
        if (isset($this->table_rows[$table_name])) {
            $data = $this->filter_table_rows($post, $table_name);
            if (isset($data['id']) && !empty($data['id'])) {
                $id=$data['id'];
                unset ($data['id']);
                return $this->db_update($data, $id, $table_name);
            } else {
                return $this->db_insert($data,$table_name);
            }
        }else{
        
            return 0;
        }
    }

    function db_insert($inserts, $table) {

        $CI =& get_instance();
        $CI->db->insert($table, $inserts);
        return $CI->db->insert_id();
        // $values = array_map('mysql_real_escape_string', array_values($inserts));
        // $keys = array_keys($inserts);
        // mysql_query('INSERT INTO `' . $table . '` (`' . implode('`,`', $keys) . '`) VALUES (\'' . implode('\',\'', $values) . '\')') or die("Unable to Connect to Databse" . mysql_error());
        // return mysql_insert_id();
    }

    function db_update($updates,$id,$table) {
        $CI =& get_instance();
        $CI->db->where('id', $id);
        return $CI->db->update($table, $updates);
        //$str = '';
        //foreach ($updates as $k => $v) {
        //    $str.=" " . $k . "='" . $v . "', ";
        //}
        //$str = substr($str, 0, -2);
        //$qry = "UPDATE $table SET $str ";
        //if (trim($condition) != '') {
        //    $qry .= $condition;
        //}
        //return mysql_query($qry);
    }

    function get_jqgrid_data($post,$query){
        $CI =& get_instance();
	$page = $post['page']; // get the requested page
	$limit = $post['rows']; // get how many rows we want to have into the grid
	$sidx = $post['sidx']; // get index row - i.e. user click to sort
	$sord = $post['sord']; // get the direction
	if(!$sidx) $sidx =1;
     
	// mysql_select_db($database) or die("Error conecting to db.");
	// $result = mysql_query("SELECT COUNT(*) AS count FROM jobs");

        $res=$CI->db->query($query);
        // $result=$res->result_array();

	// $row = mysql_fetch_array($result,MYSQL_ASSOC);
	$count = $res->num_rows();

	if( $count >0 ) {
		$total_pages = ceil($count/$limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if($start<1){ $start=0; }

        // $SQL = "SELECT * FROM jobs ORDER BY $sidx $sord LIMIT $start , $limit";
	// $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
     $sql2=$query." ORDER BY $sidx $sord LIMIT $start , $limit";
        $res2=$CI->db->query($sql2);
        $result=$res2->result_array();

	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
        $responce->db_data=$result;

        // print_r($responce); die;
        return $responce;
    }

    
}

?>
