<form id="appl_form" action="admin/update_user_account" enctype="multipart/form-data" method="post" class="m_t_10">
    <input id="rel" name="rel" type="hidden" class="text" value="user_form" />
    <input id="id" name="id" type="hidden" class="text" value="<?php if (isset($user_details[0]->id)) echo $user_details[0]->id; ?>"/>
    <input id="users_type_id" type="hidden"  name="users_type_id" class="text" value="<?php if (isset($user_details[0]->users_type_id)) echo $user_details[0]->users_type_id; ?>"/>
    <input id="student_rec_id" type="hidden" name="student_rec_id" class="text" value="<?php if (isset($student_details[0]->id)) echo $student_details[0]->id; ?>"/>
<ol>
    <li>
        <label for="name">Name of the Student:*</label>
        <input id="name" name="name" class="text" value="<?php if (isset($student_details[0]->name))
    echo $student_details[0]->name; ?>"/>
    </li>
    <li>
        <label for="fathers_name">Father Name:*</label>
        <input id="fathers_name" name="fathers_name" class="text" value="<?php if (isset($student_details[0]->fathers_name))
                   echo $student_details[0]->fathers_name; ?>"/>
    </li>
    <li>
        <label for="students_number">Student Number:*</label>
        <input id="students_number" name="students_number" class="text" value="<?php if (isset($student_details[0]->students_number))
                   echo $student_details[0]->students_number; ?>"/>
    </li>
    <li>
        <label for="sex">Sex:*</label>
        <input type="radio" name="sex" class="" value="1" <?php if (isset($student_details[0]->sex) && $student_details[0]->sex=='1') echo 'checked="checked"'; ?>/> Male
        <input type="radio" name="sex" class="" value="2" <?php if (isset($student_details[0]->sex) && $student_details[0]->sex=='2') echo 'checked="checked"'; ?>/> Female
    </li>
    <li>
        <label for="dob">Date of Birth:*</label>
        <input id="dob" name="dob" class="text apply_datepicker" readonly="readonly" value="<?php if (isset($student_details[0]->dob))
                   echo dateFormat($student_details[0]->dob); ?>"/>
    </li>
    <li>
        <label for="doj">Date of Join:*</label>
        <input id="doj" name="doj" class="text apply_datepicker" readonly="readonly" value="<?php if (isset($student_details[0]->doj))
                   echo dateFormat($student_details[0]->doj); ?>"/>
    </li>
    <li>
                    <label for="admission_type_id">Admission Type :* </label>
                    <select id="admission_type_id" name="admission_type_id" class="text">
                        <option value="">Select</option>
                        <?php if(isset($student_details[0]->admission_type_id)) $admission_type_id_select=$student_details[0]->admission_type_id; else $admission_type_id_select=0; echo load_select('admission_types',$admission_type_id_select); ?>
                    </select>
                </li>
                
                <li>
                    <label for="caste_id">Caste :* </label>
                    <select id="caste_id" name="caste_id" class="text">
                        <option value="">Select</option>
                        <?php if(isset($student_details[0]->caste_id)) $caste_id_select=$student_details[0]->caste_id; else $caste_id_select=0; echo load_select('castes',$caste_id_select); ?>
                    </select>
                </li>
                
                <li>
                    <label for="scholarship">Scholarship :* </label>
                    <input type="checkbox" name="scholarship" value="1"  <?php if(isset($student_details[0]->scholarship)){ ?> checked="yes" <?php } ?>>

                </li>
                
                
                <li>
                    <label for="college_id">College:* </label>
                    <select id="college_id" name="college_id" class="text">
                        <option value="">Select</option>
                        <?php if(isset($student_details[0]->college_id)) $college_id_select=$student_details[0]->college_id; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
                    </select>
                </li>
                <li>
                    <label for="course_id">Course:* </label>
                    <select id="course_id" name="course_id" class="text">
<!--                        <option value="">Select</option>-->
                        <?php if(isset($student_details[0]->course_id)) $course_id_select=$student_details[0]->course_id; else $course_id_select=0; // echo load_select('courses',$course_id_select); ?>
                        <?php echo selectBox('Select','courses','id,name',' college_id="'.$college_id_select.'" ',$course_id_select);  ?>
                    </select>
                </li>
                <li>
                    <label for="branch_id">Branch:* </label>
                    <select id="branch_id" name="branch_id" class="text required">
<!--                        <option value="">Select</option>-->
                        <?php if(isset($student_details[0]->branch_id)) $branch_id_select=$student_details[0]->branch_id; else $branch_id_select=0; // echo load_select('branches',$branch_id_select); ?>
                        <?php echo selectBox('Select','branches','id,name',' course_id="'.$course_id_select.'" ',$branch_id_select);  ?>
                    </select>
                </li>
                
    
