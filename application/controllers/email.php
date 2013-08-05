<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        // $this->load->model('');
    }
    
    public function index()
    {
        
    }

    function compose(){
        $data['content_page']='email/compose_email';
        $this->load->view('common/base_template',$data);
    }

    function send_email(){
        if($this->input->post()){
            $post=$this->input->post();
            if(isset($post['file_name']) && !empty($post['file_name'])){
                $file_arr['name']=$post['file_name'];
                $file_arr['type']=$post['file_type'];
                $file_arr['size']=$post['file_size'];
                $file_arr['path']=base_url().'uploads/'.$post['file_name'];
            }else{
                $file_arr=false;
            }
            $this->mail_file($post['to'],'noreply@mycollege.goendeavor.com',$post['subject'],$post['message'],$file_arr);
            echo showBigSuccess('<p>E-Mail Sent.</p>');
        }
    }

    function mail_file($to, $from, $subject, $body, $file){
        $boundary=md5(rand());
        $headers = array(
            'MIME-Version: 1.0',
            "Content-Type: multipart/mixed; boundary=\"{$boundary}\"",
            "From: {$from}"
        );
        if(is_array($file)){
            $message = array(
                "-- {$boundary}",
                'Content-Type: text/plain',
                'Content-Transfer-Encoding: 7bit',
                '',
                chunk_split($body),
                "---{$boundary}",
                "Content-Type: {$file['type']}; name=\"{$file['name']}\"",
                "Content-Disposition: attachment; filename=\"{$file['name']}\"",
                "Content-Transfer-Encoding: base64",
                '',
                chunk_split(base64_encode(file_get_contents($file['path']))),
                "--- {$boundary}--"
            );
        }else{
            $message = array(
                "-- {$boundary}",
                'Content-Type: text/plain',
                'Content-Transfer-Encoding: 7bit',
                '',
                chunk_split($body),
                "---{$boundary}",
            );
        }
        $message = array(chunk_split($body));
       // print_r(implode("\r\n", $message));
       @mail($to, $subject, implode("\r\n", $message), implode("\r\n", $headers));
    }
       

}

?>
