<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function index()
    {
        $data['users']=$this->users_model->get_loggedin_users($this->session->userdata('user_id'));
        $data['content_page'] = 'chat';
        $this->load->view('common/base_template', $data);
    }

       

}

?>
