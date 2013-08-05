<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Misc extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model(array('students_model','staff_model','admin_model','misc_model'));
    }
    
    public function index()
    {
        $data["notice_board"]=$this->students_model->get_notice_board();
        $data['content_page']='students/home';
        $this->load->view('common/base_template',$data);
    }

    function placement_cell(){
        $data['content_page']='misc/placement_cell';
        $this->load->view('common/base_template',$data);
    }

    function placement_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select sr.id,sr.name,sr.students_number,ifnull(pca.alert_type,'') as alert_type,ifnull(pcr.resume_link,'') as resume_link
                    from student_records as sr
                    left join placement_cell_resumes as pcr on pcr.user_id=sr.user_id
                    left join placement_cell_job_alerts as pca on pca.user_id=sr.user_id";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $alert_type=($v['alert_type']=='1')?'Mobile':(($v['alert_type'])?'Email':'<i>Not yet registerred</i>');
                    $link=($v['resume_link']!='')?"<a href='".base_url()."uploads/".$v['resume_link']."' target='_blank' title='Click to download the document.'>Link</a>":'<i>Not yet uploaded</i>';
                    $data->rows[$i]['cell']=array($v['name'],$v['students_number'],$alert_type,$link);
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

    function study_abroad(){
        $data['content_page']='misc/study_abroad';
        $this->load->view('common/base_template',$data);
    }

    function study_abroad_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select sa.*,ae.name as exam_name from study_abroad as sa
                    left join abroad_exams as ae on ae.id=sa.exam";

            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);

            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $data->rows[$i]['cell']=array($v['name'],$v['email'],$v['mobile'],$v['country_interested'],$v['exam_name'],$v['message']);
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
    

}

?>
