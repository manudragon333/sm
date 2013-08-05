<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Misc_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function sample(){
        $sql="";
        $res = $this->db->query($sql);
        return $res->result();
    }


    

    
}

?>
