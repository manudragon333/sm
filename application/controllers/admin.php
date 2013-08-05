<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//error_reporting(0);
class Admin extends CI_Controller {

    function __construct() {
    
        // Call the Parent constructor
        parent::__construct();
        $this->load->model(array('students_model','staff_model','admin_model','office_model'));
        $this->request_counts();
        $userObj=$this->session->userdata('user_details');
        if(!empty ($userObj))
        $this->ci_user_id=$userObj->id;
    }

    public function index() {
        $data["notice_board"]=$this->students_model->get_notice_board();
        $data['content_page'] = 'admin/home.php';
        $this->load->view('common/base_template', $data);
    }


    function student_data() {
	 //$this->load->model('exam_model');
//        $data['content_page'] = 'admin/student_data';
//        $this->load->view('common/base_template', $data);
if($this->input->post('stu_results')=='admin_stu_results')
{
	 $post=$this->input->post();
        if($post){
            
            $this->load->model('students_model');
             $this->load->model('exam_model');
			  $this->load->model('office_model');
            $search_student_number=$post['search_student_number'];
            $search_student_details=$this->students_model->get_student_details($search_student_number);
            $student_user_id=((!empty($search_student_details[0]->user_id))?$search_student_details[0]->user_id:0);
            if($student_user_id){
                $student_data=$this->students_model->get_user_details($student_user_id);
            }else{
                $student_data=false;
            }

            if(!empty($student_data)){
//                echo '<pre>'; print_r($student_data); echo '</pre>';

                $post['user_id']=$student_data[0]->user_id;
                $data['form_data']=$post;
                if(isset($post['semister_id'])){
                    $data['internal_marks']=$this->exam_model->getStudentsInternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
                    $data['external_marks']=$this->exam_model->getStudentsExternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
                }else{
                    $data['form_data']['college_id']=$student_data[0]->college_id;
                    $data['form_data']['course_id']=$student_data[0]->course_id;
                    $data['form_data']['branch_id']=$student_data[0]->branch_id;
                }
                $data['form_data']['student_number']=$student_data[0]->students_number;
                $data['student_data']=$student_data[0];
                
//                echo '<pre>'; print_r($data); echo '</pre>';                
            }else{
                $this->session->set_flashdata('error_msg', 'No Student Found with student number <i>'.$search_student_number.'</i>.');
                redirect('students/my_record_3');
                return true;
            }
            
            $data['form_data']['is_mba']=((isset($data['internal_marks'][0]->is_mba))?$data['internal_marks'][0]->is_mba:0);
            $data['form_data']['view_only']=true;
			if (!empty($post['user_id'])) {
			$user_id=$post['user_id'];
                //  print_r($user_id);
                //  $data['student_details']=$this->students_model->get_user_details($user_id[0]->user_id);
                //   $this->load->view('admin/student_record',$data);
                $data['student_details'] = $this->office_model->get_student_ledger_profile($user_id);
                $data['payment_details'] = $this->office_model->get_student_finances($user_id);
				}
          //  $data['content_page']='students/my_record_3';
//            $this->load->view('common/base_template',$data);
        }else{

            $data['content_page']='students/my_record_3';
            $this->load->view('common/base_template',$data);
        }
		if(empty($post['user_id'])){
                $data['student_details'] = $this->staff_model->search_student($post['number'], $post['name']);
                $this->load->view('students/student_list', $data);
            }else if (!empty($post['user_id'])) {
                $user_id=$post['user_id'];
                //  print_r($user_id);
                //  $data['student_details']=$this->students_model->get_user_details($user_id[0]->user_id);
                //   $this->load->view('admin/student_record',$data);
                $data['student_details'] = $this->office_model->get_student_ledger_profile($user_id);
                $data['payment_details'] = $this->office_model->get_student_finances($user_id);
				
                // $data['attendance_details'] = $this->staff_model->get_student_attendance($user_id);
                // $this->load->view('students/my_record1', $data);
				
                 
                //$data['content_page']='students/my_record_3';
//                $this->load->view('common/base_template',$data);
            } else {
                echo '<br/><p>Student Number not found. Please try again.</p>';
            }
			$data['content_page']='students/my_record_3';
            $this->load->view('common/base_template',$data);
			
}
else
{

        if($this->input->post()){
            $post = $this->input->post();
            if(empty($post['user_id'])){
                $data['student_details'] = $this->staff_model->search_student($post['number'], $post['name']);
                $this->load->view('students/student_list', $data);
            }else if (!empty($post['user_id'])) {
                $user_id=$post['user_id'];
                //  print_r($user_id);
                //  $data['student_details']=$this->students_model->get_user_details($user_id[0]->user_id);
                //   $this->load->view('admin/student_record',$data);
                $data['student_details'] = $this->office_model->get_student_ledger_profile($user_id);
                $data['payment_details'] = $this->office_model->get_student_finances($user_id);
				
                // $data['attendance_details'] = $this->staff_model->get_student_attendance($user_id);
                // $this->load->view('students/my_record1', $data);
				
                 
                $data['content_page']='students/my_record_3';
                $this->load->view('common/base_template',$data);
            } else {
                echo '<br/><p>Student Number not found. Please try again.</p>';
            }
			
        }else{
            // $data['content_page']='admin/student_profile';
            $this->load->view('admin/student_profile');
        }
		}
    }
	function view_student_results(){
        $post=$this->input->post();
        print_r($post);
        if($post){
            
            $this->load->model('students_model');
            
            $search_student_number=$post['search_student_number'];
            $search_student_details=$this->students_model->get_student_details($search_student_number);
            $student_user_id=((!empty($search_student_details[0]->user_id))?$search_student_details[0]->user_id:0);
            if($student_user_id){
                $student_data=$this->students_model->get_user_details($student_user_id);
            }else{
                $student_data=false;
            }

            if(!empty($student_data)){
//                echo '<pre>'; print_r($student_data); echo '</pre>';

                $post['user_id']=$student_data[0]->user_id;
                $data['form_data']=$post;
                if(isset($post['semister_id'])){
                    $data['internal_marks']=$this->exam_model->getStudentsInternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
                    $data['external_marks']=$this->exam_model->getStudentsExternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
                }else{
                    $data['form_data']['college_id']=$student_data[0]->college_id;
                    $data['form_data']['course_id']=$student_data[0]->course_id;
                    $data['form_data']['branch_id']=$student_data[0]->branch_id;
                }
                $data['form_data']['student_number']=$student_data[0]->students_number;
                $data['student_data']=$student_data[0];
                
//                echo '<pre>'; print_r($data); echo '</pre>';                
            }else{
                $this->session->set_flashdata('error_msg', 'No Student Found with student number <i>'.$search_student_number.'</i>.');
                redirect('students/my_record_3');
                return true;
            }
            
            $data['form_data']['is_mba']=((isset($data['internal_marks'][0]->is_mba))?$data['internal_marks'][0]->is_mba:0);
            $data['form_data']['view_only']=true;
            $data['content_page']='students/my_record_3';
            $this->load->view('common/base_template',$data);
        }else{

            $data['content_page']='students/my_record_3';
            $this->load->view('common/base_template',$data);
        }

    }
	 function get_student_results(){
	  $post=$this->input->post();
	  $this->load->model('exam_model');
				 $data['internal_marks']=$this->exam_model->getStudentsInternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
                    $data['external_marks']=$this->exam_model->getStudentsExternalMarks($post['user_id'],$post['college_id'],$post['course_id'],$post['branch_id'],$post['semister_id'],0,$post['section_id']);
       
    
            echo json_encode($data);
        
    }

