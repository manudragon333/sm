<h2><span>Search Student Exam Results</span></h2>
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
            <label for="search_student_number">Student Number:* </label>
            <input id="search_student_number" name="search_student_number" class="text" type="text" value="<?php if(isset($form_data['search_student_number'])) echo $form_data['search_student_number'];  ?>"/>
        </li>


        <?php if(isset($form_data['search_student_number']) && isset($form_data['college_id'])){  ?>
            
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($form_data['college_id'])) $college_id_select=$form_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
            <input id="college_id" name="college_id" class="hide" type="hidden" value="<?php echo $college_id_select;  ?>"/>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text "  title="Please select Course" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($form_data['course_id'])) $course_id_select=$form_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
            <input id="course_id" name="course_id" class="hide" type="hidden" value="<?php echo $course_id_select;  ?>"/>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text "  title="Please select Branch" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($form_data['branch_id'])) $branch_id_select=$form_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
            <input id="branch_id" name="branch_id" class="hide" type="hidden" value="<?php echo $branch_id_select;  ?>"/>
        </li>
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text " title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($form_data['semister_id'])) $semister_id_select=$form_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="section_id">Sections:* </label>
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($form_data['section_id'])) $section_id_select=$form_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
        </li>
        
        <?php }  ?>
<!--        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text " title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($form_data['subject_id'])) $subject_id_select=$form_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','semister_id'=>$semister_id_select)); ?>
            </select>
        </li>-->

        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload button j_gen_form_submit" value="Submit"/>
        </li>
        
    </ol>
</form>

<?php $this->load->view('exam/view_student_results_table'); ?>

<script type="text/javascript">
    $(function(){
        $('#report_form').validate();

        $('#report_form select').change(function(){
            $('#report_li').html('');
        });


        $('select[name=branch_id]').live('change',function(){
           if($('select[name=semister_id]').length>0){
            $.post(site_url+'/students/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
                $('select[name=semister_id]').html(dataR);
            })
           }
           if($('select[name=sem_id]').length>0){
            $.post(site_url+'/students/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
                $('select[name=sem_id]').html(dataR);
            })
           }
        });
        $('select[name=semister_id]').live('change',function(){
           if($(this).hasClass('getStaffSubjects') && $('select[name=subject_id]').length>0){
                $.post(site_url+'/staff/getStaffSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
                    $('select[name=subject_id]').html(dataR);
                });
           }else  if($('select[name=subject_id]').length>0){
            $.post(site_url+'/students/getCollegeSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
                $('select[name=subject_id]').html(dataR);
            })
           }
        });
        $('select[name=sem_id]').live('change',function(){
           if($('select[name=subject_id]').length>0){
            $.post(site_url+'/students/getCollegeSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=sem_id]').val(),function(dataR){
                $('select[name=subject_id]').html(dataR);
            })
           }
        });


    });
</script>


