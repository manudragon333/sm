<div id="filter_wrap" class="filter_panel">
    <form method="post" action="export_users_grid">
        <input type="hidden" name="export" value="export" />
        <input type="hidden" name="rows" value="100000" />
        <input type="hidden" name="page" value="1" />
        <input type="hidden" name="sidx" value="username" />
        <input type="hidden" name="sord" value="desc" />
       
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
         <label> Status:</label>
		<select id="sms_status" name="sms_status" class="text" title="Please select a Status">
		<option value="">All</option>
		<option value="Sent">Sent</option>
		<option value="Failed">Failed</option>
		<option value="Modaration">Modaration</option>		       
		</select>
		 <label> Religion:</label>
		<select id="religion" name="religion" class="text" title="Please select a Religion">
		<option value="">All</option>
		<option value="Hindu">Hindu</option>
		<option value="Muslim">Muslim</option>
		<option value="Christian">Christian</option>
		<option value="Others">Others</option>           
		</select>
		<button id="send_selected_sms_ids"">Send Selected</button>
    </form>
</div>
<div id="sms_edit_popup_confirm" style='display:none;'  >
  <textarea id='sms_edit_popup' cols='35' style="height: 170px;"></textarea>
</div>

<div id="sucess_sms_popup_confirm" style='display:none;' >
  Sucessfullly Sent..
</div>

<div id="users_content_wrap">
 
    <div class="jqgrid_wrap">
        <table id="grid_table"></table>
        <div id="grid_pager"></div>
    </div>

    <script type="text/javascript" rel="javascript">
        sms_users_grid();
    </script>
</div>