    function save_student_data(){
        if($this->input->post()){
            $post=$this->input->post();
            $this->my_db_lib->save_record($post,'student_records');
            echo showBigSuccess('<p>Student details saved Successfully.</p>');
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
    $photopath=$sscpath=$interpath=$otherpath='';
    $students_number=$_POST['students_number'];
	$photo=$_FILES['photo']['name'];
	$ssc=$_FILES['ssc']['name'];
	$inter=$_FILES['inter']['name'];
	$other=$_FILES['other']['name'];
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['overwrite']  = 'false';
		$config['remove_spaces']  = 'true';
		$config['upload_path'] = "./files/$students_number";
	
		
	if($photo)
	{
	if(!is_dir("files/$students_number"))
		mkdir("./files/$students_number");
	$this->load->library('upload', $config);
		if($this->upload->do_upload('photo'))
		{
		$updata=$this->upload->data();
		$x=$updata['file_name'];
		$photopath="files/$students_number/".$x;
		}else
		echo $this->upload->display_errors();
	}
	if($ssc)
	{
	if(!is_dir("files/$students_number"))
		mkdir("./files/$students_number");
	$this->load->library('upload', $config);
		if($this->upload->do_upload('ssc'))
		{
		$updata=$this->upload->data();
		$x=$updata['file_name'];
		$sscpath="files/$students_number/".$x;
		}
		else
		echo $this->upload->display_errors();
	}
	if($inter)
	{
	if(!is_dir("files/$students_number"))
		mkdir("./files/$students_number");
	$this->load->library('upload', $config);
		if($this->upload->do_upload('inter'))
		{
		$updata=$this->upload->data();
		$x=$updata['file_name'];
		$interpath="files/$students_number/".$x;
		}
		else
		echo $this->upload->display_errors();
	}	
	if($other)
	{
	if(!is_dir("files/$students_number"))
		mkdir("./files/$students_number");
	$this->load->library('upload', $config);
		if($this->upload->do_upload('other'))
		{
		$updata=$this->upload->data();
		$x=$updata['file_name'];
		$otherpath="files/$students_number/".$x;
		}
		else
		echo $this->upload->display_errors();
		
	}	
		$post['id']=$post['student_rec_id'];
				$post['photo']=$photopath;
				$post['ssc']=$sscpath;
				$post['inter']=$interpath;
				$post['other']=$otherpath;
				if($post['ugtc']!=""){$u=$post['ugtc'];}else{$u="NULL";}
				if($post['ugsc']!=""){$g=$post['ugsc'];}else{$g="NULL";}
				if($post['ugpc']!=""){$p=$post['ugpc'];}else{$p="NULL";}
				if($post['ugcmm']!=""){$c=$post['ugcmm'];}else{$c="NULL";}
				$data=array('schname'=>$post['schname'],
				'icname'=>$post['icname'],
				'ugtc'=>$u,
				'ugsc'=>$g,
				'ugpc'=>$p,
				'ugcmm'=>$c,
				'lac'=>$post['lac'],
				'cnc'=>$post['cnc']);
				$id=$this->my_db_lib->save_record($post,'student_records');
				$this->admin_model->insert_ssc_inter($id,$data);
			
	
	}			
				if(isset($post['sem_id'])){
                    $this->admin_model->save_student_semester($post['user_id'],$post['sem_id']);
                }
            else if($post['users_type_id']==2 || $post['users_type_id']==3){
                // Save Staff form
                $post['id']=$post['staff_rec_id'];
                $this->my_db_lib->save_record($post,'staff_records');
				
            }
            if($post['users_type_id']!=1){
                echo showBigSuccess('<p> User saved successfully.</p>'); // <br/><input type="button" name="imageField" id="imageField" class="send button" value="Back" onclick="javascript:window.location.reload();"/>
            }else{
                $data['content_page']='admin/userAdded';
                $this->load->view('common/base_template',$data);
            }
            
			
        }
    
	
}
function update_user_account()
{
	$post=$this->input->post();
	$photopath=$sscpath=$interpath='';
    $students_number=$_POST['students_number'];
	$photo=$_FILES['photo']['name'];
	$ssc=$_FILES['ssc']['name'];
	$inter=$_FILES['inter']['name'];
	$other=$_FILES['other']['name'];
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['overwrite']  = 'false';
		$config['remove_spaces']  = 'true';
		$config['upload_path'] = "./files/$students_number";
	
		
	if($photo)
	{
	if(!is_dir("files/$students_number"))
		mkdir("./files/$students_number");
		$this->load->library('upload', $config);
		if($this->upload->do_upload('photo'))
		{
		$updata=$this->upload->data();
		$x=$updata['file_name'];
		$post['photopath']="files/$students_number/".$x;
		}else
		echo $this->upload->display_errors();
	}
	if($ssc)
	{
	if(!is_dir("files/$students_number"))
		mkdir("./files/$students_number");
	$this->load->library('upload', $config);
		if($this->upload->do_upload('ssc'))
		{
		$updata=$this->upload->data();
		$x=$updata['file_name'];
		$post['sscpath']="files/$students_number/".$x;
		}
		else
		echo $this->upload->display_errors();
	}
	if($inter)
	{
	if(!is_dir("files/$students_number"))
		mkdir("./files/$students_number");
	$this->load->library('upload', $config);
		if($this->upload->do_upload('inter'))
		{
		$updata=$this->upload->data();
		$x=$updata['file_name'];
		$post['interpath']="files/$students_number/".$x;
		}
		else
		echo $this->upload->display_errors();
			   
				//$this->my_db_lib->save_record($post,'student_records');
	}
	if($other)
	{
	if(!is_dir("files/$students_number"))
		mkdir("./files/$students_number");
	$this->load->library('upload', $config);
		if($this->upload->do_upload('other'))
		{
		$updata=$this->upload->data();
		$x=$updata['file_name'];
		$post['otherpath']="files/$students_number/".$x;
		}
		else
		echo $this->upload->display_errors();
			   
				//$this->my_db_lib->save_record($post,'student_records');
	}
			$post['uid']=$post['student_rec_id'];
		    //print_r($post);
			 $this->admin_model->update_student_record($post);
			//echo $post['scholarship'];
			//$this->my_db_lib->save_record($post,'student_records');
			$data=$post;
			//$data['content_page']='admin/userAdded';
			$this->load->view('admin/userAdded',$data);
        
}


    /***************************************** NEW CODE *********************************************/

    function export_users_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            //echo '<pre>';
           // print_r($post);
            $sql="select * from users inner join student_records as sr on sr.user_id=users.id inner join student_semisters as ss on ss.user_id=sr.user_id 
                    where users.users_type_id='".$post['users_type']."' and users.status='".$post['status']."' ";
                    if($post['college_id'] != "")
                    	$sql.=" and sr.college_id = ".$post['college_id']." ";
                    
                    if($post['course_id'] != "")
                    	$sql.=" and sr.course_id = ".$post['course_id']." ";
                    
                    if($post['branch_id'] != "")
                    	$sql.=" and sr.branch_id = ".$post['branch_id']." ";
                    
                    if($post['semister_id'] != "")
                    	$sql.=" and ss.semister_id = ".$post['semister_id']." ";
						
						 if($post['admission_type_id'] != ""){
                    	$sql.=" and sr.admission_type_id = ".$post['admission_type_id']." ";}
						
//						
//						 if($post['scholarship'] != ""){
//                    	$sql.=" and sr.scholarship = ".$post['scholarship']." ";}
//						
//						
						 if($post['sex'] != ""){
                    	$sql.=" and sr.sex = ".$post['sex']." ";}
