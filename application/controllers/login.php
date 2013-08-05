<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function index()
    {
        // echo 'MMJ';
        $post=$this->input->post();
        $data['users_type']=$this->users_model->user_types();
        if(isset($post['uname']) && isset($post['psw'])){
            if($user_id=$this->users_model->validate_user($post)){
                $user_details=$this->users_model->user_details($user_id[0]->id);
                $this->session->set_userdata('user_details', $user_details[0]);
                $this->session->set_userdata('user_id', $user_details[0]->id);
				$this->session->set_userdata('user_name',str_replace(' ', '_',$user_details[0]->users_type).'-'.str_replace(' ', '_',$user_details[0]->username));
                // For CHAT
                session_start();
                $_SESSION['username']=str_replace(' ', '_',$user_details[0]->users_type).'-'.str_replace(' ', '_',$user_details[0]->username);
                // $this->session->set_userdata('username', $user_details[0]->users_type.'-'.$user_details[0]->username);  // FOR CHAT
                // echo $_SESSION['username']; die;
                // print_r($user_details); print_r($this->session->userdata('user_id'));die;
                // print_r($this->session->userdata('user_details'));
                $this->users_model->set_loggedin($user_details[0]->id,'1');
                switch($user_details[0]->users_type_id){
                    case 1:
                        redirect(site_url('students'));
                        break;
                    case 2:
                        redirect(site_url('staff'));
                        break;
                    case 3:
                        redirect(site_url('staff'));
                        break;
                    case 4:
                        redirect(site_url('library'));
                        break;
                    case 5:
                        redirect(site_url('book_keeper'));
                        break;
                    case 6:
                        redirect(site_url('office'));
                        break;
                    case 7:
                        redirect(site_url('office'));
                        break;
                    case 8:
                        redirect(site_url('exam'));
                        break;
                    case 9:
                        redirect(site_url('admin'));
                        break;
                    case 10:
                        redirect(site_url('misc'));
                        break;
                    default :
                        $data['error_msg']='<div class="error login_form" style="color:#E13300;">Invalid User Type. Please check your details.</div>';
                        $this->load->view('login',$data);
                }

                // $this->load->view('welcome_message');
            }else{
                $data['error_msg']='<div class="error login_form" style="color:#E13300;">Please check your details.</div>';
                $this->load->view('login',$data);
            }
        }else{
            $this->load->view('login',$data);
        }
        // $this->load->view('login');
    }

    function forgot(){
        $data['users_type']=$this->users_model->user_types();
        $post=$this->input->post();
        if(isset($post['uname'])){
            $post=$this->input->post();
            if($user_id=$this->users_model->validate_user2($post)){
                // Send Email containing psw.
                // YTI
                $user_data=$this->users_model->user_details($user_id[0]->id);
                // print_r($user_data);
                $to=$user_data[0]->email;
                $from='noreply@mycollege.goendeavor.com';
                $subject='My College - Forgot Password mail.';
                $body='<table border="0" class="sample">
                            <tbody>
                            <tr>
                                <th>My College</th>
                            </tr>
                            <tr>
                                <td>&nbsp; </td>
                            </tr>
                            <tr>
                                <td>Forgot Password Mail.</td>
                            </tr>
                            <tr>
                                <td>Please find your password below.</td>
                            </tr>
                            <tr>
                                <td>&nbsp; </td>
                            </tr>
                            <tr>
                                <td>Username: '.$user_data[0]->username.'</td>
                            </tr>
                            <tr>
                                <td>Password: '.$user_data[0]->password.'</td>
                            </tr>
                            <tr>
                                <td>&nbsp; </td>
                            </tr>
                            <tr>
                                <td>Thank you, </td>
                            </tr>
                            <tr>
                                <td>My College</td>
                            </tr>
                        </tbody>
                   </table>';
                // echo $body;
                
                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // Additional headers
                $headers .= 'To: '.$to. "\r\n";
                $headers .= 'From: My College <'.$from.'>' . "\r\n";
                $headers .= 'Cc: ' . "\r\n";
                $headers .= 'Bcc: ' . "\r\n";
                mail($to, $subject,  $body, $headers);
                
                $data['error_msg']='<div class="login_form" style="color:green;">Your Password is sent to your Email.</div>';
                $this->load->view('login',$data);
            }else{
                $data['error_msg']='<div class="error login_form" style="color:#E13300;">Please check your details.</div>';
                $this->load->view('login',$data);
            }
        }else{
            redirect('login');
        }
    }

    function change_password(){
        if($this->input->post()){
            $post=$this->input->post();
            $user_details=$this->session->userdata('user_details');
            $post['uname']=$user_details->username;
            // $post['username']=$post['uname'];
            if($this->users_model->validate_user($post)){
                $post['id']=$user_details->id;
                $this->my_db_lib->save_record($post,'users');
                echo 1;
            }else{
                echo 0;
            }
        }else{
            // print_r($user_details=$this->session->userdata('user_details'));
            echo 0;
        }
    }


    

}

?>
