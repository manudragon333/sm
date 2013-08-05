<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model(array('students_model','staff_model','admin_model'));
        $this->request_counts();
    }

    public function index() {
        $data['content_page'] = 'admin/home.php';
        $this->load->view('common/base_template', $data);
    }

    function student_data() {
//        $data['content_page'] = 'admin/student_data';
//        $this->load->view('common/base_template', $data);
        if($this->input->post()){
            $post=$this->input->post();
            $user_id=$this->staff_model->get_student_user_id($post['number']);
            if(count($user_id)){
                // print_r($user_id);
                $data['student_details']=$this->students_model->get_user_details($user_id[0]->user_id);
                $this->load->view('admin/student_record',$data);
            }else{
                echo '<br/><p>Student Number not found. Please try again.</p>';
            }
        }else{
            $data['content_page']='admin/student_profile';
            $this->load->view('common/base_template',$data);
        }
    }

    function save_student_data(){
        if($this->input->post()){
            $post=$this->input->post();
            $this->my_db_lib->save_record($post,'student_records');
            echo '<br/><p>Student details saved Successfully.</p>';
        }
    }

    function user_accounts() {
        $data["user_types"]=$this->admin_model->get_user_types();
        $data['content_page'] = 'admin/user_accounts';
        $this->load->view('common/base_template', $data);
    }
 function adduser_marks() {
        $data["user_types"]=$this->admin_model->get_user_types();
        $data['content_page'] = 'admin/adduser_marks';
        $this->load->view('common/base_template', $data);
    }

    function get_user_types(){
        if($post=$this->input->post()){
            $data["user_types"]=$this->admin_model->get_user_types();
            $data['select_id']=$post['type'];
            $this->load->view('admin/user_types_select', $data);
        }
    }

    function get_user_list(){
        if($post=$this->input->post('user_type')){
            $data["users_data"]=$this->admin_model->get_user_types_users($post['user_type']);
            $data['select_id']='select';
            $this->load->view('admin/users_select', $data);
        }
    }

    function user_details_form(){
        if($post=$this->input->post()){
            $post=$this->input->post();
            if($post['users_type_id']==1){
                // Load Student Form + login details form
                $this->load->view('admin/student_form');
            }else if($post['users_type_id']==2 || $post['users_type_id']==3){
                // Load Staff form + login details form
                $this->load->view('admin/staff_form');
            }else{
                // Load only user login details form
                $this->load->view('admin/user_form');
            }
        }
    }

    function users_formXXX(){
        if($post=$this->input->post()){
            $post=$this->input->post();
            $user_details=$this->admin_model->get_user_details($post['users_id']);
            if($user_details[0]['users_type_id']==1){
                // Load Student Form + login details form
//                print_r($user_details);
                $view_data['user_details'][0]=(object) $user_details[0];
                $view_data['student_details']=$user_details['student_details'];
                $this->load->view('admin/student_form',$view_data);
            }else if($user_details[0]['users_type_id']==2 || $user_details[0]['users_type_id']==3){
                // Load Staff form + login details form
//                print_r($user_details);
                $view_data['user_details'][0]=(object) $user_details[0];
                $view_data['data']=$user_details['staff_details'];
                $this->load->view('admin/staff_form',$view_data);
            }else{
                // Load only user login details form
                $view_data['user_details'][0]=(object) $user_details[0];
                $this->load->view('admin/user_form',$view_data);
            }
        }
    }

    function update_user_details_formXXX(){
        if($post=$this->input->post()){
            $post=$this->input->post();
            if($post['users_type_id']==1){
                // Load Student Form + login details form
            }else if($post['users_type_id']==2 || $post['users_type_id']==3){
                // Load Staff form + login details form
            }else{
                // Load only user login details form
            }
        }
    }

    function save_user_account(){  // USING 
        if($post=$this->input->post()){
            $post=$this->input->post();
            {
                // First Save only user login details form
                $user_id=$this->my_db_lib->save_record($post,'users');
            }
            if(empty($post['id'])) 
                $post['user_id']=$user_id;
            else
                $post['user_id']=$post['id'];
            if($post['users_type_id']==1){
                // Save Student Form
                $post['id']=$post['student_rec_id'];
                $this->my_db_lib->save_record($post,'student_records');
                if(isset($post['sem_id'])){
                    $this->admin_model->save_student_semester($post['user_id'],$post['sem_id']);
                }
            }else if($post['users_type_id']==2 || $post['users_type_id']==3){
                // Save Staff form
                $post['id']=$post['staff_rec_id'];
                $this->my_db_lib->save_record($post,'staff_records');
            }
            
            echo '<br/><p> User saved successfully.</p><br/><input type="button" name="imageField" id="imageField" class="send button" value="Back" onclick="javascript:window.location.reload();"/>';
        }
    }




    /***************************************** NEW CODE *********************************************/



    function load_users_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select * from users
                    where users_type_id='".$post['user_type']."' and status='".$post['status']."'";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $action1='<div><a href="javascript:void(0)" onclick="javascript:update_account(\''.$v['id'].'\',\''.$v['users_type_id'].'\');"> Update Account </a></div>';
                    if($v['status']=='1')
                    $action2='<div><a href="javascript:void(0)" onclick="javascript:squeez_account(\''.$v['id'].'\',\'0\');" title="Make the user Inactive"> Squeez Account</a></div>';
                    else
                    $action2='<div><a href="javascript:void(0)" onclick="javascript:squeez_account(\''.$v['id'].'\',\'1\');" title="Make the user Active"> Release Account</a></div>';
					
//                    if($v['users_type_id']=='1')
//                    $uname="<div><a href='".site_url('admin/add_semister/'.$v['id'])."'>".$v['username']."</a></div>";
//                    else
                    $uname=$v['username'];
					
                    $status=($v['status']=='1')?'Active':'Inactive';
                    $data->rows[$i]['cell']=array($uname,$v['password'],$v['email'],$status,$action1,$action2);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }
    }


    function load_usermarks_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select u.id,u.username,u.email,ss.semister_id,s.name as sname,b.name as bname from  users u 
                        inner join student_records sr on u.id=sr.user_id
                        inner join student_semisters ss on u.id=ss.user_id
                        inner join semisters s on ss.semister_id=s.id
                        inner join branches b on sr.branch_id=b.id
                        where ss.semister_id='".$post['status']."' and ss.is_current='1' and sr.branch_id='".$post['user_type']."'";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $add_attendance="<div><a href='javascript:void(0);' onclick='edit_attendance(\"".$v['id']."\",\"".$v['semister_id']."\")'>Add/Edit Attendance</a></div>"; // ".site_url('admin/add_attendance/'.$v['id'])."
                    $data->rows[$i]['cell']=array("<div><a href='".site_url('admin/add_marks/'.$v['id'])."'>".$v['username']."</a></div>",$v['email'],$v['sname'],$v['bname'],"<div><a href='".site_url('admin/view_marks/'.$v['id'])."'>View Marks</a></div>","<div><a href='".site_url('admin/add_marks/'.$v['id'])."'>Add Marks</a></div>",$add_attendance);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }
    }
    function update_account(){
        if($this->input->post()){
            $post=$this->input->post();
            $user_details=array();
            if(!empty($post['users_id']))
                $user_details=$this->admin_model->get_user_details($post['users_id']);
            else{
                $user_details[0]=$post;
                $user_details['student_details']=$user_details['staff_details']=0;
            }
            if($user_details[0]['users_type_id']==1){
                // Load Student Form + login details form
//                print_r($user_details);
                $view_data['user_details'][0]=(object) $user_details[0];
                $view_data['student_details']=$user_details['student_details'];
                $this->load->view('admin/student_form',$view_data);
            }else if($user_details[0]['users_type_id']==2 || $user_details[0]['users_type_id']==3){
                // Load Staff form + login details form
//                print_r($user_details);
                $view_data['user_details'][0]=(object) $user_details[0];
                $view_data['data']=$user_details['staff_details'];
                $this->load->view('admin/staff_form',$view_data);
            }else{
                // Load only user login details form
                $view_data['user_details'][0]=(object) $user_details[0];
                $this->load->view('admin/user_form',$view_data);
            }
        }
    }

    function squeez_account(){
        if($this->input->post()){
            $post=$this->input->post();
            $id=$post['id'];
            $f=$post['f'];
            $sql="update users set status='$f' where id='$id'";
            $res = $this->db->query($sql);
            if($f=='0')
                echo 'Account Squeezed';
            else
                echo 'Account released';
        }
    }

    function account() {
        $data['content_page'] = 'admin/account';
        $this->load->view('common/base_template', $data);
    }
    
    function email(){
        redirect('admin');
    }

    function no_due(){
        $data['content_page'] = 'admin/no_due_requests';
        $this->load->view('common/base_template', $data);
    }


    function request_counts(){
        $counts=array();

        $user_id=$this->session->userdata('user_id');
        if($user_id!=18){
            return true;
        }

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

    /*Principal*/
    function approve_q_papers(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select q.*,br.name as branch_name, u.username from question_papers as q
                left join users as u on q.user_id=u.id
                left join branches as br on q.branch=br.id
                where q.is_principal_approved!='1'";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $is_approved=($v['is_principal_approved']=='1')?'Approved':'<a href="javascript:approve_paper(\''.$v['id'].'\')">Approve Paper</a>';
                    $link="<a href='".base_url()."uploads/".$v['doc_link']."' target='_blank'>Link</a>";
                    $data->rows[$i]['cell']=array($v['username'],$v['students_count'],$v['branch_name'],$v['year'],$v['subject'],$v['exam_number'],$link,$is_approved);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='staff/approve_q_papers';
            $this->load->view('common/base_template',$data);
        }
    }


    function approve_paper(){
        $post=$this->input->post();
        if( $this->input->post('id')  ){
            $post['is_principal_approved']='1';
            $this->my_db_lib->save_record($post,'question_papers');
			$sql="select qp.subject,qp.year,sr.mobile,sr.name,b.name as branch  from question_papers as qp
inner join staff_records as sr on sr.user_id=qp.user_id
inner join branches  as b on b.id=qp.branch
where qp.id='".$this->input->post('id')."'";
          $query = $this->db->query($sql);
		  $row=$query->first_row();

		  $message="Subject: ".$row->subject;
		  $message.=", Year: ".$row->year;
		  $message.=", Branch:".$row->branch;
		  $message.=" Pricipal Approved";
		  $this->sms_lib->send_sms($row->mobile,$message);
            echo 1;
        }
    }


    function notice_board(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql="select * from students_notice_board where status='1'";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_notice(".$v['id'].");' >Edit</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_notice(".$v['id'].");' >Delete</a>";;
                    $data->rows[$i]['cell']=array($v['id'],$v['message'],$v['date_added'],$edit,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/notice_board';
            $this->load->view('common/base_template',$data);
        }
    }

    function delete_notice(){
        $post=$this->input->post();
        if( $this->input->post()){
            $this->admin_model->deactive_notice($post['id']);
        }
    }

    function edit_notice(){
        $post=$this->input->post();
        if($post){
            $notice_id=$post['id'];
            $data['notice_data']=$this->admin_model->get_notice_details($notice_id);
            $this->load->view('admin/notice_form',$data);
        }
    }

    function save_notice(){
        // Put the save_record lib func
        $post=$this->input->post();
        if($post){
            $this->my_db_lib->save_record($post,'students_notice_board');
            echo '<br/><p>Message saved Successfully.</p><a href="javascript:void(0);" onclick="javascript:window.location.reload();"><< Back To List</a>';
        }
    }


    function branch_semister_subjects(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql="select bss.*,b.name as branch_name, se.name as semister_name, s.name as subject_name
                    from branch_semister_subject as bss
                    left join branches as b  on b.id=bss.branch_id
                    left join semisters se on se.id=bss.semister_id
                    left join subjects s on s.id=bss.subject_id
                ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_subject_grid(".$v['id'].");' >Delete</a>";;
                    $data->rows[$i]['cell']=array($v['id'],$v['branch_name'],$v['semister_name'],$v['subject_name'],$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/branch_semister_subjects';
            $this->load->view('common/base_template',$data);
        }
    }

    function edit_subject_grid(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['subject_edit_data']=$this->admin_model->get_subject_details($id);
            $this->load->view('admin/subject_grid_form',$data);
        }
    }

    function save_subject_grid(){
        // Put the save_record lib func
        $post=$this->input->post();
        if($post){
            if($this->admin_model->check_subject_grid($post)){
                echo '<br/><div class="error">Subject already exists for Branch Semester.</div><a href="javascript:void(0);" onclick="javascript:edit_subject_grid(0);"> <br/> << Back To Adding</a>';
                return;
            }
            $this->my_db_lib->save_record($post,'branch_semister_subject');
            echo '<br/><p>Subject saved Successfully.</p><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }

    function delete_subject_grid(){
        $post=$this->input->post();
        if( $this->input->post()){
            $this->admin_model->delete_subject_grid($post['id']);
        }
    }
    
   function add_marks($id=0){
        // Put the save_record lib func
        $post=$this->input->post();
        if($post && isset($_POST['st_id'],$_POST['type_id'],$_POST['year_id'],$_POST['marks'],$_POST['sm_id'])){
		//echo "<pre>";
            //print_r($_POST);//exit;
			
                    $st_id=$_POST['st_id'];
                    $type_id=$_POST['type_id'];
					$year_id=$_POST['year_id'];
					$sm_id=$_POST['sm_id'];
				$check_sql=$this->db->query("select sm.id from student_marks sm 
												inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id
												where sm.student_id='".$st_id."' and bss.semister_id='".$sm_id."' 
												and (sm.marks!='0.00' and sm.internal_1!='0.00' and sm.internal_2!='0.00' and sm.internal_3!='0.00' ) ");
				if($check_sql->num_rows()==0){	
                    	$this->admin_model->add_student_marks($st_id,$type_id,$year_id,$_POST['marks'],$sm_id);
					}
//			redirect('admin/user_accounts');
                    redirect('admin/adduser_marks');
					
        }else{
		$sql_sem=$this->db->query("select sr.branch_id,max(ss.semister_id) as  semister_id from users u 
                                                inner join student_records sr on u.id=sr.user_id
                                                inner join student_semisters ss on u.id=ss.user_id where u.id='".$id."'");
		if($sql_sem->num_rows()>0){
		$row=$sql_sem->row();
		$sql=$this->db->query("select s.name,s.id as sid,bss.id as bssid from 
                                             branch_semister_subject bss
                                            inner join subjects s on bss.subject_id=s.id
                                            inner join semisters se on bss.semister_id=se.id
                                            inner join branches b on bss.branch_id=b.id
                                            inner join courses c on b.course_id=c.id
                                            where  bss.semister_id='".$row->semister_id."' and bss.branch_id='".$row->branch_id."'");
			$data['st_id']=$id;	
			$data['sm_id']=$row->semister_id;					
			$data['subjects']=$sql->result();			
			$data['content_page']='admin/add_marks';
                        $this->load->view('common/base_template',$data);
                }
        }
    }

    function view_marks($id=0){
        // Put the save_record lib func
        $post=$this->input->post();
        $sql_sem=$this->db->query("select sr.branch_id,max(ss.semister_id) as  semister_id from users u
                                        inner join student_records sr on u.id=sr.user_id
                                        inner join student_semisters ss on u.id=ss.user_id where u.id='".$id."'");
        if($sql_sem->num_rows()>0){
            $row=$sql_sem->row();
            $view_data=array();
            $view_data['student_marks']=$this->students_model->get_student_marks_history($id,$row->semister_id);
            $view_data['show_admin_back']=true;
            $view_data['content_page']='admin/marks_view';
            $this->load->view('common/base_template',$view_data);


//            $sql=$this->db->query("select s.name,s.id as sid,bss.id as bssid from
//                                branch_semister_subject bss
//                                inner join subjects s on bss.subject_id=s.id
//                                inner join semisters se on bss.semister_id=se.id
//                                inner join branches b on bss.branch_id=b.id
//                                inner join courses c on b.course_id=c.id
//                                where  bss.semister_id='".$row->semister_id."' and bss.branch_id='".$row->branch_id."'");
//            $data['st_id']=$id;
//            $data['subjects']=$sql->result();
//            $data['content_page']='admin/add_marks';
//            $this->load->view('common/base_template',$data);
        }
    
    }


	function add_attendence($id=0){
        // Put the save_record lib func
        $post=$this->input->post();
        if($post){
		
			$st_id=$_POST['st_id'];
			$sem_id=$_POST['sem_id'];
			$attd=$_POST['attd'];
			$attd_tot=$_POST['attd_tot'];
			 $this->admin_model->add_student_attend($st_id,$sem_id,$attd,$attd_tot);
			redirect('admin/user_accounts');
        }else{
		$sql_sem=$this->db->query("select u.id from users u where u.id='".$id."'");
		if($sql_sem->num_rows()>0){
		$row=$sql_sem->row();
		
			$data['st_id']=$id;					
			$data['content_page']='admin/add_attendence';
            $this->load->view('common/base_template',$data);
			}
		}
    }
	
	function add_semister($id=0){
        // Put the save_record lib func
        $post=$this->input->post();
        if($post){
		//echo "<pre>";
            //print_r($_POST);//exit;
			$st_id=$_POST['st_id'];
			$sem_id=$_POST['sem_id'];
		$check=$this->db->query("select id from  student_semisters where user_id='".$st_id."' and semister_id='".$sem_id."'");
		if($check->num_rows()==0){
		   $this->db->query("update student_semisters set is_current='0' where user_id='".$st_id."'");
			$this->db->query("insert into student_semisters (`user_id`, `semister_id`,`is_current`) values ('".$st_id."','".$sem_id."','1')");
			}
			redirect('admin/user_accounts');
        }else{
			$data['st_id']=$id;					
			$data['content_page']='admin/add_semister';
            $this->load->view('common/base_template',$data);
		}
    }
	



    function system_subjects_grid(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql="select * from subjects where status='1'
                ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_system_subjects(".$v['id'].");' >Edit</a>";;
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_system_subjects(".$v['id'].");' >Delete</a>";;
                    $data->rows[$i]['cell']=array($v['id'],$v['name'],$edit,$delete);

                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/add_subjects_grid';
            $this->load->view('common/base_template',$data);
        }
    }

    function edit_system_subjects(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['subject_edit_data']=$this->admin_model->get_system_subjects($id);
            $this->load->view('admin/system_subjects_form',$data);
        }
    }


    function save_system_subjects(){
        // Put the save_record lib func
        $post=$this->input->post();
        if($post){
            if($this->admin_model->check_system_subjects($post['name'])){
                echo '<br/><div class="error">Subject already exists.</div><a href="javascript:void(0);" onclick="javascript:edit_subject_grid(0);"> <br/> << Back To Adding</a>';
                return;
            }
            $this->my_db_lib->save_record($post,'subjects');
            echo '<br/><p>Subject saved Successfully.</p><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }

    function delete_system_subjects(){
        $post=$this->input->post();
        if( $this->input->post()){
            $this->admin_model->delete_system_subjects($post['id']);
        }
    }

    function add_attendance(){
        $post=$this->input->post();
        if($post && $post['user_id'] && $post['semister_id']){
            // $this->my_db_lib->save_record($post,'student_attendence');
            $data['subject_edit_data']=$this->admin_model->get_student_attendance($post);
            if(!isset($data['subject_edit_data'][0]['user_id'])) $data['subject_edit_data'][0]['user_id']=$post['user_id'];
            if(!isset($data['subject_edit_data'][0]['semister_id'])) $data['subject_edit_data'][0]['semister_id']=$post['semister_id'];
//            $data['content_page']='admin/add_attendance';
            $this->load->view('admin/add_attendance',$data);
        }else{
            $data['content_page']='admin/add_attendance';
            $this->load->view('common/base_template',$data);
        }
    }

    function get_student_attendance(){
        $post=$this->input->post();
        if($post && $post['user_id'] && $post['semister_id']){
            echo json_encode($this->admin_model->get_student_attendance($post));
        }
    }

    function save_attendance(){
        $post=$this->input->post();
        if($post && $post['user_id'] && $post['semister_id']){
            $this->my_db_lib->save_record($post,'student_attendence');
        }
    }
function pass_percentage($id=0){
            $sem_id='';
			$br_id='';
			$sub_id='';
			$p_id='';
			$data['result_data']='';
	$post=$this->input->post();
        if($post){
		
			$sem_id=$_POST['sem_id'];
			$br_id=$_POST['br_id'];
			$sub_id=$_POST['sub_id'];
			$p_id=$_POST['p_id'];
			
			if(isset($_POST['year_id'])){
				$year_id=$_POST['year_id'];
			}else{
				$year_id=date('Y');
			}
			$data['result_data']='';
			$qry='';
			if($sem_id!=''){
				$qry.=" bss.semister_id='".$sem_id."' and ";
			}
			if($br_id!=''){
				$qry.=" bss.branch_id='".$br_id."' and ";
			}
			if($sub_id!=''){
				$qry.=" bss.subject_id='".$sub_id."' and ";
			}
			if($p_id!=''){
				//$qry.=" bss.subject_id='".$p_id."' and ";
			}
			$sql=$this->db->query("select sm.student_id,u.username from student_marks sm
			               inner join users u on  sm.student_id=u.id
					inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id
					inner join subjects s on bss.subject_id=s.id
					where  ".$qry." sm.marks_year='".$year_id."' group by sm.student_id");
					$pass_u_tot=array();
					$tot_u=$sql->num_rows();
					foreach($sql->result() as $row){
					$pass_u=array();
					$sql_m=$this->db->query("select sm.* from student_marks sm 
												inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id
												where ".$qry." sm.student_id='".$row->student_id."' and sm.marks_year='".$year_id."'");
							$s_pass=1;
							$t_m=0;	
							$m_m=0;					
						foreach($sql_m->result() as $row_m){
						//if($row_m->tot_marks<10 || max($row_m->internal_1,$row_m->internal_2,$row_m->internal_3)<7 || min($row_m->marks,$row_m->internal_1,$row_m->internal_2,$row_m->internal_3)==0.00)
								//$s_pass=0;
								$t_m+=$row_m->tot_marks;
								$m_m=$row_m->avg_marks;
								
						}
						if($s_pass==1){
								$pass_u['id']=$row->student_id;
								$pass_u['uname']=$row->username;
								$pass_u['t_marks']=$t_m;
								$pass_u['max_marks']=$m_m;
								array_push($pass_u_tot,$pass_u);
						}				
					}
								$pass_users=count($pass_u_tot);
									//print_r($pass_u_tot);exit;
								$data['result_data']=$pass_u_tot;
								$data['st_id']=$id;		
								$data['sem_id']=$sem_id;
								$data['br_id']=$br_id;
								$data['sub_id']=$sub_id;
								$data['p_id']=$p_id;			
								$data['content_page']='admin/pass_percentage';
								$this->load->view('common/base_template',$data);
        }else{
			$data['st_id']=$id;					
			$data['content_page']='admin/pass_percentage';
            $this->load->view('common/base_template',$data);
		}
       
    }

}

?>
