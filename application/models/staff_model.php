<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_model extends CI_Model {
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

    function getProfileDetails($user_id){
        $sql="select * from staff_records where user_id='$user_id'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_time_table($user_id){
        $sql="select * from time_table where user_id='$user_id'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_student_user_id($number){
        $sql="select user_id from student_records where students_number='$number'";
        $res = $this->db->query($sql);
        return $res->result();
    }
    
    function search_student($number=0,$name=''){
        $sql="
            SELECT sr.*,s.name AS semister_name,b.name AS branch_name FROM student_records AS sr
            LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'
            LEFT JOIN semisters AS s ON s.id=ss.semister_id
            LEFT JOIN branches AS b ON b.id=sr.branch_id
            where sr.students_number='$number'";
        if(!empty($name)){
            $sql.=" OR sr.name LIKE '%".$name."%' ";
        }
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_staff_users(){
        $sql="select u.id,u.username, ut.name as label from users as u
                left join users_type as ut on ut.id=u.users_type_id
                where (u.users_type_id=2 || u.users_type_id=3)";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_time_table_days(){
        $sql="select * from student_time_table_days where status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_branches(){
        $sql="select * from branches where status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_student_time_table($post){
        $sql="select st.* from student_time_table as st
                left join student_time_table_days as std on std.id=st.day_id
                where st.branch_id='".$post['branch_id']."' and st.year='".$post['year']."'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getapprovals_count($user_id,$branch_id=0){
        $sql="select nd.*,sr.name,sr.students_number,sr.doj,c.name as course,b.name as branch,sr.present_year,sr.completing_year
                    from nodue_applications as nd
                    left join student_records as sr on sr.user_id=nd.user_id
                    left join courses as c on c.id=sr.course_id
                    left join branches as b on b.id=sr.branch_id
                    where nd.is_issued!='1'";
        $sql="select nd.*,nda.approver_status,sr.name,sr.students_number,sr.doj,c.name as course,b.name as branch,sr.present_year,sr.completing_year
                    from nodue_applications as nd
                    left join student_records as sr on sr.user_id=nd.user_id
                    left join courses as c on c.id=sr.course_id
                    left join branches as b on b.id=sr.branch_id
                    left join nodue_approvals as nda on nda.application_id=nd.id
                    where nd.is_issued!='1' and nda.approver_id='".$user_id."' and nda.approver_status='0'";
        $res = $this->db->query($sql);
        $count1=$res->num_rows();
        $sql2="select q.*,s.name as subject,br.name as branch_name, u.username from question_papers as q
                left join users as u on q.user_id=u.id
                left join branches as br on q.branch=br.id
                left join subjects as s on s.id=q.subject_id
                where q.is_approved!='1' and is_principal_approved='1'";
        if($branch_id) $sql2.=" and q.branch=$branch_id";
        $res2 = $this->db->query($sql2);
        $count2=$res2->num_rows();
        return $count1+$count2;
    }

    function update_nodue($appl_id,$approver_id,$status){
        $sql="update nodue_approvals set approver_status='$status' where application_id='$appl_id' and approver_id='$approver_id'";
        $res = $this->db->query($sql);
    }


    function getAttendanceStudents($cycle_id=0,$weekday_id=0,$period_id=0,$subject_id=0){
    
    $sql_staff_sections  = mysql_query("select * from staff_cycles_periods as scp inner join sections s on scp.section_id=s.id where scp.period_id=$period_id and scp.subject_id=$subject_id");
    $staff_sections = mysql_fetch_array($sql_staff_sections);
   
   
  
   
   $sql_start = mysql_query("select * from sections inner join users on users.id=sections.start_number where sections.id=".$staff_sections['section_id']);
    $sections_start = @mysql_fetch_array($sql_start);
                    
    $sql_end = mysql_query("select * from sections inner join users on users.id=sections.end_number where sections.id=".$staff_sections['section_id']);
    $sections_end = @mysql_fetch_array($sql_end);
  
    
    
    
        $sqlBACKUP=" select ss.*,sr.* from student_records as sr
                inner join student_semisters as ss on ( ss.user_id=sr.user_id and ss.is_current='1' )
                where ss.semister_id=(select sub.semister_id from subjects as sub where sub.id='$subject_id')
                group by sr.user_id";
        $sqlBACKUP1=" select ss.*,sr.*,spa.id as attendance_record_id,spa.attendance_id  from student_records as sr
                inner join student_semisters as ss on ( ss.user_id=sr.user_id and ss.is_current='1' )
                left join student_periods_attendence as spa on (spa.user_id=ss.user_id and spa.subject_id='$subject_id' and spa.period_id='$period_id' and spa.create_date between CURRENT_DATE()+' 00:00:00' and CURRENT_DATE()+' 23:60:60')
                where ss.semister_id=(select sub.semister_id from subjects as sub where sub.id='$subject_id')
                group by sr.user_id";
                    
       // $sql.=" and users.username >= '".$sections_start['username']."' and users.username <= '".$sections_end['username']."' ";
                    	
        $sql_OTHER_DEVELOPERS_BACKUP=" select ss.*,sr.*,spa.id as attendance_record_id,spa.attendance_id  from student_records as sr
                inner join student_semisters as ss on ( ss.user_id=sr.user_id and ss.is_current='1' )
                left join student_periods_attendence as spa on (spa.user_id=ss.user_id and spa.subject_id='$subject_id' and spa.period_id='$period_id' and spa.create_date between CURRENT_DATE()+' 00:00:00' and CURRENT_DATE()+' 23:60:60')
                where sr.students_number >= '".$sections_start['username']."' and sr.students_number <= '".$sections_end['username']."' 
                group by sr.user_id order by sr.students_number"; 
        
        /* Correcting the right way to select a section students for the section assigned to teacher. */
        $sql=" select ss.*,sr.*,spa.id as attendance_record_id,spa.attendance_id  from student_records as sr
                inner join student_semisters as ss on ( ss.user_id=sr.user_id and ss.is_current='1' )
                left join student_periods_attendence as spa on (spa.user_id=ss.user_id and spa.subject_id='$subject_id' and spa.period_id='$period_id' and spa.create_date between CONCAT(CURRENT_DATE(),' 00:00:00') and CONCAT(CURRENT_DATE(),' 23:60:60'))
                where ss.semister_id=(select sub.semister_id from subjects as sub where sub.id='$subject_id')
                    AND sr.section_id IN (SELECT scp.section_id FROM staff_cycles_periods AS scp WHERE  scp.period_id=$period_id and scp.subject_id=$subject_id )
                group by sr.user_id";
                
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getLeaveDetails($id=0){
        $sql="select l.*,b.name as branch_name,lt.name as leave_type_name from leave_letters as l
                    left join staff_records as sr on sr.user_id=l.user_id
                    left join branches as b on b.id=l.branch_id
                    left join leave_types as lt on lt.id=l.leave_type_id
                    where l.id='$id'
	             ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getStaffLeavesCount($user_id){
        $sql="select lt.id,lt.name,count(*) as number_of_leaves from leave_letters as ll
                left join leave_types as lt on lt.id=ll.leave_type_id
                where ll.user_id='$user_id'
                group by ll.leave_type_id";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function getStaffAllCyclePeriodsAdjustments($leave_letter_id=0,$staff_id=0,$weekday_ids=0){
        $sql="select lwa.work_adjusted_to,lwa.work_adjusted_date,scp.*,sr.name as staff_name, pc.name as cycle_name, p.time_label, s.name as subject_name,
                    c.name as course_name, b.name as branch_name, sem.name as sem_name
                    from staff_cycles_periods as scp
                    left join staff_records as sr on sr.user_id=scp.user_id
                    left join period_cycles as pc on pc.id=scp.cycle_id
                    left join periods as p on p.id=scp.period_id
                    left join subjects as s on s.id=scp.subject_id
                    left join courses as c on c.id=s.course_id
                    left join branches as b on b.id=s.branch_id
                    left join semisters as sem on sem.id=s.semister_id
                    inner join leave_work_adjusts as lwa on lwa.period_id=scp.id
                    where scp.user_id='$staff_id'  and scp.weekday_id in($weekday_ids) and lwa.leave_letter_id='$leave_letter_id' and scp.status='1' ";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function breachCounterEntry($id=0,$period_id=0){
        if($id){
            $sql="select * from attendance_breach_counter where staff_user_id='".$id."' and period_id='".$period_id."' and date_added BETWEEN '".date('Y-m-d')." 00:00:00' and '".date('Y-m-d')." 23:59:59' ";
            $res = $this->db->query($sql);
            if($res->num_rows()){
                // Already Entered for d Day
                return 0;
            }else{
                $post['staff_user_id']=$id;
                $post['period_id']=$period_id;
                $post['date_added']=date('Y-m-d H:i:s');
                return $this->my_db_lib->save_record($post,'attendance_breach_counter');
            }
        }
    }

    function checkBreachUnlocked($id=0,$period_id=0){
        $sql="select * from attendance_breach_counter where staff_user_id='".$id."' and period_id='".$period_id."' and date_added BETWEEN '".date('Y-m-d')." 00:00:00' and '".date('Y-m-d')." 23:59:59' and unlocked='1'";
        $res = $this->db->query($sql);
        if($res->num_rows()){
            return true;
        }else{
            return false;
        }
    }

    function sendStudentsAbsentSms($student_user_ids){
        $msg="Your son/daughter is absent for the college today";
        $sql=" select * from student_records where user_id in (".  implode(',', $student_user_ids).") ";
        $res = $this->db->query($sql);
        $data=$res->result_array();
        foreach($data as $k=>$v){
            if(!empty($v['mobile']))
            $this->sms_lib->send_sms($v['mobile'],$msg);
        }
    }


    function getFailedStudents($college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$section_id=0){
        $sql="
            SELECT sr.*,ss.semister_id

                FROM student_records AS sr
                LEFT JOIN users as u ON u.id=sr.user_id
                LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'
                LEFT JOIN student_external_marks AS sem ON (sem.user_id=u.id and sem.status='1')

                WHERE sr.college_id='$college_id' AND sr.course_id='$course_id' AND sr.branch_id='$branch_id'
                AND ss.semister_id='$semister_id' AND sr.section_id='$section_id' AND sr.status='1' AND u.status='1'
                AND sem.pass='0'

                GROUP BY u.id
                ORDER BY sr.students_number
            ";
        $res=$this->db->query($sql);
        return $res->result();
    }

    function getStudents($college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$section_id=0){
        $sql="
            SELECT sr.*,ss.semister_id
                
                FROM student_records AS sr
                LEFT JOIN users as u ON u.id=sr.user_id
                LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'

                WHERE sr.college_id='$college_id' AND sr.course_id='$course_id' AND sr.branch_id='$branch_id'
                AND ss.semister_id='$semister_id' AND sr.section_id='$section_id' AND sr.status='1' AND u.status='1'
                ORDER BY sr.students_number
            ";
        $res=$this->db->query($sql);
        return $res->result();
    }

    function getStudentsInternalMarks($college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$subject_id=0,$section_id=0){
        $sql="
            SELECT sim.*
                FROM student_internal_marks AS sim
                
                WHERE sim.college_id='$college_id' AND sim.course_id='$course_id' AND sim.branch_id='$branch_id'
                AND sim.semister_id='$semister_id' AND sim.section_id='$section_id' AND sim.subject_id='$subject_id' AND sim.status='1'
            ";
        $res=$this->db->query($sql);
        return $res->result();
    }

    function getStaffSubjects($user_id=0,$semister_id=0){
        $sql="
            SELECT s.id,s.name

                FROM staff_cycles_periods AS scp
                LEFT JOIN subjects AS s ON s.id=scp.subject_id

                WHERE scp.user_id='$user_id' AND scp.status='1'
            ";
            if($semister_id){
                $sql.=" AND s.semister_id='$semister_id' ";
            }
            $sql.=" GROUP BY s.id ";
        $res=$this->db->query($sql);
        return $res->result();
    }

    function getStaffSections($user_id=0,$semister_id=0){
        $sql="
            SELECT s.id,s.section as name

                FROM staff_cycles_periods AS scp
                LEFT JOIN sections AS s ON s.id=scp.section_id

                WHERE scp.user_id='$user_id' AND scp.status='1'
            ";
            if($semister_id){
                $sql.=" AND s.semister_id='$semister_id' ";
            }
            $sql.=" GROUP BY s.id ";
        $res=$this->db->query($sql);
        return $res->result();
    }
    
    function get_student_attendance($user_id=0,$sem_id=0){
        $whereSQL='';
        if(!empty($month)){
            $whereSQL.=' AND spa.create_date BETWEEN "'.$month.'-01 00:00:01" AND "'.$month.'-31 23:59:59"';
        }
        if(!empty($sem_id)){
            $whereSQL.=' AND ss.semister_id='.$sem_id;
        }
        $sql = "
                SELECT spa.*, sr.name, sr.students_number,spa.id AS attendance_record_id,spa.attendance_id,sem.name AS semister_name,b.name AS branch_name, c.name AS course_name, spa.subject_id, s.name AS subject_name, attendance_id, a.name AS attendance_type, count(attendance_id) AS attendance_count
                    FROM student_periods_attendence AS spa
                    INNER JOIN student_records AS sr ON (sr.user_id=spa.user_id)
                    LEFT JOIN student_semisters AS ss ON (ss.user_id=sr.user_id AND ss.is_current='1')
                    LEFT JOIN attendance_types AS a ON a.id=spa.attendance_id
                    LEFT JOIN semisters AS sem ON sem.id=ss.semister_id
                    LEFT JOIN courses AS c ON c.id=sr.course_id
                    LEFT JOIN branches AS b ON b.id=sr.branch_id
                    LEFT JOIN subjects AS s on s.id=spa.subject_id
                    WHERE 1 AND spa.user_id=$user_id  $whereSQL  
                    GROUP BY ss.semister_id,period_id,spa.subject_id,attendance_id
                    ORDER BY ss.semister_id,period_id,spa.subject_id,attendance_id,spa.create_date

        ";

        $res = $this->db->query($sql);
        return $res->result();
    }
    
    /*
     * FOR send_student_marks
     * 
     */
    
    function get_students($college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$section_id=0){
        $sql="
            SELECT sr.*,ss.semister_id,sem.name AS sem_name,col.name AS college_name
                
                FROM student_records AS sr
                LEFT JOIN users as u ON u.id=sr.user_id
                LEFT JOIN student_semisters AS ss ON ss.user_id=sr.user_id AND ss.is_current='1'
                LEFT JOIN semisters AS sem ON sem.id=ss.semister_id
                LEFT JOIN colleges AS col ON col.id=sr.college_id

                WHERE 1 ";
        if(!empty($college_id)){
                $sql.=" AND sr.college_id='$college_id' ";
        }
        if(!empty($course_id)){
                $sql.=" AND sr.course_id='$course_id' ";
        }
        if(!empty($branch_id)){
                $sql.=" AND sr.branch_id='$branch_id' ";
        }
        if(!empty($semister_id)){
                $sql.=" AND ss.semister_id='$semister_id' ";
        }
        if(!empty($section_id)){
                $sql.=" AND sr.section_id='$section_id' ";
        }
        
        $sql.="
                  AND sr.status='1' AND u.status='1'
                ORDER BY sr.students_number
            ";
        $res=$this->db->query($sql);
        return $res->result();
    }

    function get_students_internal_marks($college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$subject_id=0,$section_id=0){
        $sql="
            SELECT sim.*,sub.subject_type_id,sub.name AS subject_name
                FROM student_internal_marks AS sim
                LEFT JOIN subjects AS sub ON sub.id=sim.subject_id
                
                WHERE  1 ";
        if(!empty($college_id)){
                $sql.=" AND sim.college_id='$college_id' ";
        }
        if(!empty($course_id)){
                $sql.=" AND sim.course_id='$course_id' ";
        }
        if(!empty($branch_id)){
                $sql.=" AND sim.branch_id='$branch_id' ";
        }
        if(!empty($semister_id)){
                $sql.=" AND sim.semister_id='$semister_id' ";
        }
        if(!empty($subject_id)){
                $sql.=" AND sim.subject_id='$subject_id' ";
        }
        if(!empty($section_id)){
                $sql.=" AND sim.section_id='$section_id' ";
        }
        
        $sql.="  
                  AND sim.status='1'
                  ORDER BY sim.user_id, subject_id, internal_number
            ";
        $res=$this->db->query($sql);
        return $res->result();
    }
    
    function get_marks_type(){
        $sql="
            SELECT * FROM marks_type WHERE status=1 
        ";
        $res=$this->db->query($sql);
        return $res->result();
    }
    
    function get_subjects($college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$subject_id=0,$section_id=0){
        $sql="
            SELECT sub.*, IFNULL(sim.id,'0') AS `posted_status`
                FROM 
                subjects AS sub
                LEFT JOIN student_internal_marks AS sim ON sim.subject_id=sub.id
                WHERE 1 ";
        if(!empty($college_id)){
                $sql.=" AND sub.college_id='$college_id' ";
        }
        if(!empty($course_id)){
                $sql.=" AND sub.course_id='$course_id' ";
        }
        if(!empty($branch_id)){
                $sql.=" AND sub.branch_id='$branch_id' ";
        }
        if(!empty($semister_id)){
                $sql.=" AND sub.semister_id='$semister_id' ";
        }
        if(!empty($subject_id)){
                $sql.=" AND sub.subject_id='$subject_id' ";
        }
        if(!empty($section_id)){
                $sql.=" AND sub.section_id='$section_id' ";
        }
        
        $sql.="  
                  AND sub.status='1'
                  GROUP BY sub.id
            ";
        $res=$this->db->query($sql);
        return $res->result();
    }
    
    function get_teachers_assigned_to_subject($subject_id=0){
        $sql="  
                 SELECT sr.*, sub.name AS subject_name, sem.name AS semister_name
                 FROM staff_cycles_periods AS scp
                 LEFT JOIN staff_records AS sr ON sr.user_id=scp.user_id
                 LEFT JOIN subjects AS sub ON sub.id=scp.subject_id
                 LEFT JOIN semisters AS sem ON sem.id=sub.semister_id
                 
                 WHERE 1 AND scp.status=1 AND scp.subject_id=$subject_id
            ";
        $res=$this->db->query($sql);
        return $res->result();
    }

}

?>
