<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll extends CI_Controller {

    var $ci_user_id;
    function __construct() {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model('students_model');
        $this->load->model('poll_model');
        $userObj = $this->session->userdata('user_details');
        $this->ci_user_id = $userObj->id;
        $this->user_type_id = $userObj->users_type_id;
        if ($this->user_type_id == 1 or $this->user_type_id == 2 or $this->user_type_id == 3) {
            
        } else {
            redirect('login');
        }
        $student_data = $this->students_model->get_user_details($this->ci_user_id);
        $this->session->set_userdata('student_data', $student_data);
    }
    
    public function index()
    {
	
        $data["poll"]=$this->poll_model->polldetails($this->user_type_id,$this->ci_user_id);
		/*echo "<pre>";
		print_r($data["poll"]);*/
        $data['content_page']='poll/index';
        $this->load->view('common/base_template',$data);
    }
 public function voting()
    {
       if($this->input->post('submit') && $this->input->post('opt')!=''){
	   $check=$this->poll_model->checkpollforuser($this->ci_user_id,$_POST['opt'],$_POST['pid']);
	   if($check){
			$_POST['user_id']=$this->ci_user_id;
			$_POST['poll_id']=$_POST['pid'];
			$_POST['poll_option_id']=$_POST['opt'];
			$_POST['poll_date']=@date('Y-m-d H:i:s');
			$poll_id=$this->my_db_lib->save_record($_POST,'poll_users');
			
			}
			redirect('poll');
		}
    }
    

}

?>
