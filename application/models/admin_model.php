<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function sample(){
        $sql="";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_user_types(){
        $sql="select * from users_type";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_user_types_users($user_type_id){
        $sql="select * from users where users_type_id='$user_type_id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_user_details($id){
        $sql="select * from users where id='$id'";
        $res = $this->db->query($sql);
        $user_info=$res->result_array();
        if($user_info[0]['users_type_id']==1){
            // Get & append Srudent Details
            $sql="select sr.*,ss.semister_id as sem_id,ifnull(sf.fee1,'-') as fee1,ifnull(sf.fee2,'-') as fee2,ifnull(sf.fee3,'-') as fee3,ifnull(sf.fee4,'-') as fee4
                    from student_records as sr
                    left join student_fees as sf on sf.user_id=sr.user_id
                    left join student_semisters as ss on ss.user_id=sr.user_id and ss.is_current='1'
                    where sr.user_id='".$id."' and status='1'";
            $res = $this->db->query($sql);
            $user_info['student_details']=$res->result();
        }
        if($user_info[0]['users_type_id']==2 || $user_info[0]['users_type_id']==3){
            // Get & Staff/Hod Details
            $sql="select sr.*,b.college_id,b.course_id from staff_records as sr
                    left join branches as b on b.id=sr.branch_id
                    where user_id='$id'
                    ";
            $res = $this->db->query($sql);
            $user_info['staff_details']=$res->result();
        }
        return $user_info;
    }
   function get_polled_user_details($id)
   {
     $sql="select * from users where id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
   }

    function deactive_notice($id){
        $sql="update students_notice_board set status='0' where id=$id";
        $this->db->query($sql);
    }

    function get_notice_details($id){
        $sql="select * from students_notice_board where id=$id";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_subject_details($id){
        $sql="select bss.*,b.name as branch_name, se.name as semister_name, s.name as subject_name
                    from branch_semister_subject as bss
                    left join branches as b  on b.id=bss.branch_id
                    left join semisters se on se.id=bss.semister_id
                    left join subjects s on s.id=bss.subject_id
                    where bss.id='$id'
                ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_subject_grid($post){
        $sql="select bss.*,b.name as branch_name, se.name as semister_name, s.name as subject_name
                    from branch_semister_subject as bss
                    left join branches as b  on b.id=bss.branch_id
                    left join semisters se on se.id=bss.semister_id
                    left join subjects s on s.id=bss.subject_id
                    where bss.branch_id='".$post['branch_id']."' and bss.semister_id='".$post['semister_id']."' and bss.subject_id='".$post['subject_id']."'
                ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function delete_subject_grid($id){
        $sql="delete from branch_semister_subject where id='$id'";
        $this->db->query($sql);
    }
    
function add_student_marks($st_id,$type_id,$year,$marks=array(),$sm_id){
//echo "<pre>";
            //print_r($_POST);//exit;
			
			if($type_id==1){
						$in="`marks`";
					}else if($type_id==2){
						$in="`internal_1`";
					}else if($type_id==3){
						$in="`internal_2`";
					}else{
						$in="`internal_3`";
					}
			$check_sql=$this->db->query("select sm.id,bss.id as bid from student_marks sm 
												inner join branch_semister_subject bss on sm.branch_sem_sub_id=bss.id
												where sm.student_id='".$st_id."' and bss.semister_id='".$sm_id."' limit 1");
			if($check_sql->num_rows()==0){
			$i_sql='';
			foreach($marks as $k=>$val){
				if($val!=''){
					$i_sql.="('".$k."','".$st_id."','".$type_id."','".$val."','100','".$year."'),";
				}
			
			}
				if($i_sql!=''){
					
				$this->db->query("insert into student_marks (`branch_sem_sub_id`, `student_id`, `marks_type_id`, ".$in.",`max_marks`,`marks_year`) values ".trim($i_sql,','));
				}
			}else{
			$row=$check_sql->row();
				foreach($marks as $k=>$val){
				
						$this->db->query("update student_marks set ".$in."='".$val."' where 
											 student_id='".$st_id."' and branch_sem_sub_id='".$k."'");
							$v=$this->db->query("select * from student_marks sm 
										where  sm.student_id='".$st_id."' and sm.branch_sem_sub_id='".$k."' limit 1")->row();
								$x=array($v->internal_1,$v->internal_2,$v->internal_3);
								$y=array_search(min($x),$x);
								unset($x[$y]);
								$max=array_sum($x);
								$avg=$max/count($x);
								$s=$v->marks+$max;	
								$this->db->query("update student_marks set tot_marks='".$s."',avg_marks='".$avg."' where 
											 student_id='".$st_id."' and branch_sem_sub_id='".$k."'");
					
					}
			
			}
			return true;
}
function add_student_attend($st_id,$sem_id,$attd,$attd_tot){

		
			$i_sql=$this->db->query("select id from student_attendence where user_id='".$st_id."' and semister_id='".$sem_id."' ");
			
			if($i_sql->num_rows()==0){
			$this->db->query("insert into student_attendence (`user_id`, `semister_id`, `attend_days`,`tot_days`) 
			values ('".$st_id."','".$sem_id."','".$attd."','".$attd_tot."')");
			}
return true;
}

    function save_student_semester($st_id,$sem_id){
        if($st_id && $sem_id){
            //echo "<pre>";
            //print_r($_POST);//exit;
//            $st_id=$_POST['st_id'];
//            $sem_id=$_POST['sem_id'];
            $check=$this->db->query("select id from  student_semisters where user_id='".$st_id."' and semister_id='".$sem_id."'");
            if($check->num_rows()==0){
                $this->db->query("update student_semisters set is_current='0' where user_id='".$st_id."'");
                $this->db->query("insert into student_semisters (`user_id`, `semister_id`,`is_current`) values ('".$st_id."','".$sem_id."','1')");
            }
            return true;
//            redirect('admin/user_accounts');
        }
    }


    function get_system_subjects($id=0){
        $sql="select * from subjects where status='1' and id='$id'
                ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_system_subjects($name){
        $sql="select * from subjects where status='1' and name='$name'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function delete_system_subjects($id){
        $sql="update subjects set status='0' where id=$id";
        $this->db->query($sql);
    }

    function get_student_attendance($post){
        $sql="select * from student_attendence where user_id='".$post['user_id']."' and semister_id='".$post['semister_id']."'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
	function add_poll_options($options,$op_id){
		$sql='';
        foreach($options as $opt){
			if($opt!=''){
				$sql.="('".$op_id."','".$opt."'),";
			}
		}
		if($sql!=''){
			$this->db->query("insert into poll_options (`poll_id`, `label`) values ".trim($sql,','));
		}
    }

    function get_pool_data($id=0){
        $sql="select * from polls where id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_poll_result($id){
        $sql="select * from poll_users where poll_id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

   function get_poll_option($id)
   {
     $sql="select p.id as pollid,p.question, po.* from polls as p
     left join poll_options as po on po.poll_id=p.id where p.id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
   }
  function poll_count($pollid)
  {
   $sql="select count(*) as count from polls as p
     left join poll_options as po on po.poll_id=p.id 
     left join poll_users as pu on pu.poll_id=p.id and pu.poll_option_id=po.id 
     where pu.poll_id='$pollid' ";
        $res = $this->db->query($sql);
        return $res->result_array();
  }

  function get_poll_perc($pollid,$polloption)
  {
    $sql="select * from poll_users where poll_id='$pollid' and poll_option_id='$polloption'";
        $res = $this->db->query($sql);
        return $res->result_array();
  }

    function get_colleges($id=0){
        $sql="select * from colleges where id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_college_name($post){
        $sql="select * from colleges where name='".$post['name']."' and id!='".$post['id']."' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function delete_colleges($id=0){
        $sql="delete from colleges where id='$id'";
        $res = $this->db->query($sql);
        $sql="delete from courses where college_id='$id'";
        $res = $this->db->query($sql);
        $sql="delete from branches where college_id='$id'";
        return $res = $this->db->query($sql);
    }

    /***************/

    function get_courses($id=0){
        $sql="select * from courses where id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_course_name($post){
        $sql="select * from courses where name='".$post['name']."' and college_id='".$post['college_id']."' and id!='".$post['id']."' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function delete_courses($id=0){
        $sql="delete from courses where id='$id'";
        $res = $this->db->query($sql);
        $sql="delete from branches where course_id='$id'";
        return $res = $this->db->query($sql);
    }

    /***************/

    function get_branches($id=0){
        $sql="select * from branches where id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_branch_name($post){
        $sql="select * from branches where name='".$post['name']."' and college_id='".$post['college_id']."' and course_id='".$post['course_id']."' and id!='".$post['id']."' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_branch_count_exceded($post){
        $sql="select * from branches where college_id='".$post['college_id']."' and course_id='".$post['course_id']."' and status='1' ";
        $res = $this->db->query($sql);
        if($res->num_rows()>=10){
            return true;
        }else{
            return false;
        }
    }



    function delete_branches($id=0){
        $sql="delete from branches where id='$id'";
        return $res = $this->db->query($sql);
    }

    /**************************regulation management****/
    
    function check_regulation_name($post){
    	$sql="select * from regulations where name='".$post['name']. "'";
    	$res = $this->db->query($sql);
    	return $res->result_array();
    }
    
    function get_regulations()
    {
    	
    	$sql="select * from regulations";
    	$res = $this->db->query($sql);
    	return $res->result_array();
    }
    
    
    
    
    /*************************/   
    
    
    /***************/

    function get_semesters($id=0){
        $sql="select * from semisters where id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_semester_name($post){
        $sql="select * from semisters where name='".$post['name']."'  and college_id='".$post['college_id']."' and course_id='".$post['course_id']."' and branch_id='".$post['branch_id']."' and id!='".$post['id']."' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_semester_count_exceded($post){
        $sql="select * from semisters where college_id='".$post['college_id']."' and course_id='".$post['course_id']."' and branch_id='".$post['branch_id']."' and status='1' ";
        $res = $this->db->query($sql);
        if($res->num_rows()>=10){
            return true;
        }else{
            return false;
        }
    }

    function delete_semester($id=0){
        $sql="delete from semisters where id='$id'";
        return $res = $this->db->query($sql);
    }

    /***************/

    function get_subject($id=0){
        $sql="select * from subjects where id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_subject_name($post){
        $sql="select * from subjects where name='".$post['name']."'  and college_id='".$post['college_id']."' and course_id='".$post['course_id']."' and branch_id='".$post['branch_id']."' and semister_id='".$post['semister_id']."' and id!='".$post['id']."' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
	
	function check_subject_name1($name,$college_id,$course_id,$branch_id,$semister_id){
        $sql="select * from subjects where name='".$name."'  and college_id='".$college_id."' and 
		course_id='".$course_id."' and branch_id='".$branch_id."' and semister_id='".$semister_id."'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
	
    function check_subject_count_exceded($post){
        $sql="select * from subjects where college_id='".$post['college_id']."' and course_id='".$post['course_id']."' and branch_id='".$post['branch_id']."' and semister_id='".$post['semister_id']."' and status='1' ";
        $res = $this->db->query($sql);
        if($res->num_rows()>=20){
            return true;
        }else{
            return false;
        }
    }
	
	function check_subject_count_exceded1($college_id,$course_id,$branch_id,$semister_id){
        $sql="select * from subjects where college_id='".$college_id."' and course_id='".$course_id."' and branch_id='".$branch_id."'
		and semister_id='".$semister_id."' and status='1' ";
        $res = $this->db->query($sql);
        if($res->num_rows()>=20){
            return true;
        }else{
            return false;
        }
    }
	
	function add_subject($ayear,$college_id,$course_id,$branch_id,$semister_id,$stype,$subject,$credits)
	{
	$data = array(
   'id' => '' ,
   'college_id' => $college_id ,
   'course_id' => $course_id,
   'branch_id' => $branch_id,
   'semister_id' => $semister_id,
   'name' => $subject,
   'subject_type_id' => $stype,
   'credits' => $credits,
   'status' => '1',
   'create_date' => date('d-m-Y h:I:s'),
   'academic_year' =>$ayear,
   'academic_year_id' => 0
	);

$this->db->insert('subjects', $data); 
	}
	
	
    function delete_subject($id=0){
        $sql="delete from subjects where id='$id'";
        return $res = $this->db->query($sql);
    }


 function get_section($id=0){
        $sql="select * from sections where id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_section_name($post){
        $sql="select * from sections where section='".$post['section']."'  and college_id='".$post['college_id']."' and course_id='".$post['course_id']."' and branch_id='".$post['branch_id']."' and semister_id='".$post['semister_id']."' and id!='".$post['id']."' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_section_count_exceded($post){
        $sql="select * from sections where college_id='".$post['college_id']."' and course_id='".$post['course_id']."' and branch_id='".$post['branch_id']."' and semister_id='".$post['semister_id']."' ";
        $res = $this->db->query($sql);
        if($res->num_rows()>=10){
            return true;
        }else{
            return false;
        }
    }

		function section_Save($data)
		{
			$this->db->insert('sections',$data);
			return $this->db->insert_id();
		}

    function delete_section($id=0){
        $sql="delete from sections where id='$id'";
        return $res = $this->db->query($sql);
    }

    /***************/

    function get_period_cycle($id=0){
        $sql="select * from period_cycles where id='$id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function check_period_cycles_name($post){
        $sql="select * from period_cycles where name='".$post['name']."'  and college_id='".$post['college_id']."' and id!='".$post['id']."' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function delete_period_cycles($id=0){
        $sql="delete from period_cycles where id='$id'";
        $res = $this->db->query($sql);
        $sql2="delete from periods where cycles_id='$id'";
        $res2 = $this->db->query($sql2);
        $sql3="update staff_cycles_periods set status='0' where cycle_id='$id'";
        $res3 = $this->db->query($sql3);
        return $res;
    }

    function delete_attendance_management($id,$cycle_id){
        $sql3="update staff_cycles_periods set status='0'
                where cycle_id='$cycle_id' and user_id='$id'";
        $res3 = $this->db->query($sql3);
    }

    function get_period_cycle_periods($cycles_id=0){
        $sql="select * from periods where cycles_id='$cycles_id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getWeekdays(){
        $sql="select * from weekdays where status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    
    function getCyclePeriods($cycle_id=0){
        $sql="select * from periods as p
                where p.cycles_id='$cycle_id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getCyclePeriodDetails($cycle_id=0,$period_id=0){
        $sql="select * from periods as p
                where p.cycles_id='$cycle_id' and id='$period_id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getStaffPeriods($staff_id=0,$cycle_id=0,$academic_year_id=0){
        $sql="select scp.*,sr.name as staff_name, pc.name as cycle_name, p.time_label, s.name as subject_name,
                    c.name as course_name, b.name as branch_name, sem.name as sem_name
                    from staff_cycles_periods as scp
                    left join staff_records as sr on sr.user_id=scp.user_id
                    left join period_cycles as pc on pc.id=scp.cycle_id
                    left join periods as p on p.id=scp.period_id
                    left join subjects as s on s.id=scp.subject_id
                    left join courses as c on c.id=s.course_id
                    left join branches as b on b.id=s.branch_id
                    left join semisters as sem on sem.id=s.semister_id
                    where scp.user_id='$staff_id' and scp.cycle_id='$cycle_id' and scp.academic_year_id='$academic_year_id' and scp.status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getStaffsWeekdaysPeriodsSubject($staff_id=0,$cycle_id=0,$weekday_id=0,$period_id=0,$academic_year_id=0){
        $sql="select scp.*,sr.name as staff_name, pc.name as cycle_name, p.time_label, s.name as subject_name from
                    staff_cycles_periods as scp
                    left join staff_records as sr on sr.user_id=scp.user_id
                    left join period_cycles as pc on pc.id=scp.cycle_id
                    left join periods as p on p.id=scp.period_id
                    left join subjects as s on s.id=scp.subject_id
                    where scp.user_id='$staff_id' and scp.cycle_id='$cycle_id' and scp.weekday_id='$weekday_id' and scp.period_id='$period_id' and scp.academic_year_id='$academic_year_id' and scp.status='1'  ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getStaffAllCyclePeriods($staff_id=0){
        $sql="select scp.*,sr.name as staff_name, pc.name as cycle_name, p.time_label, s.name as subject_name,
                    c.name as course_name, b.name as branch_name, sem.name as sem_name
                    from staff_cycles_periods as scp
                    left join staff_records as sr on sr.user_id=scp.user_id
                    left join period_cycles as pc on pc.id=scp.cycle_id
                    left join periods as p on p.id=scp.period_id
                    left join subjects as s on s.id=scp.subject_id
                    left join courses as c on c.id=s.course_id
                    left join branches as b on b.id=s.branch_id
                    left join semisters as sem on sem.id=s.semister_id
                    where scp.user_id='$staff_id' and scp.status='1' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getStaffWeekdaysCyclePeriods($staff_id=0,$weekday_ids=0){
        $sql="select scp.*,sr.name as staff_name, pc.name as cycle_name, p.time_label, s.name as subject_name,
                    c.name as course_name, b.name as branch_name, sem.name as sem_name
                    from staff_cycles_periods as scp
                    left join staff_records as sr on sr.user_id=scp.user_id
                    left join period_cycles as pc on pc.id=scp.cycle_id
                    left join periods as p on p.id=scp.period_id
                    left join subjects as s on s.id=scp.subject_id
                    left join courses as c on c.id=s.course_id
                    left join branches as b on b.id=s.branch_id
                    left join semisters as sem on sem.id=s.semister_id
                    where scp.user_id='$staff_id' and scp.weekday_id in($weekday_ids) and scp.status='1' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    

    function getActiveStaff(){
        $sql="select sr.* from users as u
            left join staff_records as sr on sr.user_id=u.id
            where u.users_type_id in (2,3) and u.`status`='1' ";
        $res=$this->db->query($sql);
        return $res->result_array();
    }

    function checkAttendanceCollision($post){
        $sql="select * from staff_cycles_periods
                where  academic_year_id='".$post['academic_year_id']."' and cycle_id='".$post['cycle_id']."' and weekday_id='".$post['weekday_id']."' and period_id='".$post['period_id']."' and subject_id='".$post['subject_id']."' and user_id!='".$post['user_id']."' and status='1' ";
        $res=$this->db->query($sql);
        return $res->num_rows();
    }
    function checkCycleTimingCollision($post){
        $periodSql="select * from periods as p where id='".$post['period_id']."' ";
        $res=$this->db->query($periodSql);
        $periodDetails=$res->result_array();
        $sqlXXX="select scp.*,pc.name as cycle_name,p.time_label,p.period_label,p.`from`,p.`to` from staff_cycles_periods as scp
                inner join periods as p on p.id=scp.period_id
                left join period_cycles as pc on pc.id=scp.cycle_id
                where scp.user_id='".$post['user_id']."' and scp.weekday_id='".$post['weekday_id']."' and scp.id!='".$post['id']."' and scp.`status`='1'
                and ( p.`from` between '".$periodDetails[0]['from']."' and '".$periodDetails[0]['to']."'
                        || p.`to` between '".$periodDetails[0]['from']."' and '".$periodDetails[0]['to']."'  )
                ";
        $sql="select scp.*,pc.name as cycle_name,p.time_label,p.period_label,p.`from`,p.`to` from staff_cycles_periods as scp
                inner join periods as p on p.id=scp.period_id
                left join period_cycles as pc on pc.id=scp.cycle_id
                where scp.user_id='".$post['user_id']."' and scp.weekday_id='".$post['weekday_id']."' and scp.id!='".$post['id']."' and scp.`status`='1'
                and ( ('".$periodDetails[0]['from']."' between p.`from` and p.`to` && '".$periodDetails[0]['from']."'!=p.`to`)
                        || ('".$periodDetails[0]['to']."' between p.`from` and p.`to` && '".$periodDetails[0]['to']."'!=p.`from`)  )
                ";
        $res=$this->db->query($sql);
        return $res->result_array();
    }


    function getStudentPeriods($user_id=0,$cycle_id=0){

        $userDetails=$this->get_user_details($user_id);
//        echo '<pre>'; print_r($userDetails);echo '</pre>';

      /* $sql_staff=mysql_query("select scp.*,sr.name as staff_name, pc.name as cycle_name, p.time_label, s.name as subject_name,
                    c.name as course_name, b.name as branch_name, sem.name as sem_name
                    from staff_cycles_periods as scp
                    left join staff_records as sr on sr.user_id=scp.user_id
                    left join period_cycles as pc on pc.id=scp.cycle_id
                    left join periods as p on p.id=scp.period_id
                    left join subjects as s on s.id=scp.subject_id
                    left join courses as c on c.id=s.course_id
                    left join branches as b on b.id=s.branch_id
                    left join semisters as sem on sem.id=s.semister_id
                    left join sections as sec on sec.id=scp.section_id
                    where s.semister_id='".$userDetails['student_details'][0]->sem_id."' and scp.cycle_id='$cycle_id' and scp.status='1'");
        $staff = @mysql_fetch_array($sql_staff);
                    
    $sql_start = mysql_query("select * from sections inner join users on users.id=sections.start_number where sections.id=".$staff['section_id']);
    $sections_start = @mysql_fetch_array($sql_start);
                    
    $sql_end = mysql_query("select * from sections inner join users on users.id=sections.end_number where sections.id=".$staff['section_id']);
    $sections_end = @mysql_fetch_array($sql_end);
    
        echo $sql="select scp.*,sr.name as staff_name, pc.name as cycle_name, p.time_label, s.name as subject_name,
                    c.name as course_name, b.name as branch_name, sem.name as sem_name
                    from staff_cycles_periods as scp
                    left join staff_records as sr on sr.user_id=scp.user_id
                    left join period_cycles as pc on pc.id=scp.cycle_id
                    left join periods as p on p.id=scp.period_id
                    left join subjects as s on s.id=scp.subject_id
                    left join courses as c on c.id=s.course_id
                    left join branches as b on b.id=s.branch_id
                    left join semisters as sem on sem.id=s.semister_id
                    left join sections as sec on sec.id=scp.section_id
                    where s.semister_id='".$userDetails['student_details'][0]->sem_id."' and scp.cycle_id='$cycle_id' and scp.status='1' and 
                    sr.students_number >= '".$sections_start['username']."' and sr.students_number <= '".$sections_end['username']."'";
                    
                   echo '<pre>';
                   print_r($userDetails['student_details'][0]);
                   exit;*/
        /*

    $sql_sec = mysql_query("SELECT *
FROM sections
WHERE `student_start` <= '".$userDetails['student_details'][0]->students_number."'
AND `student_end` >= '".$userDetails['student_details'][0]->students_number."'");
    
    $sec = @mysql_fetch_array($sql_sec);

         *
         */
        
        $sec_id=$userDetails['student_details'][0]->section_id;
                   
                 $sql="select scp.*,sr.name as staff_name, pc.name as cycle_name, p.time_label, s.name as subject_name,
                    c.name as course_name, b.name as branch_name, sem.name as sem_name
                    from staff_cycles_periods as scp
                    left join staff_records as sr on sr.user_id=scp.user_id
                    left join period_cycles as pc on pc.id=scp.cycle_id
                    left join periods as p on p.id=scp.period_id
                    left join subjects as s on s.id=scp.subject_id
                    left join courses as c on c.id=s.course_id
                    left join branches as b on b.id=s.branch_id
                    left join semisters as sem on sem.id=s.semister_id
                    left join sections as sec on sec.id=scp.section_id
                    where sec.id='".$sec_id."' and scp.cycle_id='$cycle_id' and scp.status='1'";  // $sec['id']
                    
        $res = $this->db->query($sql);
        return $res->result_array();
    }


    function getAcademicYearDetails($id=0){
        if($id){
            $sql="
                    SELECT *
                        FROM academic_years AS a
                        WHERE a.id=$id
                ";
        $res = $this->db->query($sql);
        return $res->result();
        }
    }

    function checkAcademicYear($post=0){
        if($post){
            $sql="
                    SELECT *
                        FROM academic_years AS a
                        WHERE a.id!='".$post['id']."' and a.name='".$post['name']."'
                ";
        $res = $this->db->query($sql);
        return $res->num_rows();
        }
    }
function checkAdmissionYear($post=0){
        if($post){
            $sql="
                    SELECT *
                        FROM admission_years AS a
                        WHERE a.id!='".$post['id']."' and a.name='".$post['name']."'
                ";
        $res = $this->db->query($sql);
        return $res->num_rows();
        }
    }
	function update_student_record($post)
	{
	if($post['ugtc']!=""){$u=$post['ugtc'];}else{$u="NULL";}
				if($post['ugsc']!=""){$g=$post['ugsc'];}else{$g="NULL";}
				if($post['ugpc']!=""){$p=$post['ugpc'];}else{$p="NULL";}
				if($post['ugcmm']!=""){$c=$post['ugcmm'];}else{$c="NULL";}
				
	$student_rec_id=$post['student_rec_id'];
	$name=$post['name'];
	$fathers_name=$post['fathers_name'];
	$students_number=$post['students_number'];
	$sex=$post['sex'];
	$dob=$post['dob'];
	$doj=$post['doj'];
	$admission_type_id=$post['admission_type_id'];
	$caste_id=$post['caste_id'];
	if($post['scholarship'])
	$sc = array('scholarship'=>1);
	else
	$sc = array('scholarship'=>0);
	//$this->db->where('id', $post['id']);
	//$this->db->update('student_records', $sc); 
	
	$college_id=$post['college_id'];
	$course_id=$post['course_id'];
	$branch_id=$post['branch_id'];
	$sem_id=$post['sem_id'];
	$section_id=$post['section_id'];
	$completing_year=$post['completing_year'];
	$address=$post['address'];
	$mobile=$post['mobile'];
	$father_mobile=$post['father_mobile'];
	$email=$post['email'];
	$schname=$post['schname'];
	$icname=$post['icname'];
	$ugtc=$u;
	$ugsc=$g;
	$ugpc=$p;
	$ugcmm=$c;
	$lac=$post['lac'];
	$cnc=$post['cnc'];
	$username=$post['username'];
	$password=$post['password'];
	if(isset($post['photopath']))
	{
	$photopath=$post['photopath'];
	$data = array('photo'=>$post['photopath']);
	$this->db->where('id', $post['uid']);
	$this->db->update('student_records', $data); 
	}
	if(isset($post['sscpath']))
	{
	$sscpath=$post['sscpath'];
	$data = array('ssc'=>$post['sscpath']);
	$this->db->where('id', $post['uid']);
	$this->db->update('student_records', $data); 
	}
	if(isset($post['interpath']))
	{
	$interpath=$post['interpath'];
	$data = array('inter'=>$post['interpath']);
	$this->db->where('id', $post['uid']);
	$this->db->update('student_records', $data); 
	}
	if(isset($post['otherpath']))
	{
	$photopath=$post['otherpath'];
	$data = array('other'=>$post['otherpath']);
	$this->db->where('id', $post['uid']);
	$this->db->update('student_records', $data); 
	}
	$data = array(
               'name'=>$name,
'fathers_name'=>$fathers_name,
'students_number'=>$students_number,
'sex'=>$sex,
'dob'=>$dob,
'doj'=>$doj,
'admission_type_id'=>$admission_type_id,
'caste_id'=>$caste_id,
'college_id'=>$college_id,
'course_id'=>$course_id,
'branch_id'=>$branch_id,
'section_id'=>$section_id,
'completing_year'=>$completing_year,
'address'=>$address,
'mobile'=>$mobile,
'father_mobile'=>$father_mobile,
'email'=>$email,
'schname'=>$schname,
'icname'=>$icname,
'ugtc'=>$u,
'ugsc'=>$g,
'ugpc'=>$p,
'ugcmm'=>$c,
'lac'=>$lac,
'cnc'=>$cnc

            );
	
$this->db->where('id', $post['uid']);
$this->db->update('student_records', $data); 

$data = array(
'username'=>$username,
'password'=>$password);
$this->db->where('id', $post['id']);
$this->db->update('users', $data); 



return mysql_affected_rows();	
}
function viewevent($slug)
{
 $sql="
                    SELECT *
                        FROM events 
                        WHERE status='active' and title_slug='$slug'";
        $res = $this->db->query($sql);
        return $res->result();
}
function getevents()
{
 $sql="
                    SELECT *FROM events ";
        $res = $this->db->query($sql);
        return $res->result();
}
function deleteevent($slug)
{
	 $sql="delete from events where title_slug='$slug'";
        $this->db->query($sql);
}
function addevent($title,$date,$desc)
{
	$data = array(
   'id' => '' ,
   'title' => $title ,
   'title_slug' => url_title($title,'dash',true),
   'desc' => $desc,
   'DateTime' => $date,
   'addedby_on' => date('d-m-Y'),
   'status' => 'active'
   );

$this->db->insert('events', $data); 
}
function editevent($title,$date,$desc,$slug,$status)
{
$data = array(
'title'=>$title,
'DateTime'=>$date,
'desc'=>$desc,
'title_slug'=>url_title($title,'dash',true),
'status'=>$status);
$this->db->where('title_slug', $slug);
$this->db->update('events', $data); 
}

    function getSystemSettings($setting_name=''){
        $sql='
            SELECT * FROM settings
        ';
        if(!empty($setting_name)){
            $sql.=' WHERE name="'.$setting_name.'" ';
        }
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    
    
    function check_batch_no($post = 0) {
        if ($post) {
            $sql = "
                        SELECT *
                            FROM batch_nos AS a
                            WHERE a.id!='" . $post['id'] . "' and a.name='" . $post['name'] . "'
                    ";
            $res = $this->db->query($sql);
            return $res->num_rows();
        }
    }
    
    function get_batch_no_details($id = 0) {
        if ($id) {
            $sql = "
                        SELECT *
                            FROM batch_nos AS a
                            WHERE a.id=$id
                    ";
            $res = $this->db->query($sql);
            return $res->result();
        }
    }
    
    function checkItems($post = 0) {
        if ($post) {
            $sql = "
                        SELECT *
                            FROM items AS i
                            WHERE i.id!='" . $post['id'] . "' and i.name='" . $post['name'] . "'
                    ";
            $res = $this->db->query($sql);
            return $res->num_rows();
        }
    }
    
    function getItemDetails($id = 0) {
        if ($id) {
            $sql = "
                        SELECT *
                            FROM items AS i
                            WHERE i.id=$id
                    ";
            $res = $this->db->query($sql);
            return $res->result();
        }
    }
    
    
    function delete_academic_calendar($id){
        $sql="
                DELETE FROM academic_calendar 
                WHERE id='$id'
        ";
        $res = $this->db->query($sql);
        $sql="
                DELETE FROM academic_calendar_items 
                WHERE calender_id='$id'
        ";
        $res = $this->db->query($sql);
        $sql="
                DELETE FROM academic_calendar_semesters 
                WHERE calendar_id='$id'
        ";
        $res = $this->db->query($sql);
        return true;
    }
    
    function check_academic_calendar($post = 0) {
        if ($post) {
            $sql = "
                        SELECT *
                            FROM academic_calendar AS a
                            WHERE a.id!='" . $post['id'] . "' and a.name='" . $post['name'] . "'
                    ";
            $res = $this->db->query($sql);
            return $res->num_rows();
        }
    }
    
    function get_academic_calendar_details($id = 0) {
        if ($id) {
            $return_data=array();
            $sql = "
                        SELECT *
                            FROM academic_calendar AS a
                            WHERE a.id=$id
                    ";
            $res = $this->db->query($sql);
            $return_data['calendar_data']=$res->result();
            
            $sql = "
                        SELECT a.*,s.name AS sem_name,b.name AS branch_name 
                            FROM academic_calendar_semesters AS a
                            LEFT JOIN semisters AS s ON s.id=a.sem_id
                            LEFT JOIN branches AS b ON b.id=s.branch_id
                            WHERE a.calendar_id=$id
                    ";
            $res = $this->db->query($sql);
            $return_data['calendar_sems']=$res->result();
            return $return_data;
        }
    }
    
    function clear_calendar_semesters($id=0){
        if(!empty($id)){
            $sql = "
                    DELETE FROM academic_calendar_semesters 
                    WHERE calendar_id=$id
            ";
            return $this->db->query($sql);
        }
    }
    
    function check_academic_calendar_items($post = 0) {
        if ($post) {
            $sql = "
                        SELECT *
                            FROM academic_calendar_items AS a
                            WHERE a.id!='" . $post['id'] . "' AND a.calender_id='" . $post['calender_id'] . "' and a.item_id='" . $post['item_id'] . "'
                    ";
            $res = $this->db->query($sql);
            return $res->num_rows();
        }
    }
    
    function get_academic_calendar_items_details($id = 0) {
        if ($id) {
            $sql = "
                        SELECT a.*,i.name as item_name
                            FROM academic_calendar_items AS a
                            LEFT JOIN items AS i ON i.id=a.item_id
                            WHERE a.calender_id=$id
                    ";
            $res = $this->db->query($sql);
            return $res->result();
        }
    }
    
    function delete_academic_calendar_items($id=0){
        if(!empty($id)){
            $sql = "
                    DELETE FROM academic_calendar_items 
                    WHERE id=$id
            ";
            return $this->db->query($sql);
        }
    }
    
    
    
	function insert_ssc_inter($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('student_records',$data);
	}
	
}

?>