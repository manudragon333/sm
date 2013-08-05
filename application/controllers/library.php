<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model(array('students_model','library_model'));
        $this->request_counts();
    }
    
    public function index()
    {
        $data["notice_board"]=$this->students_model->get_notice_board();
        $data['content_page']='library/home';
        $this->load->view('common/base_template',$data);
    }

    function book_details(){
        $data['content_page']='library/book_details';
        $this->load->view('common/base_template',$data);
    }

    function save_book(){
        if($this->input->post()){
            $post=$this->input->post();
            $result=$this->my_db_lib->save_record($post,'library_books');
            if($result){
                echo showBigSuccess('<p> Book Saved Successfully.</p>');
            }else{
                echo showBigSuccess('<p> Problem Saving book. please try again.</p>');
            }

        }
    }

    function add_book(){
        $data['content_page']='library/add_book';
        $this->load->view('common/base_template',$data);
    }

    function delete_book(){
        if($this->input->post('unique_number')){
            if($this->library_model->check_if_reserved($this->input->post('unique_number'))){
                echo showBigError('Book is reserved. Cannot update/delete a reserved book.');
                return true;
            }
            $post=$this->input->post();
            $data['data']=$this->library_model->get_book_details($post['unique_number']);
            $this->load->view('library/delete_book_confirmation',$data);
        }else{
            $data['content_page']='library/delete_book';
            $this->load->view('common/base_template',$data);
        }
    }

    function book_delete_confirm(){
        if($this->input->post('id')){
            $post=$this->input->post();
            $this->library_model->delete_book($post['id']);
            echo showBigSuccess('<p>Book Deleted Succesfully.</p>');
        }else{
            echo showBigError('<p>Problem deleting Book.</p>');
        }
    }

    function update_book(){
        if($this->input->post('unique_number')){
            if($this->library_model->check_if_reserved($this->input->post('unique_number'))){
                echo showBigInfo('Book is reserved. Cannot update/delete a reserved book.');
                return true;
            }
            $post=$this->input->post();
            $data['data']=$this->library_model->get_book_details($post['unique_number']);
            $this->load->view('library/update_book_details',$data);
        }else{
            $data['content_page']='library/update_book';
            $this->load->view('common/base_template',$data);
        }
    }

    function check_data(){
        if($this->input->post()){
            $post=$this->input->post();
            $data['student_number']=$post['student_number'];
            $this->load->view('library/check_data_grid',$data);
        }else{
            $data['content_page']='library/check_data';
            $this->load->view('common/base_template',$data);
        }
    }

    function check_data_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select lb.*,l.unique_number,l.name,l.author,l.version,l.year,b.name as branch_name,
                    sr.name as student_name,sr.students_number,sr.email,sr.mobile from library_booking lb
                    left join library_books as l on lb.book_id=l.id
                    left join branches as b on b.id=l.branch_id
                    left join student_records as sr on sr.user_id=lb.user_id
                    where sr.students_number='".$post['student_number']."' and lb.status='1'";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action=($v['is_dispatched'])?'Dispatched':'Yet to Dispatch';
                    $data->rows[$i]['cell']=array($v['unique_number'],$v['name'],$v['author'],$v['version'],$v['year'],$v['branch_name'],$v['student_name'],$v['students_number'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }
    }

    function books_dispatched(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select lb.*,l.unique_number,l.name,l.author,l.version,l.year,b.name as branch_name,
                    ifnull(sr.name,stfr.name) as student_name,ifnull(sr.students_number,stfr.code) as students_number,sr.email,sr.mobile from library_booking lb
                    left join library_books as l on lb.book_id=l.id
                    left join branches as b on b.id=l.branch_id
                    left join student_records as sr on sr.user_id=lb.user_id
                    left join staff_records as stfr on stfr.user_id=lb.user_id
                    where lb.is_dispatched='1' and lb.status='1'";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action='<a href="javascript:void(0)" onclick="javascript:flag_printed(\''.$v['id'].'\')" title=" ">Action?</a>';
                    $data->rows[$i]['cell']=array($v['unique_number'],$v['name'],$v['author'],$v['version'],$v['year'],$v['branch_name'],$v['student_name'],$v['students_number']);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='library/books_dispatched';
            $this->load->view('common/base_template',$data);
        }
    }
    
    function no_due(){
        $data['content_page']='library/no_due';
        $this->load->view('common/base_template',$data);
    }

    function email(){
        $data['content_page']='library/email';
        $this->load->view('common/base_template',$data);
    }
    










    /************************************************************
     * Common Functions to students staff etc...
     ************************************************************/
       
     function library_books(){
         if($this->input->post()){
            $post=$this->input->post();
            $sqlX="select l.*,b.name as branch_name from library_books as l
                    left join branches as b on b.id=l.branch_id
                    where l.id not in (select book_id from library_booking where status='1') and l.status='1'";
            $sql="select l.*,b.name as branch_name,lb.is_dispatched,ifnull(lb.date_booked,0) as date_booked from library_books as l
                    left join branches as b on b.id=l.branch_id
                    left join library_booking as lb on lb.book_id=l.id and lb.status='1'
                    where l.status='1'";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    if($v['date_booked']){
                        $date_booked=dateFormat($v['date_booked']);
                        $action='<label>Will be back on '.date('d-M-Y',strtotime($date_booked." +2 week")).'</label>';
                    }else{
                        $action='<a href="javascript:void(0)" onclick="javascript:reserve_book(\''.$v['id'].'\')" title=" Click to reserve the Book. ">Reserve Book</a>';
                    }
                    $data->rows[$i]['cell']=array($v['unique_number'],$v['name'],$v['author'],$v['title'],$v['edition_year'],$v['branch_name'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='library/library_books';
            $this->load->view('common/base_template',$data);
        }
     }

     function reserved_library_books(){
         if($this->input->post()){
            $post=$this->input->post();
            $user_details=$this->session->userdata('user_details');
            $user_id=$user_details->id;
            $sql="select lb.is_dispatched as is_collected,l.*,b.name as branch_name from library_books as l
                    left join branches as b on b.id=l.branch_id
                    left join library_booking as lb on lb.book_id=l.id
                    where l.id in (select book_id from library_booking where user_id='$user_id') and l.status='1' and lb.status='1'";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $collected=($v['is_collected'])?'<label title="You have collected this book.">Collected</label>':'<label title="Please collect this book from the library.">Not Collected</label>';
                    $data->rows[$i]['cell']=array($v['unique_number'],$v['name'],$v['author'],$v['version'],$v['year'],$v['branch_name'],$collected);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Books Reserved','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='library/library_books';
            $this->load->view('common/base_template',$data);
        }
     }

     function reserve_book(){
//         echo date('Y-m-d',strtotime(date("Y-m-d")." +2 week"));
//         echo date('Y-m-d',strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " +2 week")); die;
         if($this->input->post()){
            $post=$this->input->post();
            $user_details=$this->session->userdata('user_details');
            $post['user_id']=$user_id=$user_details->id;
            // Check number of books booked
            $number_of_books_reserved=$this->library_model->get_booking_count($user_id);
            if($number_of_books_reserved>=3){
                echo showBigInfo('You can only book/hold 3 books at a time.');
                return true;
            }
            if($this->library_model->check_book_reserved($post)){ // Putting this in case 2 users reserve a book simultaniously from diff browsers
                echo showBigError('Problem in reserving book. Please try again.');
            }else{
                $res_post['user_id']=$post['user_id'];
                $res_post['book_id']=$post['id'];
                $result=$this->my_db_lib->save_record($res_post,'library_booking');
                $this->load->model('users_model');
                $email_mobile=$this->users_model->get_user_email_mobile();
                //print_r();
              //  echo $result."/Testing/".print_r($email_mobile,true);
				if($result){
                    $msg=showBigSuccess('Your book is reserved.  Please Collect the Book from the Library within 48 hours.  Your return date is '.date('d-M-Y',strtotime(date("Y-m-d")." +2 week")).'.');
					//$this->db->query("insert into debug (name) values ('".$msg.$email_mobile['mobile']."')");
                    $this->sms_lib->send_sms($email_mobile['mobile'],$msg);
					
                    echo $msg;
                }
            }
         }else{
             echo showBigError('Please try again');
         }
     }



    function request_counts(){
        $counts=array();
        
        $user_id=$this->session->userdata('user_id');
        $sql="select nd.*,nda.approver_status,sr.name,sr.students_number,sr.doj,c.name as course,b.name as branch,sr.present_year,sr.completing_year
                    from nodue_applications as nd
                    left join student_records as sr on sr.user_id=nd.user_id
                    left join courses as c on c.id=sr.course_id
                    left join branches as b on b.id=sr.branch_id
                    left join nodue_approvals as nda on nda.application_id=nd.id
                    where nd.is_issued!='1' and nda.approver_id='".$user_id."' and nda.approver_status='0'";
        $this->load->model('office_model');
        $counts['no_due']=$this->office_model->get_request_counts($sql);
        $this->session->set_userdata('request_counts',$counts);
    }

}

?>
