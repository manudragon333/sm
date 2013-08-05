<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam extends CI_Controller {

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model(array('students_model','exam_model'));
        $this->request_counts();
    }

    public function index()
    {
        $data['content_page']='exam/home.php';
        $this->load->view('common/base_template',$data);
    }
    
    function print_request(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select q.*,s.name as subject,br.name as branch_name, u.username from question_papers as q
                left join users as u on q.user_id=u.id
                left join branches as br on q.branch=br.id
                left join subjects as s on s.id=q.subject_id
                where q.is_approved='1' and q.to_print='1' and q.is_printed!='1' and is_principal_approved='1'";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $is_approved='<a href="javascript:void(0)" onclick="javascript:flag_printed(\''.$v['id'].'\')" title="Set the paper as printed and close.">Close</a>';
                    $link="<a href='".base_url()."uploads/".$v['doc_link']."' target='_blank' title='Click to download the document.'>Link</a>";
                    $data->rows[$i]['cell']=array($v['username'],$v['students_count'],$v['branch_name'],$v['year'],$v['subject'],$v['exam_number'],$link,$is_approved);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='exam/print_request';
            $this->load->view('common/base_template',$data);
        }
    }

    function flag_paper_printed(){
        if($this->input->post()){
            $post=$this->input->post();
            $post['is_printed']='1';
            $this->my_db_lib->save_record($post,'question_papers');
            echo 1;
        }
    }
    
    function student_data(){
        $data['content_page']='exam/student_data';
        $this->load->view('common/base_template',$data);
    }
    
    function browse_q_papers(){
        $data['content_page']='staff/browse_q_papers';
        $this->load->view('common/base_template',$data);
    }


    function sendmsg(){
        if($this->input->post()){
            $post=$this->input->post();
            $post['user_id']=$this->session->userdata('user_id');
            if($post['choice2']=='1'){
                // Group
                $data=$this->students_model->get_students_by_year($post['choice3']);
            }else if($post['choice2']=='2'){
                // individual
                $data=$this->students_model->get_student_details($post['student_number']);
            }
            if(count($data)){
                $this->load->library(array('my_email_lib'));
                foreach($data as $k=>$v){
                    if($post['choice']=='1'){// Email
                        $this->my_email_lib->html_email($v->email,$from='noreply@mycollege.goendeavor.com',$subject='My College',$post['message']);
                    }else{// Sms
                        $this->sms_lib->send_sms($v->mobile,$post['message']);
                    }
                }
            }
            $this->my_db_lib->save_record($post,'send_student_messages');
        }else{
            $data['content_page']='exam/sendmsg';
            $this->load->view('common/base_template',$data);
        }
    }
    function email(){
        redirect('exam'); die;
        $data['content_page']='exam/email';
        $this->load->view('common/base_template',$data);
    }

    function results(){
        if($post=$this->input->post()){
            echo '<p> Comming Soon.. </p>';
        }else{
            $data['content_page']='exam/results';
            $this->load->view('common/base_template',$data);
        }
    }

    function request_counts(){
        $counts=array();

        $sql="select q.*,br.name as branch_name, u.username from question_papers as q
                left join users as u on q.user_id=u.id
                left join branches as br on q.branch=br.id
                where q.is_approved='1' and q.to_print='1' and q.is_printed!='1' and is_principal_approved='1'";
        $counts['prints']=$this->exam_model->get_request_counts($sql);
        
        $this->session->set_userdata('request_counts',$counts);
    }

    
    function post_exam_results(){
        $this->load->model('staff_model');
        $post=$this->input->post();
        if($post){
            if(isset($post['user_id']) && isset($post['student_marks'])){
                /*
                 * Student Marks Submitted
                 */
                foreach($post['student_marks'] as $k_subject_id=>$value){

                    $saveMarksPost=$post;
//                    print_r($value);
//                    print_r($post); die;
                    $saveMarksPost['subject_id']=$k_subject_id;
                    
                    $saveMarksPost['external_marks']=$value['external_marks'];
                    $saveMarksPost['average_marks']=$value['average_marks'];
                    $saveMarksPost['final_marks']=$value['average_marks']+$value['external_marks'];
                    
                    $passMarks=($value['subject_type_id']=='1')?40:30;
                    $saveMarksPost['pass']=($saveMarksPost['final_marks']>=$passMarks)?'1':'0';
                    $saveMarksPost['credits']=($saveMarksPost['final_marks']>=$passMarks)?$value['max_credits']:0;

                    if(!empty($value['this_db_id']) && $post['mode_of_exam_id']=='2'){
                        // Make Status 0 for Previous record and below saveRecord will create a new record
                        $inactiveMarksPost['id']=$value['this_db_id'];
                        $inactiveMarksPost['status']='0';
                        $this->general_model->saveRecord($inactiveMarksPost,'student_external_marks');
                    }

                    $this->general_model->saveRecord($saveMarksPost,'student_external_marks');

                        
                }
                $this->session->set_flashdata('success_msg', 'Marks registered Successfully.');
                redirect('exam/post_exam_results');
                
            }else if(isset($post['user_id'])){
                /*
                 * Student Add/View/Edit Button Clicked
                 */
//                $viewData['subject_data']=$this->exam_model->getSubjectData($post['subject_id']);
                $viewData['internal_marks']=$this->exam_model->getStudentsInternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
                $viewData['external_marks']=$this->exam_model->getStudentsExternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
                $viewData['s_data']=$post;
//                echo '<pre>'; print_r($viewData); echo '</pre>';
                $viewData['content_page']='exam/post_exam_results';
                $this->load->view('common/base_template',$viewData);
            }else{
                /*
                 * Check for studnet Marks in DB and show filled readonly OR Empty Form.
                 */

                /*
                 * PLZ CLEAN BELOW DATA.. SOME OF BELOW CODE IS UNNECESSARY.
                 */
                if($post['mode_of_exam_id']=='2'){
                    $students_data=$this->staff_model->getFailedStudents($post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],$post['section_id']);
                }else{
                    $students_data=$this->staff_model->getStudents($post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],$post['section_id']);
                }
//                $student_marks_data=$this->exam_model->getStudentsExternalMarks($post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id']);
                $student_marks=array();
//                if(!empty($student_marks_data)){
//                    // print_r($student_marks_data);
//                    foreach ($student_marks_data as $key => $value) {
//                        $student_marks[$value->user_id][$value->internal_number]['objective']=$value->objective;
//                        $student_marks[$value->user_id][$value->internal_number]['descriptive']=$value->descriptive;
//                        $student_marks[$value->user_id][$value->internal_number]['assignment']=$value->assignment;
//                    }
//                }
//                print_r($students_data);
                $viewData['students_data']=$students_data;
                $viewData['student_marks']=$student_marks;
                $viewData['s_data']=$post;

                $viewData['content_page']='exam/post_exam_results';
                $this->load->view('common/base_template',$viewData);
            }
        }else{
            $data['content_page']='exam/post_exam_results';
            $this->load->view('common/base_template',$data);
        }
    }

    function exam_report(){
        $post=$this->input->post();
        if($post){
            
        }else{
            $data['content_page']='exam/exam_report';
            $this->load->view('common/base_template',$data);
        }
    }
    
    function report_failed_students($downloadExcel=false,$serializedPost=''){
        $post=$this->input->post();
        if($downloadExcel=='true' && empty($post)){
            $post=unserialize(urlsafe_b64decode($serializedPost));
        }
        if($post){
            $sqlXXX="
                SELECT sr.*,ss.semister_id,sem.average_marks,sem.external_marks,sub.name as subject

                FROM student_records AS sr
                LEFT JOIN users as u ON u.id=sr.user_id
                LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'
                LEFT JOIN student_external_marks AS sem ON (sem.user_id=u.id and sem.status='1')
                LEFT join subjects as sub on sub.id=sem.subject_id";
            $sql="
                SELECT sr.students_number,sub.name AS subject,ss.semister_id,sem.average_marks,
                        sem.external_marks,sub.name as subject,sem.pass

                    FROM student_external_marks AS sem
                    LEFT JOIN student_records AS sr ON sr.user_id=sem.user_id
                    LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'
                    LEFT JOIN users as u ON u.id=sr.user_id
                    LEFT JOIN subjects AS sub ON sub.id=sem.subject_id

                WHERE sr.college_id='".$post['college_id']."' 
                ";
                if(!empty($post['course_id'])){
                    $sql.="AND sr.course_id='".$post['course_id']."'  ";
                }
                if(!empty($post['branch_id'])){
                    $sql.="AND sr.branch_id='".$post['branch_id']."' ";
                }
                if(!empty($post['semister_id'])){
                    $sql.="AND sem.semister_id='".$post['semister_id']."' ";
                }
                if(!empty($post['subject_id'])){
                    $sql.="AND sem.subject_id='".$post['subject_id']."' ";
                }
                if(!empty($post['academic_year_id'])){
                    // $sql.="AND sem.academic_year_id='".$post['academic_year_id']."' ";
                }
                $sql.="
                AND sr.status='1' AND sem.status='1' AND u.status='1'
                AND sem.pass='0'

                # GROUP BY u.id
                ORDER BY sr.students_number ASC
            ";
//                echo $sql;
            $res=$this->db->query($sql);
            $students_data=$res->result();
//            print_r($students_data);
            $data['s_data']=$post;
            $data['students_data']=$students_data;
            if($downloadExcel=='true'){
                $excelData=array();
                if(!empty($students_data)){
                    $excelData=array(array(
                        'Student','Subject','Avg Marks','External Marks'
                    ));
                    foreach ($students_data as $key => $value) { $excelDataRow=array();
                        $excelDataRow[]=$value->students_number;
                        $excelDataRow[]=$value->subject;
                        $excelDataRow[]=$value->average_marks;
                        $excelDataRow[]=$value->external_marks;
                        array_push($excelData, $excelDataRow);
                    }
                }
                if(!empty($excelData)){
                    $this->_downloadExcel($excelData);
                }
            }else{
                $data['content_page']='exam/report_failed_students';
                $this->load->view('common/base_template',$data);
            }
        }else{
            $data['content_page']='exam/report_failed_students';
            $this->load->view('common/base_template',$data);
        }
    }

    function report_marks($downloadExcel=false,$serializedPost=''){
        $post=$this->input->post();
        if($downloadExcel=='true' && empty($post)){
            $post=unserialize(urlsafe_b64decode($serializedPost));
        }
        if($post){
            $sql="
                SELECT sr.students_number,sub.name AS subject,sem.final_marks,sem.average_marks,sem.external_marks

                    FROM student_external_marks AS sem
                    LEFT JOIN student_records AS sr ON sr.user_id=sem.user_id
                    LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'
                    LEFT JOIN users as u ON u.id=sr.user_id
                    LEFT JOIN subjects AS sub ON sub.id=sem.subject_id

                    WHERE 1
                    AND sr.college_id='".$post['college_id']."'
                ";
                if(!empty($post['course_id'])){
                    $sql.="AND sr.course_id='".$post['course_id']."'  ";
                }
                if(!empty($post['branch_id'])){
                    $sql.="AND sr.branch_id='".$post['branch_id']."' ";
                }
                if(!empty($post['semister_id'])){
                    $sql.="AND sem.semister_id='".$post['semister_id']."' ";
                }
                if(!empty($post['subject_id'])){
                    $sql.="AND sem.subject_id='".$post['subject_id']."' ";
                }

                if(!empty($post['academic_year_id'])){
                    // $sql.="AND sem.academic_year_id='".$post['academic_year_id']."' ";
                }

                if(!empty($post['option']) && $post['option']=='1'){
                    $sql.="AND sem.final_marks>=60 ";
                }else if(!empty($post['option']) && $post['option']=='2'){
                    $sql.="AND sem.final_marks<=50 ";
                }

                $sql.="
                    AND sem.pass!='0'
                    AND sem.status='1'
                    AND sr.status='1' AND u.status='1'

                    ORDER BY sr.students_number ASC
            ";
            $res=$this->db->query($sql);
            $students_data=$res->result();
//            print_r($students_data);
            $data['s_data']=$post;
            $data['students_data']=$students_data;
            if($downloadExcel=='true'){
                $excelData=array();
                if(!empty($students_data)){
                    $excelData=array(array(
                        'Student','Subject','Avg Marks','External Marks','Final Marks'
                    ));
                    foreach ($students_data as $key => $value) { $excelDataRow=array();
                        $excelDataRow[]=$value->students_number;
                        $excelDataRow[]=$value->subject;
                        $excelDataRow[]=$value->average_marks;
                        $excelDataRow[]=$value->external_marks;
                        $excelDataRow[]=$value->final_marks;
                        array_push($excelData, $excelDataRow);
                    }
                }
                if(!empty($excelData)){
                    $this->_downloadExcel($excelData);
                }
            }else{
                $data['content_page']='exam/report_marks';
                $this->load->view('common/base_template',$data);
            }
        }else{
            $data['content_page']='exam/report_marks';
            $this->load->view('common/base_template',$data);
        }
    }

    function five_backlogs($downloadExcel=false,$serializedPost=''){
        $post=$this->input->post();
        if($downloadExcel=='true' && empty($post)){
            $post=unserialize(urlsafe_b64decode($serializedPost));
        }
        if($post){
            $sql="
                SELECT sr.students_number,count(sr.students_number) as number_of_backlogs,group_concat(sub.name) AS subject

                    FROM student_external_marks AS sem
                    LEFT JOIN student_records AS sr ON sr.user_id=sem.user_id
                    LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'
                    LEFT JOIN users as u ON u.id=sr.user_id
                    LEFT JOIN subjects AS sub ON sub.id=sem.subject_id

                    WHERE 1
                    AND sr.college_id='".$post['college_id']."'
                ";
                if(!empty($post['course_id'])){
                    $sql.="AND sr.course_id='".$post['course_id']."'  ";
                }
                if(!empty($post['branch_id'])){
                    $sql.="AND sr.branch_id='".$post['branch_id']."' ";
                }
                if(!empty($post['semister_id'])){
                    $sql.="AND ss.semister_id='".$post['semister_id']."' ";
                }
                if(!empty($post['subject_id'])){
                    $sql.="AND sem.subject_id='".$post['subject_id']."' ";
                }

                if(!empty($post['academic_year_id'])){
                    $sql.="AND sem.academic_year_id='".$post['academic_year_id']."' ";
                }


                $sql.="
                    AND sem.pass='0'
                    # AND sem.status='1'
                    AND sr.status='1' AND u.status='1'

                    GROUP BY sem.user_id

                    HAVING number_of_backlogs>=5

                    ORDER BY sr.students_number ASC
            ";
            $res=$this->db->query($sql);
            $students_data=$res->result();
//            print_r($students_data);
            $data['s_data']=$post;
            $data['students_data']=$students_data;
            if($downloadExcel=='true'){
                $excelData=array();
                if(!empty($students_data)){
                    $excelData=array(array(
                        'Student','Number Of Backlogs','Subjects'
                    ));
                    foreach ($students_data as $key => $value) { $excelDataRow=array();
                        $excelDataRow[]=$value->students_number;
                        $excelDataRow[]=$value->number_of_backlogs;
                        $excelDataRow[]=$value->subject;
                        array_push($excelData, $excelDataRow);
                    }
                }
                if(!empty($excelData)){
                    $this->_downloadExcel($excelData);
                }
            }else{
                $data['content_page']='exam/five_backlogs';
                $this->load->view('common/base_template',$data);
            }
        }else{
            $data['content_page']='exam/five_backlogs';
            $this->load->view('common/base_template',$data);
        }
    }

    function report_highest_marks($downloadExcel=false,$serializedPost=''){
        $post=$this->input->post();
        if($downloadExcel=='true' && empty($post)){
            $post=unserialize(urlsafe_b64decode($serializedPost));
        }
        if($post){
            $sql="
                SELECT sr.students_number,sub.name AS subject,sem.final_marks,sem.average_marks,sem.external_marks

                    FROM student_external_marks AS sem
                    LEFT JOIN student_records AS sr ON sr.user_id=sem.user_id
                    LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'
                    LEFT JOIN users as u ON u.id=sr.user_id
                    LEFT JOIN subjects AS sub ON sub.id=sem.subject_id

                    WHERE 1
                    AND sr.college_id='".$post['college_id']."'
                ";
                if(!empty($post['course_id'])){
                    $sql.="AND sr.course_id='".$post['course_id']."'  ";
                }
                if(!empty($post['branch_id'])){
                    $sql.="AND sr.branch_id='".$post['branch_id']."' ";
                }
                if(!empty($post['semister_id'])){
                    $sql.="AND ss.semister_id='".$post['semister_id']."' ";
                }
                if(!empty($post['subject_id'])){
                    $sql.="AND sem.subject_id='".$post['subject_id']."' ";
                }

                if(!empty($post['academic_year_id'])){
                    $sql.="AND sem.academic_year_id='".$post['academic_year_id']."' ";
                }


            $sql.="
                    AND sem.pass!='0'
                    AND sem.status='1'
                    AND sr.status='1' AND u.status='1'
                    
                    ORDER BY (sem.average_marks+sem.final_marks) DESC
                    LIMIT 1,10
            ";
            $res=$this->db->query($sql);
            $students_data=$res->result();
//            print_r($students_data);
            $data['s_data']=$post;
            $data['students_data']=$students_data;
            
            if($downloadExcel=='true'){
                $excelData=array();
                if(!empty($students_data)){
                    $excelData=array(array(
                        'Student','Subject','Avg Marks','External Marks'
                    ));
                    foreach ($students_data as $key => $value) { $excelDataRow=array();
                        $excelDataRow[]=$value->students_number;
                        $excelDataRow[]=$value->subject;
                        $excelDataRow[]=$value->average_marks;
                        $excelDataRow[]=$value->external_marks;
                        array_push($excelData, $excelDataRow);
                    }
                }
                if(!empty($excelData)){
                    $this->_downloadExcel($excelData);
                }
            }else{
                $data['content_page']='exam/report_highest_marks';
                $this->load->view('common/base_template',$data);
            }
        }else{
            $data['content_page']='exam/report_highest_marks';
            $this->load->view('common/base_template',$data);
        }
    }


    function report_overall_pass_percentage(){
        $post=$this->input->post();
        if($post){
            $sql="
                SELECT count(sr.students_number) AS number_of_students,sem.pass

                    FROM student_records AS sr
                    LEFT JOIN users as u ON u.id=sr.user_id
                    LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'
                    LEFT JOIN student_external_marks AS sem ON (sem.user_id=u.id and sem.status='1')
                    LEFT join subjects as sub on sub.id=sem.subject_id

                    WHERE 1
                    AND sr.college_id='".$post['college_id']."'
                ";
                if(!empty($post['course_id'])){
                    $sql.="AND sr.course_id='".$post['course_id']."'  ";
                }
                if(!empty($post['branch_id'])){
                    $sql.="AND sr.branch_id='".$post['branch_id']."' ";
                }
                if(!empty($post['semister_id'])){
                    $sql.="AND ss.semister_id='".$post['semister_id']."' ";
                }
                if(!empty($post['subject_id'])){
                    $sql.="AND sem.subject_id='".$post['subject_id']."' ";
                }

                if(!empty($post['academic_year_id'])){
                    $sql.="AND sem.academic_year_id='".$post['academic_year_id']."' ";
                }


                $sql.="
                    AND sem.status='1'
                    AND sr.status='1' AND u.status='1'

                    GROUP BY sem.pass
            ";
            $res=$this->db->query($sql);
            $students_data=$res->result();
//            print_r($students_data);
            $data['s_data']=$post;
            $data['students_data']=$students_data;
            $data['content_page']='exam/report_overall_pass_percentage';
            $this->load->view('common/base_template',$data);
        }else{
            $data['content_page']='exam/report_overall_pass_percentage';
            $this->load->view('common/base_template',$data);
        }
    }

    function downloadThisReport(){
        $excelData=$this->session->userdata('excelData');
        if(!empty($excelData)){
            $this->_downloadCsv($excelData);
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
            header('Content-Disposition: attachment; filename=MyCollege Report.xls');
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





    /*
     * View Exam Results - STUDENT SEARCH
     */

    function view_student_results(){
        $post=$this->input->post();
        
        if($post){
            
            $this->load->model('students_model');
            
            $search_student_number=$post['search_student_number'];
            $search_student_details=$this->students_model->get_student_details($search_student_number);
            $student_user_id=((!empty($search_student_details[0]->user_id))?$search_student_details[0]->user_id:0);
            if($student_user_id){
                $student_data=$this->students_model->get_user_details($student_user_id);
            }else{
                $student_data=false;
            }

            if(!empty($student_data)){
//                echo '<pre>'; print_r($student_data); echo '</pre>';

                $post['user_id']=$student_data[0]->user_id;
                $data['form_data']=$post;
                if(isset($post['semister_id'])){
                    $data['internal_marks']=$this->exam_model->getStudentsInternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
                    $data['external_marks']=$this->exam_model->getStudentsExternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
                }else{
                    $data['form_data']['college_id']=$student_data[0]->college_id;
                    $data['form_data']['course_id']=$student_data[0]->course_id;
                    $data['form_data']['branch_id']=$student_data[0]->branch_id;
                }
//                echo '<pre>'; print_r($data); echo '</pre>';
                $data['form_data']['student_number']=$student_data[0]->students_number;
                $data['student_data']=$student_data[0];
                
//                echo '<pre>'; print_r($data); echo '</pre>';                
            }else{
                $this->session->set_flashdata('error_msg', 'No Student Found with student number <i>'.$search_student_number.'</i>.');
                redirect('exam/view_student_results');
                return true;
            }
            
            $data['form_data']['is_mba']=((isset($data['internal_marks'][0]->is_mba))?$data['internal_marks'][0]->is_mba:0);
            $data['form_data']['view_only']=true;
            if(isset($post['only_results_table'])){
                $this->load->view('exam/view_student_results_table',$data);
            }else{
                $data['content_page']='exam/view_student_results';
                $this->load->view('common/base_template',$data);
            }
        }else{

            $data['content_page']='exam/view_student_results';
            $this->load->view('common/base_template',$data);
        }

    }

    function bulk_post_exam_results(){
        $post=$this->input->post();
        if($post && $post['doc_link']){

            $this->load->model('students_model');
            $this->load->library('csv_reader');
            
            $file_path=FCPATH.'uploads/'.$post['doc_link'];
            $csv_contents=$this->csv_reader->parse_file($file_path);

            // echo '<pre>'; print_r($csv_contents); echo '</pre>';

            // echo '<pre>'; print_r($post); echo '</pre>';

            $logMsg='';
            $errorMsg='';
            if(!empty($csv_contents)){
                $subject_name=generalId('name','subjects','id',$post['subject_id']);
                $subject_type_id=generalId('subject_type_id','subjects','id',$post['subject_id']);
                $subject_max_credits=generalId('credits','subjects','id',$post['subject_id']);

                if(array_key_exists('STUDENT NUMBER', $csv_contents[0]) && array_key_exists('AVERAGE MARKS', $csv_contents[0]) && array_key_exists('MARKS AWARDED', $csv_contents[0])){
                    foreach ($csv_contents as $key => $value) {
                        $search_student_number=$value['STUDENT NUMBER'];
                        $average_marks=$value['AVERAGE MARKS'];
                        $marks_awarded=$value['MARKS AWARDED'];

                        /* GET STUDENT DETAILS FROM STUDENT NUMBER */
                        $search_student_details=$this->students_model->get_student_details($search_student_number);
                        $student_user_id=((!empty($search_student_details[0]->user_id))?$search_student_details[0]->user_id:0);
                        if($student_user_id){
                            $student_data=$this->students_model->get_user_details($student_user_id);
                        }else{
                            $student_data=false;                            
                        }

                        // echo '<pre>'; print_r($student_data); echo '</pre>';
                        if(empty($student_data)){
                            
                            $errorMsg.='<div>No Student Found with student number <i>'.$search_student_number.'</i>.</div>';

                        }else if($post['college_id']!=$student_data[0]->college_id && $post['course_id']!=$student_data[0]->course_id && $post['branch_id']!=$student_data[0]->branch_id){
                            
                            $errorMsg.='<div><i>'.$search_student_number.'</i> Student doesnot belong to this College/Course/Branch.</div>';

                        }else if(!empty($student_data) && !empty($student_data[0]->user_id) && isset($value['AVERAGE MARKS']) && isset($value['MARKS AWARDED'])){
                            /* IF STUDENT DETAILS FOUND PROCESS THE MARKS */
                            
                            // echo '<pre>'; print_r($student_data); echo '</pre>';

                            /*
                             * Save Student Marks
                             */
                            $saveMarksPost = array(); // Clear prev values..!!
                            $saveMarksPost = $post;

                            $saveMarksPost['user_id'] = $student_data[0]->user_id;
                            $saveMarksPost['section_id'] = $student_data[0]->section_id;
                            $saveMarksPost['external_marks'] = $marks_awarded;
                            $saveMarksPost['average_marks']=$average_marks;
                            $saveMarksPost['final_marks']=$average_marks+$marks_awarded;
                            $passMarks=($subject_type_id=='1')?40:30;
                            $saveMarksPost['pass']=($saveMarksPost['final_marks']>=$passMarks)?'1':'0';
                            $saveMarksPost['credits']=($saveMarksPost['final_marks']>=$passMarks)?$subject_max_credits:0;

                            /* CHECK FOR PREV RECORDS AND INACTIVATE IT */
                            $students_external_marks=$this->exam_model->getStudentsExternalMarks($student_data[0]->user_id,$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id']);
                            if (!empty($students_external_marks) && $post['subject_id']) {
                                foreach($students_external_marks as $k=>$v){
                                    if($v->subject_id==$post['subject_id']){
                                        // Make Status 0 for Previous record and below saveRecord will create a new record
                                        $inactiveMarksPost=array();
                                        $inactiveMarksPost['id'] = $v->id;
                                        $inactiveMarksPost['status'] = '0';
                                        $this->general_model->saveRecord($inactiveMarksPost, 'student_external_marks');
                                    }
                                }
                            }

                            // echo '<pre>'; print_r($saveMarksPost); echo '</pre>';
                            // $logMsg.='<pre>'.print_r($saveMarksPost,TRUE).'</pre>';
                            $this->general_model->saveRecord($saveMarksPost, 'student_external_marks');

                            $logMsg.='<div>Marks Registered Successfully for Student: <i>' . $search_student_number . '</i></div>';

                            /*********** X ***********/

                            // echo '<pre>'; print_r($data); echo '</pre>';
                        }

                    }
                }else{
                    $errorMsg.='<div>Please Check the CSV Format.</div>';
                }
                
            }else{
                $errorMsg.='<div>CSV File is Empty/ Not in format.</div>';
            }

            
            $data['logMsg']=$logMsg;
            $data['errorMsg']=$errorMsg;
            $data['form_data']=$post;
            
            $data['content_page']='exam/bulk_post_exam_results';
            $this->load->view('common/base_template',$data);
        }else{
            $data['content_page']='exam/bulk_post_exam_results';
            $this->load->view('common/base_template',$data);
        }
    }




}

?>
