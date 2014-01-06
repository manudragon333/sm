<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff extends CI_Controller {

    var $ci_user_details;

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model(array('staff_model', 'students_model', 'office_model', 'users_model', 'exam_model'));
        $this->ci_user_details = $this->session->userdata('user_details');
        if ($this->ci_user_details && $this->ci_user_details->users_type_id == 3) {
            $number = $this->check_approvals();
            $this->session->set_userdata('approval_count', $number);
        }
    }

    public function index() {
        $data["notice_board"] = $this->students_model->get_notice_board();
        $data["notifications"] = $this->users_model->get_user_notifications($this->ci_user_details->id);
        $data['content_page'] = 'staff/home';
        $this->load->view('common/base_template', $data);
    }

    function profile() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $post['user_id'] = $this->ci_user_details->id;
            $this->my_db_lib->save_record($post, 'staff_records');
            echo showBigSuccess('<p>Profile details updated succesfully</p>');
        } else {
            // print_r($this->ci_user_details->id);
            $data['data'] = $this->staff_model->getProfileDetails($this->ci_user_details->id);
            $data['content_page'] = 'staff/profile';
            $this->load->view('common/base_template', $data);
        }
    }

    function time_table() {
        $data['data'] = $this->staff_model->get_time_table($this->ci_user_details->id);
        $data['content_page'] = 'staff/time_table';
        $this->load->view('common/base_template', $data);
    }

    function update_time_table() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $this->my_db_lib->save_record($post, 'time_table');
            $this->send_staff_tt_sms($post['user_id']);
            echo showBigSuccess('<p>Time Table Updated Successfully.</p>');
        } else {
            $data['staff'] = $this->staff_model->get_staff_users();
            $data['content_page'] = 'staff/update_time_table';
            $this->load->view('common/base_template', $data);
        }
    }

    function get_staff_time_table() {
        if ($post = $this->input->post()) {
            $data = $this->staff_model->get_time_table($post['staff_select']);
            echo json_encode($data);
        }
    }

    function send_staff_tt_sms($user_id) {
        return true;
    }

    function update_student_time_table() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $post['year'] = $post['sem_id'];
            foreach ($post['rows'] as $kr => $vr) {
                $row = $vr;
                $row['branch_id'] = $post['branch_id'];
                $row['year'] = $post['year'];
                $this->my_db_lib->save_record($row, 'student_time_table');
            }
            $this->send_student_tt_sms($post['branch_id'], $post['year']);
            echo showBigSuccess('<p>Time Table Updated Successfully.</p>'); //'<pre>'; print_r($post); echo '</pre>';
        } else {
            $data['days'] = $this->staff_model->get_time_table_days();
            $data['branches'] = $this->staff_model->get_branches();
            $data['content_page'] = 'staff/update_student_time_table';
            $this->load->view('common/base_template', $data);
        }
    }

    function send_student_tt_sms($branch_id, $year) {
        return true;
    }

    function get_student_time_table() {
        if ($post = $this->input->post()) {
            $post['year'] = $post['sem_id'];
            $data = $this->staff_model->get_student_time_table($post);
            $rows = array();
            if (count($data) > 0) {
                foreach ($data as $k => $v) {
                    $rows[$v['day_id']] = $v; // IMP as rows in the DOM are as per day_id index so taking the same.
                }
            }
            // echo '<pre>'; print_r($rows); echo '</pre>';
            echo json_encode($rows);
        }
    }

    function library() {
        $data['content_page'] = 'library/library_books';
        $this->load->view('common/base_template', $data);
    }

    function reserved_books() {
        $data['content_page'] = 'library/reserved_books';
        $this->load->view('common/base_template', $data);
    }

    function office() {
        $data['content_page'] = 'staff/office';
        $this->load->view('common/base_template', $data);
    }

    function upload_q_papers() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $post['year'] = $post['sem_id'];
            $post['branch'] = $post['branch_id'];
            $post['user_id'] = $this->ci_user_details->id;
            $this->my_db_lib->save_record($post, 'question_papers');
            echo showBigSuccess('<p>Question paper uploaded succesfully</p>');
        } else {
            $data['content_page'] = 'staff/upload_q_papers';
            $this->load->view('common/base_template', $data);
        }
    }

    function browse_q_papers() {
        $data['content_page'] = 'staff/browse_q_papers';
        $this->load->view('common/base_template', $data);
    }

    function browse_q_papers_grid() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $sql = "select q.*,br.name as branch_name,s.name as subject, u.username from question_papers as q
                left join users as u on q.user_id=u.id
                left join subjects as s on s.id=q.subject_id
                left join branches as br on q.branch=br.id
                where 1 "; // q.is_printed!='1'

            $user_details = $this->session->userdata('user_details');
            if ($user_details->users_type_id == 2 || $user_details->users_type_id == 3) {
                $staff_details = $this->staff_model->getProfileDetails($this->ci_user_details->id);
                $branch_id = $staff_details[0]->branch_id;
                $sql.=" and q.branch=$branch_id"; // echo $sql;
            }
            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    $data->rows[$i]['id'] = $v['id'];
                    $is_approved = ($v['is_approved'] && $v['is_principal_approved']) ? (($v['to_print']) ? 'Sent to Printing' : '<a href="javascript:send_to_print(\'' . $v['id'] . ' \');">Send to print</a>(Approved)') : 'Waiting';
                    if (isset($post['ro'])) {
                        $is_approved = ($v['is_approved']) ? (($v['to_print']) ? 'Sent to Printing' : 'Approved') : 'Waiting for approval';
                        ;
                    }
                    if ($v['is_printed'] == '1') {
                        $is_approved = '<span style="color:green;">All Process Completed</span>';
                    }
                    $link = "<a href='" . base_url() . "uploads/" . $v['doc_link'] . "' target='_blank'>Link</a>";
                    $data->rows[$i]['cell'] = array($v['username'], $v['students_count'], $v['branch_name'], $v['year'], $v['subject'], $v['exam_number'], $link, $is_approved);
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Data', '', '', '', '', '', '', '');
            }
            unset($data->db_data);
            echo json_encode($data);
        }
    }

    function send_q_papers_print() {
        $post = $this->input->post();
        if ($this->input->post('id')) {
            $post['to_print'] = '1';
            $this->my_db_lib->save_record($post, 'question_papers');
            echo 1;
        }
    }

    function pay_slip() {
        $data['data'] = $this->staff_model->getProfileDetails($this->ci_user_details->id);
        // print_r($data);
        $data['content_page'] = 'staff/pay_slip';
        $this->load->view('common/base_template', $data);
    }

    //surya function 
    function get_sms_students() {
        $data = $this->students_model->get_smsstudents($_POST);
        $output = '';
        //print_r($datatype);
        $totalstudents = count($data);
        if ($totalstudents > 0) {
            //$output ='Students Are <br>';
            $i = 0;
            $output = '<table align="center">';
            foreach ($data as $individualstudent) {
                if ($i % 3 == 0) {

                    $output .= "<tr>";
                }
                $output .= "<td><input type='checkbox' checked class='required' name='sms_student_ids[]' value='" . $individualstudent->id . "' />" . $individualstudent->name . ' (' . $individualstudent->students_number . ')<td>';
                if ($i % 3 == 0) {

                    $output .= "</tr>";
                }

                $i++;
            }
            $output .= '</table>';
        } else {
            $output = '<br><br><div align="center"><b>No records</b></div>';
        }
        echo $output;
    }

    function test_sms() {
        $this->load->library('my_email_lib');
        $this->my_email_lib->html_email('mca.surya@gmail.com', 'surya email');
    }

    //surya function
    function send_msg() {
        //print_r($_POST);die();
        if (!empty($_POST)) {
            $post_array = $_POST;

            /* $post_array['choice']=1; //email or mobile
              $post_array['choice2']=1; //single message or bulk
              $post_array['college_id']=1;
              $post_array['course_id']=4;
              $post_array['branch_id']=12;
              $post_array['semister_id']=29;
              $post_array['section_id']=100;
              $post_array['message']='Hi %sname%  is absent';
              $post_array['smsto']= 'parent'; //parent or student (possible values)
              $post_array['student_number']='11QP1A0301';
              $post_array['religion']='others'; */
            if ($post_array['choice2'] == 1) {
                //now get all the students for this crieteria		
                if (!empty($post_array['sms_student_ids'])) {
                    $data = $this->students_model->get_smsstudents_by_ids($post_array['sms_student_ids']);
                    $totalstudents = count($data);
                    if ($totalstudents > 0) {
                        foreach ($data as $individualstudent) {
                            //now cal the generic function for sending email or sms 
                            $this->students_model->send_sms_or_email($post_array, $individualstudent);
                        }
                    }
                }
            } else if ($post_array['choice2'] == 2) {
                //now find the student details based on the student number
                $data = $this->students_model->get_student_details($post_array['student_number']);
                if (!empty($data[0])) {
                    //now cal the generic function for sending email or sms
                    $this->students_model->send_sms_or_email($post_array, $data[0]);
                }
            } else {
                return;
            }
            echo showBigSuccess('<p>Success</p>');
        } else {
            $data['content_page'] = 'staff/send_msg';
            $this->load->view('common/base_template', $data);
        }
    }

    function send_msgold() {

        /* echo '<pre>';
          print_r($_POST);
          die(); */

        if ($this->input->post()) {
            $post = $this->input->post();
            $post['choice3'] = $post['semister_id'];
            $post['user_id'] = $this->ci_user_details->id;
            if ($post['choice2'] == '1') {
                // Group
                $data = $this->students_model->get_students_by_year($post['choice3']);
            } else if ($post['choice2'] == '2') {
                // individual
                $data = $this->students_model->get_student_details($post['student_number']);
            }
            if (count($data)) {
                $this->load->library(array('my_email_lib'));
                foreach ($data as $k => $v) {
                    if ($post['choice'] == '1') {// Email
                        $this->my_email_lib->html_email($v->email, $from = 'noreply@mycollege.goendeavor.com', $subject = 'My College', $post['message']);
                    } else {// Sms
                        $this->sms_lib->send_sms($v->mobile, $post['message']);
                    }
                }
            }
            $this->my_db_lib->save_record($post, 'send_student_messages');
        } else {
            $data['content_page'] = 'staff/send_msg';
            $this->load->view('common/base_template', $data);
        }
    }

    function apply_id_card() {
        if ($this->input->post()) {
            $post = $this->input->post();
            if ($data = $this->session->userdata('staff_preview_id_card')) {
                $this->my_db_lib->save_record($data, 'id_card_applications');
                $this->session->unset_userdata('staff_preview_id_card');
                echo showBigSuccess('<p> ID Card request submitted successfully</p>');
            }
        } else {
            $data['content_page'] = 'staff/id_card';
            $this->load->view('common/base_template', $data);
        }
    }

    function preview_apply_idcard() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $post['user_id'] = $this->ci_user_details->id;
            $this->session->set_userdata('staff_preview_id_card', $post);
            $this->load->view('staff/id_card_preview');
        } else {
            redirect('staff/apply_idcard');
        }
    }

    function student_profile() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $user_id = $this->staff_model->get_student_user_id($post['number']);
            if (count($user_id)) {
                //$data['student_details']=$this->students_model->get_user_details($user_id[0]->user_id);
                $data['student_details'] = $this->office_model->get_student_ledger_profile($user_id[0]->user_id);
                $data['payment_details'] = $this->office_model->get_student_finances($user_id[0]->user_id);

                //$this->load->view('staff/student_record',$data);
                $this->load->view('students/my_record1', $data);
            } else {
                echo showBigError('<p>Student Number not found. Please try again.</p>');
            }
        } else {
            $data['content_page'] = 'staff/student_profile';
            $this->load->view('common/base_template', $data);
        }
    }

    function email() {
        $data['content_page'] = 'staff/home';
        $this->load->view('common/base_template', $data);
    }

    function check_approvals() {
        $user_details = $this->session->userdata('user_details');
        if ($user_details->users_type_id == 3 || $user_details->users_type_id == 4) {
            $staff_details = $this->staff_model->getProfileDetails($this->ci_user_details->id);
            $branch_id = $staff_details[0]->branch_id;
        }
        return $this->staff_model->getapprovals_count($this->ci_user_details->id, $branch_id);
    }

    function approvals() {
        $data['content_page'] = 'staff/approvals';
        $this->load->view('common/base_template', $data);
    }

    function no_due_requests() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $user_id = $this->session->userdata('user_id');
            $sql = "select nd.*,nda.approver_status,sr.name,sr.students_number,sr.doj,c.name as course,b.name as branch,sr.present_year,sr.completing_year
                    from nodue_applications as nd
                    left join student_records as sr on sr.user_id=nd.user_id
                    left join courses as c on c.id=sr.course_id
                    left join branches as b on b.id=sr.branch_id
                    left join nodue_approvals as nda on nda.application_id=nd.id
                    where nd.is_issued!='1' and nda.approver_id='" . $user_id . "'"; // and nda.approver_status!='1'

            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);
            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    $data->rows[$i]['id'] = $v['id'];
                    if ($v['approver_status'] == '0') {
                        $approval = '<a href="javascript:void(0);" onclick="javascript:nodue_update(\'' . $v['id'] . '\',\'1\');">Approve</a>';
                        $approval.=' | <a href="javascript:void(0);" onclick="javascript:nodue_update(\'' . $v['id'] . '\',\'2\');">Reject</a> ';
                    }
                    if ($v['approver_status'] == '1') {
                        $approval = '(Approved)';
                        $approval.=' | <a href="javascript:void(0);" onclick="javascript:nodue_update(\'' . $v['id'] . '\',\'2\');" title="Click if you wish to reject.">Reject</a> ';
                    }
                    if ($v['approver_status'] == '2') {
                        $approval = '<a href="javascript:void(0);" onclick="javascript:nodue_update(\'' . $v['id'] . '\',\'1\');" title="Click if you wish to Approve.">Approve</a>';
                        $approval.=' | (Rejected) ';
                    }
                    if ($this->ci_user_details->users_type_id == '7') {
                        $approval.='<div><a href="javascript:void(0);" onclick="javascript:print_nodue(\'' . $v['user_id'] . '\');" >Print</a> | ';
                        $approval.='<a href="javascript:void(0);" onclick="javascript:close_requests(\'no_due\',\'' . $v['id'] . '\');" >Close</a></div>';
                    }
                    $data->rows[$i]['cell'] = array($v['name'], $v['students_number'], $v['course'], $v['branch'], $v['present_year'], $v['completing_year'], $approval);
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Data', '', '', '', '', '', '');
            }
            unset($data->db_data);
            echo json_encode($data);
        } else {
            $data['content_page'] = 'staff/no_due_requests';
            $this->load->view('common/base_template', $data);
        }
    }

    function update_nodue() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $appl_id = $post['id'];
            $approver_id = $this->session->userdata('user_id');
            $status = $post['update'];
            $this->staff_model->update_nodue($appl_id, $approver_id, $status);
            echo showBigSuccess('No Due status updated');
        }
    }

    function approve_q_papers() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $sql = "select q.*,br.name as branch_name, u.username,s.name AS subject from question_papers as q
                left join users as u on q.user_id=u.id
                left join branches as br on q.branch=br.id
                left join subjects as s on s.id=q.subject_id
                where q.is_approved!='1' and is_principal_approved='1'";

            $user_details = $this->session->userdata('user_details');
            if ($user_details->users_type_id == '3' || $user_details->users_type_id == '4') {
                $staff_details = $this->staff_model->getProfileDetails($this->ci_user_details->id);
                $branch_id = $staff_details[0]->branch_id;
                $sql.=" and q.branch=$branch_id";
            }

            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    $data->rows[$i]['id'] = $v['id'];
                    $is_approved = '<a href="javascript:approve_paper(\'' . $v['id'] . '\')">Approve Paper</a>';
                    $link = "<a href='" . base_url() . "uploads/" . $v['doc_link'] . "' target='_blank'>Link</a>";
                    $data->rows[$i]['cell'] = array($v['username'], $v['students_count'], $v['branch_name'], $v['year'], $v['subject'], $v['exam_number'], $link, $is_approved);
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Data', '', '', '', '', '', '');
            }

            unset($data->db_data);
            echo json_encode($data);
        } else {
            $data['content_page'] = 'staff/approve_q_papers';
            $this->load->view('common/base_template', $data);
        }
    }

    function approve_paper() {
        $post = $this->input->post();
        if ($this->input->post('id')) {
            $post['is_approved'] = '1';
            $this->my_db_lib->save_record($post, 'question_papers');
            $sql = "select s.name AS subject,qp.year,sr.mobile,sr.name,b.name as branch  from question_papers as qp
                    inner join staff_records as sr on sr.user_id=qp.user_id
                    inner join branches  as b on b.id=qp.branch
                    left join subjects as s on s.id=qp.subject_id
                    where qp.id='" . $this->input->post('id') . "'";
            $query = $this->db->query($sql);
            $row = $query->first_row();

            $message = "Subject: " . $row->subject;
            $message.=", Year: " . $row->year;
            $message.=", Branch:" . $row->branch;
            $message.="HOD Approved";
            $this->sms_lib->send_sms($row->mobile, $message);
            echo 1;
        }
    }

    function upload_assigments() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $post['user_id'] = $this->ci_user_details->id;
            $this->my_db_lib->save_record($post, 'assignments');
            echo showBigSuccess('<p>Assignment submitted succesfully.</p>');
        } else {
            $data['content_page'] = 'staff/upload_assignments';
            $this->load->view('common/base_template', $data);
        }
    }

    function view_assignments() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $sql = "select a.*,b.name as branch_name, s.name as sem_name from assignments as a
                    left join branches as b on b.id=a.branch_id
                    left join semisters as s on s.id=a.sem_id
                    where a.status='1' ";

            // $user_details=$this->session->userdata('user_details');
            if ($this->ci_user_details->id) {
                $sql.=" and a.user_id='" . $this->ci_user_details->id . "' ";
            }

            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    $data->rows[$i]['id'] = $v['id'];
                    $view_submissions = '<a href="javascript:view_submissions(\'' . $v['id'] . '\')">View Submissions</a>';
                    $link = "<a href='" . base_url() . "uploads/" . $v['doc_link'] . "' target='_blank'>Link</a>";
                    $data->rows[$i]['cell'] = array(dateFormat($v['date_added']), $v['branch_name'], $v['sem_name'], $v['subject'], $v['instructions'], $link, $v['max_marks'], dateFormat($v['last_date'], 'Y-m-d'), $view_submissions);
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Data', '', '', '', '', '', '');
            }

            unset($data->db_data);
            echo json_encode($data);
        } else {
            $data['content_page'] = 'staff/view_assignments';
            $this->load->view('common/base_template', $data);
        }
    }

    //surya function
    function student_messages() {
        if ($this->input->post()) {
            $post = $this->input->post();

            $sql = " select id,user_id,student_number,user_name,message,message_type,`status`,sent_to,sent_date from student_messages where user_id='" . $this->ci_user_details->id . "'";



            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    $data->rows[$i]['id'] = $v['id'];
                    $data->rows[$i]['cell'] = array($v['message'], $v['message_type'], $v['status'], $v['sent_to'], dateFormat($v['sent_date']));
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Data', '', '', '', '');
            }

            unset($data->db_data);
            echo json_encode($data);
        } else {
            $data['content_page'] = 'staff/student_messages';
            $this->load->view('common/base_template', $data);
        }
    }

    function view_submissions() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $sql = "select asub.*,sr.name,sr.students_number from assignment_submissions as asub
                    left join student_records as sr on sr.user_id=asub.user_id
                    where asub.assignments_id='" . $this->input->post('id') . "' ";

            // $user_details=$this->session->userdata('user_details');

            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    $data->rows[$i]['id'] = $v['id'];
                    $view_submissions = '<a href="javascript:assign_marks(\'' . $v['id'] . '\')">Assign Marks</a>';
                    $link = "<a href='" . base_url() . "uploads/" . $v['doc_link'] . "' target='_blank'>Link</a>";
                    $data->rows[$i]['cell'] = array($v['name'], $v['students_number'], $v['student_replies'], $link, $v['marks_alloted'], $v['staff_comments'], $view_submissions);
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Submissions Yet', '', '', '', '', '', '');
            }

            unset($data->db_data);
            echo json_encode($data);
        } else {
            /// $data['content_page']='staff/view_submissions';
            $this->load->view('staff/view_submissions');
        }
    }

    function get_marks_details() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $sql = "select * from assignment_submissions where id='" . $this->input->post('id') . "' ";
            $res = $this->db->query($sql);
            $result = $res->result();
            echo json_encode($result);
        }
    }

    function save_assignment_marks() {
        if ($post = $this->input->post()) {
            $this->my_db_lib->save_record($post, 'assignment_submissions');
        }
    }

    function upload_pdfs() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $post['user_id'] = $this->ci_user_details->id;
            $this->my_db_lib->save_record($post, 'library_pdfs');
            echo showBigSuccess('<p>PDF submitted succesfully.</p>');
        } else {
            $data['content_page'] = 'staff/upload_pdfs';
            $this->load->view('common/base_template', $data);
        }
    }

    function getCollegeSections($college_id = 0) {
        $options = '<option value="">Select</option>';
        $options.=load_select_section('sections', 0, array('semister_id' => $this->input->post('sem_id')));
        echo $options;
    }

    function view_library_pdfs() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $sql = "select a.*,b.name as branch_name, s.name as sem_name from library_pdfs as a
                    left join branches as b on b.id=a.branch_id
                    left join semisters as s on s.id=a.sem_id
                    where a.status='1' ";

            // $user_details=$this->session->userdata('user_details');
            if ($this->ci_user_details->id) {
                // print_r($student_data);
                $sql.=" and a.user_id='" . $this->ci_user_details->id . "' ";
            }

            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    $data->rows[$i]['id'] = $v['id'];
                    $view_submissions = '<a href="' . site_url('students/library_pdfs_discussions') . '/' . urlencode(base64_encode($v['id'])) . '">View Discussions</a>';
                    $link = "<a href='" . base_url() . "uploads/" . $v['doc_link'] . "' target='_blank'>Link</a>";
                    $data->rows[$i]['cell'] = array(dateFormat($v['date_added']), $v['branch_name'], $v['sem_name'], $v['instructions'], $link, $view_submissions);
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Data', '', '', '', '', '', '');
            }

            unset($data->db_data);
            echo json_encode($data);
        } else {
            $data['content_page'] = 'students/view_library_pdfs';
            $this->load->view('common/base_template', $data);
        }
    }

    function upload_videos() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $post['user_id'] = $this->ci_user_details->id;
            $this->my_db_lib->save_record($post, 'videos');
            echo showBigSuccess('<p>Video submitted succesfully.</p>');
        } else {
            $data['content_page'] = 'staff/upload_videos';
            $this->load->view('common/base_template', $data);
        }
    }

    function attendance() {
        if ($this->input->post()) {
            $user_details = $this->session->userdata('user_details');
            $post = $this->input->post();
            $selectedWeekNum = dateFormat($post['date_added'], 'w');
            if (empty($post['cycle_id'])) {
                redirect('staff/attendance');
            }
            $data = $post;
            $data['staff_id'] = $this->ci_user_details->id;
            $this->load->model('admin_model');
            $data['weekdays'] = $this->admin_model->getWeekdays();
            $data['cycle_periods'] = $this->admin_model->getCyclePeriods($post['cycle_id']);
            $data['staff_periods'] = $this->admin_model->getStaffPeriods($this->ci_user_details->id, $post['cycle_id'], $post['academic_year_id']);
            /*
             * $data['students'] Format: $data['students'][<period_id>][<subject_id>]
             */

            $cycleWeekdayPeriods = array();
            if (!empty($data['staff_periods'])) {
                foreach ($data['staff_periods'] as $k => $v) {
                    if ($v['weekday_id'] == $selectedWeekNum) {
                        $cycleWeekdayPeriods[$v['period_id']] = $v;
                    }
                }
            }
            if (!empty($cycleWeekdayPeriods)) {
                foreach ($cycleWeekdayPeriods as $cwp_k => $cwp_v) {
                    $data['students'][$cwp_k] = $this->staff_model->getAttendanceStudents($cwp_v['cycle_id'], $cwp_v['weekday_id'], $cwp_v['period_id'], $cwp_v['subject_id'], $cwp_v['section_id'], $user_details->id, $post['date_added']);
                }
            }
            $data['cycleWeekdayPeriods'] = $cycleWeekdayPeriods;
            $data['selectedWeekNum'] = $selectedWeekNum;

            // echo '<pre>'; print_r($data); echo '</pre>';

            $data['content_page'] = 'staff/staff_attendance';
            $this->load->view('common/base_template', $data);
        } else {
            $data['allotted_weeks'] = $this->staff_model->getStaffPeriodsWeeks($this->ci_user_details->id);
            $data['staff_leave_dates'] = $this->staff_model->getStaffLeaveDates($this->ci_user_details->id);
            $data['staff_leave_adjusted_dates'] = $this->staff_model->getStaffLeaveAdjustedDates($this->ci_user_details->id);
            $data['staff_exam_duty_dates'] = $this->staff_model->getStaffExamDutyDates($this->ci_user_details->id);
            $data['academic_calendar_dates'] = $this->staff_model->getAcademicCalendarDates();

            $data['content_page'] = 'staff/attendance';
            $this->load->view('common/base_template', $data);
        }
    }

    function add_edit_attendance() {
        if ($this->input->post()) {
            $user_details = $this->session->userdata('user_details');
            $post = $this->input->post();

            // echo 'MMJ'.(date('Y-m-d H:i:s')).' :: '.  strtotime(date('Y-m-d H:i:s')).' :: '.time().' :: '.date('Y-m-d').' 16:40:00';
            if (strtotime(date('Y-m-d H:i:s')) >= strtotime(date('Y-m-d') . ' 16:40:00')) {
                if ($this->staff_model->checkBreachUnlocked($user_details->id, $post['period_id'])) {
                    // breach Unlocked.. 
                } else {
                    $data['content_page'] = 'staff/student_attendance_timeout';
                    $this->load->view('common/base_template', $data);
                    return true;
                }
            }

            if (empty($post['cycle_id']) && empty($post['weekday_id']) && empty($post['period_id'])) {
                redirect('staff/attendance');
            }
            $data = $post;
            $data['students'] = $this->staff_model->getAttendanceStudents($post['cycle_id'], $post['weekday_id'], $post['period_id'], $post['subject_id'], $post['section_id'], $user_details->id);

            $data['content_page'] = 'staff/student_attendance';
            $this->load->view('common/base_template', $data);
        } else {
            redirect('staff/attendance');
        }
    }

    function save_student_attendance() {
        $user_details = $this->session->userdata('user_details');
        if ($this->input->post()) {
            $post = $this->input->post();
//            echo '<pre>';
//            print_r($post);
//            echo '</pre>';
            $studentUser_Ids = array();
            if (!empty($post['attendance'])) {
                foreach ($post['attendance'] as $k => $v) {
                    // $attendancePost=array();
                    if ($v['attendance_id'] == '2') { // If Absent
                        $studentUser_Ids[] = $k;
                    }
                    $attendancePost = $v;
                    $attendancePost['user_id'] = $k;
                    $attendancePost['staff_user_id'] = $user_details->id;
                    $attendancePost['cycle_id'] = $post['cycle_id'];
                    $attendancePost['weekday_id'] = $post['weekday_id'];
                    $attendancePost['subject_id'] = $post['subject_id'];
                    $attendancePost['period_id'] = $post['period_id'];
                    $attendancePost['create_date'] = $post['date_added'];
                    $this->my_db_lib->save_record($attendancePost, 'student_periods_attendence');
                    if (!empty($v['id']))
                        $this->staff_model->increaseAttendanceUpdateCount($v['id']);
                    if ($attendancePost['period_id']) {
                        
                    }
                }
            }
            if (!empty($studentUser_Ids)) { // If Absent
                $this->staff_model->sendStudentsAbsentSms($studentUser_Ids, $post['date_added']);
            }
            $data['content_page'] = 'staff/save_student_attendance_saved';
            $this->load->view('common/base_template', $data);
        }
    }

    function save_student_attendance_saved() {
        $data['content_page'] = 'staff/save_student_attendance_saved';
        $this->load->view('common/base_template', $data);
    }

    function leave_letter() {
        $post = $this->input->post();
        if ($post) {
            $sql = "select l.*,b.name as branch_name,lt.name as leave_type_name from leave_letters as l
                    left join staff_records as sr on sr.user_id=l.user_id
                    left join branches as b on b.id=l.branch_id
                    left join leave_types as lt on lt.id=l.leave_type_id
                    where l.status='1'
	             ";

            $user_details = $this->session->userdata('user_details');

            if ($user_details->id) {
                $sql.=" and l.user_id='" . $user_details->id . "'";
            }
            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    $data->rows[$i]['id'] = $v['id'];
                    $is_approved = ($v['is_approved'] == '1') ? '<span style="color:green;">Approved by HOD</span>' : (($v['is_approved'] == '2') ? '<span style="color:red;">Approved</span>' : 'Waiting');
                    $link = "<a href='" . site_url('') . "/staff/view_leave_letter/" . $v['id'] . "' target='_blank'>View</a>";
                    $data->rows[$i]['cell'] = array(dateFormat($v['date_added'], 'd-M-Y'), dateFormat($v['from'], 'd-M-Y'), dateFormat($v['to'], 'd-M-Y'), $v['branch_name'], $v['leave_type_name'], $v['purpose'], $link, $is_approved);
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Data', '', '', '', '', '', '', '');
            }
            unset($data->db_data);
            echo json_encode($data);
        } else {
            $data['content_page'] = 'staff/leave_letter_grid';
            $this->load->view('common/base_template', $data);
        }
    }

    function view_leave_letter($id = 0) {
        if ($id && is_numeric($id)) {
            $this->load->model('admin_model');
            $data['data'] = $this->staff_model->getLeaveDetails($id);
            $data['teachersOptions'] = $this->admin_model->getActiveStaff();

            $weekdays = '0,';
            $weekNumbers = $this->getWeekNumbers($data['data'][0]['from'], $data['data'][0]['to']);
            $weekdays.=implode(',', $weekNumbers);
//            $weekdays='1,2,3,4,5';
            $weekdays = trim($weekdays, ',');

            $data['staff_periods'] = $this->staff_model->getStaffAllCyclePeriodsAdjustments($id, $data['data'][0]['user_id'], $weekdays);

            $data['content_page'] = 'staff/leave_letter_view';
            $this->load->view('common/base_template', $data);
        } else {
            redirect('staff');
        }
    }

    function apply_leave() {
        $post = $this->input->post();
        $user_details = $this->session->userdata('user_details');
        if ($post) {
            // print_r($post);
            $post['user_id'] = $user_details->id;
            $this->db->trans_start();
            $leave_id = $this->my_db_lib->save_record($post, 'leave_letters');
            $work_adj_post['leave_letter_id'] = $leave_id;
            if (isset($post['work_adjustments']) && !empty($post['work_adjustments'])) {
//                    foreach($post['work_adjustments'] as $k=>$v){
//                        $work_adj_post['period_id']=$k;
//                        $work_adj_post['work_adjusted_to']=$v;
//                        $this->my_db_lib->save_record($work_adj_post,'leave_work_adjusts');
//                    }
                foreach ($post['work_adjustments'] as $wa_k => $wa_v) {
                    if (!empty($wa_v))
                        foreach ($wa_v as $k => $v) {
                            $work_adj_post['work_adjusted_date'] = date('Y-m-d', $wa_k);
                            $work_adj_post['period_id'] = $k;
                            $work_adj_post['work_adjusted_to'] = $v;
                            $this->my_db_lib->save_record($work_adj_post, 'leave_work_adjusts');
                        }
                }
            }
            $this->db->trans_complete();

            echo showBigSuccess('<div class=""><p>Leave application successfully submited.</p></div>');
//            if ($this->db->trans_status() === FALSE){
//                echo '<div class="error"><p>Leave application failed. Please try again</p></div>';
//            }
        } else {
            $this->load->model('admin_model');
            $data['this_staff_id'] = $user_details->id;
            $data['data'] = $this->staff_model->getProfileDetails($user_details->id);
            $data['teachersOptions'] = $this->admin_model->getActiveStaff();
            // $data['staff_periods']=$this->admin_model->getStaffAllCyclePeriods($user_details->id);
            $data['content_page'] = 'staff/leave_letter_form';
            $this->load->view('common/base_template', $data);
        }
    }

    function getStaffWeekdaysCyclePeriods() {
        $post = $this->input->post();
        $user_details = $this->session->userdata('user_details');
        if ($post) {
            $this->load->model('admin_model');
            $weekdays = '0,';
            $weekNumbers = $this->getWeekNumbers($post['from'], $post['to']);
            $weekdays.=implode(',', $weekNumbers);
//            $weekdays='1,2,3,4,5';
            $weekdays = trim($weekdays, ',');
            $data = $post;
            $data['this_staff_id'] = $user_details->id;
            $data['staff_periods'] = $this->admin_model->getStaffWeekdaysCyclePeriods($user_details->id, $weekdays);
            // $data['teachersOptions']=$this->admin_model->getActiveStaff();
            $this->load->view('staff/leave_adjustments', $data);
        }
    }

    function getWeekNumbers($from, $to) {
        $weekNumbers = array();
        while (strtotime($from) <= strtotime($to)) {
            // echo date('N', strtotime($from));
            if (!in_array(date('N', strtotime($from)), $weekNumbers)) {
                array_push($weekNumbers, date('N', strtotime($from)));
            }
            $fromTS = strtotime($from . ' +1 day');
            $from = date('Y-m-d', $fromTS);
        }
        return ($weekNumbers);
    }

    function leave_requests() {
        $post = $this->input->post();
        if ($post) {
            $sqlXX = "select l.*,b.name as branch_name,lt.name as leave_type_name from leave_letters as l
                    left join staff_records as sr on sr.user_id=l.user_id
                    left join branches as b on b.id=l.branch_id
                    left join leave_types as lt on lt.id=l.leave_type_id
                    where l.status='1'
	             ";

            $user_details = $this->session->userdata('user_details');
            // print_r($user_details);
            $branchWhere = '';
            if ($user_details->id && ($user_details->id != '18')) { // Not Filtering for Principal (id=18)
                $branchWhere = " and ll.branch_id=(select branch_id from staff_records where user_id='" . $user_details->id . "') ";
            }

            $sql = "select min(lwa.is_approved) as is_all_approved,ll.*,b.name as branch_name,lt.name as leave_type_name
                        from leave_letters as ll
                        left join leave_work_adjusts as lwa on lwa.leave_letter_id=ll.id
                        left join staff_records as sr on sr.user_id=ll.user_id
                        left join branches as b on b.id=ll.branch_id
                        left join leave_types as lt on lt.id=ll.leave_type_id
                        where ll.status='1' " . $branchWhere . "
                        group by lwa.leave_letter_id
                ";


            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {

                    $data->rows[$i]['id'] = $v['id'];
                    if ($v['is_all_approved'] == '0') {
                        $is_approved = '<i>Waiting for Work Adjust Approvals</i>';
                    } else {
                        $is_approved = ($v['is_approved'] == '1') ? '<span style="color:green;">Approved</span>|<a href="javascript:change_leave_approval(' . $v['id'] . ',2);">Reject</a>' : (($v['is_approved'] == '2') ? '<a href="javascript:change_leave_approval(' . $v['id'] . ',1);">Approve</a>|<span style="color:red;">Rejected</span>' : '<a href="javascript:change_leave_approval(' . $v['id'] . ',1);">Approve</a>|<a href="javascript:change_leave_approval(' . $v['id'] . ',2);">Reject</a>');
                    }
                    $link = "<a href='" . site_url('') . "/staff/view_leave_letter/" . $v['id'] . "' target='_blank'>View</a>";
                    $data->rows[$i]['cell'] = array($v['staff_name'], dateFormat($v['date_added'], 'd-M-Y'), dateFormat($v['from'], 'd-M-Y'), dateFormat($v['to'], 'd-M-Y'), $v['branch_name'], $v['leave_type_name'], $v['purpose'], $link, $is_approved);
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Data', '', '', '', '', '', '', '');
            }
            unset($data->db_data);
            echo json_encode($data);
        } else {
            $data['content_page'] = 'staff/leave_letter_request_grid';
            $this->load->view('common/base_template', $data);
        }
    }

    function change_leave_approval() {
        $post = $this->input->post();
        if ($post) {
            $smsMsg = "";
            if ($post['is_approved'] == '2') {
                $smsMsg.="Your leave application is Rejected.\nPlease login to the MyCollege.or.in/kits to review the same.";
            } else if ($post['is_approved'] == '1') {
                $smsMsg.="Your leave application is Approved.\nPlease login to the MyCollege.or.in/kits to review the same.";
            }
            $user_id = generalId('user_id', 'leave_letters', 'id', $post['id']);
            $mobileNum = generalId('mobile', 'staff_records', 'user_id', $user_id);
            if (!empty($smsMsg))
                $this->sms_lib->send_sms($mobileNum, $smsMsg);

            echo $this->my_db_lib->save_record($post, 'leave_letters');
        }
    }

    function leave_adjust_requests() {
        $post = $this->input->post();
        $user_details = $this->session->userdata('user_details');

        if ($post) {
            $sql = "select lwa.*,sr.name as staff_name, pc.name as cycle_name, p.time_label, s.name as subject_name,
                    c.name as course_name, b.name as branch_name, sem.name as sem_name
                    from leave_work_adjusts as lwa
                    left join staff_cycles_periods as scp on scp.id=lwa.period_id
                    left join staff_records as sr on sr.user_id=scp.user_id
                    left join period_cycles as pc on pc.id=scp.cycle_id
                    left join periods as p on p.id=scp.period_id
                    left join subjects as s on s.id=scp.subject_id
                    left join courses as c on c.id=s.course_id
                    left join branches as b on b.id=s.branch_id
                    left join semisters as sem on sem.id=s.semister_id
                    where lwa.work_adjusted_to='" . $user_details->id . "' and lwa.status='1'
	             ";


            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    $data->rows[$i]['id'] = $v['id'];
                    $is_approved = ($v['is_approved'] == '1') ? '<span style="color:green;">Approved</span>|<a href="javascript:change_leave_adjust_approval(' . $v['id'] . ',2);">Reject</a>' : (($v['is_approved'] == '2') ? '<a href="javascript:change_leave_adjust_approval(' . $v['id'] . ',1);">Approve</a>|<span style="color:red;">Rejected</span>' : '<a href="javascript:change_leave_adjust_approval(' . $v['id'] . ',1);">Approve</a>|<a href="javascript:change_leave_adjust_approval(' . $v['id'] . ',2);">Reject</a>');
                    $link = "<a href='" . site_url('') . "/staff/view_leave_letter/" . $v['id'] . "' target='_blank'>View</a>";
                    $data->rows[$i]['cell'] = array(dateFormat($v['date_added'], 'd-M-Y'), $v['course_name'] . '<br/>' . $v['branch_name'] . '<br/>' . $v['branch_name'] . '<br/>' . $v['subject_name'], $v['cycle_name'], $v['time_label'], $link, $is_approved);
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Data', '', '', '', '', '', '', '');
            }
            unset($data->db_data);
            echo json_encode($data);
        } else {
            $data['content_page'] = 'staff/leave_adjust_request_grid';
            $this->load->view('common/base_template', $data);
        }
    }

    function change_leave_adjust_approval() {
        $post = $this->input->post();
        if ($post) {
            // echo "MMJ";
            echo $this->my_db_lib->save_record($post, 'leave_work_adjusts');
        }
    }

    function check_leave_count() {
        $user_details = $this->session->userdata('user_details');
        $user_id = $user_details->id;
        $data['leaves'] = $this->staff_model->getStaffLeavesCount($user_id);
        $data['content_page'] = 'staff/leaves_count';
        $this->load->view('common/base_template', $data);
    }

    function attendance_breach() {
        $post = $this->input->post();
        $user_details = $this->session->userdata('user_details');
        if (strtotime(date('Y-m-d H:i:s')) < strtotime(date('Y-m-d') . ' 16:40:00')) {
            $data['content_page'] = 'staff/attendance_breach_time_out_wait';
            $this->load->view('common/base_template', $data);
            return true;
        }

        if ($post) {
            $sql_BACKUP = "select sr.*,b.name as branch_name,c.name as college_name, abc.unlocked,abc.id as breach_id,abc.date_added as breach_date
                        from staff_records as sr
                        left join attendance_breach_counter as abc on abc.staff_user_id=sr.user_id
                        left join branches as b on b.id=sr.branch_id
                        left join colleges as c on c.id=b.college_id
                        where sr.user_id in (
                                select scp.user_id from staff_cycles_periods as scp
                                where scp.weekday_id=" . date('N') . " and scp.user_id not in (
                                                select spa.staff_user_id from student_periods_attendence as spa
                                                where spa.create_date BETWEEN '" . date('Y-m-d') . " 00:00:00' and '" . date('Y-m-d') . " 23:59:59'
                                                group by spa.staff_user_id
                                        )
                                group by scp.user_id
                        ) 
                        and sr.status='1'
                        and sr.branch_id=(select branch_id from staff_records as sr where user_id='" . $user_details->id . "')
                ";

            $dateLimit = strtotime(date('Y-m-d') . '-1 day');
            $sql = "select scp.*,concat(scp.user_id,'_',scp.period_id) as staff_user_period_ids,sr.name,sr.code, b.name as branch_name,c.name as college_name,
                    abc.unlocked,abc.id as breach_id,abc.date_added as breach_date,sub.name as subject_name, pc.name as cycle_name,
                    peri.time_label, sems.name as semister_name
                    from staff_cycles_periods as scp
                        inner join staff_records as sr on sr.user_id=scp.user_id
                        left join attendance_breach_counter as abc on (abc.staff_user_id=sr.user_id and abc.period_id=scp.period_id and abc.date_added BETWEEN '" . date('Y-m-d', $dateLimit) . " 00:00:00' and '" . date('Y-m-d', $dateLimit) . " 23:59:59')
                        left join subjects as sub on sub.id=scp.subject_id
                        left join semisters as sems on sems.id=sub.semister_id
                        left join branches as b on b.id=sub.branch_id
                        left join period_cycles as pc on pc.id=scp.cycle_id
                        left join periods as peri on peri.id=scp.period_id
                        left join colleges as c on c.id=b.college_id
                        where concat(scp.user_id,'_',scp.period_id) in (
                                select concat(scp.user_id,'_',scp.period_id) as staff_user_period_ids
                                from staff_cycles_periods as scp
                                where scp.weekday_id=" . date('N', $dateLimit) . " and concat(scp.user_id,'_',scp.period_id) not in (
                                                select concat(spa.staff_user_id,'_',spa.period_id) as staff_user_period_ids
                                                from student_periods_attendence as spa
                                                where spa.create_date BETWEEN '" . date('Y-m-d', $dateLimit) . " 00:00:00' and '" . date('Y-m-d', $dateLimit) . " 23:59:59'
                                                group by staff_user_period_ids
                                        )
                                group by staff_user_period_ids
                        )
                        and sr.status='1'
                        and sr.branch_id=(select branch_id from staff_records as sr where user_id='" . $user_details->id . "')

                        group by concat(scp.user_id,'_',scp.period_id)
                ";
            // echo $sql; die;
            /*
             * - In Above the inner-most sub query is to fetch staff user_id's who have submitted there attendance for d day.
             * - The next subquery is to select staff user_id's who HAVE TO submit there attendace. NOW the `not in` is used to remove the user_id's
             *      who have submitted there attendance.
             *      i.e (who all have to submit for d day - who submitted for d day = who dint submit)
             * - The Main Query then gets the details resulted from users_id's from sub queries
             *      
             */

            $data = $this->my_db_lib->get_jqgrid_data($post, $sql);

            if (count($data->db_data)) {
                $i = 0;
                foreach ($data->db_data as $k => $v) {
                    // print_r($v);
                    /*
                     * MAKE A ENTRY FOR BREACH COUNTER
                     */
                    $breach_id = $this->staff_model->breachCounterEntry($v['user_id'], $v['period_id']);
                    if (empty($v['breach_id'])) {
                        $v['breach_id'] = $breach_id; // New Entry.
                        $v['breach_date'] = date('Y-m-d');
                    } else {
                        $v['breach_date'] = dateFormat($v['breach_date'], 'Y-m-d');
                    }

                    $data->rows[$i]['id'] = $v['id'];
                    $is_approved = ($v['unlocked'] == '1') ? '<span style="color:green;">Unlocked</span>' : '<a href="javascript:unlock_breach(' . $v['user_id'] . ',' . $v['breach_id'] . ');">Unlock</a>';
                    $data->rows[$i]['cell'] = array(
                        $v['code'], $v['name'], $v['college_name'], $v['breach_date'], $v['branch_name'], $v['subject_name'],
                        $v['semister_name'], $v['cycle_name'], $v['time_label'], $is_approved
                    );
                    $i++;
                }
            } else {
                $data->rows[0]['id'] = 0;
                $data->rows[0]['cell'] = array('No Breaches Today', '', '', '', '', '', '', '', '', '');
            }
            unset($data->db_data);
            echo json_encode($data);
        } else {
            $data['content_page'] = 'staff/attendance_breach_grid';
            $this->load->view('common/base_template', $data);
        }
    }

    function unlock_breach() {
        $post = $this->input->post();
        $user_details = $this->session->userdata('user_details');

        if ($post) {
            $post['unlocked'] = '1';
            echo $this->my_db_lib->save_record($post, 'attendance_breach_counter');
        }
    }

    function post_exam_results() {
        $post = $this->input->post();
        if ($post) {
            if (isset($post['student_marks'])) {
                /*
                 * Student Marks Submitted
                 */
                foreach ($post['student_marks'] as $k_user_id => $v_marks) {
                    $marksPost = $post;
                    foreach ($v_marks as $k => $v) {
                        $marksPost['user_id'] = $k_user_id;
                        $marksPost['user_id'] = $k_user_id;
                        $marksPost['internal_number'] = $k;
                        $marksPost['objective'] = $v['objective'];
                        $marksPost['descriptive'] = $v['descriptive'];
                        $marksPost['assignment'] = $v['assignment'];
                        $this->general_model->saveRecord($marksPost, 'student_internal_marks');
                    }
                }
                $this->session->set_flashdata('success_msg', 'Marks registered Successfully.');
                redirect('staff/post_exam_results');
            } else {
                /*
                 * Check for studnet Marks in DB and show filled readonly OR Empty Form.
                 */

                $students_data = $this->staff_model->getStudents($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id'], $post['section_id']);
                $student_marks_data = $this->staff_model->getStudentsInternalMarks($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id'], $post['subject_id'], $post['section_id']);
                $student_marks = array();
                if (!empty($student_marks_data)) {
                    // print_r($student_marks_data);
                    foreach ($student_marks_data as $key => $value) {
                        $student_marks[$value->user_id][$value->internal_number]['objective'] = $value->objective;
                        $student_marks[$value->user_id][$value->internal_number]['descriptive'] = $value->descriptive;
                        $student_marks[$value->user_id][$value->internal_number]['assignment'] = $value->assignment;
                    }
                }
//                print_r($students_data);
                $viewData['students_data'] = $students_data;
                $viewData['student_marks'] = $student_marks;
                $viewData['s_data'] = $post;
                $semister_year = generalId('year', 'semisters', 'id', $post['semister_id']);
                $viewData['s_data']['is_first_year'] = (($post['is_mba'] == '0' && $semister_year == '1') ? '1' : '0');
                $viewData['content_page'] = 'staff/post_exam_results';
                $this->load->view('common/base_template', $viewData);
            }
        } else {
            $data['content_page'] = 'staff/post_exam_results';
            $this->load->view('common/base_template', $data);
        }
    }

    function getStaffSubjects() {
        $post = $this->input->post();
        $data = $this->staff_model->getStaffSubjects($this->ci_user_details->id, $post['semister_id']);
        $return = '<option value="">Select</option>';
        if (!empty($data))
            foreach ($data as $key => $value) {
                $return.='<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        echo $return;
    }

    function getStaffSections() {
        $post = $this->input->post();
        $data = $this->staff_model->getStaffSections($this->ci_user_details->id, $post['semister_id']);
        $return = '<option value="">Select</option>';
        if (!empty($data))
            foreach ($data as $key => $value) {
                $return.='<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        echo $return;
    }

    function send_student_marks() {
        $post = $this->input->post();
        if ($post && !empty($post['subject_ids']) && !empty($post['marks_types_ids'])) {

            $students_data = $this->staff_model->get_students($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id']);
            $student_marks_data = $this->staff_model->get_students_internal_marks($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id']);
            $student_marks = array();
//            echo '<pre>'; print_r($students_data); echo '</pre>';
//            echo '<pre>'; print_r($student_marks_data); echo '</pre>';

            if (!empty($student_marks_data)) {
                // print_r($student_marks_data);
                foreach ($student_marks_data as $key => $value) {
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['objective'] = $value->objective;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['descriptive'] = $value->descriptive;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['assignment'] = $value->assignment;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['subject_type_id'] = $value->subject_type_id;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['is_mba'] = $value->is_mba;
                }
            }

//            $student_wise_marks=array();
//            foreach($student_marks_data as $sm_k=>$sm_v){
//                $student_wise_marks[$sm_v->user_id][]=$sm_v;
//            }
            $error_msg = $success_msg = '';

            if (!empty($students_data)) {
                foreach ($students_data as $sd_k => $sd_v) {
                    $SMS_MSG = "Student Name:" . $sd_v->name . "\nYear/sem:" . $sd_v->sem_name;
                    $selectedSubjectMarksFound = FALSE;

                    if (!empty($student_marks[$sd_v->user_id])) {
                        foreach ($student_marks[$sd_v->user_id] as $sm_k => $sm_v) {
                            $subject_name = generalId('name', 'subjects', 'id', $sm_k);
                            /*
                             * BELOW PROCESS SIMILAR TO & TAKEN FROM views/admin/post_exam_results.php - WHICH is as PER THE PDF.
                             */
                            if (in_array($sm_k, $post['subject_ids'])) { /* SEND ONLY IF SUBJECT SELECTED IN THE FORM */
                                $selectedSubjectMarksFound = TRUE;
                                $avg_marks = $total_marks1 = $total_marks2 = $total_marks3 = 0;
                                if (!empty($student_marks[$sd_v->user_id][$sm_k][1]['is_mba']) && $student_marks[$sd_v->user_id][$sm_k][1]['is_mba'] == '1') { /* FOR MBA PATTERN */
                                    if (!empty($student_marks[$sd_v->user_id][$sm_k][1]['subject_type_id']) && $student_marks[$sd_v->user_id][$sm_k][1]['subject_type_id'] == '2') { /* IF LAB */
                                        $avg_marks = $student_marks[$sd_v->user_id][$sm_k][1]['objective'];
                                    } else { /* IF Subjective */
                                        $avg_marks = $student_marks[$sd_v->user_id][$sm_k][1]['objective'];
                                        $avg_marks = ($student_marks[$sd_v->user_id][$sm_k][2]['objective'] > $avg_marks) ? $student_marks[$sd_v->user_id][$sm_k][2]['objective'] : $avg_marks;
                                    }
                                } else { /* IF B.Tech PATTERN */

                                    /* FOR INTERNAL WISE SMS - USE THIS IF ASKED INTERNAL WISE

                                      if(isset($student_marks[$sd_v->user_id][$sm_k][1]['objective']) && in_array(1,$post['marks_types_ids'])){
                                      $total_marks1= $student_marks[$sd_v->user_id][$sm_k][1]['objective']+$student_marks[$sd_v->user_id][$sm_k][1]['descriptive']+$student_marks[$sd_v->user_id][$sm_k][1]['assignment'];
                                      $SMS_MSG.="\n".$subject_name." Int1:".$total_marks1;
                                      }
                                      if(isset($student_marks[$sd_v->user_id][$sm_k][2]['objective']) && in_array(2,$post['marks_types_ids'])){
                                      $total_marks2= $student_marks[$sd_v->user_id][$sm_k][2]['objective']+$student_marks[$sd_v->user_id][$sm_k][2]['descriptive']+$student_marks[$sd_v->user_id][$sm_k][2]['assignment'];
                                      $SMS_MSG.="\n".$subject_name." Int2:".$total_marks1;
                                      }
                                      if(isset($student_marks[$sd_v->user_id][$sm_k][3]['objective']) && in_array(3,$post['marks_types_ids'])){
                                      $total_marks3= $student_marks[$sd_v->user_id][$sm_k][3]['objective']+$student_marks[$sd_v->user_id][$sm_k][3]['descriptive']+$student_marks[$sd_v->user_id][$sm_k][3]['assignment'];
                                      $SMS_MSG.="\n".$subject_name." Int3:".$total_marks1;
                                      }

                                     */

                                    if (isset($student_marks[$sd_v->user_id][$sm_k][1]['objective'])) {
                                        $avg_marks = $total_marks1 = $student_marks[$sd_v->user_id][$sm_k][1]['objective'] + $student_marks[$sd_v->user_id][$sm_k][1]['descriptive'] + $student_marks[$sd_v->user_id][$sm_k][1]['assignment'];
                                    }
                                    if (isset($student_marks[$sd_v->user_id][$sm_k][2]['objective'])) {
                                        $total_marks2 = $student_marks[$sd_v->user_id][$sm_k][2]['objective'] + $student_marks[$sd_v->user_id][$sm_k][2]['descriptive'] + $student_marks[$sd_v->user_id][$sm_k][2]['assignment'];
                                        $avg_marks+=$total_marks2;
                                    }
                                    if (isset($student_marks[$sd_v->user_id][$sm_k][3]['objective'])) {
                                        $total_marks3 = $student_marks[$sd_v->user_id][$sm_k][3]['objective'] + $student_marks[$sd_v->user_id][$sm_k][3]['descriptive'] + $student_marks[$sd_v->user_id][$sm_k][3]['assignment'];
                                        $avg_marks+=$total_marks3;
                                    }

                                    if ($avg_marks > 0)
                                        $avg_marks = $avg_marks / 2; /* ACTUALY THIS LINE NOT NEEDED. */

                                    $best_of_2 = ($total_marks1 > $total_marks2) ? $total_marks1 : $total_marks2;
                                    if (isset($student_marks[$sd_v->user_id][$sm_k][3]['objective'])) {
                                        if ($total_marks1 && $total_marks2 && $total_marks3) {
                                            $best_of_2 = round(($total_marks1 + $total_marks2 + $total_marks3) / 3);
                                        } else {
                                            $best_of_2 = '';
                                        }
                                    }
                                    $avg_marks = $best_of_2;
                                }

                                $SMS_MSG.="\n" . $subject_name . ":" . $avg_marks;
                            }
                        }/* $student_marks Foreach end */

                        $SMS_MSG.="\n\n" . $sd_v->college_name;
                        /* SEND SMS TO FATHER */
                        if (!empty($sd_v->father_mobile) && $selectedSubjectMarksFound) {
                            $this->sms_lib->send_sms($sd_v->father_mobile, $SMS_MSG);
                        }
                        if ($selectedSubjectMarksFound) {
                            $success_msg.='SMS Sent to ' . $sd_v->name . '(' . $sd_v->students_number . ') Father<br/>';
                        } else {
                            $error_msg.='No Marks found for ' . $sd_v->name . '(' . $sd_v->students_number . ')..<br/>';
                        }
                    } else {
                        $error_msg.='No Marks found for ' . $sd_v->name . '(' . $sd_v->students_number . ')<br/>';
                    }
                }/* $students_data Foreach end */
            } else {
                $error_msg.='No Students Found.!! Please try again.<br/>';
            }
            if (!empty($error_msg)) {
                $this->session->set_flashdata('error_msg', $error_msg);
            }
            if (!empty($success_msg)) {
                $this->session->set_flashdata('success_msg', $success_msg);
            }
            redirect('staff/send_student_marks');

//            $viewData['students_data']=$students_data;
//            $viewData['student_marks']=$student_marks;
//            
//            $viewData['subjects_data']=$this->staff_model->get_subjects($post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id']);
//            $viewData['marks_types']=$this->staff_model->get_marks_type();
//            $viewData['form_data']=$post;
//            
//            $viewData['content_page']='staff/send_student_marks';
//            $this->load->view('common/base_template',$viewData);
        } else if ($post && !empty($post['marks_types_ids'])) {

            $viewData['subjects_data'] = $this->staff_model->get_subjects($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id']);
            $viewData['marks_types'] = $this->staff_model->get_marks_type();
            $viewData['form_data'] = $post;
            $viewData['content_page'] = 'staff/send_student_marks';
            // echo '<pre>'; print_r($viewData); echo '</pre>';
            $this->load->view('common/base_template', $viewData);
        } else {
            $data['marks_types'] = $this->staff_model->get_marks_type();
            $data['content_page'] = 'staff/send_student_marks';
            $this->load->view('common/base_template', $data);
        }
    }

    function send_teacher_sms() {
        $post = $this->input->post();
        if ($post) {
            $subject_id = $post['subject_id'];
            $teachers = $this->staff_model->get_teachers_assigned_to_subject($subject_id);
            if (!empty($teachers)) {
                foreach ($teachers as $k => $v) {
                    $SMS_MSG = "Dear " . $v->name . "/nPlease post the Marks for " . $v->subject_name . " for the " . $v->semister_name . ".\n\n" . $sd_v->college_name;
                    /* SEND SMS TO TEACHER */
                    if (!empty($v->mobile)) {
                        $this->sms_lib->send_sms($v->mobile, $SMS_MSG);
                    }
                }
            }
        }
    }

    /*
     * STUDENT INTERNAL MARKS PROGRESS REPORT
     */

    function progress_card() {
        $post = $this->input->post();
        if ($post && !empty($post['marks_types_ids'])) {

//            $students_data=$this->staff_model->get_students($post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id']);
            $this->load->model('admin_model');
//            $student_details=$this->admin_model->get_user_details($post['user_id']);
            $student_marks_data = $this->staff_model->get_students_internal_marks($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id']);
            $student_marks = array();
//            echo '<pre>'; print_r($students_data); echo '</pre>';
//            echo '<pre>'; print_r($student_marks_data); echo '</pre>';

            if (!empty($student_marks_data)) {
                // print_r($student_marks_data);
                foreach ($student_marks_data as $key => $value) {
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['objective'] = $value->objective;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['descriptive'] = $value->descriptive;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['assignment'] = $value->assignment;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['subject_type_id'] = $value->subject_type_id;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['is_mba'] = $value->is_mba;
                }
            }

            $viewData['students_data'] = $this->staff_model->get_students($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id']);

            $viewData['student_marks'] = $student_marks;
//            $viewData['student_details']=$student_details['student_details'];

            $viewData['subjects_data'] = $this->staff_model->get_subjects($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id']);
            $viewData['marks_types'] = $this->staff_model->get_marks_type();
            $viewData['form_data'] = $post;

            $viewData['content_page'] = 'staff/progress_card';
            $this->load->view('common/base_template', $viewData);
        } else {
            $data['marks_types'] = $this->staff_model->get_marks_type();
            $data['content_page'] = 'staff/progress_card';
            $this->load->view('common/base_template', $data);
        }
    }

    function progress_card_XXXX() {
        $post = $this->input->post();
        if ($post && !empty($post['user_id']) && !empty($post['marks_types_ids'])) {

//            $students_data=$this->staff_model->get_students($post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id']);
            $this->load->model('admin_model');
            $student_details = $this->admin_model->get_user_details($post['user_id']);
            $student_marks_data = $this->staff_model->get_students_internal_marks($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id']);
            $student_marks = array();
//            echo '<pre>'; print_r($students_data); echo '</pre>';
//            echo '<pre>'; print_r($student_marks_data); echo '</pre>';

            if (!empty($student_marks_data)) {
                // print_r($student_marks_data);
                foreach ($student_marks_data as $key => $value) {
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['objective'] = $value->objective;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['descriptive'] = $value->descriptive;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['assignment'] = $value->assignment;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['subject_type_id'] = $value->subject_type_id;
                    $student_marks[$value->user_id][$value->subject_id][$value->internal_number]['is_mba'] = $value->is_mba;
                }
            }


            $viewData['student_marks'] = $student_marks[$value->user_id];
            $viewData['student_details'] = $student_details['student_details'];

            $viewData['subjects_data'] = $this->staff_model->get_subjects($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id']);
            $viewData['marks_types'] = $this->staff_model->get_marks_type();
            $viewData['form_data'] = $post;

            $viewData['content_page'] = 'staff/progress_card';
            $this->load->view('common/base_template', $viewData);
        } else if ($post && !empty($post['marks_types_ids'])) {
            $viewData['students_data'] = $this->staff_model->get_students($post['college_id'], $post['course_id'], $post['branch_id'], $post['semister_id']);

            $viewData['marks_types'] = $this->staff_model->get_marks_type();
            $viewData['form_data'] = $post;
            $viewData['content_page'] = 'staff/progress_card';
            // echo '<pre>'; print_r($viewData); echo '</pre>';
            $this->load->view('common/base_template', $viewData);
        } else {
            $data['marks_types'] = $this->staff_model->get_marks_type();
            $data['content_page'] = 'staff/progress_card';
            $this->load->view('common/base_template', $data);
        }
    }

    /*
     * @@START: Notification Panel Feature.
     * 
     */

    function notification_panel() {
        $post = $this->input->post();
        $userDetails = $this->session->userdata('user_details');
        if (!empty($post)) {
            $this->load->library('my_email_lib');
            $smsMsg = 'You have a High Priority notification. Please login to MyCollege Portal to view the notification. ';
            $doc_link = '';
            $phoneNumbers = $emailIds = $users = array();

            if (!empty($post['doc_link'])) {
                $doc_link = '<br/><br/>' . anchor(base_url() . 'uploads/' . $post['doc_link'], 'Attached File', array('target' => '_blank'));
            }

            switch ($post['notification_for']) {
                case 'hod':
                    $users = $this->exam_model->get_staff_user_details('hod');
                    break;
                case 'students':
                    foreach ($post['student_ids'] as $key => $value) {
                        if (!empty($post['student_phone_nos'][$value]))
                            $phoneNumbers[$value] = $post['student_phone_nos'][$value];
                        if (!empty($post['student_emails'][$value]))
                            $emailIds[$value] = $post['student_emails'][$value];
                    }
                    // $phoneNumbers=$post['student_phone_nos'];
                    // $emailIds=$post['student_emails'];
                    break;
                case 'faculty':
                    $users = $this->exam_model->get_staff_user_details('faculty');
                    break;
                case 'all':
                    $users_1 = $this->exam_model->get_students();
                    $users_2 = $this->exam_model->get_staff_user_details();
                    $users = array_merge($users_1, $users_2);
                    // $phoneNumbers=$post['student_phone_nos'];
                    break;
                default:

                    break;
            }

            /*
             * Extract Phone and email from $user, If exists
             */
            if (!empty($users)) {
                foreach ($users as $key => $value) {
                    $phoneNumbers[$value->user_id] = $value->mobile;
                    $emailIds[$value->user_id] = $value->email;
                }
            }


            /*
             * Send Message to Email IDs
             */
            if (!empty($emailIds)) {
                $createdTimeStamp = time();
                foreach ($emailIds AS $k => $v) {
                    $this->my_email_lib->html_email($v, 'noreply@mycollege.org', 'My College-Notification', $post['message'] . $doc_link);
                    /*
                     * Save in DB.
                     */
                    $saveNotificationPost = $post;
                    $saveNotificationPost['message'] = $post['message'] . $doc_link;
                    $saveNotificationPost['user_id'] = $k;
                    $saveNotificationPost['created_by'] = $userDetails->id;
                    $saveNotificationPost['created_timestamp'] = $createdTimeStamp;
                    $this->general_model->saveRecord($saveNotificationPost, 'notification_panel');
                }
            }

            /*
             * Send SMS if priority high
             */
            if (!empty($phoneNumbers) && $post['priority'] == 'high') {
                foreach ($phoneNumbers AS $k => $v) {
                    if (!empty($v))
                        $this->sms_lib->send_sms($v, $smsMsg);
                }
            }

            $this->session->set_flashdata('success_msg', 'Messages sent Successfully.');
            redirect('staff/notification_panel');
        }else {
            $data['content_page'] = 'staff/notification_panel';
            $this->load->view('common/base_template', $data);
        }
    }

    /*
     * Ajax for Displaying the students
     */

    function students_filter_list() {
        $post = $this->input->post();
        if (!empty($post)) {
            $data['students'] = $this->exam_model->get_students($post);
            $this->load->view('exam/students_filter_list', $data);
        }
    }

    /*
     * @@END: Notification Panel Feature
     */


    /*
     * Attendance Report
     */

    function attendance_report() {
        $post = $this->input->post();
        if (!empty($post)) {
            $data['form_data'] = $post;
            $data['content_page'] = 'staff/attendance_report';
            $student_attendance = $this->staff_model->getStudentAttendanceCounts($post);
            $data['attendance_types'] = $this->general_model->getTableData('attendance_types');

            /* Attendance Ids considered to be as attended. */
            $presentIds = array(1);
            $student_attendance_arr = array();

            /* Format the data */
            if (!empty($student_attendance)) {
                foreach ($student_attendance as $key => $value) {
                    $student_attendance_arr[$value->user_id][$value->attendance_id] = $value;
                    $student_attendance_arr[$value->user_id]['students_number'] = $value->students_number;

                    if (in_array($value->attendance_id, $presentIds)) {
                        if (!empty($student_attendance_arr[$value->user_id]['total_attended'])) {
                            $student_attendance_arr[$value->user_id]['total_attended']+=$value->number_of_classes;
                        } else {
                            $student_attendance_arr[$value->user_id]['total_attended'] = $value->number_of_classes;
                        }
                    }

                    if (!empty($student_attendance_arr[$value->user_id]['total_classes'])) {
                        $student_attendance_arr[$value->user_id]['total_classes']+=$value->number_of_classes;
                    } else {
                        $student_attendance_arr[$value->user_id]['total_classes'] = $value->number_of_classes;
                    }

                    /* FallBack Check */
                    if (empty($student_attendance_arr[$value->user_id]['total_attended'])) {
                        $student_attendance_arr[$value->user_id]['total_attended'] = 0;
                    }

                    $student_attendance_arr[$value->user_id]['attendance_percentage'] = round(($student_attendance_arr[$value->user_id]['total_attended'] / $student_attendance_arr[$value->user_id]['total_classes']) * 100, 2);
                }
            }
            $data['student_attendance'] = $student_attendance_arr;

            if (isset($post['export_to_excel'])) {
                /*
                 * Export to Excel
                 */

                error_reporting(0);
                // error_reporting(E_ALL);
                // ini_set('display_errors','1');
                $this->load->library('Exellmanager');
                $workbook = Exellmanager::getInstance();

                // HeaderingExcel('Report.xls');
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=Attendance_Report.xls");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                header("Pragma: public");

                $workbook = new Workbook("-");
                $worksheet = & $workbook->add_worksheet('Attendance_Report');


                $header = & $workbook->add_format();
                $header->set_size(10);
                $header->set_bold(0);
                $header->set_align('left');
                $header->set_color('black');
                $header->set_left(1);
                $header->set_right(1);
                $header->set_bottom(1);

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

                if (!empty($post['college_id'])) {
                    $worksheet->write_string($row, $col++, "College: ", $h);
                    $worksheet->write_string($row, $col++, generalId('name', 'colleges', 'id', $post['college_id']), $h);
                    $row++;
                    $col = 0;
                }
                if (!empty($post['course_id'])) {
                    $worksheet->write_string($row, $col++, "Course: ", $h);
                    $worksheet->write_string($row, $col++, generalId('name', 'courses', 'id', $post['course_id']), $h);
                    $row++;
                    $col = 0;
                }
                if (!empty($post['branch_id'])) {
                    $worksheet->write_string($row, $col++, "Branch: ", $h);
                    $worksheet->write_string($row, $col++, generalId('name', 'branches', 'id', $post['branch_id']), $h);
                    $row++;
                    $col = 0;
                }
                if (!empty($post['semister_id'])) {
                    $worksheet->write_string($row, $col++, "Semester: ", $h);
                    $worksheet->write_string($row, $col++, generalId('name', 'semisters', 'id', $post['semister_id']), $h);
                    $row++;
                    $col = 0;
                }
                if (!empty($post['section_id'])) {
                    $worksheet->write_string($row, $col++, "Section: ", $h);
                    $worksheet->write_string($row, $col++, generalId('section', 'sections', 'id', $post['section_id']), $h);
                    $row++;
                    $col = 0;
                }
                if (!empty($post['subject_id'])) {
                    $worksheet->write_string($row, $col++, "Subject: ", $h);
                    $worksheet->write_string($row, $col++, generalId('name', 'subjects', 'id', $post['subject_id']), $h);
                    $row++;
                    $col = 0;
                }
                if (!empty($post['academic_year_id'])) {
                    $worksheet->write_string($row, $col++, "Academic years: ", $h);
                    $worksheet->write_string($row, $col++, generalId('name', 'academic_years', 'id', $post['academic_year_id']), $h);
                    $row++;
                    $col = 0;
                }
                if (!empty($post['month'])) {
                    $worksheet->write_string($row, $col++, "Month: ", $h);
                    $worksheet->write_string($row, $col++, dateFormat('2013-' . $post['month'] . '-1', "F"), $h);
                    $row++;
                    $col = 0;
                }
                if (!empty($post['percentage'])) {
                    $worksheet->write_string($row, $col++, "Percentage: ", $h);
                    $worksheet->write_string($row, $col++, $post['percentage'] . '% - ' . ($post['percentage'] + 10) . '%', $h);
                    $row++;
                    $col = 0;
                }

                $worksheet->write_string($row++, $col, "", $header);
                $col = 0;
                $worksheet->write_string($row, $col++, "Student Number ", $h);
                $worksheet->write_string($row, $col++, "Percentage ", $h);

                $row++;
                $col = 0;
                if (!empty($student_attendance_arr))
                    foreach ($student_attendance_arr as $k => $v) {
                        if (!empty($post['percentage']) && $post['percentage'] <= $v['attendance_percentage'] && $v['attendance_percentage'] <= ($post['percentage'] + 10)) {
                            $worksheet->write_string($row, $col++, $v['students_number'], $header);
                            $worksheet->write_string($row, $col++, $v['attendance_percentage'], $header);
                        } else if (empty($post['percentage'])) {
                            $worksheet->write_string($row, $col++, $v['students_number'], $header);
                            $worksheet->write_string($row, $col++, $v['attendance_percentage'], $header);
                        }

                        $row++;
                        $col = 0;
                    }

                $workbook->close();
            } else {
                $this->load->view('common/base_template', $data);
            }
        } else {
            $data['content_page'] = 'staff/attendance_report';
            $this->load->view('common/base_template', $data);
        }
    }

}

?>