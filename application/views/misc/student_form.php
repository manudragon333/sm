<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by http://www.MyCollege.org
-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>MyCollege.org</title>
        <?php $this->load->view('common/links'); ?>
    </head>
    <body>
        <div class="main">

            <div class="header">
                <div class="header_resize">
                    <div class="logo">
                        <h1><a href="javascript:void(0)"></a><small>My College</small></h1>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                    <div class="clr"></div>
                </div>
            </div>

            <div class="clr"></div>
            <div id="system_notification" class="header_resize"></div>
            <div class="clr"></div>
            <div class="content">
                <div class="content_resize">
                    <div class="mainbar">
                        <div class="article" id="main_content">


                            
<?php // print_r($student_details);
?>
<div class="clr"></div>
<br/>
<form id="appl_form" action="/student_registration/save_student">
    <input id="rel" name="rel" type="hidden" class="text" value="general"/>
    <input id="id" name="id" type="hidden" class="text" value="<?php if (isset($user_details[0]->id)) echo $user_details[0]->id; ?>"/>
    <input id="student_rec_id" type="hidden" name="student_rec_id" class="text" value="<?php if (isset($student_details[0]->id)) echo $student_details[0]->id; ?>"/>
<ol style="border:0px solid #ccc; ">
    <li>
        <label for="name">Name of the Student:*</label>
        <input id="name" name="name" class="required text" value="<?php if (isset($student_details[0]->name))
    echo $student_details[0]->name; ?>"/>
    </li>
    <li>
        <label for="fathers_name">Father Name:*</label>
        <input id="fathers_name" name="fathers_name" class="required text" value="<?php if (isset($student_details[0]->fathers_name))
                   echo $student_details[0]->fathers_name; ?>"/>
    </li>
    <li>
        <label for="students_number">Student Number:*</label>
        <input id="students_number" name="students_number" class="required text" value="<?php if (isset($student_details[0]->students_number))
                   echo $student_details[0]->students_number; ?>"/>
    </li>
    <li>
        <label for="sex">Sex:*</label>
        <input type="radio" name="sex" class="required " value="1" <?php if (isset($student_details[0]->sex) && $student_details[0]->sex=='1') echo 'checked="checked"'; ?>/> Male
        <input type="radio" name="sex" class="required " value="2" <?php if (isset($student_details[0]->sex) && $student_details[0]->sex=='2') echo 'checked="checked"'; ?>/> Female
    </li>
    <li>
        <label for="dob">Date of Birth:*</label>
        <input id="dob" name="dob" class="required text apply_datepicker" readonly="readonly" value="<?php if (isset($student_details[0]->dob))
                   echo dateFormat($student_details[0]->dob); ?>"/>
    </li>
    <li>
        <label for="doj">Date of Join:*</label>
        <input id="doj" name="doj" class="required text apply_datepicker" readonly="readonly" value="<?php if (isset($student_details[0]->doj))
                   echo dateFormat($student_details[0]->doj); ?>"/>
    </li>
    <li>
        <label for="regulation_id">Regulation:*</label>
        <select name='regulation_id' id='regulation_id' class="required text">
         <?php
            $regulation_id_selected=(isset($student_details[0]->regulation_id))?$student_details[0]->regulation_id:0 ;
            echo selectBox('Select','regulations','id,name','status="1"',$regulation_id_selected);
         ?>
        </select>
    </li>
    <li>
        <label for="college_id">College:*</label>
        <select id="college_id" name="college_id" class="required text">
            <option value="">Select</option>
            <?php $selected_college_id=(isset($student_details[0]->college_id))?$student_details[0]->college_id:0 ;echo load_select('colleges',$selected_college_id);?>
        </select>
<!--        <input id="course_id" name="course_id" class="text" value="<?php if (isset($student_details[0]->course_id))
                   echo $student_details[0]->course_id; ?>"/>-->
    </li>
    <li>
        <label for="course_id">Course:*</label>
        <select id="course_id" name="course_id" class="required text">
            <option value="">Select</option>
            <?php $selected=(isset($student_details[0]->course_id))?$student_details[0]->course_id:0 ;echo load_select('courses',$selected);?>
        </select>
<!--        <input id="course_id" name="course_id" class="text" value="<?php if (isset($student_details[0]->course_id))
                   echo $student_details[0]->course_id; ?>"/>-->
    </li>
    <li>
        <label for="branch_id">Branch:*</label>
        <select id="branch_id" name="branch_id" class="required text">
            <option value="">Select</option>
            <?php $selected=(isset($student_details[0]->branch_id))?$student_details[0]->branch_id:0 ;echo load_select('branches',$selected);?>
        </select>
<!--        <input id="branch_id" name="branch_id" class="text" value="<?php if (isset($student_details[0]->branch_id))
                   echo $student_details[0]->branch_id; ?>"/>-->
    </li>
<!--    <li>
        <label for="degree">Degree:*</label>
        <input id="degree" name="degree" class="text " readonly="readonly" value="<?php if (isset($student_details[0]->degree))
                   echo $student_details[0]->degree; ?>"/>
    </li>-->
    <li>
        <label for="sem_id">Present Year/Sem:*</label>
        <select name='sem_id' id='sem_id' class="required text">
         <?php
            $sem_selected=(isset($student_details[0]->sem_id))?$student_details[0]->sem_id:0 ;
            echo selectBox('Select','semisters','id,name','status="1"',$sem_selected);
         ?>
        </select>
    </li>
    <li>
        <label for="completing_year">Estimated Year of Completion:*</label>
        <select id="completing_year" name="completing_year" class="required text">
            <option value="">Select</option>
            <?php $selected=(isset($student_details[0]->completing_year))?$student_details[0]->completing_year:0 ;echo year_select($selected);?>
        </select>
