<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_registration extends CI_Controller {

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model(array('students_model','staff_model','admin_model'));
    }

    public function index() {
        $data['content_page'] = 'misc/student_form';
        $this->load->view('misc/student_form', $data);
    }

    function save_student(){
        $post=$this->input->post();
        if($post){
            $post['users_type_id']=1;
            {
                // First Save only user login details form
                $user_id=$this->my_db_lib->save_record($post,'users');
            }
            if(empty($post['id']))
                $post['user_id']=$user_id;
            else
                $post['user_id']=$post['id'];

            // Save Student Form
            $post['id']=$post['student_rec_id'];
            $this->my_db_lib->save_record($post,'student_records');
            if(isset($post['sem_id'])){
                $this->admin_model->save_student_semester($post['user_id'],$post['sem_id']);
            }
            echo showBigSuccess('<p> User saved successfully.</p>'); // <br/><br/>
                    // <input type="button" name="imageField" id="imageField" class="send button" value="Back" onclick="javascript:window.location=\''.site_url('student_registration').'\';"/>';
        }
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

}

?>
