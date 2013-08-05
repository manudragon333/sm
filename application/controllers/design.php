<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Design extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        // $this->load->model('');
    }
    
    public function index()
    {
        $this->load->view('design');
    }

       

}

?>
