<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Office extends CI_Controller {

    var $send_data_email_id='firstfruitconsulting@googlemail.com';

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model(array('staff_model','students_model','office_model','users_model'));
        $this->request_counts();
    }

    public function index() {
        $data["notice_board"]=$this->students_model->get_notice_board();
        $data['content_page']='office/home';
        $this->load->view('common/base_template',$data);
    }

    function id_card_requests() {
        if($this->input->post()){
            $post=$this->input->post();

            $sql="select i.*,b.name as branch_name from id_card_applications as i
                    left join branches as b on b.id=i.branch
                    where i.is_issued!='1'";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $approval='<div><a href="javascript:void(0)" onclick="javascript:print_id_card('.$v['id'].');" title="Print"> Print Card</a></div><div><a href="javascript:void(0)" onclick="javascript:send_print_data(\'id_card\','.$v['id'].');" title="Send data to email for printing"> Send Data</a></div><div><a href="javascript:void(0)" onclick="javascript:close_requests(\'id_card\','.$v['id'].');" title="Close the request after printing"> Close</a></div>';
                    $photo='<img height="120px" width="100px" src="'.base_url().'uploads/'.$v['photo'].'"/>';
                    $data->rows[$i]['cell']=array($v['name'],$v['stu_number'],$v['branch_name'],$v['date_of_join'],$v['address'],$v['mobile_no'],$photo,$approval);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page'] = 'office/id_card_requests';
            $this->load->view('common/base_template', $data);
        }
    }

    function id_card_print_preview($id=0,$option=FALSE){
        if($id){
            $data['data']=$this->office_model->get_id_card_details($id);
            $this->load->model('users_model');
            $email_mobile=$this->users_model->get_user_email_mobile($data['data'][0]['user_id']);
            $this->sms_lib->send_sms($email_mobile['mobile'],'Please collect your ID Card from the Office.');
            return $this->load->view('prints/id_card_print',$data,$option);
        }else{
            echo '<p> No data..! </p>';
        }
    }

    function processed_id_cards() {
        if($this->input->post()){
            $data['data']=$this->office_model->get_processed_id_cards($this->input->post('student_number'));
            $this->load->view('prints/id_card_print', $data);
        }else{
            $data['content_page'] = 'office/processed_id_cards';
            $this->load->view('common/base_template', $data);
        }
    }

    function bus_pass() {
        if($this->input->post()){
            $post=$this->input->post();

            $sql="select bpa.*,b.name as branch_name,c.name as course_name,bp.name as boarding_point from bus_pass_applications as bpa
                    left join branches as b on b.id=bpa.branch
                    left join courses as c on c.id=bpa.course
                    left join boarding_points bp on bp.id=bpa.start_from
                    where bpa.is_issued!='1'";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action='<div><a href="javascript:void(0)" onclick="javascript:print_bus_pass('.$v['id'].');"> Print Card</a></div><div><a href="javascript:void(0)" onclick="javascript:send_print_data(\'bus_pass\','.$v['id'].');" title="Send data to email for printing"> Send Data</a></div><div><a href="javascript:void(0)" onclick="javascript:close_requests(\'bus_pass\','.$v['id'].');" title="Close the request after printing"> Close</a></div>';
                    // $photo='<img height="120px" width="100px" src="'.base_url().'uploads/'.$v['photo'].'"/>';
                    $data->rows[$i]['cell']=array($v['name'],$v['student_number'],$v['boarding_point'],$v['branch_name'],$v['course_name'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page'] = 'office/bus_pass';
            $this->load->view('common/base_template', $data);
        }
        
    }

    function bus_pass_print($id,$option=FALSE){
        if($id){
            $data['data']=$this->office_model->get_bus_pass_details($id);
            $this->load->model('users_model');
            $email_mobile=$this->users_model->get_user_email_mobile($data['data'][0]['user_id']);
            $this->sms_lib->send_sms($email_mobile['mobile'],'Please collect your Bus Pass from the Office.');
            return $this->load->view('prints/bus_pass_print',$data,$option);
        }else{
            echo '<p> No data..! </p>';
        }
    }

    function study_certi_requests() {
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select sc.*,c.name as course_name from study_certi_applications as sc
                    left join courses as c on c.id=sc.course
                    where is_issued!='1'";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action='<div><a href="javascript:void(0)" onclick="javascript:print_study_certi('.$v['id'].');"> Print Certificate </a></div><div><a href="javascript:void(0)" onclick="javascript:send_print_data(\'study_certi\','.$v['id'].');" title="Send data to email for printing"> Send Data</a></div><div><a href="javascript:void(0)" onclick="javascript:close_requests(\'study_certi\','.$v['id'].');" title="Close the request after printing"> Close</a></div>';
                    // $photo='<img height="120px" width="100px" src="'.base_url().'uploads/'.$v['photo'].'"/>';
                    $data->rows[$i]['cell']=array($v['name'],$v['stu_number'],$v['son_of'],$v['course_name'],$v['from'],$v['to'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page'] = 'office/study_certi_requests';
            $this->load->view('common/base_template', $data);
        }
    }

    function study_certi_print($id,$option=FALSE){
        if($id){
            $data['data']=$this->office_model->get_study_certi_details($id);
            $this->load->model('users_model');
            $email_mobile=$this->users_model->get_user_email_mobile($data['data'][0]['user_id']);
            $this->sms_lib->send_sms($email_mobile['mobile'],'Please collect your Study certificate from the Office.');
            return $this->load->view('prints/study_certi_print',$data,$option);
        }else{
            echo '<p> No data..! </p>';
        }
    }

    function processed_study_certis() {
        if($this->input->post()){
            $data['data']=$this->office_model->get_processed_study_certi($this->input->post('student_number'));
            $this->load->view('prints/study_certi_print',$data);
        }else{
            $data['content_page'] = 'office/processed_study_certis';
            $this->load->view('common/base_template', $data);
        }
    }

    function conduct_certi_requests() {
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select ca.*,c.name as course_name from conduct_applications as ca
                    left join courses as c on c.id=ca.course
                    where is_issued!='1'";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action='<div><a href="javascript:void(0)" onclick="javascript:print_conduct_certi('.$v['id'].');"> Print Certificate </a></div><div><a href="javascript:void(0)" onclick="javascript:close_requests(\'conduct\','.$v['id'].');" title="Close the request after printing"> Close</a></div>';
                    // $photo='<img height="120px" width="100px" src="'.base_url().'uploads/'.$v['photo'].'"/>';
                    $data->rows[$i]['cell']=array($v['name'],$v['stu_number'],$v['co'],$v['course_name'],$v['from_date'],$v['to_date'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page'] = 'office/conduct_certi_requests';
            $this->load->view('common/base_template', $data);
        }
    }

    function conduct_certi_print($id,$option=FALSE){
        if($id){
            $data['data']=$this->office_model->get_conduct_certi_details($id);
            $this->load->model('users_model');
            $email_mobile=$this->users_model->get_user_email_mobile($data['data'][0]['user_id']);
            $this->sms_lib->send_sms($email_mobile['mobile'],'Please collect your Conduct certificate from the Office.');
            return $this->load->view('prints/conduct_certi_print',$data,$option);
        }else{
            echo '<p> No data..! </p>';
        }
    }

    function processed_conduct_certis() {
        if($this->input->post()){
            $data['data']=$this->office_model->get_processed_conduct_certi($this->input->post('student_number'));
            $this->load->view('prints/conduct_certi_print',$data);
        }else{
            $data['content_page'] = 'office/processed_conduct_certis';
            $this->load->view('common/base_template', $data);
        }
    }

    function tc_certi_requests() {
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select sr.*,c.name as course_name,b.name as branch_name,ta.id as ta_id from tc_applications as ta
                   left join student_records as sr on ta.user_id=sr.user_id
                   left join courses as c on c.id=sr.course_id
                   left join branches as b on b.id=sr.branch_id
                   where ta.is_issued!='1'";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action='<div><a href="javascript:void(0)" onclick="javascript:print_tc('.$v['ta_id'].');"> Print Certificate </a></div><div><a href="javascript:void(0)" onclick="javascript:close_requests(\'tc\','.$v['ta_id'].');" title="Close the request after printing"> Close</a></div>';
                    // $photo='<img height="120px" width="100px" src="'.base_url().'uploads/'.$v['photo'].'"/>';
                   // $data->rows[$i]['cell']=array($v['name'],$v['students_number'],$v['branch_name'],$v['course_name'],$v['doj'],$v['completing_year'],$action);
				    $data->rows[$i]['cell']=array($v['name'],$v['students_number'],$v['branch_name'],$v['course_name'],$v['doj'],$v['completing_year'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page'] = 'office/tc_certi_requests';
            $this->load->view('common/base_template', $data);
        }
    }

    function tc_print($id,$option=FALSE){
        if($id){
            $data['data']=$this->office_model->get_tc_details($id);
            $this->load->model('users_model');
            $email_mobile=$this->users_model->get_user_email_mobile($data['data'][0]['user_id']);
            $this->sms_lib->send_sms($email_mobile['mobile'],'Please collect your Transfer certificate from the Office.');
            return $this->load->view('prints/tc_print',$data,$option);
        }else{
            echo '<p> No data..! </p>';
        }
    }

    function processed_tc_certis() {
        if($this->input->post()){
            $data['data']=$this->office_model->get_processed_tc($this->input->post('student_number'));
            $this->load->view('prints/tc_print',$data);
        }else{
            $data['content_page'] = 'office/processed_tc_certis';
            $this->load->view('common/base_template', $data);
        }
    }

    function student_data() { // Using staff controller submit for data display
        $data['content_page'] = 'office/student_data';
        $this->load->view('common/base_template', $data);
    }

    function fee_details() {
        if($this->input->post()){
            $s_details=$this->students_model->get_student_details($this->input->post('student_number'));
			if($s_details)
			{
			$row=$s_details[0];
			$course=$row->course_id;
			//echo $course;
			$data['data']=$this->office_model->get_fee_details($this->input->post('student_number'));
			if($course==1)
			$this->load->view('office/btech_fee_details_table', $data);
			else if($course==2)
			$this->load->view('office/mtech_fee_details_table', $data);
			else if($course==3)
			$this->load->view('office/mba_fee_details_table', $data);
			else if($course==4)
			$this->load->view('office/mca_fee_details_table', $data);
			else if($course==5)
			$this->load->view('office/mba_fee_details_table', $data);
			}
			else
			echo showBigError("Student Number not found");
			
            //$this->load->view('office/fee_details_table', $data);
        }else{
            $data['content_page'] = 'office/fee_details';
            $this->load->view('common/base_template', $data);
        }
    }

    function save_fee_details(){
        if($this->input->post()){
            $post=$this->input->post();
            { 
			$x=$this->my_db_lib->save_record($post,'student_fees');
			if($x)
			echo "Updated";
			}
        }
		else
		echo "No data sent";
    }

    function no_due_requests() {
        $data['content_page'] = 'office/no_due_requests';
        $this->load->view('common/base_template', $data);
    }


    function no_due_print($id,$option=FALSE){
        if($id){
            // error_reporting(E_ALL);
            $student_data=$this->students_model->get_user_details($id);
            $view_data['data']=$student_data;
            $view_data['only_table']=1;
            $view_data['nodue_data']=$nodue_data=$this->students_model->get_no_due($id);
            $this->load->model('users_model');
            $email_mobile=$this->users_model->get_user_email_mobile($id); //print_r($email_mobile);
            // $this->sms_lib->send_sms($email_mobile['mobile'],'Please collect your No Due certificate from the Office.');
            // echo '<pre>';print_r($nodue_data);
            $all_approved=true;
            foreach($nodue_data as $k=>$v){
                if($v->approver_status=='2' || $v->approver_status=='0'){ $all_approved=false; }
            }
            if($all_approved){
                $this->sms_lib->send_sms($email_mobile['mobile'],'Please collect your No Due certificate from the Office.');
                return $this->load->view('prints/no_due',$view_data,$option);                
            }else{
                return $this->load->view('prints/no_due_unapproved',$view_data,$option);
            }
        }else{
            echo '<p> No data..! </p>';
        }
    }

    function pay_slip_requests() {
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select psr.*,sr.name,sr.code,sr.email,sr.mobile,sr.salary,sr.status from pay_slip_requests as psr
                    left join staff_records as sr on sr.user_id=psr.user_id
                    where psr.is_issued!='1'";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action='<div><a href="javascript:void(0)" onclick="javascript:print_payslip('.$v['id'].');"> Print Pay Slip </a></div><div><a href="javascript:void(0)" onclick="javascript:send_print_data(\'payslip\','.$v['id'].');" title="Send data to email for printing"> Send Data</a></div><div><a href="javascript:void(0)" onclick="javascript:close_requests(\'payslip\','.$v['id'].');" title="Close the request after printing"> Close</a></div>';
                    // $photo='<img height="120px" width="100px" src="'.base_url().'uploads/'.$v['photo'].'"/>';
                    $data->rows[$i]['cell']=array($v['name'],$v['code'],$v['email'],$v['from_month'],$v['to_month'],$v['year'],$v['salary'],$action);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page'] = 'office/pay_slip_requests';
            $this->load->view('common/base_template', $data);
        }
    }

    function payslip_print($id,$option=FALSE){
        if($id){
            $data['data']=$this->office_model->get_payslip_details($id);
            return $this->load->view('prints/payslip_print',$data,$option);
        }else{
            echo '<p> No data..! </p>';
        }
    }

    function email() {
        redirect('office'); die;
        $data['content_page'] = 'office/email';
        $this->load->view('common/base_template', $data);
    }

function conf_pswd() {
       if($this->input->post())
         {
         //$post=$this->input->post();
          }
        $data['content_page'] = 'office/conf_pswd';
        $this->load->view('common/base_template', $data);
    }







    function send_print_data(){
        if($this->input->post()){
            $post=$this->input->post();
            $body='';
            $id=$post['id'];
            switch ($post['option']){
                case 'id_card':
                    $body=$this->id_card_print_preview($id,true);
                    break;
                case 'bus_pass':
                    $body=$this->bus_pass_print($id,true);
                    break;
                case 'study_certi':
                    $body=$this->study_certi_print($id,true);
                    break;
                case 'conduct':
                    $body=$this->conduct_certi_print($id,true);
                    break;
                case 'tc':
                    $body=$this->tc_print($id,true);
                    break;
                case 'payslip':
                    $body=$this->payslip_print($id,true);
                    break;
                
                default:
                    $body='';
            }
            // $body=$this->payslip_print(1,true);
            // echo $body;
            if(!empty($body)){
                $this->load->library('my_email_lib');
                $this->my_email_lib->html_email($this->send_data_email_id,'noreply@mycollege.goendeavor.com','My College Print Request',$body);
            }
        }
    }

    function close_requests(){
        if($this->input->post()){
            $post=$this->input->post();
            $map=array(
                'id_card'=>'id_card_applications',
                'bus_pass'=>'bus_pass_applications',
                'study_certi'=>'study_certi_applications',
                'conduct'=>'conduct_applications',
                'tc'=>'tc_applications',
                'payslip'=>'pay_slip_requests',
                'no_due'=>'nodue_applications'
            );
            $table=(isset($map[$post['controller']]))?$map[$post['controller']]:'0';
            $post['is_issued']='1';
            if($table!='0')
            $this->my_db_lib->save_record($post,$table);
        }
    }

    function request_counts(){
        $counts=array();
        
        $sql="select i.*,b.name as branch_name from id_card_applications as i
                    left join branches as b on b.id=i.branch
                    where i.is_issued!='1'";
        $counts['id_card']=$this->office_model->get_request_counts($sql);

        $sql="select bpa.*,b.name as branch_name,c.name as course_name,bp.name as boarding_point from bus_pass_applications as bpa
                    left join branches as b on b.id=bpa.branch
                    left join courses as c on c.id=bpa.course
                    left join boarding_points bp on bp.id=bpa.start_from
                    where bpa.is_issued!='1'";
        $counts['buss_pass']=$this->office_model->get_request_counts($sql);

        $sql="select sc.*,c.name as course_name from study_certi_applications as sc
                    left join courses as c on c.id=sc.course
                    where is_issued!='1'";
        $counts['study_certi']=$this->office_model->get_request_counts($sql);

        $sql="select ca.*,c.name as course_name from conduct_applications as ca
                    left join courses as c on c.id=ca.course
                    where is_issued!='1'";
        $counts['conduct_certi']=$this->office_model->get_request_counts($sql);

        $sql="select sr.*,c.name as course_name,b.name as branch_name,ta.id as ta_id from tc_applications as ta
                   left join student_records as sr on ta.user_id=sr.user_id
                   left join courses as c on c.id=sr.course_id
                   left join branches as b on b.id=sr.branch_id
                   where is_issued!='1'";
        $counts['tc']=$this->office_model->get_request_counts($sql);

        $user_id=$this->session->userdata('user_id');
        $sql="select nd.*,nda.approver_status,sr.name,sr.students_number,sr.doj,c.name as course,b.name as branch,sr.present_year,sr.completing_year
                    from nodue_applications as nd
                    left join student_records as sr on sr.user_id=nd.user_id
                    left join courses as c on c.id=sr.course_id
                    left join branches as b on b.id=sr.branch_id
                    left join nodue_approvals as nda on nda.application_id=nd.id
                    where nd.is_issued!='1' and nda.approver_id='".$user_id."' and nda.approver_status='0'";
        $counts['no_due']=$this->office_model->get_request_counts($sql);
        $sql="select psr.*,sr.name,sr.code,sr.email,sr.mobile,sr.salary,sr.status from pay_slip_requests as psr
                    left join staff_records as sr on sr.user_id=psr.user_id
                    where psr.is_issued!='1'";
        $counts['pay_slip']=$this->office_model->get_request_counts($sql);

        $this->session->set_userdata('request_counts',$counts);
    }
function fee_payment()
{

$data['content_page']='office/fee_payment';
$this->load->view('common/base_template',$data);
}
function feepayment()
{
$data=array();
if($this->input->post()){
  $pass=$this->input->post('password');
  $result=$this->users_model->confirm_office_pass($pass);
  if($result){
  $data['content_page']='office/fee_student_profile';
  $this->load->view('common/base_template',$data);
}
else
{
$data['content_page']='office/fee_payment_error';
$this->load->view('common/base_template',$data);
}
}
else
$data['content_page']='office/fee_payment';

}

function fee_student_profile(){
if($this->input->post()){
            $post=$this->input->post();
            $user_id=$this->staff_model->get_student_user_id($post['number']);
            if(count($user_id)){
                // print_r($user_id);
//                $data['student_details']=$this->students_model->get_user_details($user_id[0]->user_id);
		$data['student_details']=$this->office_model->get_fee_profile($user_id[0]->user_id);

$payment_details=$this->office_model->get_student_balance($user_id[0]->user_id,'I Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$data['paid1']=$amount;         
}

$payment_details=$this->office_model->get_student_balance($user_id[0]->user_id,'II Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$data['paid2']=$amount;         
}

$payment_details=$this->office_model->get_student_balance($user_id[0]->user_id,'III Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$data['paid3']=$amount;         
}

$payment_details=$this->office_model->get_student_balance($user_id[0]->user_id,'IV Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$data['paid4']=$amount;         
}
$discount_details=$this->office_model->getDiscounts($user_id[0]->user_id);
	  if($discount_details)
	  {
	  $data['disc1']=$discount_details[0]->disc1;
	  $data['disc2']=$discount_details[0]->disc2;
	  $data['disc3']=$discount_details[0]->disc3;
	  $data['disc4']=$discount_details[0]->disc4;
	  }
	  else
	  {
	  $data['disc1']=0;
	  $data['disc2']=0;
	  $data['disc3']=0;
	  $data['disc4']=0;
	  }



       $this->load->view('office/student_collect_fee',$data);
            }else{
                echo showBigError('<p>Student Number not found. Please try again.</p>');
            }
        }else{
            $data['content_page']='office/fee_student_profile';
            $this->load->view('common/base_template',$data);
        }
    }






function collect_fee(){

if($this->input->post()){
            $post=$this->input->post();
$ffy=$post['ffy'];
$tof= $post['tof'];
$ptype= $post['ptype'];
$amount= $post['amount'];
$remarks= $post['remarks'];
$date= $post['date'];
$userid= $post['userid'];
$uby= $post['uby'];
$receipt=time();
$data['student_data']=$this->students_model->get_user_details($userid);
            if(empty($data['student_data'])){
                echo showBigError('<div> Student Not Found.!</div>');
                return true;
            }

$num=$this->office_model->update_student_fee_payment($receipt,$ffy,$tof,$amount,$ptype,$remarks,$uby,$userid);

if($num>0)
{
$data['status']="$num rows updated";
$data['info']=$post;
$data['date']=date("d-m-Y");;
//$data['content_page']='office/fee_collect_preview';
//$this->load->view('common/base_template',$data);
$data['receipt_no']=$receipt;
$this->load->view('office/fee_collect_preview',$data);
}
}
else
{
//$data['status']="error";
$data['content_page']='office/fee_payment_error';
$this->load->view('common/base_template',$data);
}
}

function fee_ledger()
{
$data['content_page']='office/fee_ledger';
$this->load->view('common/base_template',$data);
}
function feeledger()
{
$data=array();
if($this->input->post()){
  $pass=$this->input->post('password');
  $result=$this->users_model->confirm_office_pass($pass);
  if($result){
  $data['content_page']='office/fee_student_ledger';
  $this->load->view('common/base_template',$data);
}
else
{
$data['content_page']='office/fee_payment_error';
$this->load->view('common/base_template',$data);
}
}
else
$data['content_page']='office/fee_payment';

}

function fee_student_ledger()
{
if($this->input->post()){
            $post=$this->input->post();
	     $ffy=$post['ffy'];
            $user_id=$this->staff_model->get_student_user_id($post['number']);
            if(count($user_id)){
//                $data['student_details']=$this->students_model->get_user_details($user_id[0]->user_id);
		$data['student_details']=$this->office_model->get_student_ledger_profile($user_id[0]->user_id);
$data['payment_details']=$this->office_model->get_student_payments($user_id[0]->user_id,$ffy);
$data['ffy']=$ffy;
                $this->load->view('office/student_fee_history',$data);
            }else{
                echo showBigError('<p>Student Number not found. Please try again.</p>');
            }
        }else{
            $data['content_page']='office/fee_payment_error';
            $this->load->view('common/base_template',$data);
        }

}

function fee_reports()
{
			$data['colleges']=$this->office_model->get_college_names();
            $data['content_page']='office/fee_reports';
            $this->load->view('common/base_template',$data);

}

function getAjaxCourses()
{
$q=$_GET["q"];
if($q=="0")
{
echo "<select id='course' name='course' onchange='getTableData()'><option value='0'>select</option></select>";
}
else
{
$courses=$this->office_model->get_course_names($q);
$str="<select id='course' name='course' onchange='getBranches();'><option value='0'>Select</option>";
for($i=1;$i<=count($courses);$i++)
{$str=$str."<option value=";
$str=$str.$courses[$i-1]->id.">"; 
$str=$str.$courses[$i-1]->name;
$str=$str."</option>";
}
//$str=$str."</select>";
echo $str."</select>";
}
}


function getAjaxBranches()
{
$p=$_GET["course"];
$q=$_GET["coll"];
//echo "course".$q;
$branches=$this->office_model->get_branch_names($p,$q);

$str="<select id='branch' name='branch' onchange=";
$str=$str."javascript:document.forms[0].ffy.style.display='block'><option value='0'>Select</option>";
for($i=1;$i<=count($branches);$i++)
{$str=$str."<option value=";
$str=$str.$branches[$i-1]->id.">"; 
$str=$str.$branches[$i-1]->name;
$str=$str."</option>";
}
//$str=$str."</select>";
echo $str."</select>";
}

function getAjaxBranches1()
{
$p=$_GET["course"];
$q=$_GET["coll"];
//echo "course".$q;

if($p=="")
echo "<select id='branch' name='branch' onchange='getTableData()'><option value=''>All</option></select>";
else
{
$branches=$this->office_model->get_branch_names($p,$q);

$str="<select id='branch' name='branch' onchange='getTableData()'";
$str=$str."><option value=''>All</option>";
for($i=1;$i<=count($branches);$i++)
{$str=$str."<option value=";
$str=$str.$branches[$i-1]->id.">"; 
$str=$str.$branches[$i-1]->name;
$str=$str."</option>";
}
//$str=$str."</select>";
echo $str."</select>";
}
}


function load_coll_reports()
{

if($this->input->post()){
            $post=$this->input->post();
$data['college']=$post['coll'];
$data['course']= $post['course'];
$data['branch']= $post['branch'];
$data['ffy']= $post['ffy'];
$data['ptype']= $post['ptype'];
$data['tof']= $post['tof'];

$data['result']=$this->office_model->get_stu_payments($data['college'],$data['course'],$data['branch'],$data['ffy'],$data['ptype'],$data['tof']);


         $data['content_page']='office/load_coll_reports';
            $this->load->view('common/base_template',$data);

}

}

function fee_ledger_pdf()
{

/*
$this->load->library('fpdf');
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Ln();
$pdf->Cell(60,10,'Sample Pdf.',0,1,'C');

$pdf->Output('report.pdf','D');

echo "success";
*/

if($this->input->post()){
            $post=$this->input->post();
	     $ffy=$post['ffyear'];
            $user_id=$this->staff_model->get_student_user_id($_POST['number']);
            
	if($user_id){

		$data['student_details']=$this->office_model->get_student_ledger_profile($user_id[0]->user_id);
		$data['payment_details']=$this->office_model->get_student_payments($user_id[0]->user_id,$_POST['ffyear']);

                $this->load->view('office/stu_fee_ledger_pdf',$data);
            }else{
                echo showBigError('<p>Student Number not found. Please try again.</p>');
            }

        }else{
            $data['content_page']='office/fee_payment_error';
            $this->load->view('common/base_template',$data);
        }



}

function coll_reports()
{
$data['colleges']=$this->office_model->get_college_names();
            $data['content_page']='office/coll_fee_reports';
            $this->load->view('common/base_template',$data);
}

function getCollReportsData()
{
//echo $_GET['q']."<br>";
$a=$_GET['q'];
if($a=='Select')
{
}
else
{
$out=$this->office_model->load_coll_reports($_GET['q']);
echo "No of Records:".count($out);
$str=site_url('office/excel').'?q='.$_GET['q'];
echo "<a href=".$str." >Download Excel Report</a>";
echo "<table width='70%' border='5px solid green' style='TEXT-align:center'> ";
echo "<tr><td>Sno</td><td>Receipt No</td><td>HT Num</td><td>Fee Type</td><td>Ptype</td><td>Paid for </td><td>Amount</td><td>Date</td>
<td>Paid to</td></tr>";


for ($i=1;$i<=count($out);$i++)
{
 echo "<tr><td>".$i."</td><td>".$out[$i-1]->receipt_no."</td><td>".$out[$i-1]->students_number."</td><td>".
$out[$i-1]->typeoffee."</td><td>".
$out[$i-1]->paymenttype."</td><td>".$out[$i-1]->feeforyear."</td><td style='TEXT-align:right'>".$out[$i-1]->amount;
echo "</td><td>".substr($out[$i-1]->date,0,10)."</td><td>".$out[$i-1]->updatedby."</td></tr>";
}
//print_r($out);
echo "</table>";
}
}

function excel()
{
ob_start();

$out=$_GET['q'];
header("Content-Type:application/vnd.ms-excel");
$out=$this->office_model->load_coll_reports($_GET['q']);
//echo "No of Records:".count($out);

echo "<table width='70%' border='5px solid green' style='TEXT-align:center'> ";
echo "<tr><td>Sno</td><td>Receipt No</td><td>HT Num</td><td>Fee Type</td><td>Ptype</td><td>Paid for </td><td>Amount</td><td>Date</td>
<td>Paid to</td></tr>";


for ($i=1;$i<=count($out);$i++)
{
 echo "<tr><td>".$i."</td><td>".$out[$i-1]->receipt_no."</td><td>".$out[$i-1]->students_number."</td><td>".
$out[$i-1]->typeoffee."</td><td>".
$out[$i-1]->paymenttype."</td><td>".$out[$i-1]->feeforyear."</td><td style='TEXT-align:right'>".$out[$i-1]->amount;
echo "</td><td>".substr($out[$i-1]->date,0,10)."</td><td>".$out[$i-1]->updatedby."</td></tr>";
}
//print_r($out);
echo "</table>";
header("Content-disposition:attachment; filename=reports.xls");

}

function test()
{
echo $_GET['id'];
}
function pdfReceipt()
{
	if($_GET)        
	{
	$receiptno=$_GET['id'];
	$data['details']=$this->office_model->get_fee_receipt($receiptno);
        $this->load->view('office/pdfReceipt',$data);
	}
	else{
            $data['content_page']='office/fee_payment_error';
            $this->load->view('common/base_template',$data);
        }
}

function dayReports()
{
	    $data['content_page']='office/get_day_wise_reports';
            $this->load->view('common/base_template',$data);

}
function dayWiseReports()
{
$date1= $_GET['val'];
$date2=strtotime($date1);
$final_date= date('Y-m-d H:i:s',$date2);
$student_details=$this->office_model->get_day_reports($final_date);

$count= count($student_details);
if($count>0)
{
$str=site_url('office/dayWiseReports1').'?val='.$_GET['val'];
echo "<a href='$str'>Download Excel File</a>";
echo "<table width='100%' border='1' id='tables' >
<tr>
<td>S No</td>
<td>Receipt No</td>
<td>HT Num</td>
<td>Ptype</td>
<td>Paid for</td>
<td>Fee Type</td>
<td>Amount</td>
<td>Paidto</td>
</tr>";


for($i=0;$i<$count;$i++)
{
echo "<tr><td>";
echo $i+1;
echo "</td><td>";
echo $student_details[$i]->receipt_no;
echo "</td><td>";
echo $student_details[$i]->students_number;
echo "</td><td>";
print($student_details[$i]->paymenttype);
echo "</td><td>";
print($student_details[$i]->feeforyear);
echo "</td><td>";
print($student_details[$i]->typeoffee);
echo "</td><td>";
print($student_details[$i]->amount);
echo "</td><td>";
print($student_details[$i]->updatedby);
echo "</td></tr>";
}
echo "</table>";
}
else
echo showBigError('No Records Found');
}


function dayWiseReports1()
{
ob_start();
header("Content-Type:application/vnd.ms-excel");
$date1= $_GET['val'];
$date2=strtotime($date1);
$final_date= date('Y-m-d H:i:s',$date2);
$student_details=$this->office_model->get_day_reports($final_date);

$count= count($student_details);
if($count>0)
{
echo "<table width='100%' border='1' id='tables' >
<tr>
<td>S No</td>
<td>Receipt No</td>
<td>Date</td>
<td>HT Num</td>
<td>Ptype</td>
<td>Paid for</td>
<td>Fee Type</td>
<td>Amount</td>
<td>Paidto</td>
</tr>";


for($i=0;$i<$count;$i++)
{
echo "<tr><td>";
echo $i+1;
echo "</td><td>";
echo $student_details[$i]->receipt_no;
echo "</td><td>";
echo date('d-m-Y',strtotime($date1));
echo "</td><td>";
echo $student_details[$i]->students_number;
echo "</td><td>";
print($student_details[$i]->paymenttype);
echo "</td><td>";
print($student_details[$i]->feeforyear);
echo "</td><td>";
print($student_details[$i]->typeoffee);
echo "</td><td>";
print($student_details[$i]->amount);
echo "</td><td>";
print($student_details[$i]->updatedby);
echo "</td></tr>";
}
echo "</table>";
}
else
echo showBigError('No Records Found');
header("Content-disposition:attachment; filename=Daywisereports.xls");
}




function paymentGrid()
{
	    $data['colleges']=$this->office_model->get_college_names();
            $data['content_page']='office/pgrid';
            $this->load->view('common/base_template',$data);

}
function nodue_start()
{
	    $data=$this->office_model->getYear(227);
	    echo $data;
}

function getPaymentGrid()
{

$college=$_GET['college'];
$course=$_GET['course'];
$branch=$_GET['branch'];
$ffy=$_GET['ffy'];
$ptype=$_GET['ptype'];
$tof=$_GET['tof'];
$result=$this->office_model->GridData($college,$course,$branch,$ffy,$ptype,$tof);

echo "No of Records found:".count($result);
$str=site_url('office/getPaymentGrid1').'?college='.$college.'&course='.$course.'&branch='.$branch.'&ffy='.
$ffy.'&ptype='.$ptype.'&tof='.$tof;
echo "<a href='$str'>Download Excel File</a>";

echo "<table border='1' id='tables' width='100%'>


<tr>
<th>Receipt  No</th>
<th>HT No</th>
<th>Name</th>
<th>Amount</th>
<th>Date</th>
<th>Paid to</th>
</tr>";

for($i=0;$i<count($result);$i++)
{
$user= $result[$i]->user_id;
$receipt_no=$result[$i]->receipt_no;
$htnum=$result[$i]->students_number;
$name=$result[$i]->name;
$amount=$result[$i]->amount;
$date=substr($result[$i]->date,0,10);
$paidto=$result[$i]->updatedby;

echo "<tr>
<td>$receipt_no</td>
<td>$htnum</td>
<th>$name</td>
<th>$amount</td>
<td>$date</td>
<td>$paidto</td>
</tr>";

}
echo "</table>";
/*print count($result);

print $result;
*/
}

function getPaymentGrid1()
{
ob_start();
header("Content-Type:application/vnd.ms-excel");
$college=$_GET['college'];
$course=$_GET['course'];
$branch=$_GET['branch'];
$ffy=$_GET['ffy'];
$ptype=$_GET['ptype'];
$tof=$_GET['tof'];
$result=$this->office_model->GridData($college,$course,$branch,$ffy,$ptype,$tof);

echo "No of Records found:".count($result);
echo "<table border='1' id='tables' width='100%'>

<tr>
<th>Receipt  No</th>
<th>HT No</th>
<th>Name</th>
<th>Amount</th>
<th>Date</th>
<th>Paid to</th>
</tr>";

for($i=0;$i<count($result);$i++)
{
$user= $result[$i]->user_id;
$receipt_no=$result[$i]->receipt_no;
$htnum=$result[$i]->students_number;
$name=$result[$i]->name;
$amount=$result[$i]->amount;
$date=substr($result[$i]->date,0,10);
$paidto=$result[$i]->updatedby;

echo "<tr>
<td>$receipt_no</td>
<td>$htnum</td>
<th>$name</td>
<th>$amount</td>
<td>$date</td>
<td>$paidto</td>
</tr>";

}
echo "</table>";
/*print count($result);

print $result;
*/
header("Content-disposition:attachment; filename=reports.xls");
}



function duegrid()
{
	    $data['colleges']=$this->office_model->get_college_names();
            $data['content_page']='office/duegrid';
            $this->load->view('common/base_template',$data);


}

function getDueGrid()
{

$college=$_GET['college'];
$course=$_GET['course'];
$branch=$_GET['branch'];



$result=$this->office_model->dueGridData($college,$course,$branch);
//echo $result->college_name;
echo count($result);
$str=site_url('office/getDueGrid1').'?college='.$college.'&course='.$course.'&branch='.$branch;
echo "<a href='$str'>Download Excel File</a>";

echo "<table border='1' id='tables' width='100%'>
<tr>
<th>HT No</th>
<th>Name</th>
<th>College</th>
<th>Course</th>
<th>Branch</th>
<th align='right'>I Year Fee/Paid</th>
<th align='right'>II Year/Paid</th>
<th align='right'>III Year/Paid</th>
<th align='right'>IV Year/Paid</th>
</tr>";


for($i=0;$i<count($result);$i++)
{
$userid=$result[$i]->user_id;
$name=$result[$i]->name;
$htnum=$result[$i]->students_number;
$college=$result[$i]->college_name;
$course=$result[$i]->course_name;
$branch=$result[$i]->branch_name;
$fee1=$result[$i]->fee1;
$fee2=$result[$i]->fee2;
$fee3=$result[$i]->fee3;
$fee4=$result[$i]->fee4;


$paid1='0';
if($fee1!='-')
{
$payment_details=$this->office_model->get_student_balance($userid,'I Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$paid1=$amount;         
}
}
$paid2='0';
if($fee2!='-')
{
$payment_details=$this->office_model->get_student_balance($userid,'II Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$paid2=$amount;         
}
}
$paid3='0';
if($fee3!='-')
{
$payment_details=$this->office_model->get_student_balance($userid,'III Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$paid3=$amount;         
}
}
$paid4='0';
if($fee4!='-')
{
$payment_details=$this->office_model->get_student_balance($userid,'IV Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$paid4=$amount;         
}
}

echo "<tr>
<td>$htnum</td>
<td>$name</td>
<td>$college</td>
<td>$course</td>
<td>$branch</td>
<td align='right'>".$fee1."/".$paid1."</td>
<td align='right'>".$fee2."/".$paid2."</td>
<td align='right'>".$fee3."/".$paid3."</td>
<td align='right'>".$fee4."/".$paid4."</td></tr>";
}
print "<table>";



}

function getDueGrid1()
{
ob_start();
header("Content-Type:application/vnd.ms-excel");
$college=$_GET['college'];
$course=$_GET['course'];
$branch=$_GET['branch'];



$result=$this->office_model->dueGridData($college,$course,$branch);
//echo $result->college_name;
echo count($result);


echo "<table border='1' id='tables' width='100%'>
<tr>
<th>HT No</th>
<th>Name</th>
<th>College</th>
<th>Course</th>
<th>Branch</th>
<th align='right'>I Year Fee/Paid</th>
<th align='right'>II Year/Paid</th>
<th align='right'>III Year/Paid</th>
<th align='right'>IV Year/Paid</th>
</tr>";


for($i=0;$i<count($result);$i++)
{
$userid=$result[$i]->user_id;
$name=$result[$i]->name;
$htnum=$result[$i]->students_number;
$college=$result[$i]->college_name;
$course=$result[$i]->course_name;
$branch=$result[$i]->branch_name;
$fee1=$result[$i]->fee1;
$fee2=$result[$i]->fee2;
$fee3=$result[$i]->fee3;
$fee4=$result[$i]->fee4;


$paid1='0';
if($fee1!='-')
{
$payment_details=$this->office_model->get_student_balance($userid,'I Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$paid1=$amount;         
}
}
$paid2='0';
if($fee2!='-')
{
$payment_details=$this->office_model->get_student_balance($userid,'II Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$paid2=$amount;         
}
}
$paid3='0';
if($fee3!='-')
{
$payment_details=$this->office_model->get_student_balance($userid,'III Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$paid3=$amount;         
}
}
$paid4='0';
if($fee4!='-')
{
$payment_details=$this->office_model->get_student_balance($userid,'IV Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$paid4=$amount;         
}
}

echo "<tr>
<td>$htnum</td>
<td>$name</td>
<td>$college</td>
<td>$course</td>
<td>$branch</td>
<td align='right'>".$fee1."/".$paid1."</td>
<td align='right'>".$fee2."/".$paid2."</td>
<td align='right'>".$fee3."/".$paid3."</td>
<td align='right'>".$fee4."/".$paid4."</td></tr>";
}
print "<table>";



header("Content-disposition:attachment; filename=reports.xls");
}

 function test_grid()
{
 $this->load->view('office/test_grid');
}

function discounts()
{
if($this->input->post())
{

$post=$this->input->post();
$user_id=$this->staff_model->get_student_user_id($post['number']);
   if(count($user_id)){
       // print_r($user_id);
$student_details=$this->office_model->get_fee_profile($user_id[0]->user_id);
$course=$student_details[0]->course_id;
$fee1=$student_details[0]->fee1;
$fee2=$student_details[0]->fee2;
$fee3=$student_details[0]->fee3;
$fee4=$student_details[0]->fee4;
$course= $student_details[0]->course_id;
//$data['student_details']=
$data['fee1']=$fee1; 
$data['fee2']=$fee2; 
$data['fee3']=$fee3; 
$data['fee4']=$fee4; 
switch($course)
{
case 1:
$payment_details=$this->office_model->get_student_balance($user_id[0]->user_id,'I Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$data['paid1']=$amount; 

//echo "I year paid:".$amount;        
}

$payment_details=$this->office_model->get_student_balance($user_id[0]->user_id,'II Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$data['paid2']=$amount;   
//echo "II year paid:".$amount;      
}

$payment_details=$this->office_model->get_student_balance($user_id[0]->user_id,'III Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$data['paid3']=$amount;    
//echo "III year paid:".$amount;     
}

$payment_details=$this->office_model->get_student_balance($user_id[0]->user_id,'IV Year');
if(count($payment_details))
{
$amount=0;
foreach($payment_details as $row)
$amount=$amount+$row->amount;
$data['paid4']=$amount;     
//echo "IV year paid:".$amount;    
}
break;
}
       
	   $data['course']=$course;
	   $data['user_id']=$user_id[0]->user_id;
	  $discount_details=$this->office_model->getDiscounts($user_id[0]->user_id);
	  if($discount_details)
	  {
	  $data['disc1']=$discount_details[0]->disc1;
	  $data['disc2']=$discount_details[0]->disc2;
	  $data['disc3']=$discount_details[0]->disc3;
	  $data['disc4']=$discount_details[0]->disc4;
	  }
	  else
	  {
	  $data['disc1']=0;
	  $data['disc2']=0;
	  $data['disc3']=0;
	  $data['disc4']=0;
	  }
//	  print_r($data);
//$this->load->view('office/btech_discounts',$data);
//$data['content_page'] = 'office/discounts_view';
if($course==1){
$data['content_page'] = 'office/btech_discounts';
$this->load->view('common/base_template', $data);
}
else if($course=="2")
{
$data['content_page'] = 'office/mtech_discounts';
$this->load->view('common/base_template', $data);
}
else if($course=="3")
{
$data['content_page'] = 'office/mba_discounts';
$this->load->view('common/base_template', $data);
}
else if($course=="4")
{
$data['content_page'] = 'office/mca_discounts';
$this->load->view('common/base_template', $data);
}
else if($course=="5")
{
$data['content_page'] = 'office/mba_discounts';
$this->load->view('common/base_template', $data);
}
}else echo "Student Number Not Found";
	  
}
else
{
$data['content_page'] = 'office/discounts';
$this->load->view('common/base_template', $data);
        
}
}

function post_discounts()
{
if($this->input->post())
{
$post=$this->input->post();
$uid=$this->input->post('userid');
$d1=$this->input->post('d1');
$d2=$this->input->post('d2');
$d3=$this->input->post('d3');
$d4=$this->input->post('d4');
$up_by = $this->session->userdata('user_name');
if($d1=='')
$d1=0;
if($d2=='')
$d2=0;
if($d3=='')
$d3=0;
if($d4=='')
$d4=0;

$this->office_model->postDiscounts($d1,$d2,$d3,$d4,$uid,$up_by);
$data['content_page'] = 'office/discount_success';
$this->load->view('common/base_template', $data);

}
else
echo showBigError("No data Received");
}

function feebulkupdate()
{
			if($this->input->post())
			{
			$post=$this->input->post();
			$joinyear=$post['ffy'];
			$coll=$post['coll'];
			$course=$post['course'];
			$branch=$post['branch'];
			$at=$post['at'];
			$fee1=$post['amount1'];
			$fee2=$post['amount2'];
			$fee3=$post['amount3'];
			$fee4=$post['amount4'];
			//echo "<br>COllege:".$coll;
			//echo "<br>Course".$course;
			//echo "<br>Branch".$branch;
			
			$list=$this->office_model->get_students_bulk_update($joinyear,$coll,$course,$branch,$at);
			//print_r($list);		
			foreach($list as $user)
			{
			$this->office_model->postFee($user->user_id,$fee1,$fee2,$fee3,$fee4);
			//echo "Successsful";;
			//echo $ffy.'='.$user_id."<br>";
			//$x=$this->office_model->get_student_ledger_profile($user_id);
			//echo $x[0]->students_number."-".$x[0]->user_id."<br>";
			}
			$data['content_page'] = 'office/BulkUpdateSuccess';
			$this->load->view('common/base_template', $data);
			}
			else
			{
			$data['colleges']=$this->office_model->get_college_names();
            $data['content_page'] = 'office/BulkUpdate';
			$this->load->view('common/base_template', $data);
			}
}

function test11()
{
$a=mysql_query("select *from student_records where doj between '2011-12-31' and '2012-12-31'");
while($x=mysql_fetch_array($a))
print_r($x);
}

/*
   * debitvoucher
   */
  function debitvoucher() {

    if ($this -> input -> post()) {
      $post = $this -> input -> post();
    		$where =' WHERE 1=1 AND';
		if($post['vcreationdate']) {
				$where .= " vcreationdate = '".$post['vcreationdate']."' AND";
		}
		
		if($post['vorefno']) {
				$where .= " vorefno = '".$post['vorefno']."' AND";
		}
		
		/*if($post['createdby']) {
				$where = "createdby = '".$post['createdby']."' AND";
		}*/
		
		if($where) {
			$where = substr($where, 0,-3);
		}
      $sql = "SELECT * FROM debit_vouchers {$where}";
				
			
      $data = $this -> my_db_lib -> get_jqgrid_data($post, $sql);
      if (count($data -> db_data)) {
        $i = 0;
        foreach ($data->db_data as $k => $v) {
          $data -> rows[$i]['vorefno'] = $v['vorefno'];
          //$action='<div><a href="javascript:void(0)" onclick="javascript:view_voucher(\''.$v['vorefno'].'\');"> View Voucher </a></div>';
					$action="<div><a href='". site_url('office/view_voucher?vorefno='.$v['vorefno'])."'>". $v['vorefno'] ."</a></div>";
          $data -> rows[$i]['cell'] = array($action, $v['vcreationdate'], $v['createdby'] );
					$i++;
        }
      }
      else {
        $data -> rows[0]['vorefno'] = 0;
        $data -> rows[0]['cell'] = array('No Data', '', '', '', '', '', '');
      }
      unset($data -> db_data);
      echo json_encode($data);
    }
    else {
      $data['content_page'] = 'office/debitvoucher';
      $this -> load -> view('common/base_template', $data);
    }

  }

############ START CASH BOOK ####################
	function cashbook()
	{
	   
      
       $data['prev_balance'] = $this->office_model->get_prev_balance();
       
      
      $data['msg']="";
       $data['content_page'] = 'office/addbalance';
      $this -> load -> view('common/base_template', $data);
      
        
	}



function add_balance()
{
    
    
    if($this->input->post())
       {
            $post = $this->input->post();
            
            //$data['success_msg'] = "Your balance successfully updated in cashbook";
                   
           $this->office_model->update_cashbook_credit($post);
          // $data['transactions_all'] = $this->office_model->get_all_transactions();
           $this->load->view('office/balance_success');
          
       }
    
}
    function view_cashbook()
    {
       if($this->input->post())
            {
                
                 $post = $this -> input -> post();
                 $dfrom = $post['dfrom'];
                 $dto = $post['dto'];
                 $data['dfrom'] = $dfrom;
                 $data['dto']  = $dto;   

             $data['transactions'] =  $this->office_model->get_transations($dfrom,$dto);
                 
                
         
               $this->load->view('office/view_cashbook',$data);
               //exit;
                               
        	}
           else
           {
                $data['success_msg'] = "";
                $data['transactions_all'] = $this->office_model->get_all_transactions();
                  $data['content_page'] = 'office/cashbook';
                 $this -> load -> view('common/base_template', $data);
               // $this->load->view('office/cashbook',$data);    
           }
    }
    
function export_cashbook()
{
    ob_start();
    header("Content-Type:application/vnd.ms-excel");
echo $dfrom =$_GET['dfrom'];
echo $dto=$_GET['dto'];

$transactions=$this->office_model->get_transations($dfrom,$dto);

//echo "No of Records found:".count($result);
echo "<table border='1' id='tables' width='100%'>

<tr>
<th>Date</th><th>Payment</th><th>Pmt Details</th><th>Receipt No</th><th>Debit</th><th>Debit Details</th><th>Payment Type</th><th>V.ref.no</th><th>Updated By</th><th>Balance</th>
</tr>";


 
foreach($transactions as $transaction){
    echo "<tr><td>".$transaction->date."</td><td>".$transaction->credit_amount."</td><td>".$transaction->credit_type."</td><td>".$transaction->credit_rec_no."</td><td>".$transaction->debit_ammount."</td><td>".$transaction->debit_details."</td><td>".$transaction->debit_type."</td><td>".$transaction->debit_rec_no."</td><td>".$transaction->updated_by."</td><td>".$transaction->balance."</td></tr>";
    } 


echo "</table>";

header("Content-disposition:attachment; filename=cashbook.xls");

	}
############### END CASH BOOK #########################
    
    
  /*
   * Add voucher
   */
   
  function addvoucher() {

    $post = $this -> input -> post();

    if ($post) {

      if ($this -> debitvoucher_model -> check_debitvoucher($post)) {
        echo showBigError('<div>Debit Voucher already exists.</div>'); // <a href="../office/addvoucher" ><br/><< Back To Adding</a>';
        return;
      }
      
      $this -> debitvoucher_model -> addvoucher($post);
     // $this->debitvoucher_model->update_cashbook_debit($post);
      echo showBigSuccess('<p>Debit Voucher saved Successfully.</p>'); // <a href="../office/debitvoucher" ><br/><< List Vouchers</a>');
    }
    else {
    	
	$data['colleges']=$this->office_model->get_college_names();
      $data['content_page'] = 'office/addvoucher';
      $this -> load -> view('common/base_template', $data);
    }
  }
	
/*
 * get vouchers based on date
 */
	function  getVouchers($vcreationdate=''){
        $options='<option value="">Select</option>';
				$options.= load_select_vouchcer('debit_vouchers',0,array('vcreationdate'=>$vcreationdate));
        echo $options;
    }

  
	
	
/*
 * view_voucher
 */
 function view_voucher(){
 	$post = $this -> input -> post();
	

	if ($this -> input -> post()) {

	
		
		
      $post = $this -> input -> post();
			$where =' WHERE 1=1 AND';

		
		if($post['vorefno']) {
				$where .= " dv.vorefno = '".$post['vorefno']."' ";
		}
		

       $sql = "SELECT dv.*,dp.particulars, dp.amount,dp.id as 'pid' FROM debit_vouchers dv join debit_payment_particulars dp on dv.vorefno=dp.vorefno  {$where}";
      
				
			
      $data = $this -> my_db_lib -> get_jqgrid_data($post, $sql);
      if (count($data -> db_data)) {
        $i = 0;
        foreach ($data->db_data as $k => $v) {
          $data -> rows[$i]['pid'] = $v['pid'];
          
          $voucher_info = array($v['vorefno'], $v['vcreationdate'], $v['createdby'], $v['college_code'],$v['debitedto'],$v['type']);
					//$data->row[$i]['cell']  = array($v['vorefno'], $v['vcreationdate'], $v['createdby'], $v['college_code'],$v['debitedto'],$v['type']);
					
					$data->rows[$i]['cell']  = array($v['particulars'],$v['amount']);
					
					
					$i++;
        }
      }
      else {
        $data -> rows[0]['pid'] = 0;
        $data -> rows[0]['cell'] = array('No Data', '', '');
      }
      unset($data -> db_data);
			
      echo json_encode($data);
    }
    else {
      $data['content_page'] = 'office/view_voucher';
      $this -> load -> view('common/base_template', $data);
    }
	
 }


}

?>