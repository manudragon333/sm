<div id="filter_wrap" class="filter_panel">
    <form method="post" action="export_users_grid">
        <input type="hidden" name="export" value="export" />
        <input type="hidden" name="rows" value="100000" />
        <input type="hidden" name="page" value="1" />
        <input type="hidden" name="sidx" value="username" />
        <input type="hidden" name="sord" value="desc" />
        <label for="user_type">User Type: </label>
        <select name="users_type" id="users_type" class="text">
            <?php foreach ($user_types as $k => $v) { ?>
                <option value="<?php echo $v['id']; ?>"> <?php echo $v['name']; ?> </option>
            <?php } ?>
        </select>
        <label for="college_id">College:* </label>
        <select id="college_id" name="college_id" class="text">
            <option value="">Select</option>
            <?php if (isset($s_data['college_id'])) $college_id_select = $s_data['college_id']; else $college_id_select = 0; echo load_select('colleges', $college_id_select); ?>
        </select>
        <label for="course_id">Course:* </label>
        <select id="course_id" name="course_id" class="text">
            <option value="">Select</option>
            <?php if (isset($s_data['course_id'])) $course_id_select = $s_data['course_id']; else $course_id_select = 0; if ($course_id_select) echo load_select('courses', $course_id_select, array('status' => '1', 'college_id' => $college_id_select)); ?>
        </select>
        <label for="branch_id">Branch:* </label>
        <select id="branch_id" name="branch_id" class="text required">
            <option value="">Select</option>
            <?php if (isset($s_data['branch_id'])) $branch_id_select = $s_data['branch_id']; else $branch_id_select = 0; echo load_select('branches', $branch_id_select, array('status' => '1', 'course_id' => $course_id_select)); ?>
        </select>
        <label for="semister_id">Semester:* </label>
        <select id="semister_id" name="semister_id" class="text required" title="Please select a Semester">
            <option value="">Select</option>
            <?php if (isset($s_data['semister_id'])) $semister_id_select = $s_data['semister_id']; else $semister_id_select = 0; echo load_select('semisters', $semister_id_select, array('status' => '1', 'branch_id' => $branch_id_select)); ?>
        </select>
        <label for="section_id">Sections:* </label>
        <select id="section_id" name="section_id" class="text required" title="Please select a Section">
            <option value="">Select</option>
            <?php if (isset($s_data['section_id'])) $section_id_select = $s_data['section_id']; else $section_id_select = 0; echo load_select_section('sections', $section_id_select, array('semister_id' => $semister_id_select)); ?>
        </select>
        
        
        
        
        <label for="admission_type">Admission Type: </label>
        <select name="admission_type_id" id="admission_type_id" class="text required">
            <option value="">Select</option>
            <option value="1">Management</option>
            <option value="2">Counseling</option>
        </select>
        <label for="scholar">Scholar ship: </label>
        <select name="scholarship" id="scholarship" class="text">
            <option value="">Select</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="sex">Sex: </label>
        <select name="sex" id="sex" class="text">
            <option value="">Select</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
        </select>
        <label for="caste">Caste: </label>
        <select name="caste_id" id="caste_id" class="text">
            <option value="">Select</option>
            <option value="1">SC</option>
            <option value="2">BC</option>
            <option value="3">OC</option>
            <option value="4">ST</option>
                            
        </select>
        <label for="status">Active/Inactive: </label>
        <select name="status" id="status" class="text">
            <option value="1">Active</option>
            <option value="0">In Active</option>
        </select>
        <input type="submit" value="Export to Excel" class="button black m_l_10"/>
    </form>
</div>

<div id="users_content_wrap">
    <input type="button" value="+ Add user" id="add_user_btn" class="send m_t_b_10 button green"/>
 
    <div class="jqgrid_wrap">
        <table id="grid_table"></table>
        <div id="grid_pager"></div>
    </div>

    <script type="text/javascript" rel="javascript">
        users_grid();
    </script>
</div>

