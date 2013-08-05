<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        // $this->load->model('');
    }
    
    public function index()
    {
        session_start();
        $this->load->model('users_model');
        $this->users_model->set_loggedin($this->session->userdata('user_id'),'0');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        session_destroy();
        // print_r($_SESSION); die;
        redirect('login');
    }

       

}

?>
