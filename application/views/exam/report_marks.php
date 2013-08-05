<h2><span>List of the student who got more than 60% marks/less than 50%.</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>

<form id="report_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>
<!--        <li>
            <label for="branch_id">Branch:*</label>
            <select id="branch_id" name="branch_id" class="text">
                <option value="">Select</option>
                <?php echo load_select('branches');?>
            </select>
        </li>
        <li>
            <label for="sem_id">Year/Sem:*</label>
            <select name='sem_id' id='sem_id' class="text">
             <?php
                echo selectBox('Select','semisters','id,name','status="1"',0);
             ?>
            </select>
        </li>-->


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
<!--        <li>
            <label for="academic_year_id">Academic year:* </label>
            <select id="academic_year_id" name="academic_year_id" class="text " title="Please select a Academic Year">
                <option value="">Select</option>
                <?php if(isset($s_data['academic_year_id'])) $academic_year_select=$s_data['academic_year_id']; else $academic_year_select=0; echo load_select('academic_years',$academic_year_select,array('status'=>'1')); ?>
            </select>
        </li>-->
        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text " title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($s_data['subject_id'])) $subject_id_select=$s_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','semister_id'=>$semister_id_select)); ?>
            </select>
        </li>
        
        <li>
            <label for="option_1">Option:* </label>
            <?php  if(isset($s_data['option'])){ $option_select=$s_data['option']; }else{ $option_select=0; } ?>
            <label ><input id="option_1" type="radio" name="option" value="1" class="required" title="Please Select a Option" <?php if($option_select=='1'){ echo ' checked="checked" '; }  ?>/> More than 60% </label>
            <label ><input id="option_2" type="radio" name="option" value="2" class="required" title="Please Select a Option" <?php if($option_select=='2'){ echo ' checked="checked" '; }  ?>/> Less than 50% </label>
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
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Avg Marks</th>
                    <th>External Marks</th>
                    <th>Final Marks</th>
                </tr>
                <?php
                    $excelData=array(array(
                        'Student','Subject','Avg Marks','External Marks','Final Marks'
                    ));
                ?>
                <?php foreach ($students_data as $key => $value) { $excelDataRow=array(); ?>

                <tr>
                    <td><?php echo $value->students_number; $excelDataRow[]=$value->students_number;  ?></td>
                    <td><?php echo $value->subject; $excelDataRow[]=$value->subject; ?></td>
                    <td><?php echo $value->average_marks; $excelDataRow[]=$value->average_marks; ?></td>
                    <td><?php echo $value->external_marks; $excelDataRow[]=$value->external_marks; ?></td>
                    <td><?php echo $value->final_marks; $excelDataRow[]=$value->final_marks; ?></td>
                </tr>

                <?php   array_push($excelData, $excelDataRow);
                    }
                    $this->session->set_userdata('excelData',$excelData); ?>
            </table>

            <br/>
<!--            <p style="text-align:right;"><?php echo anchor('exam/downloadThisReport','<input type="button" class="button" value="Download Excel"/>');  ?></p>-->
            <p style="text-align:right;"><?php echo anchor('exam/report_marks/true/'.urlsafe_b64encode(serialize($s_data)),'<input type="button" class="button" value="Download Excel"/>');  ?></p>
            <?php }  ?>
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


