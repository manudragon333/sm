<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students extends CI_Controller {

    var $ci_user_id;
    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model(array('staff_model','students_model','office_model','users_model'));
        $userObj=$this->session->userdata('user_details');
        if($userObj){
            $this->ci_user_id=$userObj->id;
            $student_data=$this->students_model->get_user_details($this->ci_user_id);
            $this->session->set_userdata('student_data',$student_data);
        }
    }
    
    public function index()
    {
        $data["notice_board"]=$this->students_model->get_notice_board();
        $data['content_page']='students/home';
        $this->load->view('common/base_template',$data);
    }

    function my_office(){
        
        $data['content_page']='students/my_office';
        $this->load->view('common/base_template',$data);
    }

    function apply_idcard(){
        if($this->input->post()){
            if($data=$this->session->userdata('preview_id_card')){
                $this->my_db_lib->save_record($data,'id_card_applications');
                $this->session->unset_userdata('preview_id_card');
                echo showBigSuccess('<p> ID Card request submitted successfully</p>');
            }
        }else{
            $data['content_page']='students/id_card';
            $this->load->view('common/base_template',$data);
        }
    }

    function preview_apply_idcard(){
        if($this->input->post()){
            $post=$this->input->post();
            $post['user_id']=$this->ci_user_id;
            $this->session->set_userdata('preview_id_card',$post);
            $this->load->view('students/id_card_preview');
        }else{
            redirect('students/apply_idcard');
        }
    }

    function study_certificate(){
        if($this->input->post()){
            if($data=$this->session->userdata('preview_study_certificate')){
                $this->my_db_lib->save_record($data,'study_certi_applications');
                $this->session->unset_userdata('preview_study_certificate');
                echo showBigSuccess('<p> Study Certificate request submitted successfully</p>');
            }
        }else{
            $data['student_data']=$this->students_model->get_user_details($this->ci_user_id);
            $data['content_page']='students/study_certificate';
            $this->load->view('common/base_template',$data);
        }
    }

    function preview_study_certificate(){
        if($this->input->post()){
            $post=$this->input->post();
            $post['user_id']=$this->ci_user_id;
            $data['student_data']=$this->students_model->get_user_details($this->ci_user_id);
            if(empty($data['student_data'])){
                echo showBigSuccess('<div class=""> Please Fill your profile details in My Record.</div>');
                return true;
            }
            // Check if student is 1 Year + in the college.
//            $present_date=new DateTime(date('Y-m-d'));
//            $joining_date=new DateTime($data['student_data'][0]->doj);
//            $duration=$joining_date->diff($present_date);
//            if($duration->y<1){
//                echo '<br/><div> Study certificates will be issued only after 1 year of joining.</div>';
//                return true;
//            }
            $data['student_data']=(array)$data['student_data'][0];
            $this->session->set_userdata('preview_study_certificate',$post);
            $this->load->view('students/study_certificate_preview',$data);
        }else{
            redirect('students/study_certificate');
        }
    }

    function conduct_certificate(){
//        if(isset($_POST) && count($_POST)>0){
//            $post=$this->input->post();
//            if($this->session->userdata('user_id')){
//                $user_id = $this->session->userdata('user_id');
//                $post['user_id'] = $user_id[0];
//            }
//            $result=$this->students_model->check_conduct($user_id[0]);
//            if($result>0){
//                echo 0;
//            }else{
//                $this->students_model->save_conduct($post);
//                echo 1;
//            }

        if($this->input->post()){
            if($data=$this->session->userdata('preview_conduct_certificate')){
                $this->my_db_lib->save_record($data,'conduct_applications');
                $this->session->unset_userdata('preview_conduct_certificate');
                echo showBigSuccess('<p> Conduct Certificate request submitted successfully</p>');
            }
        }else{
            $data['content_page']='students/conduct_certificate';
            $this->load->view('common/base_template',$data);
        }
    }

    function preview_conduct_certificate(){
        if($this->input->post()){
            $post=$this->input->post();
            $post['user_id']=$this->ci_user_id;
            $result=$this->students_model->check_conduct($this->ci_user_id);
            if($result>0){
                echo showBigError('<div> You already applied for Conduct Certificate.  Please contact the office for further reference.</div>');
                return true;
            }

            $data['student_data']=$this->students_model->get_user_details($this->ci_user_id);
            if(empty($data['student_data'])){
                echo showBigError('<div> Please Fill your profile details in My Record.</div>');
                return true;
            }
            $data['student_data']=(array)$data['student_data'][0];
            $this->session->set_userdata('preview_conduct_certificate',$post);
            $this->load->view('students/conduct_certificate_preview',$data);
        }else{
            redirect('students/conduct_certificate');
        }
    }

    function transfer_certificate(){
        if($this->input->post()){
            $post=$this->input->post();
            if($this->session->userdata('user_id')){
                $user_id = $this->session->userdata('user_id');
                $post['user_id'] = $user_id;
            }
            $result=$this->students_model->check_tc($user_id);
            if($result>0){
                echo 0;
            }else{
                $this->students_model->save_tc($post);
                echo 1;
            }
//            if($data=$this->session->userdata('preview_tc')){
//                $this->my_db_lib->save_record($data,'tc_applications');
//                $this->session->unset_userdata('preview_tc');
//                echo '<br/><p> Transfer Certificate request submitted successfully.</p>';
//            }
        }else{
            $data['content_page']='students/transfer_certificate';
            $this->load->view('common/base_template',$data);
        }
    }

    function transfer_certificateXXX(){
//        if(isset($_POST) && count($_POST)>0){
//            $post=$this->input->post();
//            if($this->session->userdata('user_id')){
//                $user_id = $this->session->userdata('user_id');
//                $post['user_id'] = $user_id[0];
//            }
//            $result=$this->students_model->check_tc($user_id[0]);
//            if($result>0){
//                echo 0;
//            }else{
//                $this->students_model->save_tc($post);
//                echo 1;
//            }
        if($this->input->post()){
            if($data=$this->session->userdata('preview_tc')){
                $this->my_db_lib->save_record($data,'tc_applications');
                $this->session->unset_userdata('preview_tc');
                echo showBigSuccess('<p> Transfer Certificate request submitted successfully.</p>');
            }
        }else{
            $data['content_page']='students/transfer_certificate';
            $this->load->view('common/base_template',$data);
        }
    }

    function preview_tc(){
        if($this->input->post()){
            $post=$this->input->post();
            $post['user_id']=$this->ci_user_id;
            $result=$this->students_model->check_tc($this->ci_user_id);
            if($result>0){
                echo showBigError('<div> You already applied for Transfer Certificate.  Please contact the office for further reference.</div>');
                return true;
            }

            $data['student_data']=$this->students_model->get_user_details($this->ci_user_id);
            if(empty($data['student_data'])){
                echo showBigError('<div> Please Fill your profile details in My Record.</div>');
                return true;
            }
            $data['student_data']=(array)$data['student_data'][0];
            $this->session->set_userdata('preview_tc',$post);
            $this->load->view('students/transfer_certificate_preview',$data);
        }else{
            redirect('students/transfer_certificate');
        }
    }

    function bus_pass(){
        if($this->input->post()){
            if($data=$this->session->userdata('preview_bus_pass')){
                $this->my_db_lib->save_record($data,'bus_pass_applications');
                $this->session->unset_userdata('preview_bus_pass');
                echo showBigSuccess('<p> Bus Pass request submitted successfully.</p>');
            }
        }else{
            $data['content_page']='students/bus_pass';
            $this->load->view('common/base_template',$data);
        }
    }

    function preview_bus_pass(){
        if($this->input->post()){
            $post=$this->input->post();
            $post['user_id']=$this->ci_user_id;

            $this->session->set_userdata('preview_bus_pass',$post);
            $this->load->view('students/bus_pass_preview');
        }else{
            redirect('students/bus_pass');
        }
    }

    function no_due(){
        if(isset($_POST) && count($_POST)>0){
            $post=$this->input->post();
            if($this->session->userdata('user_id')){
                $user_id = $this->session->userdata('user_id');
                $post['user_id'] = $user_id;
            }
            if($post['no_due']=='1'){
                $result=$this->students_model->check_no_due($user_id);
                if($result>0){
                    echo 0;
                }else{
                    $approver_ids=array();
                    $student_data=$this->session->userdata('student_data');
                    // $hods=$this->students_model->get_branch_hods($student_data[0]->branch_id);
                    $hods=$this->students_model->get_users_of_type('3');
                    $librarians=$this->students_model->get_users_of_type('4');
                    $office_incharges=$this->students_model->get_users_of_type('7');
                    $approver_ids[]=$principal_id=18; // CHECK THIS.......
                    foreach($hods as $k=>$v){ $approver_ids[]=$v['id']; }
                    foreach($librarians as $k=>$v){ $approver_ids[]=$v['id']; }
                    foreach($office_incharges as $k=>$v){ $approver_ids[]=$v['id']; }
                    $this->db->trans_start();
                    $app_id=$this->students_model->save_no_due($post);
                    $save_data['application_id']=$app_id;
                    foreach($approver_ids as $k=>$v){
                        $save_data['approver_id']=$v;
                        $this->students_model->send_approval_requests($save_data);
                    }
                    $this->db->trans_complete();
                    echo 1;
                }
            }else{
                $data['data']=$this->students_model->get_no_due($user_id);
                $this->load->view('students/no_due_preview',$data);
            }
        }else{
            $data['content_page']='students/no_due';
            $this->load->view('common/base_template',$data);
        }
    }

    function preview_no_due(){
        $user_id = $this->session->userdata('user_id');
        $student_data=$this->session->userdata('student_data');
        $view_data['data']=$student_data;
        $view_data['nodue_data']=$this->students_model->get_no_due($user_id);
        $this->load->view('prints/no_due',$view_data);
    }

    function my_record(){
    /*    if($this->session->userdata('user_id')){
            // $user_id_arr = $this->session->userdata('user_id');
            $user_id = $this->session->userdata('user_id');
            // echo $user_id;
            $data['student_details']=$this->students_model->get_user_details($user_id);
            $data['content_page']='students/my_record';
            $this->load->view('common/base_template',$data);
            
        }
    */
if($this->session->userdata('user_id')){
            
            $user_id = $this->session->userdata('user_id');
            // echo $user_id;
            //$data['student_details']=$this->students_model->get_user_details($user_id);
            $data['student_details']=$this->office_model->get_student_ledger_profile($user_id);
            $data['payment_details']=$this->office_model->get_student_finances($user_id);

            $data['content_page']='students/my_record1';
            $this->load->view('common/base_template',$data);
    }
}
    function study_abroad(){
        $data['content_page']='students/study_abroad';
        $this->load->view('common/base_template',$data);
    }

    function placement(){
        $data['notice_board']=$this->students_model->get_placement_news();
        $data['content_page']='students/placement';
        $this->load->view('common/base_template',$data);
    }

    function job_alerts(){
        $data['content_page']='students/placement_alert';
        $this->load->view('common/base_template',$data);
    }

    function upload_resume(){
        $data['content_page']='students/placement_resume';
        $this->load->view('common/base_template',$data);
    }

    function library(){
        $data['content_page']='library/library_books';
        $this->load->view('common/base_template',$data);
    }

    function reserved_books(){
        $data['content_page']='library/reserved_books';
        $this->load->view('common/base_template',$data);
    }
    
    function fill_student_data(){
        if($this->input->post()){
            $post=$this->input->post();
            $data=$this->students_model->get_student_details($post['student_number']);
            // print_r($data);
            echo json_encode($data);
        }
    }


    function time_table(){
        $student_data=$this->session->userdata('student_data');
        if(isset($student_data[0]->branch_id) && isset($student_data[0]->present_year)){
            $post['branch_id']=$student_data[0]->branch_id;
            $post['year']=$student_data[0]->present_year;
            $this->load->model('staff_model');
            $data=$this->staff_model->get_student_time_table($post);
            $rows=array();
            if(count($data)>0){
                foreach($data as $k=>$v){
                    $rows[$v['day_id']]=$v; // IMP as rows in the DOM are as per day_id index so taking the same.
                }
            }
            $view_data['days']=$this->staff_model->get_time_table_days();
            $view_data['data']=$rows;
            $view_data['content_page']='students/time_table';
            $this->load->view('common/base_template',$view_data);
        }
    }



    function check_library_returns(){
        $this->load->model('library_model');
        $result=$this->library_model->check_library_returns($this->ci_user_id);
        if(count($result)>0){
            $msg='<ul style="margin-left:50px;">';
            $sms='';
            foreach ($result as $k=>$v){
                $msg.='<li> '.$v['name'].'( '.$v['unique_number'].' ) </li>';
                $sms.=$v['name'].'( '.$v['unique_number'].' ). ';
            }
            $msg.='</ul>';
            if($this->session->userdata('sent_library_return')){
                // Nothign
            }else{
                $student_data=$this->session->userdata('student_data');
                $this->sms_lib->send_sms($student_data[0]->mobile,'Library books to submit: '.$sms);
                $this->session->set_userdata('sent_library_return',true);
            }
            echo $msg;
        }else{
            echo 0;
        }
//        print_r($result);
//        return $result;
    }


    function exam_marks(){
        $view_data['student_semesters']=$this->students_model->get_student_semesters($this->ci_user_id);
        $view_data['content_page']='students/exam_marks';
        $this->load->view('common/base_template',$view_data);
    }


    function marks_view(){
        $post=$this->input->post();
        if($post && !empty($post['semester_id'])){
            $student_data=$this->session->userdata('student_data');
            //echo '<pre>'; print_r($student_data); echo '</pre>';
            $view_data->student_data=$student_data[0];
            $view_data->student_marks=$this->students_model->get_student_marks($student_data[0]->user_id,$post['semester_id']);
            $this->load->view('students/marks_view',$view_data);
        }
    }

    function attendance(){
        $view_data['student_semesters']=$this->students_model->get_student_semesters($this->ci_user_id);
        $view_data['content_page']='students/attendance';
        $this->load->view('common/base_template',$view_data);
    }

    function get_attendance(){
        $post=$this->input->post();
        if($post && !empty($post['semester_id'])){
            $student_data=$this->session->userdata('student_data');
            //echo '<pre>'; print_r($student_data); echo '</pre>';
            $view_data->student_data=$student_data[0];
            $view_data->student_attendance=$this->students_model->get_student_attendance($student_data[0]->user_id,$post['semester_id']);
            $this->load->view('students/attendance_view',$view_data);
        }
    }

    function view_assignments(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select a.*,b.name as branch_name, s.name as sem_name from assignments as a
                    left join branches as b on b.id=a.branch_id
                    left join semisters as s on s.id=a.sem_id
                    where a.status='1' ";

            // $user_details=$this->session->userdata('user_details');
            if($student_data=$this->session->userdata('student_data')){
                // print_r($student_data);
                $sql.=" and a.branch_id='".$student_data[0]->branch_id."'  and a.sem_id='".$student_data[0]->sem_id."' ";
            }

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $view_submissions='<a href="'.site_url('students/submit_assignment').'/'.urlencode(base64_encode($v['id'])).'">Submit Assignment</a>';
                    $link="<a href='".base_url()."uploads/".$v['doc_link']."' target='_blank'>Link</a>";
                    $data->rows[$i]['cell']=array(dateFormat($v['date_added']),$v['branch_name'],$v['sem_name'],$v['subject'],$v['instructions'],$link,$v['max_marks'],  dateFormat($v['last_date'], 'Y-m-d'),$view_submissions);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='students/view_assignments';
            $this->load->view('common/base_template',$data);
        }
    }

    function submit_assignment($enc_id=0){
        $enc_id=urldecode($enc_id);
        if($enc_id && base64_decode($enc_id) && is_numeric(base64_decode($enc_id))){
            $id=base64_decode($enc_id);
            if($this->input->post()){
                $student_data=$this->session->userdata('student_data');
                // print_r($student_data); die;
                $post=$this->input->post();
                $filter_post['user_id']=$student_data[0]->user_id;
                $filter_post['assignments_id']=$id;
                $filter_post['doc_link']=$post['doc_link'];
                $filter_post['student_replies']=$post['student_replies'];
                $this->my_db_lib->save_record($filter_post,'assignment_submissions');
                echo showBigSuccess('<p>Assignment Submitted Successfully.</p>');
            }else{
                $view_data['enc_id']=$enc_id;
                $view_data['content_page']='students/submit_assignment';
                $this->load->view('common/base_template',$view_data);
            }


            
        }
    }

    function view_library_pdfs(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select a.*,b.name as branch_name, s.name as sem_name from library_pdfs as a
                    left join branches as b on b.id=a.branch_id
                    left join semisters as s on s.id=a.sem_id
                    where a.status='1' ";

            // $user_details=$this->session->userdata('user_details');
            if($student_data=$this->session->userdata('student_data')){
                // print_r($student_data);
                $sql.=" and a.branch_id='".$student_data[0]->branch_id."'  and a.sem_id='".$student_data[0]->sem_id."' ";
            }

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $view_submissions='<a href="'.site_url('students/library_pdfs_discussions').'/'.urlencode(base64_encode($v['id'])).'">View Discussions</a>';
                    $link="<a href='".base_url()."uploads/".$v['doc_link']."' target='_blank'>Link</a>";
                    $data->rows[$i]['cell']=array(dateFormat($v['date_added']),$v['branch_name'],$v['sem_name'],$v['instructions'],$link,$view_submissions);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='students/view_library_pdfs';
            $this->load->view('common/base_template',$data);
        }
    }

    function library_pdfs_discussions($enc_id=0){
        $enc_id=urldecode($enc_id);
        if($enc_id && base64_decode($enc_id) && is_numeric(base64_decode($enc_id))){
            $id=base64_decode($enc_id);
            if($this->input->post() && $this->input->post('comment')){
                $student_data=$this->session->userdata('student_data');
                $post=$this->input->post();
                $post['library_pdf_id']=$id;
                $ci_user_details=$this->session->userdata('user_details');
                if($ci_user_details->users_type_id==3 || $ci_user_details->users_type_id==2){
                    $post['user_id']=$ci_user_details->id;
                }else{
                    $post['user_id']=$student_data[0]->user_id;
                }
                $this->my_db_lib->save_record($post,'library_pdf_discussions');
                echo '<script type="text/javascript"> window.location.reload(); </script>';
                return;
            }
            $data['enc_id']=urlencode($enc_id);
            $data['discussions']=$this->students_model->get_library_pdfs_discussions($id);
            $data['content_page']='students/library_pdfs_discussions';
            $this->load->view('common/base_template',$data);
        }else{
            redirect('students/view_library_pdfs');
        }
    }

    function videos()
    {
        $data["notice_board"]=$this->students_model->get_videos();
        $data['content_page']='students/videos';
        $this->load->view('common/base_template',$data);
    }

    /********************* Select boxes ***********************/

    function  getCollegeCourses($college_id=0){
        $options='<option value="">Select</option>';
        $options.=load_select('courses',0,array('status'=>'1','college_id'=>$college_id));
        echo $options;
    }
    function  getCollegeBranches($college_id=0){
        $options='<option value="">Select</option>';
        $options.=load_select('branches',0,array('status'=>'1','college_id'=>$college_id,'course_id'=>$this->input->post('course_id')));
        echo $options;
    }
    function  getCollegeSemesters($college_id=0){
        $options='<option value="">Select</option>';
        $options.=load_select('semisters',0,array('status'=>'1','college_id'=>$college_id,'branch_id'=>$this->input->post('branch_id')));
        echo $options;
    }
    function  getCollegeSubjects($college_id=0){
        $options='<option value="">Select</option>';
        $options.=load_select('subjects',0,array('status'=>'1','college_id'=>$college_id,'semister_id'=>$this->input->post('semister_id')));
        echo $options;
    }

    /********************* Select boxes END ***********************/



    function student_attendance(){
        if($this->input->post()){
            $post=$this->input->post();
            if(empty($post['cycle_id'])){
                redirect('students/student_attendance');
            }
            $data=$post;
            $ci_user_details=$this->session->userdata('user_details');
            // print_r($ci_user_details);
            $data['user_id']=$ci_user_details->id;
            $this->load->model('admin_model');
            $data['weekdays']=$this->admin_model->getWeekdays();
            $data['cycle_periods']=$this->admin_model->getCyclePeriods($post['cycle_id']);
            $data['students_periods']=$this->admin_model->getStudentPeriods($ci_user_details->id,$post['cycle_id']);

            $data['content_page']='students/student_attendance';
            $this->load->view('common/base_template',$data);
        }else{
            $data['content_page']='students/attendance_cycle';
            $this->load->view('common/base_template',$data);
        }
    }


    /*
     * View Exam Results
     */

    function view_results(){
        $post=$this->input->post();
        $student_data=$this->session->userdata('student_data');
        if($post){
//            echo '<pre>'; print_r($student_data); echo '</pre>';

            $post['user_id']=$student_data[0]->user_id;

            $this->load->model('exam_model');
            $data['internal_marks']=$this->exam_model->getStudentsInternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
            $data['external_marks']=$this->exam_model->getStudentsExternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);

//            echo '<pre>'; print_r($data); echo '</pre>';
            $data['form_data']=$post;
            $data['form_data']['student_number']=$student_data[0]->students_number;
            $data['form_data']['is_mba']=((isset($data['internal_marks'][0]->is_mba))?$data['internal_marks'][0]->is_mba:0);
            $data['form_data']['view_only']=true;
            $data['content_page']='students/view_results';
            $this->load->view('common/base_template',$data);
        }else{
            
            
            $data['form_data']=(array) $student_data[0];
            $data['content_page']='students/view_results';
            $this->load->view('common/base_template',$data);
        }

    }


    function downloadReport(){
        $excelData=$this->session->userdata('excelData');
        // echo 'MMJ'; print_r($this->session);
        if(!empty($excelData)){
            $this->_downloadExcel($excelData);
        }
    }

    function _downloadCsv($array=array()){
        $sampleArray=array(
            array('Column 1','Column 2'),
            array('Column CC 1','Column CC 2'),
            array('Column CC 3','Column CC 3')
        );
        if(!empty($array)){
            $fileContents='';
            foreach ($array as $key => $value) {
                $fileContents.=implode(',', $value)."\n";
            }

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=MyCollege Report.csv');
            echo $fileContents;
        }
    }

    function _downloadExcel($array=array()){

        $sampleArray=array(
            array('Column 1','Column 2'),
            array('Column CC 1','Column CC 2'),
            array('Column CC 3','Column CC 3')
        );

        error_reporting(0);
        // error_reporting(E_ALL);
        // ini_set('display_errors','1');
        $this->load->library('Exellmanager');
        $workbook = Exellmanager::getInstance();

        // HeaderingExcel('Report.xls');
        header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=Report.xls");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	header("Pragma: public");

    // Creating a workbook
        $workbook = new Workbook("-");
        $worksheet = & $workbook->add_worksheet('Report Details');


        $header = & $workbook->add_format();
        $header->set_size(10);
        $header->set_bold(1);
        $header->set_align('left');
        $header->set_color('black');
        $header->set_left(1);
        $header->set_right(1);


        $color1 = & $workbook->set_custom_color(41, 176, 214, 241);
        $h = & $workbook->add_format(array('fg_color' => $color1, 'pattern' => 1, 'border' => 0));
        $h->set_size(10);
        $h->set_align('center');
        $h->set_color('black');
        $h->set_bold(1);
        $h->set_left(1);
        $h->set_right(1);
        $h->set_bottom(1);

        ////setting worksheet columns
        $worksheet->set_column(0, 0, 30);
        $worksheet->set_column(0, 1, 30);
        $worksheet->set_column(0, 2, 30);
        $worksheet->set_column(0, 3, 30);
        $worksheet->set_column(0, 4, 30);
        $worksheet->set_column(0, 5, 30);
        $worksheet->set_column(0, 6, 30);

        $col = 0;
        $row = 0;

        if(!empty($array)){
            foreach ($array as $key => $value) {
                foreach($value as $k=>$v){
                    if($key=='0'){
                        $worksheet->write_string($row, $col++, $v, $h);
                    }else{
                        $worksheet->write_string($row, $col++, $v, $header);
                    }
                }
                $row++;
                $col=0;
            }
        }

        $workbook->close();
    }




}

?>