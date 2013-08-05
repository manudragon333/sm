<h2><span>Overall pass percentage of the College,Branch,Course individually.</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>

<form id="report_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>

        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College">
                <option value="">Select</option>
                <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text "  title="Please select Course">
                <option value="">Select</option>
                <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text "  title="Please select Branch">
                <option value="">Select</option>
                <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text " title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($s_data['semister_id'])) $semister_id_select=$s_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="academic_year_id">Academic year:* </label>
            <select id="academic_year_id" name="academic_year_id" class="text " title="Please select a Academic Year">
                <option value="">Select</option>
                <?php if(isset($s_data['academic_year_id'])) $academic_year_select=$s_data['academic_year_id']; else $academic_year_select=0; echo load_select('academic_years',$academic_year_select,array('status'=>'1')); ?>
            </select>
        </li>
        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text " title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($s_data['subject_id'])) $subject_id_select=$s_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','semister_id'=>$semister_id_select)); ?>
            </select>
        </li>

        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload button j_gen_form_submit" value="Submit"/>
        </li>

        <?php if(isset($students_data)){  ?>
        <li id="reports_li">
            <?php if(empty($students_data)){  ?>
            <h3>No students Found</h3>
            <?php }else{  ?>
                <table class="sample table_view" style="margin: 0 auto;">
                    <tr>
                        <th>Total Students</th>
                        <th>Passed Students</th>
                        <th>Pass Percentage</th>
                    </tr>
                    <?php
                        $totalStudents=$passed=0;
                        if(!empty($students_data))
                        foreach ($students_data as $key => $value) {
                            $totalStudents+=$value->number_of_students;
                            if($value->pass=='1'){
                                $passed+=$value->number_of_students;
                            }
                        }
                        $passPercentage=($passed/$totalStudents)*100;
                    ?>

                    <tr>
                        <td><?php echo $totalStudents;  ?></td>
                        <td><?php echo $passed;  ?></td>
                        <td><?php echo $passPercentage;  ?></td>
                    </tr>

                </table>
            <?php } ?>

        </li>
        <?php }  ?>

    </ol>
</form>



<script type="text/javascript">
    $(function(){
        $('#report_form').validate();

        $('#report_form select').change(function(){
            $('#report_li').html('');
        });



    });
</script>


