<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam_model extends CI_Model {
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

    function get_request_counts($sql){
        $res = $this->db->query($sql);
        return $res->num_rows();
    }


    /*
     * NEW FROM AUG 2012
     */
    

    function getSubjectData($id=0){
        if($id){
            $sql="
            SELECT s.*,st.name as subject_type_name

                FROM subjects AS s
                LEFT JOIN subject_type AS st ON st.id=s.subject_type_id

                WHERE s.id='$id' AND s.status='1'
            ";
            $res=$this->db->query($sql);
            return $res->result();
        }
    }

    function getStudentsInternalMarks($user_id=0,$college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$subject_id=0,$section_id=0){
        $sql="
            SELECT sim.*,st.name AS subject_type_name,s.name AS subject_name, s.subject_type_id,
               s.credits, s.academic_year

                FROM student_internal_marks AS sim
                LEFT JOIN subjects AS s ON s.id=sim.subject_id
                LEFT JOIN subject_type AS st ON st.id=s.subject_type_id

                WHERE sim.user_id='$user_id' AND sim.college_id='$college_id' AND sim.course_id='$course_id' AND sim.branch_id='$branch_id'
                AND sim.semister_id='$semister_id' AND sim.section_id='$section_id' AND sim.status='1'
            ";
        //  AND sim.subject_id='$subject_id'
        $res=$this->db->query($sql);
        return $res->result();
    }

    function getStudentsExternalMarks($user_id=0,$college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$subject_id=0,$section_id=0){
        $sql="
            SELECT sem.*
                FROM student_external_marks AS sem

                WHERE sem.user_id='$user_id' AND sem.college_id='$college_id' AND sem.course_id='$course_id' AND sem.branch_id='$branch_id'
                AND sem.semister_id='$semister_id' AND sem.section_id='$section_id' AND sem.status='1'
            ";
        $res=$this->db->query($sql);
        return $res->result();
    }
	function getStudentsInternalMarks1($user_id=0,$college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$subject_id=0,$section_id=0){
        $sql="
            SELECT sim.*,st.name AS subject_type_name,s.name AS subject_name, s.subject_type_id,
               s.credits, s.academic_year

                FROM student_internal_marks AS sim
                LEFT JOIN subjects AS s ON s.id=sim.subject_id
                LEFT JOIN subject_type AS st ON st.id=s.subject_type_id

                WHERE sim.user_id='$user_id' AND sim.college_id='$college_id' AND sim.course_id='$course_id' AND sim.branch_id='$branch_id'
                AND sim.semister_id='$semister_id' AND sim.section_id='$section_id' AND sim.status='1'
            ";
        //  AND sim.subject_id='$subject_id'
        $res=$this->db->query($sql)->result();
		 $result=$res[0];
        return $result;
    }

    function getStudentsExternalMarks1($user_id=0,$college_id=0,$course_id=0,$branch_id=0,$semister_id=0,$subject_id=0,$section_id=0){
        $sql="
            SELECT sem.*
                FROM student_external_marks AS sem

                WHERE sem.user_id='$user_id' AND sem.college_id='$college_id' AND sem.course_id='$course_id' AND sem.branch_id='$branch_id'
                AND sem.semister_id='$semister_id' AND sem.section_id='$section_id' AND sem.status='1'
            ";
        $res=$this->db->query($sql)->result();
		 $result=$res[0];
        return $result;
    }


}

?>