<!--    <li>
        <label for="degree">Degree:*</label>
        <input id="degree" name="degree" class="text " readonly="readonly" value="<?php if (isset($student_details[0]->degree))
                   echo $student_details[0]->degree; ?>"/>
    </li>-->
    <li style="display:none;">
        <label for="present_year">Present Year:*</label>
        <select id="present_yearXX" name="present_yearXX" class="text">
            <option value="">Select</option>
            <?php /// $selected=(isset($student_details[0]->present_year))?$student_details[0]->present_year:0 ;echo year_select($selected);?>
            <?php
            $selected=(isset($student_details[0]->present_year))?$student_details[0]->present_year:0 ;
            for($i=1;$i<=4;$i++){ ?>
                <option value="<?php echo $i; ?>" <?php if($i==$selected){ echo 'selected="selected"'; } ?>><?php echo $i; ?></option>
            <?php } ?>
        </select>
<!--        <input id="present_year" name="present_year" class="text apply_datepickerx" readonly="readonly" value="<?php if (isset($student_details[0]->present_year))
                   echo $student_details[0]->present_year; ?>"/>-->
    </li>
    <li>
        <label for="sem_id">Present Year/Sem:*</label>
        <select name='sem_id' id='sem_id' class="text">
         <?php
            $sem_selected=(isset($student_details[0]->sem_id))?$student_details[0]->sem_id:1 ;
            echo selectBox('Select','semisters','id,name',' branch_id="'.$branch_id_select.'" and status="1"',$sem_selected);
         ?>
        </select>
    </li>
    <li>
        <label for="semister_id">Sections:* </label>
        <select id="section_id" name="section_id" class="text" title="Please select a Section">
            <option value="">Select</option>
            <?php
                if(isset($student_details[0]->section_id)) $section_id_select=$student_details[0]->section_id; else $section_id_select=0;
                echo load_select_section('sections',$section_id_select,array('semister_id'=>$sem_selected));
            ?>
        </select>
    </li>
    <li>
        <label for="completing_year">Estimated Year of Completion:*</label>
        <select id="completing_year" name="completing_year" class="text">
            <option value="">Select</option>
            <?php $selected=(isset($student_details[0]->completing_year))?$student_details[0]->completing_year:0 ;echo year_select($selected);?>
        </select>
<!--        <input id="completing_year" name="completing_year" class="text apply_datepickerx" readonly="readonly" value="<?php if (isset($student_details[0]->completing_year))
                   echo $student_details[0]->completing_year; ?>"/>-->
    </li>

    <li>
        <label for="address">Mailing Address:*</label>
        <textarea id="address" name="address" rows="8" cols="50"><?php if (isset($student_details[0]->address))
                   echo $student_details[0]->address; ?></textarea>
   </li>
   <li>
       <label for="mobile">Mobile Number:*</label>
       <input id="mobile" name="mobile" class="text" value="<?php if (isset($student_details[0]->mobile))
               echo $student_details[0]->mobile; ?>"/>
    </li>
	<li>
       <label for="mobile">Fathers Mobile Number:*</label>
       <input id="father_mobile" name="father_mobile" class="text" value="<?php if (isset($student_details[0]->father_mobile))
               echo $student_details[0]->father_mobile; ?>"/>
    </li>
    <li>
        <label for="email">Email:*</label>
        <input id="email" name="email" class="text" value="<?php if (isset($student_details[0]->email))
                   echo $student_details[0]->email; ?>"/>
    </li>
	 <li>
        <label for="schname">10th Class School Name:*</label>
        <input id="schname" name="schname" class="text" value="<?php if (isset($student_details[0]->schname))
                   echo $student_details[0]->schname; ?>"/>
    </li>
	 <li>
        <label for="icname">Intermediate College Name:*</label>
        <input id="icname" name="icname" class="text" value="<?php if (isset($student_details[0]->icname))
                   echo $student_details[0]->icname; ?>"/>
    </li>
	 <li>
        <label for="ugtc">UG TC:*</label>
        <input id="ugtc" name="ugtc" class="text" value="<?php if (isset($student_details[0]->ugtc))
                   echo $student_details[0]->ugtc; ?>"/>
    </li>
	 <li>
        <label for="ugsc">UG Study & Conduct:*</label>
        <input id="ugsc" name="ugsc" class="text" value="<?php if (isset($student_details[0]->ugsc))
                   echo $student_details[0]->ugsc; ?>"/>
    </li>
	<li>
        <label for="ugpc">UG Provisional Certificate:*</label>
        <input id="ugpc" name="ugpc" class="text" value="<?php if (isset($student_details[0]->ugpc))
                   echo $student_details[0]->ugpc; ?>"/>
    </li>
	<li>
        <label for="ugcmm">UG CMM Certificate:*</label>
        <input id="ugcmm" name="ugcmm" class="text" value="<?php if (isset($student_details[0]->ugcmm))
                   echo $student_details[0]->ugcmm; ?>"/>
    </li>
	<li>
        <label for="lac">Local Area Certificate:*</label>
        <input id="lac" name="lac" class="text" value="<?php if (isset($student_details[0]->lac))
                   echo $student_details[0]->lac; ?>"/>
    </li>
	<li>
        <label for="cnc">Community & Nativity Certificate:*</label>
        <input id="cnc" name="cnc" class="text" value="<?php if (isset($student_details[0]->cnc))
                   echo $student_details[0]->cnc; ?>"/>
    </li>
	
    <div class="clr"></div>
