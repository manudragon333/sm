<h2><span>Send Student Marks</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>

<form id="send_student_marks_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College">
                <option value="">Select</option>
                <?php if(isset($form_data['college_id'])) $college_id_select=$form_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text required"  title="Please select Course">
                <option value="">Select</option>
                <?php if(isset($form_data['course_id'])) $course_id_select=$form_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text required"  title="Please select Branch">
                <option value="">Select</option>
                <?php if(isset($form_data['branch_id'])) $branch_id_select=$form_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text getStaffSubjects required" title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($form_data['semister_id'])) $semister_id_select=$form_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
<!--        <li>
            <label for="section_id">Sections:* </label>
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($form_data['section_id'])) $section_id_select=$form_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
        </li>-->
<!--        <li>
            <label for="batch_id">Batch No:* </label>
            <select id="batch_id" name="batch_id" class="text required" title="Please select a Batch">
                <option value="">Select</option>
                <?php if(isset($form_data['batch_id'])) $batch_id_select=$form_data['batch_id']; else $batch_id_select=0; echo load_select('batch_nos',$batch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>-->
        
        <li>
            <label for="marks_types_id">Internals:* </label>
            <?php if(!empty($marks_types)){ ?>
                <?php foreach ($marks_types as $key => $value) { if($value->id!=1){ /*Not Displaying External*/?>
            <label>
                <input type="checkbox" value="<?php echo $value->id-1; /* SOMEONE HAD CODED THE INTERNAL IDS Instead taking from DB while assigning/saving in DB SO ADJUSTED ID BY -1 */ ?>" name="marks_types_ids[]" class="required " title="Please select a Internal" <?php if(!empty($form_data['marks_types_ids']) && in_array($value->id-1, $form_data['marks_types_ids'])){ echo 'checked="checked"';  } ?>/> <?php echo $value->name; ?>
            </label>
                <?php }} ?>
            <?php } ?>
        </li>
        <li id="internal_error_li">
        </li>
        <li>
            <br/>
        </li>

        
        
        <?php if(isset($subjects_data) && !empty($subjects_data)){
            /*
             * Show the Subjects List.
             */
            ?>
            <li id="student_marks_li">
                <br/>
                <table class="sample table_view" >
                    <tr>
                        <th> &nbsp; </th>
                        <th>Subject Name</th>
                        <th>Status</th>
                        <th>Send Message</th>
                    </tr>
                    <?php
                    foreach($subjects_data as $k=>$v){
                    ?>
                    <tr>
                        <td>
                            <?php if(!empty($v->posted_status)){ ?>
                            <input type="checkbox" value="<?php echo $v->id; ?>" name="subject_ids[]" class="required " title="Please select a Subject" <?php if(!empty($form_data['subject_ids']) && in_array($v->id, $form_data['subject_ids'])){ echo 'checked="checked"';  } ?>/>
                            <?php } ?>
                        </td>
                        <td><?php echo $v->name;  ?></td>
                        <td><?php echo (empty($v->posted_status)?'Not Posted':'Posted');  ?></td>
                        <td>
                            <?php if(empty($v->posted_status)){ ?>
                            <a href="javascript:void(0);" class="send_teacher_sms" onclick="javascript:send_teacher_sms(<?php echo $v->id; ?>);" >Send Message</a>
                            <?php }else{ ?>
                            &nbsp;
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </li>
        <?php 
        }
        ?>
        <?php if(isset($subjects_data) && empty($subjects_data)){ ?>
            <li>
                <br/>
                <b>No Data Found.</b>
            </li>
        <?php }  ?>
        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload button j_gen_form_submit" value="Submit"/>
        </li>
    </ol>
</form>
<style type="text/css">
/*    table.sample td {
        padding: 2px;
    }
    table.sample td input{
        width: 50px;
        padding: 3px 1px;
    }*/

    #notofication_wrapper{
        display:block !important;
        height:100% !important;
    }
</style>

<script type="text/javascript">
    $(function(){
        $('#send_student_marks_form').validate({
            errorPlacement: function(error, element) {
                if(element.attr('name')=='marks_types_ids[]')
                    error.appendTo( $('#internal_error_li') );
                else if(element.attr('name')=='subject_ids[]')
                    error.appendTo( $('#student_marks_li') );
                else
                    error.appendTo( element.parent() )
            }
        });
    });
    
    function send_teacher_sms(id){
        dataP='subject_id='+id+' ';
        $.ajax({
            url:site_url+'/staff/send_teacher_sms',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                alert('SMS sent to teacher');
            }
        });
    }
</script>