<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function sample() {
        $sql = "";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_request_counts($sql) {
        $res = $this->db->query($sql);
        return $res->num_rows();
    }

    /*
     * NEW FROM AUG 2012
     */

    function getSubjectData($id = 0) {
        if ($id) {
            $sql = "
            SELECT s.*,st.name as subject_type_name

                FROM subjects AS s
                LEFT JOIN subject_type AS st ON st.id=s.subject_type_id

                WHERE s.id='$id' AND s.status='1'
            ";
            $res = $this->db->query($sql);
            return $res->result();
        }
    }

    function getStudentsInternalMarks($user_id = 0, $college_id = 0, $course_id = 0, $branch_id = 0, $semister_id = 0, $subject_id = 0, $section_id = 0) {
        $sql = "
            SELECT sim.*,st.name AS subject_type_name,s.name AS subject_name, s.subject_type_id,
               s.credits, s.academic_year

                FROM student_internal_marks AS sim
                LEFT JOIN subjects AS s ON s.id=sim.subject_id
                LEFT JOIN subject_type AS st ON st.id=s.subject_type_id

                WHERE sim.user_id='$user_id' AND sim.college_id='$college_id' AND sim.course_id='$course_id' AND sim.branch_id='$branch_id'
                AND sim.semister_id='$semister_id' AND sim.section_id='$section_id' AND sim.status='1'
            ";
        //  AND sim.subject_id='$subject_id'
        $res = $this->db->query($sql);
        return $res->result();
    }

    function getStudentsExternalMarks($user_id = 0, $college_id = 0, $course_id = 0, $branch_id = 0, $semister_id = 0, $subject_id = 0, $section_id = 0) {
        $sql = "
            SELECT sem.*
                FROM student_external_marks AS sem

                WHERE sem.user_id='$user_id' AND sem.college_id='$college_id' AND sem.course_id='$course_id' AND sem.branch_id='$branch_id'
                AND sem.semister_id='$semister_id' AND sem.section_id='$section_id' AND sem.status='1'
            ";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function getStudentsInternalMarks1($user_id = 0, $college_id = 0, $course_id = 0, $branch_id = 0, $semister_id = 0, $subject_id = 0, $section_id = 0) {
        $sql = "
            SELECT sim.*,st.name AS subject_type_name,s.name AS subject_name, s.subject_type_id,
               s.credits, s.academic_year

                FROM student_internal_marks AS sim
                LEFT JOIN subjects AS s ON s.id=sim.subject_id
                LEFT JOIN subject_type AS st ON st.id=s.subject_type_id

                WHERE sim.user_id='$user_id' AND sim.college_id='$college_id' AND sim.course_id='$course_id' AND sim.branch_id='$branch_id'
                AND sim.semister_id='$semister_id' AND sim.section_id='$section_id' AND sim.status='1'
            ";
        //  AND sim.subject_id='$subject_id'
        $res = $this->db->query($sql)->result();
        $result = $res[0];
        return $result;
    }

    function getStudentsExternalMarks1($user_id = 0, $college_id = 0, $course_id = 0, $branch_id = 0, $semister_id = 0, $subject_id = 0, $section_id = 0) {
        $sql = "
            SELECT sem.*
                FROM student_external_marks AS sem

                WHERE sem.user_id='$user_id' AND sem.college_id='$college_id' AND sem.course_id='$course_id' AND sem.branch_id='$branch_id'
                AND sem.semister_id='$semister_id' AND sem.section_id='$section_id' AND sem.status='1'
            ";
        $res = $this->db->query($sql)->result();
        $result = $res[0];
        return $result;
    }

    function get_semester_subjects($semester_id = 0) {
        if (!empty($semester_id)) {
            $sql = "
            SELECT s.*,st.name as subject_type_name

                FROM subjects AS s
                LEFT JOIN subject_type AS st ON st.id=s.subject_type_id

                WHERE s.semister_id='$semester_id' AND s.status='1'
            ";
            $res = $this->db->query($sql);
            return $res->result('array');
        }
    }

    function get_students($post = array()) {
        $sql = "
            SELECT sr.*,sem.semister_id

                FROM student_records AS sr
                LEFT JOIN student_semisters AS sem ON sem.user_id=sr.user_id AND is_current='1'

                WHERE sr.status='1' 
            ";
        if (!empty($post['college_id'])) {
            $sql.=" AND sr.college_id= '" . $post['college_id'] . "' ";
        }
        if (!empty($post['course_id'])) {
            $sql.=" AND sr.course_id= '" . $post['course_id'] . "' ";
        }
        if (!empty($post['branch_id'])) {
            $sql.=" AND sr.branch_id= '" . $post['branch_id'] . "' ";
        }
        if (!empty($post['semister_id'])) {
            $sql.=" AND sem.semister_id= '" . $post['semister_id'] . "' ";
        }

        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_staff_user_details($staffType = '') {
        $sql = "
                SELECT sr.* 
                FROM staff_records AS sr
                LEFT JOIN users AS u ON u.id=sr.user_id
                LEFT JOIN users_type AS ut ON ut.id=u.users_type_id
                WHERE 1  AND sr.status='1' 
            ";
        if (empty($staffType)) {
            $sql.=" AND (u.users_type_id=2 || u.users_type_id=3) ";
        } else if ($staffType == 'hod') {
            $sql.=" AND u.users_type_id=3 ";
        } else if ($staffType == 'faculty') {
            $sql.=" AND u.users_type_id=2 ";
        }
        $res = $this->db->query($sql);
        return $res->result();
    }

    /*
     * @param: $userTypesIds => coma seperated use_type_ids
     */

    function get_users_of_types($userTypesIds = '') {
        $sql = "
            SELECT u.*,u.id AS user_id, '' AS mobile
                FROM users AS u

                WHERE u.status='1' 
            ";
        if (!empty($userTypesIds)) {
            $sql.=" AND u.users_type_id IN ($userTypesIds) ";
        }

        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_exam_duty_day_slots() {
        $sql = '
                SELECT e.*
                FROM exam_duty_day_slots AS e
                WHERE status="1"
            ';
        $res = $this->db->query($sql);
        return $res->result();
    }

    function get_chart_details($id = 0) {
        if (!empty($id)) {
            $sql = '
                SELECT ec.*, c.name AS course_name
                FROM exam_duty_charts AS ec
                LEFT JOIN courses AS c ON c.id=ec.course_id
                WHERE ec.id="' . $id . '"
            ';
            $res = $this->db->query($sql);
            return $res->result();
        }
    }

    function get_exam_duty_day_staff($post) {
        if (!empty($post)) {
            $sql = '
                SELECT sr.*
                FROM staff_records AS sr
                LEFT JOIN branches AS b ON b.id=sr.branch_id
                
                WHERE b.course_id="' . $post->course_id . '"  AND sr.status="1" 
            ';
            $res = $this->db->query($sql);
            return $res->result();
        }
    }

    function get_exam_duty_allocations($post) {
        if (!empty($post)) {
            $sql = '
                SELECT ea.*
                FROM exam_duty_allocations AS ea
                LEFT JOIN exam_duty_charts AS ec ON ec.id=ea.chart_id
                
                WHERE ec.id="' . $post->id . '"  AND ea.status="1" 
            ';
            $res = $this->db->query($sql);
            return $res->result();
        }
    }

    function inactive_chart_allocations($id = 0) {
        $sql = '
            UPDATE exam_duty_allocations 
            SET status="0"
            WHERE id="' . $id . '"
        ';
        return $this->db->query($sql);
    }

}

?>