<!--        <input id="completing_year" name="completing_year" class="text apply_datepickerx" readonly="readonly" value="<?php if (isset($student_details[0]->completing_year))
                   echo $student_details[0]->completing_year; ?>"/>-->
    </li>
    <li>
        <label for="fee_details">Fee Details:*</label>
<!--        <input id="fee_details" name="fee_details" class="text" value="<?php if (isset($student_details[0]->fee_details))
                   echo $student_details[0]->fee_details; ?>"/>-->
                   <span style="padding:5px; padding-left: 0;" class="fl">
                   <table class="sample table_view">
                        <tr>
                            <th>Year</th>
                            <th>1<sup>st</sup>Year</th>
                            <th>2<sup>nd</sup>Year</th>
                            <th>3<sup>rd</sup>Year</th>
                            <th>4<sup>th</sup>Year</th>
                        </tr>
                        <tr>
                            <th>Fee Status</th>
                            <td><?php if(isset($student_details[0]->fee1))echo $student_details[0]->fee1; ?></td>
                            <td><?php if(isset($student_details[0]->fee2))echo $student_details[0]->fee2; ?></td>
                            <td><?php if(isset($student_details[0]->fee3))echo $student_details[0]->fee3; ?></td>
                            <td><?php if(isset($student_details[0]->fee4))echo $student_details[0]->fee4; ?></td>
                        </tr>
                    </table>
                   </span>
    </li>
    <li>
        <label for="address">Mailing Address:*</label>
        <textarea id="address" name="address" rows="8" cols="50"><?php if (isset($student_details[0]->address))
                   echo $student_details[0]->address; ?></textarea>
   </li>
   <li>
       <label for="mobile">Mobile Number:*</label>
       <input id="mobile" name="mobile" class="required text" value="<?php if (isset($student_details[0]->mobile))
               echo $student_details[0]->mobile; ?>"/>
    </li>
    <li>
        <label for="email">Email:*</label>
        <input id="email" name="email" class="required email text" value="<?php if (isset($student_details[0]->email))
                   echo $student_details[0]->email; ?>"/>
    </li>
    <li>
        <label for="admission_type_id">Admission Type:*</label>
        <select name='admission_type_id' id='admission_type_id' class="required text">
         <?php
            $admission_type_id_selected=(isset($student_details[0]->admission_type_id))?$student_details[0]->admission_type_id:0 ;
            echo selectBox('Select','admission_types','id,name','status="1"',$admission_type_id_selected);
         ?>
        </select>
    </li>
    <li>
        <label for="caste_id">Caste:*</label>
        <select name='caste_id' id='caste_id' class="required text">
         <?php
            $caste_id_selected=(isset($student_details[0]->caste_id))?$student_details[0]->caste_id:0 ;
            echo selectBox('Select','castes','id,name','status="1"',$caste_id_selected);
         ?>
        </select>
    </li>
        <li>
           <label for="scholarship">Scholarship:*</label>
           <select name='scholarship' id='scholarship' class="required text">
               <option value="">Select</option>
               <option value="1">Yes</option>
               <option value="0">No</option>
           </select>
        </li>
        <div class="clr"></div>
</ol>
<br/>
<ol style="border:1px solid #ccc;">
    <li>
        <label for="username"><h3>Login Info:</h3></label>
    </li>
    <li>
        <label for="username">Username:*</label>
        <input id="username" name="username" class="required text" value="<?php if (isset($user_details[0]->username))
                   echo $user_details[0]->username; ?>"/>
    </li>
    <li>
        <label for="password">Password:*</label>
        <input id="password" name="password" class="required text" value="<?php if (isset($user_details[0]->password))
                   echo $user_details[0]->password; ?>" type="password"/>
    </li>
<!--    <li>
        <label for="email">Email:*</label>
        <input id="email" name="email" class="text" value="<?php if (isset($user_details[0]->email))
                   echo $user_details[0]->email; ?>"/>
    </li>-->
    <div class="clr"></div>
</ol>
<br/>
<ol>
    <li>
        <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save"/>
<!--        <input type="button" name="imageField" id="imageField" class="send button" value="Back" onclick="javascript:window.location.reload();"/>-->
        <div class="clr"></div>
    </li>
</ol>
</form>
<script type="text/javascript">
    postGradIDs=[];
    $(function(){

        if($('.apply_datepicker').length>0){
            $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
        }

        $('select[name=college_id]').live('change',function(){
           if($('select[name=course_id]').length>0){
            $.post(site_url+'/student_registration/getCollegeCourses/'+$('select[name=college_id]').val(),function(dataR){
                $('select[name=course_id]').html(dataR);
            })
           }
        });
        $('select[name=course_id]').live('change',function(){
           if($('select[name=branch_id]').length>0){
            $.post(site_url+'/student_registration/getCollegeBranches/'+$('select[name=college_id]').val(),'course_id='+$('select[name=course_id]').val(),function(dataR){
                $('select[name=branch_id]').html(dataR);
            })
           }
        });
        $('select[name=branch_id]').live('change',function(){
           if($('select[name=sem_id]').length>0){
            $.post(site_url+'/student_registration/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
                $('select[name=sem_id]').html(dataR);
            })
           }
        });

    })
</script>


 </div>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>
            <!-- Footer -->
            <div class="footer">
                <p class="lr">&nbsp;<a href="#"></a>.</p>
                <p class="lf">Powered By<a href="" class="footer_highlight">MyCollege</a>.org</p>
                <div class="clr"></div>
            </div>
        </div>
    </body>
</html>