//						
						if($post['caste_id'] != ""){
                    	$sql.=" and sr.caste_id = ".$post['caste_id']." ";}
						 
                  
                  //prakash 
                
                    if($post['section_id'] != "")
                    {
                     $sql_start = mysql_query("select * from sections inner join users on users.id=sections.start_number where sections.id=".$post['section_id']);
                    $sections_start = mysql_fetch_array($sql_start);
                    
                    $sql_end = mysql_query("select * from sections inner join users on users.id=sections.end_number where sections.id=".$post['section_id']);
                    $sections_end = mysql_fetch_array($sql_end);
                    if($sections_start['username']!="" && $sections_end['username']!="" ){
                    	$sql.=" and users.username >= '".$sections_start['username']."' and users.username <= '".$sections_end['username']."' ";
						}
						$sql.=" and sr.section_id = ".$post['section_id']." ";
                    }
                    
                   
                   
                    
                    
               // echo $sql; 
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
     
           if(count($data->db_data)){
                $i=0;
                //echo APPPATH.'libraries/class.export_excel.php';
                ob_start();
                $fn="users.xls";
            include_once(APPPATH.'libraries/class.export_excel.php');
                
                $excel_obj=new ExportExcel("$fn");
                
                $report_header=array("Student Name","Father Name","Student Number","Sex","Date of Birth","Date of Join","College","Course","Branch","Present Year/Sem","Estimated year of Completion","Mailing Address","Mobile Number","Email","Status"); 
                foreach($data->db_data as $k=>$v){
                
                $report_values[$i][0]=$v['name']." ";
		          $report_values[$i][1]=$v['fathers_name']." ";
		          $report_values[$i][2]=$v['students_number']." ";
		           if($v['sex'] == 1) $report_values[$i][3]="Mail"." ";
		           $report_values[$i][3]=($v['sex']=='1')?'Male'." ":'Female'." ";
		            $report_values[$i][4]=$v['dob']." ";
		             $report_values[$i][5]=$v['doj']." ";
		            $college_name = $this->admin_model->get_colleges($v['college_id']);
		              $report_values[$i][6]=$college_name[0]['name']." ";
		              $course_name =$this->admin_model->get_courses($v['course_id']);
		               $report_values[$i][7]=$course_name[0]['name']." ";
		               
		              $branch_name=  $this->admin_model->get_branches($v['branch_id']);
		               $report_values[$i][8]=$branch_name[0]['name']." ";
		               $semister_name = $this->admin_model->get_semesters($v['semister_id']);
		               
		              
		               $report_values[$i][9]=$semister_name[0]['name']." ";
		               
		               $report_values[$i][10]=$v['completing_year']." ";
		               $report_values[$i][11]=$v['address']." ";
		               $report_values[$i][12]=$v['mobile']." ";
		               $report_values[$i][13]=$v['email']." ";
		               
		          
                //echo $v['username'].'<br>';
                //prakash 
                
               /*if($post['section_id'] )
                {
                
                if($sections_start['username'] < $v['username'] && $sections_end['username'] > $v['username'])
                {}
                else
                continue;
                //echo substr($v['username'], -2).'<br>';
                   //if(substr($sections_start['username'], -2) > substr($v['username'], -2) || substr($sections_end['username'], -2) < substr($v['username'], -2))
                   //continue;
                }*/
                
            
               
                
   		          
                
               
					
//                    if($v['users_type_id']=='1')
//                    $uname="<div><a href='".site_url('admin/add_semister/'.$v['id'])."'>".$v['username']."</a></div>";
//                    else
                    $uname=$v['username'];
					
                    $status=($v['status']=='1')?'Active':'Inactive';
                    $report_values[$i][14]=$status." ";
                    
                    $i++;
                }
                
            $excel_obj->setHeadersAndValues($report_header,$report_values); 
            $excel_obj->GenerateExcelFile();
        	exit;
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }
    }

    function load_users_grid(){
	
        if($this->input->post()){
            $post=$this->input->post();
            //echo '<pre>';
            //print_r($post);
            
            if($post['user_type'] == 1)
            {
            	$sql="select sr.*, users.users_type_id, users.username, users.`password` , users.email, users.id as users_id ,users.status
                        from users
                        inner join student_records as sr on sr.user_id=users.id
                        inner join student_semisters as ss on ss.user_id=sr.user_id
                    where users.users_type_id='".$post['user_type']."' and users.status='".$post['status']."' and ss.is_current='1' ";
                    if($post['college_id'] != "")
                    	$sql.=" and sr.college_id = ".$post['college_id']." ";
                    
                    if($post['course_id'] != "")
                    	$sql.=" and sr.course_id = ".$post['course_id']." ";
						
						
                   
                    if($post['branch_id'] != "")
                    	$sql.=" and sr.branch_id = ".$post['branch_id']." ";
						
				  if($post['semister_id'] != "")
                    	$sql.=" and ss.semister_id = ".$post['semister_id']." ";
						
						if($post['admission_type_id'] != ""){
                    	$sql.=" and sr.admission_type_id = ".$post['admission_type_id']." ";}
						
						
						 if($post['scholarship'] != ""){
                    	$sql.=" and sr.scholarship = ".$post['scholarship']." ";}
						
						
						 if($post['sex'] != ""){
                    	$sql.=" and sr.sex = ".$post['sex']." ";}
//						
						if($post['caste_id'] != ""){
                    	$sql.=" and sr.caste_id = ".$post['caste_id']." ";}
						
						
				  
                  //prakash 
                
                    if($post['section_id'] != "")
                    {
                     $sql_start = mysql_query("select * from sections inner join users on users.id=sections.start_number where sections.id=".$post['section_id']);
                    $sections_start = mysql_fetch_array($sql_start);
                    
                    $sql_end = mysql_query("select * from sections inner join users on users.id=sections.end_number where sections.id=".$post['section_id']);
                    $sections_end = mysql_fetch_array($sql_end);
                    if($sections_start['username']!="" && $sections_end['username']!=""){
                    $sql.=" and users.username >= '".$sections_start['username']."' and users.username <= '".$sections_end['username']."' ";
				   }
					$sql.=" and sr.section_id='".$post['section_id']."' ";
                    }
					
					
		    // $sql.=" GROUP BY users.id  ";		
					
                    
            }
            else
            {
             $sql="select * from users
                    where users_type_id='".$post['user_type']."' and status='".$post['status']."'";
            }
            
                    
                    
                   
                    
                    
                //echo $sql; 
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
           
           if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                
                //echo $v['username'].'<br>';
                //prakash 
                
               /*if($post['section_id'] )
                {
                
                if($sections_start['username'] < $v['username'] && $sections_end['username'] > $v['username'])
                {}
                else
                continue;
                //echo substr($v['username'], -2).'<br>';
                   //if(substr($sections_start['username'], -2) > substr($v['username'], -2) || substr($sections_end['username'], -2) < substr($v['username'], -2))
                   //continue;
                }*/
                
            if($post['user_type'] == 1)
            {
            
                    $data->rows[$i]['id']=$v['users_id'];
                    $action1='<div><a href="javascript:void(0)" onclick="javascript:update_account(\''.$v['users_id'].'\',\''.$v['users_type_id'].'\');"> Update Account </a></div>';
                    if($v['status']=='1')
                    $action2='<div><a href="javascript:void(0)" onclick="javascript:squeez_account(\''.$v['users_id'].'\',\'0\');" title="Make the user Inactive"> Squeez Account</a></div>';
                    else
                    $action2='<div><a href="javascript:void(0)" onclick="javascript:squeez_account(\''.$v['users_id'].'\',\'1\');" title="Make the user Active"> Release Account</a></div>';
                }
                else
                {
                    
                      $data->rows[$i]['id']=$v['id'];
                    $action1='<div><a href="javascript:void(0)" onclick="javascript:update_account(\''.$v['id'].'\',\''.$v['users_type_id'].'\');"> Update Account </a></div>';
                    if($v['status']=='1')
                    $action2='<div><a href="javascript:void(0)" onclick="javascript:squeez_account(\''.$v['id'].'\',\'0\');" title="Make the user Inactive"> Squeez Account</a></div>';
                    else
                    $action2='<div><a href="javascript:void(0)" onclick="javascript:squeez_account(\''.$v['id'].'\',\'1\');" title="Make the user Active"> Release Account</a></div>';
                }
					
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
                $this->load->view('admin/student_update_form',$view_data);
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
function add_account(){
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
				  $data['content_page']='';
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
            $sql="select q.*,br.name as branch_name, u.username , s.name AS subject
                from question_papers as q
                left join users as u on q.user_id=u.id
                left join branches as br on q.branch=br.id
                left join subjects as s on s.id=q.subject_id
                where q.is_principal_approved!='1' ";

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
			$sql="select s.name AS subject,qp.year,sr.mobile,sr.name,b.name as branch  from question_papers as qp
inner join staff_records as sr on sr.user_id=qp.user_id
inner join branches  as b on b.id=qp.branch
left join subjects as s on s.id=qp.subject_id
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
            echo showBigSuccess('<p>Message saved Successfully.</p>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"><< Back To List</a>';
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
                echo showBigError('<div class="">Subject already exists for Branch Semester.</div>'); //<a href="javascript:void(0);" onclick="javascript:edit_subject_grid(0);"> <br/> << Back To Adding</a>';
                return;
            }
            $this->my_db_lib->save_record($post,'branch_semister_subject');
            echo showBigSuccess('<p>Subject saved Successfully.</p>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
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
        if($post && isset($_POST['st_id'],$_POST['type_id'],$_POST['year_id'],$_POST['marks'],$_POST['sm_id'])){ exit;
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
function edit_marks($id=0,$uid=0){
        $post=$this->input->post();
        
        $post=$this->input->post();
        if($post){
		
                    $st_id=$_POST['st_id'];
                   $extr=$_POST['extr'];
				   $intr1=$_POST['intr1'];
				   $intr2=$_POST['intr2'];
				   $intr3=$_POST['intr3'];
					$sm_id=$_POST['sm_id'];
					$x=array($intr1,$intr2,$intr3);
								$y=array_search(min($x),$x);
								unset($x[$y]);
								$max=array_sum($x);
								$avg_marks=$max/count($x);
								$tot_marks=$extr+$max;	
								
				$check_sql=$this->db->query(" update student_marks set marks='".$extr."',internal_1='".$intr1."',internal_2='".$intr2."', 
				internal_3='".$intr3."',tot_marks=".$tot_marks.",avg_marks=".$avg_marks." where id='".$sm_id."' and student_id='".$st_id."' ");
				
                    redirect('admin/view_marks/'.$st_id);
					
        }else{
		
		
		$sql=$this->db->query("select sm.*,s.name as sname,u.username,u.id as st_id,sm.id as sm_id from student_marks sm 
								inner join users u on sm.student_id=u.id 
								inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id 
								inner join subjects s on bss.subject_id=s.id 
                                            where sm.id='".$id."' and sm.student_id='".$uid."'");
						$data['st_id']=$uid;	
						$data['sm_id']=$id;					
						$data['subjects']=$sql->result();			
						$data['content_page']='admin/edit_marks';
                        $this->load->view('common/base_template',$data);
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
                echo showBigError('<div class="">Subject already exists.</div>'); // <a href="javascript:void(0);" onclick="javascript:edit_subject_grid(0);"> <br/> << Back To Adding</a>';
                return;
            }
            $this->my_db_lib->save_record($post,'subjects');
            echo showBigSuccess('<p>Subject saved Successfully.</p>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
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
			$qry2='';
			if($p_id!=''){
				if($p_id==39)
					$qry2=" having sum(sm.tot_marks)<40*count(student_id) ";
				else if($p_id==40)
					$qry2=" having sum(sm.tot_marks)>=40*count(student_id) ";
			   else if($p_id==59)
					$qry2=" having sum(sm.tot_marks) between 40*count(student_id) and  60*count(student_id)";
			   else if($p_id==60)
					$qry2=" having sum(sm.tot_marks)>=60*count(student_id) ";
			 	 				
			}
			$sql=$this->db->query("select sm.student_id,u.username,sum(tot_marks) as t_marks,sum(tot_marks)/count(student_id) as avg,sr.fname,sr.lname from student_marks sm
			               inner join users u on  sm.student_id=u.id
						   inner join student_records sr on u.id=sr.user_id
					inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id
					inner join subjects s on bss.subject_id=s.id
					where  ".$qry." sm.marks_year='".$year_id."' group by sm.student_id ".$qry2);
					$pass_u_tot=array();
					$tot_u=$sql->num_rows();
					/*foreach($sql->result() as $row){
							$pass_u=array();
				
						
								$pass_u['id']=$row->student_id;
								$pass_u['uname']=$row->username;
								$pass_u['t_marks']=$row->avg;
								array_push($pass_u_tot,$pass_u);
					}
								$pass_users=count($pass_u_tot);*/
									//print_r($pass_u_tot);exit;
								$data['result_data']=$sql->result();//$pass_u_tot;
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
function addpoll(){
		if($this->input->post('submit')){
			$_POST['created_by']=$this->ci_user_id;
			$_POST['create_date']=date('Y-m-d H:i:s');
			$poll_id=$this->my_db_lib->save_record($_POST,'polls');
			if($poll_id){
                            $this->admin_model->add_poll_options($_POST['option'],$poll_id);
			}
                        $data['content_page']='poll/add_poll_success';
                        $this->load->view('common/base_template',$data);
			// redirect('admin/addpoll');
		}else{
			$data['content_page']='poll/add_poll';
			$this->load->view('common/base_template',$data);
		}

}
function edit_poll(){
    if($this->input->post('submit')){
            $poll_id=$this->input->post('id');
            $post=$_POST;
            $this->my_db_lib->save_record($_POST,'polls');
            echo showBigSuccess('Poll Saved Successfully.'); // <br/><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
            // $data['content_page']='poll/edit_poll_success';
            // $this->load->view('common/base_template',$data);
            // redirect('admin/addpoll');
    }else if($this->input->post('id')){
            $data['data']=$this->admin_model->get_pool_data($this->input->post('id'));
            $this->load->view('poll/edit_poll',$data);
    }
}


function result_poll()
{
 $poll_id=$this->input->post('id');

$polloptions=$this->admin_model->get_poll_option($poll_id);
$result=$this->admin_model->poll_count($poll_id);
if(count($result))
{
$row=$result[0];
if($row)
$casted=$row['count'];
$row1=$polloptions[0];
echo "<br><font color='pink'><strong>".$row1['question']."<strong></font><br>";
echo "<strong><font color='blue'>Total No of Votes Casted:&nbsp</font>".$casted;
echo "</strong><br>Individual votings <br>";
$op=Array();
$s="";
foreach($polloptions as $option)
{
$pollid= $option['pollid'];
$qstn= $option['question'];
$label=$option['label'];
$polloption=$option['id'];
$op[]=$label;
$pollfinal=$this->admin_model->get_poll_perc($pollid,$polloption);
$votes_total=sizeof($pollfinal);
if($casted!=0)
$per=$votes_total/$casted * 100;
else
$per=0;
echo "<strong><font color='purple'>$label:&nbsp</font></strong><font color='green'>".$votes_total."</font>&nbsp &nbsp<font color='red'>".substr($per,0,4)."%</font>";
echo "";
foreach($pollfinal as $user)
{
$uid= $user['user_id'];
$user_details=$this->admin_model->get_polled_user_details($uid);
foreach($user_details as $x)
echo "<br>->". $x['username']."&nbsp(".$x['email'].")";
}
echo "<br>";
}
}


echo '<br/><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';

}

 function poll_grid(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql="select * from polls ";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_polls(".$v['id'].");' >Edit</a>";
                    $active="<a class='poll_status_a".$v['id']."' href='javascript:void(0);' onclick='javascript:toggle_pool_status(".$v['id'].",".$v['status'].");' >".(($v['status']=='1')?'<b>Active</b>/Inactive':'Active/<b>Inactive</b>')."</a>";
$result="<a href='javascript:void(0);' onclick='javascript:result_polls(".$v['id'].");' >Result</a>";
                    $data->rows[$i]['cell']=array($v['question'],date('m-d-Y',strtotime($v['start_date'])),date('m-d-Y',strtotime($v['end_date'])),$edit,$active,$result);

                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='poll/poll_list';
            $this->load->view('common/base_template',$data);
        }
    }
    function polls() {
        $data["user_types"]=$this->admin_model->get_user_types();
        $data['content_page'] = 'poll/poll_list';
        $this->load->view('common/base_template', $data);
    }


    function toggle_status(){
        if($this->input->post()){
            $post=$this->input->post();
            if($post['status']=='1'){ $status='0'; }else{ $status='1'; }
            $sql=" update polls SET status='$status' where id='".$post['id']."' ";
            $this->db->query($sql);
            echo $status;
        }
    }

    /***********************************************/

    function college_management(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql=" select * from colleges ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;$sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_college_management(".$v['id'].");' >Edit</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_college_management(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$v['college_code'],$status,$edit,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/college_management';
            $this->load->view('common/base_template',$data);
        }
    }


    function edit_college_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['college_data']=$this->admin_model->get_colleges($id);
            $this->load->view('admin/college_management_form',$data);
        }
    }

    function delete_college_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $this->admin_model->delete_colleges($id);
            echo showBigSuccess('<div class="">College Deleted.</div>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }


    function save_college(){
        $post=$this->input->post();
        if($post){
            if($this->admin_model->check_college_name($post)){
                // echo '<br/><div >College Name already exists.</div><a href="javascript:void(0);" onclick="javascript:edit_college_management(0);"> <br/> << Back To Adding</a>';
                $this->session->set_flashdata('error_msg', 'College Name already exists. Please try again.');
                redirect('admin/college_management');
                return;
            }
            // Image Upload & Save
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '1000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['overwrite'] = 'false';
            $config['remove_spaces'] = 'true';
            $config['upload_path'] = "./files/";
            
            if(!empty($_FILES)){
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('upload_image')) {
                    $updata = $this->upload->data();
                    $x = $updata['file_name'];
                    $post['college_logo'] = "/files/" . $x;
                }
                else{
                    $errorMsg= $this->upload->display_errors();
                    $errorMsg.=' Please try again.';
                    $this->session->set_flashdata('error_msg', strip_tags($errorMsg));
                    redirect('admin/college_management');
                    return;
                }
            }
            $this->my_db_lib->save_record($post,'colleges');
            // echo '<br/><p>College saved Successfully.</p><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
            $this->session->set_flashdata('success_msg', 'College saved Successfully.');
            redirect('admin/college_management');
        }
    }

    /***********************************************/

    function course_management(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql=" select cou.*,IFNULL(col.name,'-') as college_name from courses as cou
                    left join colleges as col on col.id=cou.college_id ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;$sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_course_management(".$v['id'].");' >Edit</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_course_management(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$v['college_name'],$status,$edit,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/course_management';
            $this->load->view('common/base_template',$data);
        }
    }


    function edit_course_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['college_data']=$this->admin_model->get_courses($id);
            $this->load->view('admin/course_management_form',$data);
        }
    }

    function delete_course_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $this->admin_model->delete_courses($id);
            echo showBigSuccess('<div class="">Course Deleted.</div>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }


    function save_courseXX(){
        $post=$this->input->post();
        if($post){
            if($this->admin_model->check_course_name($post)){
                echo showBigError('<div class="">Course Name already exists for this College.</div>'); // <a href="javascript:void(0);" onclick="javascript:edit_course_management(0);"> <br/> << Back To Adding</a>';
                return;
            }
            $this->my_db_lib->save_record($post,'courses');
            echo showBigSuccess('<p>Course saved Successfully.</p>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }

    function save_course(){
        $post=$this->input->post();
        if($post){
            foreach($post['course_names'] as $k=>$v){
                if(!empty($v)){
                    $post['name']=$v;
                    if($this->admin_model->check_course_name($post)){
                        echo '<br/><div >Course Name '.$v.' already exists for this College.</div>';
                        continue ;
                    }
                    $this->my_db_lib->save_record($post,'courses');
                    echo showBigSuccess('<p>Course '.$v.' saved Successfully.</p>');
                }
            }
            echo '<br/><a href="javascript:void(0);" onclick="javascript:edit_course_management(0);"> <br/> << Back To Adding</a><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }
     
/*******regulation management***********/
    function regulation_management(){
    	
    	$post=$this->input->post();
    	if( $this->input->post()){
    		$post=$this->input->post();
    		//$sql=" select cou.*,IFNULL(col.name,'-') as college_name from courses as cou
    		// left join colleges as col on col.id=cou.college_id ";
    		$sql = "select * from regulations";
    				$user_details=$this->session->userdata('user_details');
    
    						$data=$this->my_db_lib->get_jqgrid_data($post,$sql);
    							echo count($data->db_data);
    						if(count($data->db_data)){
    						$i=0;$sno=1;
    							foreach($data->db_data as $k=>$v){
    							$data->rows[$i]['id']=$v['id'];
    							$edit="<a href='javascript:void(0);' onclick='javascript:edit_regulation_management(".$v['id'].");' >Edit</a>";
    							$delete="<a href='javascript:void(0);' onclick='javascript:delete_regulation_management(".$v['id'].");' >Delete</a>";
    				$status=($v['status']=='1')?'Active':'InActive';
        						$data->rows[$i]['cell']=array($sno++,$v['name'],$status,$edit,$delete);
        						$i++;
    							}
    							}else{
    							$data->rows[0]['id']=0;
    							$data->rows[0]['cell']=array('No Data','','','','','');
    							}
    
    							unset($data->db_data);
    							echo json_encode($data);
    	}else{
    	$data['content_page']='admin/regulation_management';
    		$this->load->view('common/base_template',$data);
    	}
    	
    	//$data['content_page']='admin/regulation_management.php';
    	//$this->load->view('common/base_template',$data);
    	echo "haiiiiiii";
    	}
    	
    	function save_regulation(){
    		$post=$this->input->post();
    		if($post){
    			
    			
    			if($this->admin_model->check_regulation_name($post)){
    				echo showBigError('<div class="">Section Name '.$post['section'].' already exists for this Semester, Branch, Course in the College.</div>');
    	
    			}
    			
    	
    			else{
    				$section_id=$this->my_db_lib->save_record($post,'regulations');
    				echo showBigSuccess('<p>Regulation'.$post['name'].' saved Successfully.</p>');
    				echo '<br/><a href="javascript:void(0);" onclick="javascript:edit_regulation_management(0);"> <br/> << Back To Adding</a><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
    			}
    	
    	
    			//   $studdentUserIdLarger=($post['start_number']>$post['end_number'])?$post['start_number']:$post['end_number'];
    			//   $studdentUserIdSmaller=($post['start_number']<$post['end_number'])?$post['start_number']:$post['end_number'];
    			//   $studentRecordSectionUpdateSql=' UPDATE student_records as sr
    			//                                       SET sr.section_id='.$section_id.'
    			//                                    WHERE sr.user_id BETWEEN '.$studdentUserIdSmaller.' AND '.$studdentUserIdLarger.' ';
    			//   $this->db->query($studentRecordSectionUpdateSql);
    	
    	
    		}
    		}
    	
    	
    	
    	function edit_regulation_management(){
    		$post=$this->input->post();
    		if($post){
    			$id=$post['id'];
    			$data['regulation_data']=$this->admin_model->get_regulations();
    			$this->load->view('admin/regulation_management_form');
    		}
    		
    		echo "haiiiaiaiaiaiaiai";
    	}
    
    	function save_regulations(){
    		/*
    		$post=$this->input->post();
    		if($post){
    			if($this->admin_model->check_regulation_name($post)){
    				echo '<br/><div >Course Name already exists for this College.</div><a href="javascript:void(0);" onclick="javascript:edit_course_management(0);"> <br/> << Back To Adding</a>';
    				return;
    			}
    			$this->my_db_lib->save_record($post,'regulations');
    			echo '<br/><p>Course saved Successfully.</p><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
    		}
    		*/
    		echo "QWERTTTTRTTT";
    	} 
    	
    	
    	function delete_regulation_management(){
    		$post=$this->input->post();
    		if($post){
    			$id=$post['id'];
    			$this->admin_model->delete_regulation($id);
    			echo showBigSuccess('<div class="">regulation Deleted.</div>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
    		}
    	}
    
/*************************end regulation management **************/
    
    /***********************************************/

    function branch_management(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql=" select b.*,c.name as course_name,IFNULL(col.name,'-') as college_name from branches as b
                    left join colleges as col on col.id=b.college_id
                    left join courses as c on c.id=b.course_id";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_branch_management(".$v['id'].");' >Edit</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_branch_management(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$v['course_name'],$v['college_name'],$status,$edit,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Data','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/branch_management';
            $this->load->view('common/base_template',$data);
        }
    }


    function edit_branch_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['college_data']=$this->admin_model->get_branches($id);
            $this->load->view('admin/branch_management_form',$data);
        }
    }

    function delete_branch_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $this->admin_model->delete_branches($id);
            echo showBigSuccess('<div >Course Deleted.</div>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }


    function save_branch(){
        $post=$this->input->post();
        if($post){
            foreach($post['branch_names'] as $k=>$v){
                if(!empty($v)){
                    $post['name']=$v;
                    if($this->admin_model->check_branch_name($post)){
                        echo showBigSuccess('<div class="">Branch Name '.$v.' already exists for this Course in the College.</div>');
                        continue ;
                    }else if($this->admin_model->check_branch_count_exceded($post) && $post['status']!='0'){ // Not checking if updating to InActive
                        echo showBigError('<div class="">Only 10 Branches can be added to a Course in a College.</div>');
                        continue ;
                    }
                    $this->my_db_lib->save_record($post,'branches');
                    echo showBigSuccess('<p>Branch '.$v.' saved Successfully.</p>');
                }
            }
            echo '<br/><a href="javascript:void(0);" onclick="javascript:edit_branch_management(0);"> <br/> << Back To Adding</a><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }


    /***********************************************/

    function semester_management(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql=" select s.*,b.name as branch_name, c.name as course_name, IFNULL(col.name,'-') as college_name from semisters as s
                    left join colleges as col on col.id=s.college_id
                    left join courses as c on c.id=s.course_id
                    left join branches as b on b.id=s.branch_id ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_semester_management(".$v['id'].");' >Edit</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_semester_management(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$v['year'],$v['branch_name'],$v['course_name'],$v['college_name'],$status,$edit,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/semester_management';
            $this->load->view('common/base_template',$data);
        }
    }


    function edit_semester_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['college_data']=$this->admin_model->get_semesters($id);
            $this->load->view('admin/semester_management_form',$data);
        }
    }

    function delete_semester_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $this->admin_model->delete_semester($id);
            echo showBigSuccess('<div class="">Semester Deleted.</div>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }


    function save_semester(){
        $post=$this->input->post();
        if($post){
            foreach($post['semester_names'] as $k=>$v){
                if(!empty($v)){
                    $post['name']=$v;
                    if($this->admin_model->check_semester_name($post)){
                        echo showBigError('<div class="">Semester Name '.$v.' already exists for this Branch in the College.</div>');
                        continue ;
                    }else if($this->admin_model->check_semester_count_exceded($post) && $post['status']!='0'){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Semesters can be added to a Branch, Course in a College.</div>');
                        continue ;
                    }
                    $this->my_db_lib->save_record($post,'semisters');
                    echo showBigSuccess('<p>Semester '.$v.' saved Successfully.</p>');
                }
            }
            echo '<br/><a href="javascript:void(0);" onclick="javascript:edit_semester_management(0);"> <br/> << Back To Adding</a><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }


    /***********************************************/

    function subject_management(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql=" select sub.*,s.name as semister_name, s.year, b.name as branch_name, c.name as course_name, IFNULL(col.name,'-') as college_name from subjects as sub
                    left join semisters as s on s.id=sub.semister_id
                    left join colleges as col on col.id=sub.college_id
                    left join courses as c on c.id=sub.course_id
                    left join branches as b on b.id=sub.branch_id ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_subject_management(".$v['id'].");' >Edit</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_subject_management(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$v['semister_name'],$v['year'],$v['branch_name'],$v['course_name'],$v['college_name'],$status,$edit,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/subject_management';
            $this->load->view('common/base_template',$data);
        }
    }


    function edit_subject_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['college_data']=$this->admin_model->get_subject($id);
           /* echo '<pre>';
            print_r($data);*/
            $this->load->view('admin/subject_management_form',$data);
        }
    }
	
	function add_subject_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['college_data']=$this->admin_model->get_subject($id);
           /* echo '<pre>';
            print_r($data);*/
            $this->load->view('admin/add_subject_management_form',$data);
        }
    }

    function delete_subject_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $this->admin_model->delete_subject($id);
            echo showBigSuccess('<div class="">Subject Deleted.</div>');  // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }


    function save_subject(){
        $post=$this->input->post();
        if($post){
            foreach($post['subject_names'] as $k=>$v){
                if(!empty($v)){
                    $post['name']=$v;
                    if($this->admin_model->check_subject_name($post)){
                        echo showBigError('<div class="">Subject Name '.$v.' already exists for this Semester, Branch, Course in the College.</div>');
                        continue ;
                    }else if($this->admin_model->check_subject_count_exceded($post) && $post['status']!='0'){ // Not checking if updating to InActive
                        echo showBigError('<div class="">Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                        continue ;
                    }
                    $this->my_db_lib->save_record($post,'subjects');
                    echo showBigSuccess('<p>Subject '.$v.' saved Successfully.</p>');
                }
            }
            echo '<br/><a href="javascript:void(0);" onclick="javascript:add_subject_management(0);"> <br/> << Back To Adding</a>
			<a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }
	
	function add_subject(){
        $post=$this->input->post();
        if($post){
		
		$college_id=$post['college_id'];
		$course_id=$post['course_id'];
		$branch_id=$post['branch_id'];
		$semister_id=$post['semister_id'];
		$ayear=$post['semister_id'];
		if((isset($post['subject1']))&&(isset($post['credits1'])))
		 {
		 //echo $post['subject1'].'-'.$post['credits1'];
		 if($this->admin_model->check_subject_name1($post['subject1'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div class="">Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div class="">Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
                        $stype=$post['subject_type_id1'];
                        $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject1'],$post['credits1']);
                    }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		if((isset($post['subject2']))&&(isset($post['credits2'])))
		 {
		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject2'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div class="">Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div class="">Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
                        $stype=$post['subject_type_id2'];
                        $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject2'],$post['credits2']);
                    }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');

		 }
		if((isset($post['subject3']))&&(isset($post['credits3'])))
		 {		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject3'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div class="">Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div class="">Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id3'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject3'],$post['credits3']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
				   }
		if((isset($post['subject4']))&&(isset($post['credits4'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject4'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div class="">Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div class="">Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id4'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject4'],$post['credits4']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		if((isset($post['subject5']))&&(isset($post['credits5'])))
		 {
		 		 
		 if($this->admin_model->check_subject_name1($post['subject5'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div class="">Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div class="">Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id5'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject5'],$post['credits5']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		if((isset($post['subject6']))&&(isset($post['credits6'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject6'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id6'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject6'],$post['credits6']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		if((isset($post['subject7']))&&(isset($post['credits7'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject7'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id7'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject7'],$post['credits7']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		if((isset($post['subject8']))&&(isset($post['credits8'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject8'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id8'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject8'],$post['credits8']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		if((isset($post['subject9']))&&(isset($post['credits9'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject9'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id9'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject9'],$post['credits9']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		if((isset($post['subject10']))&&(isset($post['credits10'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject10'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id10'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject10'],$post['credits10']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject11']))&&(isset($post['credits11'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject11'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id11'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject11'],$post['credits11']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject12']))&&(isset($post['credits12'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject12'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id12'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject12'],$post['credits12']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject13']))&&(isset($post['credits13'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject13'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id13'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject13'],$post['credits13']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject14']))&&(isset($post['credits14'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject14'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id14'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject14'],$post['credits14']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject15']))&&(isset($post['credits15'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject15'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id15'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject15'],$post['credits15']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject16']))&&(isset($post['credits16'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject16'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id16'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject16'],$post['credits16']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject17']))&&(isset($post['credits17'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject17'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id17'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject17'],$post['credits17']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject18']))&&(isset($post['credits18'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject18'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id18'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject18'],$post['credits18']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject19']))&&(isset($post['credits19'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject19'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id19'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject19'],$post['credits19']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }
		 if((isset($post['subject20']))&&(isset($post['credits20'])))
		 {
		 		 //echo $post['subject2'].'-'.$post['credits2'];
		 if($this->admin_model->check_subject_name1($post['subject20'],$college_id,$course_id,$branch_id,$semister_id)){
                        echo showBigError('<div >Subject Name already exists for this Semester, Branch, Course in the College.</div>');
                       
                    }else if($this->admin_model->check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id)){ // Not checking if updating to InActive
                        echo showBigError('<div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>');
                     //   continue ;
                    }
                   else{
				   $stype=$post['subject_type_id20'];
				   $this->admin_model->add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$post['subject20'],$post['credits20']);
				   }
                   echo showBigSuccess('<p>Operation Performed Successfully.</p>');
		 }

		 
		 /*foreach($post['subject_names'] as $k=>$v){
                if(!empty($v)){
                    $post['name']=$v;
                    if($this->admin_model->check_subject_name($post)){
                        echo '<br/><div >Subject Name '.$v.' already exists for this Semester, Branch, Course in the College.</div>';
                        continue ;
                    }else if($this->admin_model->check_subject_count_exceded($post) && $post['status']!='0'){ // Not checking if updating to InActive
                        echo '<br/><div >Only 10 Subjects can be added to a Semesters, Branch, Course in a College.</div>';
                        continue ;
                    }
                    $this->my_db_lib->save_record($post,'subjects');
                    echo '<br/><p>Subject '.$v.' saved Successfully.</p>';
                }
            }
			*/
            echo '<br/><a href="javascript:void(0);" onclick="javascript:add_subject_management(0);"> <br/> << Back To Adding</a><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        
		//print_r($post);
		}
    }


    /***********************************************/

    function period_management(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql=" select pc.*,col.name as college_name from period_cycles as pc
                    left join colleges as col on col.id=pc.college_id ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_period_management(".$v['id'].");' >View/Edit</a>";
                    $edit_periods="<a href='javascript:void(0);' onclick='javascript:edit_periods(".$v['id'].");' >View/Edit Cycle</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_period_management(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$v['college_name'],$v['no_of_periods'],$v['time_period'],$v['starting_time'],$status,$edit,$edit_periods,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/period_management';
            $this->load->view('common/base_template',$data);
        }
    }


    function edit_period_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['college_data']=$this->admin_model->get_period_cycle($id);
            $this->load->view('admin/period_cycle_management_form',$data);
        }
    }

    function delete_period_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $this->admin_model->delete_period_cycles($id);
            echo showBigSuccess('<div >Period Cycles Deleted.</div>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }


    function generate_period_cycle(){
        $post=$this->input->post();
        if($post){
            if($this->admin_model->check_period_cycles_name($post)){
                echo showBigError('<div >Cycle Name '.$post['name'].' already exists for this College.</div>');
                return ;
            }
            $newId=$this->my_db_lib->save_record($post,'period_cycles');
            if(empty($post['id']) && $newId){
                $interval=strtotime($post['time_period']);
                $neutral=strtotime('00:00:00');
                $additive=$interval-$neutral;
                $start=strtotime($post['starting_time']);
                $period_time=$start;
                for($i=1;$i<=$post['no_of_periods'];$i++){
                    $periods_post['time_label']=date('h:i:s a',($period_time)).' to '.(string)date('h:i:s a',($period_time+$additive));
                    $periods_post['from']=date('H:i:s',($period_time));
                    $periods_post['to']=date('H:i:s',($period_time+$additive));
                    $periods_post['cycles_id']=$newId;
                    $periods_post['period_label']='C'.$newId.' - P'.$i;
                    $this->my_db_lib->save_record($periods_post,'periods');
                    $period_time+=$additive;
                }
                redirect('admin/edit_periods/'.$newId);
            }else{
            echo showBigSuccess('<p>Period Cycle '.$post['name'].' Saved Successfully.</p>');
            echo '<br/><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
            }
            

        }
    }

    function edit_periods($cycles_id=0){
        if($cycles_id){
            $post=$this->input->post(); 
            if($post){
                // echo '<pre>'; print_r($post); echo '</pre>';
                foreach ($post['periods'] as $key => $value) {
                    $periods_post=$value;
                    $periods_post['id']=$key;
                    $this->my_db_lib->save_record($periods_post,'periods');
                }
                echo showBigSuccess('<p>Periods for the Period Cycle Saved Successfully.</p>');
                echo '<br/><a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
            }else{
                $cycle_data=$this->admin_model->get_period_cycle($cycles_id);
                // print_r($cycle_data);
                $data['cycles_id']=$cycles_id;
                $data['cycles_name']=(isset($cycle_data[0]['name'])?$cycle_data[0]['name']:'');
                $data['data']=$this->admin_model->get_period_cycle_periods($cycles_id);
                $this->load->view('admin/period_cycle_periods_form',$data);
            }

        }else{
            redirect('admin/period_management');
        }
    }


    /********************* Select boxes ***********************/

    function  getCollegeCourses($college_id=0){
        $options='<option value="">Select</option>';
        $options.=load_select('courses',0,array('status'=>'1','college_id'=>$college_id));
        echo $options;
    }
    //Start numbers
    function  getCollegeNumbers($college_id=0,$course_id=0,$branch_id=0, $semister_id=0){
        $options='<option value="">Select</option>';    $options.=load_select_numbers('student_records',0,array('users.users_type_id'=>'1','users.status'=>'1','student_records.college_id'=>$college_id,'student_records.course_id'=>$course_id,'student_records.branch_id'=>$branch_id,'student_semisters.semister_id'=>$semister_id));
        //$options.=load_select_numbers('student_records',0,array('semister_id'=>$semister_id,'branch_id'=>$branch_id,'course_id'=>$this->input->post('course_id')));
        echo $options; 
    }
    function  getCollegeBranches($college_id=0){
        $options='<option value="">Select</option>';     $options.=load_select('branches',0,array('status'=>'1','college_id'=>$college_id,'course_id'=>$this->input->post('course_id')));
        echo $options;
    }
    function  getCollegeSemesters($college_id=0){
        $options='<option value="">Select</option>';
        $options.=load_select('semisters',0,array('status'=>'1','college_id'=>$college_id,'branch_id'=>$this->input->post('branch_id')));
        echo $options;
    }
    function  getCourseSemesters($college_id=0){
        // $options='<option value="">Select</option>';
        $course_id=$this->input->post('course_id');
        $sql="
            SELECT s.*,b.name AS branch_name FROM semisters AS s
                LEFT JOIN branches AS b ON b.id=s.branch_id
                WHERE s.course_id=$course_id
        ";
        $res=$this->db->query($sql);
        $data=$res->result();
        $options='';
        foreach($data as $k=>$v){
            $options.="<option value='$v->id'";
            // if($selected_val==$v->id){ $html.=" selected='selected' "; }
            $options.=">$v->branch_name - $v->name</option>";
        }
        echo $options;
    }
    function  getCollegeSubjects($college_id=0){
        $options='<option value="">Select</option>';
        $options.=load_select('subjects',0,array('status'=>'1','college_id'=>$college_id,'semister_id'=>$this->input->post('semister_id')));
        echo $options;
    }
    function  getCollegeSections($college_id=0){
        $options='<option value="">Select</option>';
        $options.=load_select_section('sections',0,array('semister_id'=>$this->input->post('semister_id')));
        echo $options;
    }
    
    function  getCollegeAcademic($college_id=0){
        $options='<option value="">Select</option>';
        $options.=load_select_academicyears('colleges',0,array('id'=>$college_id));
        echo $options;
    }

    function attendance_management(){
        $data['teachersOptions']=$this->admin_model->getActiveStaff();
        $data['content_page']='admin/attendance_management';
        $this->load->view('common/base_template',$data);
    }

    function attendance_management_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql=" select sr.user_id as id,scp.cycle_id,sr.name as staff_name, pc.name as cycle_name, ay.name as academic_year, scp.academic_year_id from
                    staff_cycles_periods as scp
                    LEFT JOIN academic_years as ay ON ay.id=scp.academic_year_id
                    inner join staff_records as sr on sr.user_id=scp.user_id
                    inner join period_cycles as pc on pc.id=scp.cycle_id
                    where scp.status='1'
                    group by sr.user_id,scp.cycle_id ";

//            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit_form='
                        <form action="'.site_url('admin/staff_attendance').'" id="appl_form2'.$v['id'].'" method="post" style="white-space: normal; " >
                        <input name="staff_id"  type="hidden" value="'.$v['id'].'"/>
                        <input name="cycle_id"  type="hidden" value="'.$v['cycle_id'].'"/>
                        <input name="academic_year_id"  type="hidden" value="'.$v['academic_year_id'].'"/>
                        <input type="submit" name="submit"  class="send button j_gen_form_submit" value="View/Edit"/>
                        </form>
                    ';
                    // $edit_periods="<a href='javascript:void(0);' onclick='javascript:edit_attendance_management(".$v['id'].");' >View/Edit Cycle</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_attendance_management(".$v['id'].",".$v['cycle_id'].");' >Delete</a>";
                    // $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['staff_name'],$v['cycle_name'],$v['academic_year'],$edit_form,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }
    }

    function delete_attendance_management(){
        if($this->input->post()){
            $post=$this->input->post();
            echo $this->admin_model->delete_attendance_management($post['id'],$post['cycle_id']);
        }
    }

    function staff_attendance(){
        if($this->input->post()){
            $post=$this->input->post();
            if(empty($post['staff_id']) || empty($post['cycle_id']) || empty($post['academic_year_id'])){
                $this->session->set_flashdata('error_msg', 'Please select the Teacher, Cycle and Academic year. ');
                redirect('admin/attendance_management');
            }
            $data=$post;
            $data['weekdays']=$this->admin_model->getWeekdays();
            $data['cycle_periods']=$this->admin_model->getCyclePeriods($post['cycle_id']);
            $data['staff_periods']=$this->admin_model->getStaffPeriods($post['staff_id'],$post['cycle_id'],$post['academic_year_id']);
            
            $data['content_page']='admin/staff_attendance';
            $this->load->view('common/base_template',$data);
        }else{
            redirect('admin/attendance_management');
        }
    }

    function edit_staff_attendance(){
        if($this->input->post()){
            $post=$this->input->post();
            if(empty($post['staff_id']) && empty($post['cycle_id']) && empty($post['weekday_id']) && empty($post['period_id']) && empty($post['academic_year_id'])){
                $this->session->set_flashdata('error_msg', 'Please select the Teacher, Cycle and Academic year. ');
                redirect('admin/attendance_management');
            }
            $data=$post;
            $data['weekdays']=$this->admin_model->getWeekdays();
            $data['period_details']=$this->admin_model->getCyclePeriodDetails($post['cycle_id'],$post['period_id']);
            $data['subjects']=$this->admin_model->getStaffsWeekdaysPeriodsSubject($post['staff_id'],$post['cycle_id'],$post['weekday_id'],$post['period_id'],$post['academic_year_id']);
            if(isset($data['subjects'][0]['subject_id']))
            $data['subject_details']=$this->admin_model->get_subject($data['subjects'][0]['subject_id']);
            $this->load->view('admin/edit_staff_attendance_form',$data);
        }
    }

    function save_edit_staff_attendance(){
        if($this->input->post()){
            $post=$this->input->post();
            if($this->admin_model->checkAttendanceCollision($post)){
                echo showBigError('<div >Subject already allotted for the same period.</div>');
                    // <br/><input type="button" name="imageField" id="imageField" class="send button" value="Back" onclick="javascript:window.location.reload();"/>';
                return true;
            }
            $cycleTimeCollisions=$this->admin_model->checkCycleTimingCollision($post);
            if(!empty($cycleTimeCollisions)){
                echo showBigError('<div >Period Timings might Collide with the other allotted period in the Cycle -- '.$cycleTimeCollisions[0]['cycle_name'].' - '.$cycleTimeCollisions[0]['period_label'].' - '.$cycleTimeCollisions[0]['time_label'].'.</div>');
                    // <br/><input type="button" name="imageField" id="imageField" class="send button" value="Back" onclick="javascript:window.location.reload();"/>';
                return true;
            }
            /*echo '<pre>';
            print_r($post); exit;*/
            $this->my_db_lib->save_record($post,'staff_cycles_periods');
            echo showBigSuccess('<p>Subject saved to period Successfully.</p>'); 
                   //  <br/><input type="button" name="imageField" id="imageField" class="send button" value="Back" onclick="javascript:window.location.reload();"/>';
        }
    }
  
    //function section_management(){
    
    
/*
       $post=$this->input->post();
         if( $this->input->post()){
            $post=$this->input->post();
            $sql=" select sub.*,s.name as semister_name, s.year, b.name as branch_name, c.name as course_name, IFNULL(col.name,'-') as college_name from subjects as sub
                    left join semisters as s on s.id=sub.semister_id
                    left join colleges as col on col.id=sub.college_id
                    left join courses as c on c.id=sub.course_id
                    left join branches as b on b.id=sub.branch_id ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_section_management(".$v['id'].");' >Edit</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_subject_management(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$v['semister_name'],$v['year'],$v['branch_name'],$v['course_name'],$v['college_name'],$status,$edit,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
*/
           //$data['content_page']='admin/section_management';
            //$this->load->view('common/base_template',$data);
//       }
    //}
/*
       function edit_section_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['college_data']=$this->admin_model->get_subject($id);
            $this->load->view('admin/section_management_form',$data);
        }
    }
*/

/***********************************************/

    function section_management(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql="select sec.*,s.name as semister_name, s.year, b.name as branch_name, c.name as course_name, IFNULL(col.name,'-') as college_name from sections as sec
                    left join semisters as s on s.id=sec.semister_id
                    left join colleges as col on col.id=sec.college_id
                    left join courses as c on c.id=sec.course_id
                    left join branches as b on b.id=sec.branch_id ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='javascript:void(0);' onclick='javascript:edit_section_management(".$v['id'].");' >Edit</a>";
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_section_management(".$v['id'].");' >Delete</a>";
                   // $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['section'],$v['semister_name'],$v['year'],$v['branch_name'],$v['course_name'],$v['college_name'],$edit,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','','','','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/section_management';
            $this->load->view('common/base_template',$data);
        }
    }
	function save_section()
	{
		$data=array('college_id'=>$this->input->post('college_id'),
					'course_id'=>$this->input->post('course_id'),
					'branch_id'=>$this->input->post('branch_id'),
					'semister_id'=>$this->input->post('semister_id'),
					'section'=>$this->input->post('section'));
					$this->admin_model->section_Save($data);
					//Admin::section_management();
					//redirect('admin/section_management','refresh');
					echo showBigSuccess('<div >Section Inserted Successfully.</div>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
					
		
	} 

    function edit_section_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $data['college_data']=$this->admin_model->get_section($id);
            $this->load->view('admin/section_management_form',$data);
        }
    }

    function delete_section_management(){
        $post=$this->input->post();
        if($post){
            $id=$post['id'];
            $this->admin_model->delete_section($id);
            echo showBigSuccess('<div >Section Deleted.</div>'); // <a href="javascript:void(0);" onclick="javascript:window.location.reload();"> <br/> << Back To List</a>';
        }
    }


    


    function academic_year(){
        $post=$this->input->post();
        if( $this->input->post()){
            $post=$this->input->post();
            $sql=" select * from academic_years ";

            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit="<a href='".site_url('admin/edit_academic_year/'.$v['id'])."'>View/Edit</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$status,$edit);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/academic_year';
            $this->load->view('common/base_template',$data);
        }
    }

    function edit_academic_year($id=0){
        $post=$this->input->post();
        if($post){
            /*
             * Save Submitted Data
             */
            if($this->admin_model->checkAcademicYear($post)){
                $this->session->set_flashdata('error_msg', 'Academic Year Already Exists.');
                redirect('admin/edit_academic_year/'.(($id)?$id:''));
            }
            $this->general_model->saveRecord($post,'academic_years');
            $this->session->set_flashdata('success_msg', 'Academic Year Saved Successfully.');
            redirect('admin/academic_year');
        }
        if($id){
            /*
             * Show the Data of $id
             */
            $data['form_data']=$this->admin_model->getAcademicYearDetails($id);
        }
        $data['content_page']='admin/edit_academic_year';
        $this->load->view('common/base_template',$data);
    }

    function admission_year(){
    	$post=$this->input->post();
    	if( $this->input->post()){
    		$post=$this->input->post();
    		$sql=" select * from admission_years ";
    
    		$user_details=$this->session->userdata('user_details');
    
    		$data=$this->my_db_lib->get_jqgrid_data($post,$sql);
    
    		if(count($data->db_data)){
    			$i=0; $sno=1;
    			foreach($data->db_data as $k=>$v){
    				$data->rows[$i]['id']=$v['id'];
    				$edit="<a href='".site_url('admin/edit_academic_year/'.$v['id'])."'>View/Edit</a>";
    				$status=($v['status']=='1')?'Active':'InActive';
    				$data->rows[$i]['cell']=array($sno++,$v['name'],$status,$edit);
    				$i++;
    			}
    		}else{
    			$data->rows[0]['id']=0;
    			$data->rows[0]['cell']=array('','No Data','','');
    		}
    
    		unset($data->db_data);
    		echo json_encode($data);
    	}else{
    		$data['content_page']='admin/admission_year_management';
    		$this->load->view('common/base_template',$data);
    	}
    }
    
    function edit_admission_year($id=0){
    	$post=$this->input->post();
    	if($post){
    		/*
    		 * Save Submitted Data
    		*/
    		if($this->admin_model->checkAdmissionYear($post)){
    			$this->session->set_flashdata('error_msg', 'Admission Year Already Exists.');
    			redirect('admin/edit_academic_year/'.(($id)?$id:''));
    		}
    		$this->general_model->saveRecord($post,'admission_years');
    		$this->session->set_flashdata('success_msg', 'Academic Year Saved Successfully.');
    		redirect('admin/admission_year');
    	}
    	if($id){
    		/*
    		 * Show the Data of $id
    		*/
    		$data['form_data']=$this->admin_model->getAcademicYearDetails($id);
    	}
    	$data['content_page']='admin/edit_academic_year';
    	$this->load->view('common/base_template',$data);
    }
    
    
    function college_logo(){
        $settings=$this->admin_model->getSystemSettings('college_logo');
        $data['college_logo']=$settings[0]['value'];
        $data['content_page']='admin/college_logo';
    	$this->load->view('common/base_template',$data);
    }
    
    function edit_college_logo(){
        $post=$this->input->post();
        if(empty($post)){
            $settings=$this->admin_model->getSystemSettings('college_logo');
            $data['form_data']=$settings;
            $data['content_page']='admin/edit_college_logo';
            $this->load->view('common/base_template',$data);
        }else{
            // Save the Form
            
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '1000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['overwrite'] = 'false';
            $config['remove_spaces'] = 'true';
            $config['upload_path'] = "./files/";
            
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('upload_image')) {
                $updata = $this->upload->data();
                $x = $updata['file_name'];
                $post['value'] = "/files/" . $x;
                $this->general_model->saveRecord($post,'settings');
                // Update the Settings Var
                $system_settings=$this->admin_model->getSystemSettings();
                $this->session->set_userdata('system_settings', $system_settings);
        
                $this->session->set_flashdata('success_msg', 'College Logo Updated Successfully.');
                redirect('admin/college_logo');
            }
            else{
                $errorMsg= $this->upload->display_errors();
                $errorMsg.=' Please try again.';
                $this->session->set_flashdata('error_msg', strip_tags($errorMsg));
                redirect('admin/edit_college_logo');
            }
            
        }
        
    }
    
    function batch_no(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql=" SELECT bno.* FROM batch_nos AS bno ";

//            $user_details=$this->session->userdata('user_details');

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit_link='<a href="'.site_url('admin/edit_batch_no/'.$v['id']).'" >Edit </a>';
                    // $delete="<a href='javascript:void(0);' onclick='javascript:delete_batch_no_management(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$status,$edit_link);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }else{
            $data['content_page']='admin/batch_no';
            $this->load->view('common/base_template',$data);
        }
    }
    
    function edit_batch_no($id=0){
        $post=$this->input->post();
        if($post){
            /*
             * Save Submitted Data
             */
            if($this->admin_model->check_batch_no($post)){
                $this->session->set_flashdata('error_msg', 'Batch No Already Exists.');
                redirect('admin/edit_batch_no/'.(($id)?$id:''));
            }
            $this->general_model->saveRecord($post,'batch_nos');
            $this->session->set_flashdata('success_msg', 'Batch No Saved Successfully.');
            redirect('admin/batch_no');
        }
        if($id){
            /*
             * Show the Data of $id
             */
            $data['form_data']=$this->admin_model->get_batch_no_details($id);
        }
        $data['content_page']='admin/edit_batch_no';
        $this->load->view('common/base_template',$data);
    }
    
    function student_attendance(){
        $post=$this->input->post();
        if(!empty($post)){
            $data['attendance_details'] = $this->staff_model->get_student_attendance($post['user_id'],$post['month']);
            // $this->load->view('students/my_record1', $data);
            $this->load->view('admin/student_attendance',$data);
        }
    }
    
    /* 
     * START ::
     * ADMIN Calendar Items
     * 
     */
    
    function items(){
        $data['content_page']='admin/items';
        $this->load->view('common/base_template',$data);
    }
    
    function items_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql=" select i.* FROM items AS i
                    where i.status='1'
                    
                ";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit_link=' <a href="'.site_url('admin/edit_items/'.$v['id']).'" >Edit </a> ';
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_items_management(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';

                    $data->rows[$i]['cell']=array($sno++,$v['name'],$status,$edit_link);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }
    }
    
    function edit_items($id=0){
        $post=$this->input->post();
        if($post){
            /*
             * Save Submitted Data
             */
            if(!empty($post['name']) && is_array($post['name'])){
                $error_msg=$success_msg='';
                foreach($post['name'] as $k=>$v){
                    $savePost=array();
                    $savePost['id']=$post['id'][$k];
                    $savePost['name']=$post['name'][$k];
                    $savePost['status']=$post['status'][$k];
                    if($this->admin_model->checkItems($savePost)){
                        $error_msg.='Item `'.$savePost['name'].'` Already Exists.<br/>';
                    }else{
                        $success_msg='Items Saved Successfully.';
                        $this->general_model->saveRecord($savePost,'items');
                    }
                }
                if(!empty($error_msg)){
                    $this->session->set_flashdata('error_msg', $error_msg);
                }
                if(!empty($success_msg)){
                    $this->session->set_flashdata('success_msg', $success_msg);
                }
                redirect('admin/items');
            }else if($this->admin_model->checkItems($post)){
                $this->session->set_flashdata('error_msg', 'Item Already Exists.');
                redirect('admin/edit_items/'.(($id)?$id:''));
            }
            $this->general_model->saveRecord($post,'items');
            $this->session->set_flashdata('success_msg', 'Item Saved Successfully.');
            redirect('admin/items');
        }
        if($id){
            /*
             * Show the Data of $id
             */
            $data['form_data']=$this->admin_model->getItemDetails($id);
        }
        if(empty($id)){
            $data['content_page']='admin/add_items';
        }else{
            $data['content_page']='admin/edit_items';
        }
        $this->load->view('common/base_template',$data);
    }

    /* 
     * END ::
     * ADMIN Calendar Items
     * 
     */
    
    /* 
     * START ::
     * ADMIN Calendar Add Edit Grid
     * 
     */
    
    
    function academic_calendar(){
        $data['content_page']='admin/academic_calendar';
        $this->load->view('common/base_template',$data);
    }

    
    function academic_calendar_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql=" SELECT ac.* FROM academic_calendar AS ac 
                ";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0; $sno=1;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $edit_link=' <a href="'.site_url('admin/edit_academic_calendar/'.$v['id']).'" >Edit </a> ';
                    $view_link=' <a href="'.site_url('admin/view_academic_calendar/'.$v['id']).'" >View </a> ';
                    $delete="<a href='javascript:void(0);' onclick='javascript:delete_academic_calendar(".$v['id'].");' >Delete</a>";
                    $status=($v['status']=='1')?'Active':'InActive';
                    $data->rows[$i]['cell']=array($sno++,$v['name'],$status,$edit_link,$view_link,$delete);
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('','No Data','','','');
            }

            unset($data->db_data);
            echo json_encode($data);
        }
    }
    
    function delete_academic_calendar(){
        if($this->input->post()){
            $post=$this->input->post();
            echo $this->admin_model->delete_academic_calendar($post['id']);
        }
    }
    
    
    function edit_academic_calendar($id=0){
        $post=$this->input->post();
        if($post){
            /*
             * Save Submitted Data
             */
            if($this->admin_model->check_academic_calendar($post)){
                $this->session->set_flashdata('error_msg', 'Academic Calendar Already Exists.');
                redirect('admin/edit_academic_calendar/'.(($id)?$id:''));
                return true;
            }
            $db_id=$this->general_model->saveRecord($post,'academic_calendar');
            $calendar_id=(empty($post['id']))?$db_id:$post['id'];
            if(!empty($post['sem_id'])){
                $this->admin_model->clear_calendar_semesters($calendar_id);
                foreach($post['sem_id'] as $k=>$v){
                    $savePost=array();
                    $savePost['calendar_id']=$calendar_id;
                    $savePost['sem_id']=$v;
                    $this->general_model->saveRecord($savePost,'academic_calendar_semesters');
                }
            }
            $this->session->set_flashdata('success_msg', 'Academic Calendar Saved Successfully.');
            redirect('admin/edit_academic_calendar_items/'.$calendar_id);
            return true;
        }else if($id){
            /*
             * Show the Data of $id
             */
            $data=$this->admin_model->get_academic_calendar_details($id);
            $data['form_data']=$data['calendar_data'];
        }
        $data['content_page']='admin/edit_academic_calendar';
        $this->load->view('common/base_template',$data);
    }
    
    function edit_academic_calendar_items($id=0){
        $post=$this->input->post();
        if($post && !empty($id)){
            /*
             * Save Submitted Data
             */
            if(!empty($post['post_data']) && is_array($post['post_data'])){
                
                $error_msg=$success_msg='';
                foreach($post['post_data'] as $k=>$v){
                    $savePost=$v;
                    $savePost['calender_id']=$id;
                    if($this->admin_model->check_academic_calendar_items($savePost)){
                        $error_msg.='Item `'.generalId('name','items','id',$v['item_id']).'` Already Added to Calendar.<br/>';
                    }else{
                        $success_msg='Items Saved to Calendar Successfully';
                        $this->general_model->saveRecord($savePost,'academic_calendar_items');
                    }
                }
                if(!empty($error_msg)){
                    $this->session->set_flashdata('error_msg', $error_msg);
                }
                if(!empty($success_msg)){
                    $this->session->set_flashdata('success_msg', $success_msg);
                }
                redirect('admin/academic_calendar');
                return true;
            } 
        }else if(!empty($id)){
            /*
             * Show the Data of $id
             */
            $data['form_data']=$this->admin_model->get_academic_calendar_items_details($id);
        }
        
        $data['content_page']='admin/edit_academic_calendar_items';
        $this->load->view('common/base_template',$data);
    }
    
    
    function delete_academic_calendar_items(){
        if($this->input->post()){
            $post=$this->input->post();
            echo $this->admin_model->delete_academic_calendar_items($post['id']);
        }
    }
    
    function view_academic_calendar($id=0){
        if($id){
            /*
             * Show the Data of $id
             */
            $data=$this->admin_model->get_academic_calendar_details($id);
            $data['form_data']=$data['calendar_data'];
            $data['items_data']=$this->admin_model->get_academic_calendar_items_details($id);
        }
        $data['content_page']='admin/view_academic_calendar';
        $this->load->view('common/base_template',$data);
    }
    
    /* 
     * END ::
     * ADMIN Calendar Add Edit Grid
     * 
     */
    
    

}



    
 ?>