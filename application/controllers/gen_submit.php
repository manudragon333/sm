<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gen_submit extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model('gen_submit_model');
    }
    
    public function index()
    {
        if($this->input->post()){
            $post=$this->input->post();
            if(isset($post['rel'])){
                $rel=$post['rel'];
                if($table_name=$this->my_db_lib->get_table_name($rel)){
                    if($this->session->userdata('user_id')){
                        $user_id=$this->session->userdata('user_id');
                        $post['user_id']=$user_id[0];
                    }
                    $return=$this->my_db_lib->save_record($post,$table_name);
                    echo 1; // remove $return and kept `1 as genform submit expects 1 and not ID.!!
                }else{ echo 0; }
            }else{ echo 0; }
        }
    }

    public function indexXXXX()
    {
        if($this->input->post()){
            $post=$this->input->post();
            if(isset($post['rel'])){
                $rel=$post['rel'];
                if($table_name=$this->my_db_lib->get_table_name($rel)){
                    if($this->session->userdata('user_id')){
                        $user_id=$this->session->userdata('user_id');
                        $post['user_id']=$user_id[0];
                    }
                    if($data=$this->my_db_lib->filter_post($post,$table_name)){
                        $this->gen_submit_model->save_form($data,$table_name);
                    }else{ echo 0; }
                }else{ echo 0; }
            }else{ echo 0; }
        }
    }

       

}

?>