</ol>
<br/>
<ol>
    <li>
        <label for="username">Username:*</label>
        <input id="username" name="username" class="text" value="<?php if (isset($user_details[0]->username))
                   echo $user_details[0]->username; ?>"/>
    </li>
    <li>
        <label for="password">Password:*</label>
        <input id="password" name="password" class="text" value="<?php if (isset($user_details[0]->password))
                   echo $user_details[0]->password; ?>" type="password"/>
    </li>
<!--    <li>
        <label for="email">Email:*</label>
        <input id="email" name="email" class="text" value="<?php if (isset($user_details[0]->email))
                   echo $user_details[0]->email; ?>"/>
    </li>-->
    <div class="clr"></div>
</ol>
<ol>
    <li>
	<table><tr>
       <td> <img src="<?if (isset($student_details[0]->photo))
                   echo base_url().'/'.$student_details[0]->photo;?>" width="125px" height="150" alt="Photo"/> </td>
       <td> <img src="<?if (isset($student_details[0]->ssc))
                   echo base_url().'/'.$student_details[0]->ssc;?>" width="125px" height="150" alt="SSC"/></td>
       <td> <img src="<?if (isset($student_details[0]->inter))
                   echo base_url().'/'.$student_details[0]->inter;?>" width="125px" height="150" alt="INTER"/></td>
		<td> <img src="<?if (isset($student_details[0]->other))
                   echo base_url().'/'.$student_details[0]->other;?>" width="125px" height="150" alt="OTHER"/></td>
	   </tr><tr>
	   <td><input type="file" name="photo" id="photo" size="10"/></td>
	   <td><input type="file" name="ssc" id="ssc" size="10"/></td>
	   <td><input type="file" name="inter" id="inter"  size="10"/></td>
	   <td><input type="file" name="other" id="other" size="10"/></td>
	   </tr>
	   </table>
    </li>
	
    <!--<li>
        <label for="password">SSC Certificate:</label>
        <img src="http://mycollege.org.in/testserver/files/<?php //echo $user_details[0]->username; ?>/ssc.jpeg" width="150px" height="200px" /> 
    </li>

<li>
        <label for="password">inter Certificate:</label>
        <img src="http://mycollege.org.in/testserver/files/<?php //echo $user_details[0]->username; ?>/inter.jpeg" width="150px" height="200px" />
    </li>-->
    <!--    <li>
        <label for="email">Email:*</label>
        <input id="email" name="email" class="text" value="<?php //if (isset($user_details[0]->email))
                   //echo $user_details[0]->email; ?>"/>
    </li>-->
    <div class="clr"></div>
</ol>
<br/>
<ol>
    <li>
        <input type="submit" name="imageField" id="imageField" class=" button j_gen_form_submit gblue" value="Save"/>
        <input type="button" name="imageField" id="imageField" class=" button grey m_l_20 " value="Back" onclick="javascript:window.location.reload();"/>
        <div class="clr"></div>
    </li>
</ol>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#students_number').keyup(function(){
            var stunum=$('#students_number').val();
            $('#username').val(stunum)
        });
        if(<?php echo $student_details[0]->course_id; ?>==1)
        {
            
            $("#ugtc").attr("disabled", "disabled");
            $("#ugsc").attr("disabled", "disabled");
            $("#ugpc").attr("disabled", "disabled");
            $("#ugcmm").attr("disabled", "disabled");
        }
        else {
            $("#ugtc").removeAttr("disabled");
            $("#ugsc").removeAttr("disabled");
            $("#ugpc").removeAttr("disabled");
            $("#ugcmm").removeAttr("disabled");
            
        }
        
    });
    if($('.apply_datepicker').length>0){
        $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
    }
    $(function(){
       //For Sections
        $('select[name=sem_id]').live('change',function(){
           if($('select[name=section_id]').length>0){
            $.post(site_url+'/staff/getCollegeSections/'+$('select[name=college_id]').val(),'sem_id='+$('select[name=sem_id]').val(),function(dataR){
                $('select[name=section_id]').html(dataR);
            })
           }
        });
        
        $('select[name=semister_id]').live('change',function(){
           if($('select[name=section_id]').length>0){
            $.post(site_url+'/staff/getCollegeSections/'+$('select[name=college_id]').val(),'sem_id='+$('select[name=semister_id]').val(),function(dataR){
                $('select[name=section_id]').html(dataR);
            })
           }
        });
    });
</script>