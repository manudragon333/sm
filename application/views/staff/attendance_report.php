<h2><span>Attendance Report</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="" method="post">
    <ol>
        <li>
            <label for="college_id">College*:</label>
            <select id="college_id" name="college_id" class="text required" title="Please select College">
                <option value="">Select</option>
                <?php if (isset($form_data['college_id'])) $college_id_select = $form_data['college_id']; else $college_id_select = 0; echo load_select('colleges', $college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:</label>
            <select id="course_id" name="course_id" class="text "  title="Please select Course">
                <option value="">Select</option>
                <?php if (isset($form_data['course_id'])) $course_id_select = $form_data['course_id']; else $course_id_select = 0; echo load_select('courses', $course_id_select, array('status' => '1', 'college_id' => $college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:</label>
            <select id="branch_id" name="branch_id" class="text "  title="Please select Branch">
                <option value="">Select</option>
                <?php if (isset($form_data['branch_id'])) $branch_id_select = $form_data['branch_id']; else $branch_id_select = 0; echo load_select('branches', $branch_id_select, array('status' => '1', 'course_id' => $course_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="semister_id">Year/Semester:</label>
            <select id="semister_id" name="semister_id" class="text " title="Please select a Year/Semester">
                <option value="">Select</option>
                <?php if (isset($form_data['semister_id'])) $semister_id_select = $form_data['semister_id']; else $semister_id_select = 0; echo load_select('semisters', $semister_id_select, array('status' => '1', 'branch_id' => $branch_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="semister_id">Sections:</label>
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if (isset($form_data['section_id'])) $section_id_select = $form_data['section_id']; else $section_id_select = 0; echo load_select_section('sections', $section_id_select, array('semister_id' => $semister_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="subject_id">Subject:</label>
            <select id="subject_id" name="subject_id" class="text " title="Please select a Subject">
                <option value="">Select</option>
                <?php if (isset($form_data['subject_id'])) $subject_id_select = $form_data['subject_id']; else $subject_id_select = 0; echo load_select('subjects', $subject_id_select, array('status' => '1', 'semister_id' => $semister_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="academic_year_id">Academic year:</label>
            <select id="academic_year_id" name="academic_year_id" class="text " title="Please select a Academic Year">
                <option value="">Select</option>
                <?php if (isset($form_data['academic_year_id'])) $academic_year_select = $form_data['academic_year_id']; else $academic_year_select = 0; echo load_select('academic_years', $academic_year_select, array('status' => '1')); ?>
            </select>
        </li>
        <li>
            <label for="month">Month:</label>
            <select id="month" name="month" class="text " title="Please select a Month">
                <option value="">Select</option>
                <?php if (isset($form_data['month'])) $month_select = $form_data['month']; else $month_select = 0; ?>
                <?php for ($i = 1; $i <= 12; $i++){  $mon = dateFormat( '2013-'.($i).'-1',"F"); ?>
                <option value="<?php echo $i; ?>" <?php if($i == $month_select){ echo 'selected'; } ?> ><?php echo $mon; ?></option>
                <?php } ?>
            </select>
        </li>
        <li>
            <label for="percentage">Percentage:</label>
            <select id="percentage" name="percentage" class="text " title="Please select a Percentage">
                <option value="">Select</option>
                <?php if (isset($form_data['percentage'])) $percentage_select = $form_data['percentage']; else $percentage_select = 0; ?>
                <?php for ($i = 1; $i < 10; $i++){ $from_p=$i*10; $to_p=$from_p+10; ?>
                <option value="<?php echo $from_p; ?>" <?php if($from_p == $percentage_select){ echo 'selected'; } ?> ><?php echo $from_p,'% - ',$to_p,'%'; ?></option>
                <?php } ?>
            </select>
        </li>
        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload button " value="Submit"/>
        </li>
        
    </ol>
</form>
<?php if(!empty($student_attendance)){ ?>
<div id="attendance_report">
    <h3>Attendance Report:</h3>
    <table class="sample">
        <tr>
            <th colspan="2" style="text-align: left;">
                <?php if(!empty($form_data['college_id'])){ ?>
                College name: <?php echo generalId('name', 'colleges', 'id', $form_data['college_id']); ?>
                <?php } ?>
                <?php if(!empty($form_data['course_id'])){ ?>
                <br/>Course: <?php echo generalId('name', 'courses', 'id', $form_data['course_id']); ?>
                <?php } ?>
                <?php if(!empty($form_data['branch_id'])){ ?>
                <br/>Branch: <?php echo generalId('name', 'branches', 'id', $form_data['branch_id']); ?>
                <?php } ?>
                <?php if(!empty($form_data['semister_id'])){ ?>
                <br/>Semester: <?php echo generalId('name', 'semisters', 'id', $form_data['semister_id']); ?>
                <?php } ?>
                <?php if(!empty($form_data['section_id'])){ ?>
                <br/>Section: <?php echo generalId('section', 'sections', 'id', $form_data['section_id']); ?>
                <?php } ?>
                <?php if(!empty($form_data['subject_id'])){ ?>
                <br/>Subject: <?php echo generalId('name', 'subjects', 'id', $form_data['subject_id']); ?>
                <?php } ?>
                <?php if(!empty($form_data['academic_year_id'])){ ?>
                <br/>Academic years: <?php echo generalId('name', 'academic_years', 'id', $form_data['academic_year_id']); ?>
                <?php } ?>
                <?php if(!empty($form_data['month'])){ ?>
                <br/>Month: <?php echo dateFormat( '2013-'.$form_data['month'].'-1',"F"); ?>
                <?php } ?>
                <?php if(!empty($form_data['percentage'])){ ?>
                <br/>Percentage: <?php echo $form_data['percentage'],'% - ',$form_data['percentage']+10,'%'; ?>
                <?php } ?>
            </th>
        </tr>
        <tr>
            <th>Student Number</th>
            <th>Percentage</th>
        </tr>
        <?php $studentCount=0; foreach ($student_attendance as $key => $value) { if(!empty($form_data['percentage']) && $form_data['percentage']<=$value['attendance_percentage'] && $value['attendance_percentage']<=($form_data['percentage']+10)){ ?>
        <tr>
            <td><?php echo $value['students_number']; ?></td>
            <td><?php echo $value['attendance_percentage']; ?> %</td>
        </tr>
        <?php $studentCount++; } else if(empty($form_data['percentage'])){ ?>
        <tr>
            <td><?php echo $value['students_number']; ?></td>
            <td><?php echo $value['attendance_percentage']; ?> %</td>
        </tr>
        <?php $studentCount++; } } ?>
        
    </table>
    <i>Total Students: <?php echo $studentCount; ?></i>
    <?php // echo '<pre>'; print_r($student_attendance); echo '</pre>'; ?>
    
</div>
<div style="padding: 5px; margin-top: 20px;">
    <form id="appl_form" action="" method="post">
    <input type="hidden" value="<?php echo $form_data['college_id']; ?>" name="college_id" />
    <input type="hidden" value="<?php echo $form_data['course_id']; ?>" name="course_id" />
    <input type="hidden" value="<?php echo $form_data['branch_id']; ?>" name="branch_id" />
    <input type="hidden" value="<?php echo $form_data['semister_id']; ?>" name="semister_id" />
    <input type="hidden" value="<?php echo $form_data['section_id']; ?>" name="section_id" />
    <input type="hidden" value="<?php echo $form_data['subject_id']; ?>" name="subject_id" />
    <input type="hidden" value="<?php echo $form_data['academic_year_id']; ?>" name="academic_year_id" />
    <input type="hidden" value="<?php echo $form_data['month']; ?>" name="month" />
    <input type="hidden" value="<?php echo $form_data['percentage']; ?>" name="percentage" />
    <input type="hidden" name="export_to_excel" value="true" />
    <input type="submit" name="imageField" id="imageField" class="upload button " value="Export to Excel"/>
    </form>
    <!--<a href="#" onclick="javascript:exportExcel($('#attendance_report table').html());">Excel</a>-->
</div>

<?php } else if(isset($student_attendance)) { echo showBigInfo('No Records found for the above Selection.'); }?>

    
    
    
<script type="text/javascript">
    $(function(){
        $('#appl_form').validate();
    });
    function exportExcel(html) {
        window.open('data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(
        '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"><meta name=ProgId content=Excel.Sheet><style>body {font-family:Arial} .ean {mso-number-format:0000000000000;}</style></head><body><table>'+html.replace(/[♫^]/gi,'')+'</table></body></html>'));
    }
</script>
<style type="text/css">
    .sample{
        min-width: 500px;
    }
    #attendance_report{
        margin-top: 40px;
        padding: 10px;
        border: 1px solid #333;
        box-shadow: 0px 0px 8px #4c4c4c inset;
        border-radius: 8px;
    }
</style>