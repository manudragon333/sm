<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_keeper extends CI_Controller {

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
        $data['content_page']='book_keeper/home';
        $this->load->view('common/base_template',$data);
    }

    function books_dispatched(){
        if($this->input->post()){
            $post=$this->input->post();
            $data['student_number']=$post['student_number'];
            $data['book_number']=$post['book_number'];
            $this->load->view('book_keeper/books_dispatched_grid',$data);
        }else{
            $data['content_page']='book_keeper/books_dispatched_grid';
            $this->load->view('common/base_template',$data);
        }
    }

    function books_dispatched_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select lb.*,l.unique_number,l.name,l.author,l.version,l.year,b.name as branch_name,
                    ifnull(sr.name,str.name) as student_name,ifnull(sr.students_number,str.code) as students_number,ifnull(sr.email,str.email) as email,ifnull(sr.mobile,str.mobile) as mobile from library_booking lb
                    left join library_books as l on lb.book_id=l.id
                    left join branches as b on b.id=l.branch_id
                    left join student_records as sr on sr.user_id=lb.user_id
                    left join staff_records as str on str.user_id=lb.user_id
                    where lb.is_dispatched='1'  and lb.status='1' ";
            if(isset($post['book_number']) && !empty($post['book_number'])) $sql.=" and l.unique_number like '%".$post['book_number']."%'";
            if(isset($post['student_number']) && !empty($post['student_number'])) $sql.=" and sr.students_number like '%".$post['student_number']."%'";
            if(isset($post['staff_number']) && !empty($post['staff_number'])) $sql.=" and str.code like '%".$post['staff_number']."%'";
            // echo $sql;

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action='<a href="javascript:void(0)" onclick="javascript:flag_printed(\''.$v['id'].'\')" title=" ">Action?</a>';
                    $data->rows[$i]['cell']=array($v['unique_number'],$v['name'],$v['author'],$v['version'],$v['year'],$v['branch_name'],$v['student_name'],$v['students_number'],dateFormat($v['dispatched_on'],'Y-m-d'));
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

    function receive_books(){
        if($this->input->post()){
            $post=$this->input->post();
            $data['student_number']=$post['student_number'];
            $data['teacher_number']=$post['teacher_number'];
            $this->load->view('book_keeper/receive_books_grid',$data);
        }else{
            $data['content_page']='book_keeper/receive_books';
            $this->load->view('common/base_template',$data);
        }
    }

    function receive_books_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select lb.*,l.unique_number,l.name,l.author,l.version,l.year,b.name as branch_name,
                    ifnull(sr.name,str.name) as student_name,ifnull(sr.students_number,str.code) as students_number,ifnull(sr.email,str.email) as email,ifnull(sr.mobile,str.mobile) as mobile from library_booking lb
                    left join library_books as l on lb.book_id=l.id
                    left join branches as b on b.id=l.branch_id
                    left join student_records as sr on sr.user_id=lb.user_id
                    left join staff_records as str on str.user_id=lb.user_id
                    where lb.is_dispatched='1' and lb.status='1'";
            // if(!empty($post['teacher_number'])) $sql.=" and l.unique_number like '%".$post['teacher_number']."%'";
            if(!empty($post['student_number'])) $sql.=" and sr.students_number like '%".$post['student_number']."%'";
            if(!empty($post['teacher_number'])) $sql.=" and str.code like '%".$post['teacher_number']."%'";
            // echo $sql;

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action='<a href="javascript:void(0)" onclick="javascript:receive_book(\''.$v['id'].'\')" title=" ">Receive Book</a>';
                    $data->rows[$i]['cell']=array($v['unique_number'],$v['name'],$v['author'],$v['version'],$v['year'],$v['branch_name'],$v['student_name'],$v['students_number'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }
    }

    function receive_book(){
        if($this->input->post()){
            $post=$this->input->post();
            $id=$post['id'];
            $sql="update library_booking set status='0' where id='$id'";
            $this->db->query($sql);
            echo showBigSuccess('Book Received.');
        }
    }
    function pass_on_books(){
        if($this->input->post()){
            $post=$this->input->post();
            $book_number=$post['book_number'];
            $student_number=$post['student_number'];
            $book_id=$this->library_model->get_book_id($book_number);
            $user_id=$this->library_model->get_student_user_id($student_number);
            if($this->library_model->check_if_reserved($this->input->post('book_number'))){
                echo showBigError('<div>Book is reserved. Cannot pass on a reserved book.</div>');
                return true;
            }
            if(empty($book_id)){
                echo showBigError('<div>Book not found. Please check the book number.</div>');
                return true;
            }
            if(empty($user_id)){
                echo showBigError('<div>Student not found. Please check the student number.</div>');
                return true;
            }
            if($rec_id=$this->library_model->is_book_reserved($book_id)){
                $this->library_model->un_reserve_book($rec_id);
                $this->library_model->reserve_book($book_id,$user_id);
            }else{
                $this->library_model->reserve_book($book_id,$user_id);
            }
            echo showBigSuccess('<p>Book Passed on successfully</p>');
        }else{
            $data['content_page']='book_keeper/pass_on_books';
            $this->load->view('common/base_template',$data);
        }
    }

    function books_reserved(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select lb.*,l.unique_number,l.name,l.author,l.version,l.year,b.name as branch_name,
                    ifnull(sr.name,str.name) as student_name,ifnull(sr.students_number,str.code) as students_number,ifnull(sr.email,str.email) as email,ifnull(sr.mobile,str.mobile) as mobile from library_booking lb
                    left join library_books as l on lb.book_id=l.id
                    left join branches as b on b.id=l.branch_id
                    left join student_records as sr on sr.user_id=lb.user_id
                    left join staff_records as str on str.user_id=lb.user_id
                    where lb.is_dispatched!='1' and lb.status='1'";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action='<a href="javascript:void(0)" onclick="javascript:dispatch_book(\''.$v['id'].'\')" title=" ">Dispatch Book</a>';
                    $data->rows[$i]['cell']=array($v['unique_number'],$v['name'],$v['author'],$v['version'],$v['year'],$v['branch_name'],$v['student_name'],$v['students_number'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='book_keeper/books_reserved';
            $this->load->view('common/base_template',$data);
        }
    }

    function dispatch_book(){
        if($this->input->post()){
            $post=$this->input->post();
            $postP['id']=$post['id'];
            $postP['is_dispatched']=1;
            $postP['dispatched_on']=date('Y-m-d');
            $this->my_db_lib->save_record($postP,'library_booking');
            echo 'Book Flagged as Dispatched.';
        }
    }

    function ticket(){
        $data['content_page']='book_keeper/ticket';
        $this->load->view('common/base_template',$data);
    }

    function ticket_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sqlBKUP="select lb.*,l.unique_number,l.name,l.author,l.version,l.year,b.name as branch_name,
                    ifnull(sr.name,str.name) as student_name,ifnull(sr.students_number,str.code) as students_number,ifnull(sr.email,str.email) as email,ifnull(sr.mobile,str.mobile) as mobile ,datediff(now(),lb.date_booked) as days
                    from library_booking as lb
                    left join library_books as l on lb.book_id=l.id
                    left join branches as b on b.id=l.branch_id
                    left join student_records as sr on sr.user_id=lb.user_id
                    left join staff_records as str on str.user_id=lb.user_id
                    where ((lb.is_dispatched='1' and  datediff(now(),lb.date_booked)>14) or (lb.is_dispatched!='1' and datediff(now(),lb.date_booked)>2)) and lb.status='1'";
            $sql="select lb.*,l.unique_number,l.name,l.author,l.version,l.year,b.name as branch_name,
                    ifnull(sr.name,str.name) as student_name,ifnull(sr.students_number,str.code) as students_number,ifnull(sr.email,str.email) as email,ifnull(sr.mobile,str.mobile) as mobile ,datediff(now(),lb.date_booked) as days
                    from library_booking as lb
                    left join library_books as l on lb.book_id=l.id
                    left join branches as b on b.id=l.branch_id
                    left join student_records as sr on sr.user_id=lb.user_id
                    left join staff_records as str on str.user_id=lb.user_id
                    where ((lb.is_dispatched!='1' and datediff(now(),lb.date_booked)>2)) and lb.status='1'";
            // echo $sql;

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){ 
                    $data->rows[$i]['id']=$v['id'];
                    if($v['days']>14 && $v['is_dispatched']=='1'){
                        $action='Yet to Return - <a href="javascript:void(0)" onclick="javascript:ticket_msg(\''.$v['id'].'\',\'return\',\''.$v['mobile'].'\')" title="Send message alerting to submit the book. ">Send message</a>';
                    }else if($v['days']>2 && $v['is_dispatched']=='0'){
                        $action='Did not collect - <a href="javascript:void(0)" onclick="javascript:ticket_msg(\''.$v['id'].'\',\'collect\',\''.$v['mobile'].'\')" title="Book was not taken from library in time. Cancel the book reservation. ">Cancel Reservation</a>';
                    }
                    if($v['msg1_sent']=='1' || $v['msg2_sent']=='1'){
                        $action='<i>Message Sent.</i> '.$action;
                    }
                    $data->rows[$i]['cell']=array($v['unique_number'],$v['name'],$v['author'],$v['version'],$v['year'],$v['branch_name'],$v['student_name'],$v['students_number'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }
    }

    function ticket_msg(){
        if($this->input->post()){
            $post=$this->input->post();
            if($post['option']=='return'){
                $id=$post['id'];
                $sql="update library_booking set msg2_sent='1' where id='$id'";
                $this->db->query($sql);
                $this->sms_lib->send_sms($post['mobile'],'You have a library book to return. please check.');
                echo showBigSuccess('Alert message sent');
            }else if($post['option']=='collect'){
                $id=$post['id'];
                $sql="update library_booking set status='0', msg1_sent='1' where id='$id'";
                $this->db->query($sql);
                $this->sms_lib->send_sms($post['mobile'],'Your library book reservation has been cancelled as the duration for collecting the book has exceded.');
                echo showBigSuccess('Reservation has been cancelled');
            }
            
        }
    }


    function request_counts(){
        $counts=array();

        $user_id=$this->session->userdata('user_id');
        $sql="select lb.*,l.unique_number,l.name,l.author,l.version,l.year,b.name as branch_name,
                    ifnull(sr.name,str.name) as student_name,ifnull(sr.students_number,str.code) as students_number,ifnull(sr.email,str.email) as email,ifnull(sr.mobile,str.mobile) as mobile ,datediff(now(),lb.date_booked) as days
                    from library_booking as lb
                    left join library_books as l on lb.book_id=l.id
                    left join branches as b on b.id=l.branch_id
                    left join student_records as sr on sr.user_id=lb.user_id
                    left join staff_records as str on str.user_id=lb.user_id
                    where ((lb.is_dispatched!='1' and datediff(now(),lb.date_booked)>2)) and lb.status='1'";
        $this->load->model('office_model');
        $counts['ticket']=$this->office_model->get_request_counts($sql);

        $sql="select lb.*,l.unique_number,l.name,l.author,l.version,l.year,b.name as branch_name,
                    ifnull(sr.name,str.name) as student_name,ifnull(sr.students_number,str.code) as students_number,ifnull(sr.email,str.email) as email,ifnull(sr.mobile,str.mobile) as mobile from library_booking lb
                    left join library_books as l on lb.book_id=l.id
                    left join branches as b on b.id=l.branch_id
                    left join student_records as sr on sr.user_id=lb.user_id
                    left join staff_records as str on str.user_id=lb.user_id
                    where lb.is_dispatched!='1' and lb.status='1'";
        $this->load->model('office_model');
        $counts['books_reserved']=$this->office_model->get_request_counts($sql);


        $this->session->set_userdata('request_counts',$counts);
    }






}

?>
