<?php
if($this->session->userdata('preview_id_card'))
    $s_data=$this->session->userdata('preview_id_card');
else if($this->session->userdata('student_data')){
    $student_data=$this->session->userdata('student_data');
    $s_data=(array) $student_data[0];
    $s_data['stu_number']=$s_data['students_number'];
    $s_data['branch']=$s_data['branch_id'];
    $s_data['mobile_no']=$s_data['mobile'];
    $s_data['date_of_join']=dateFormat($s_data['doj'],'Y');
//    print_r($s_data);
}
?>

<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/students/preview_apply_idcard" suc_msg="ID Card Request Submited Successfully.">
    <input id="" name="rel" class="text" type="hidden" value="id_card"/>
    <ol>
        <li>
            <label for="name">Name of the Student:*</label>
            <input id="name" name="name" class="text" value="<?php if(isset($s_data['name'])) echo $s_data['name']; ?>"/>
        </li><li>
            <label for="stu_number">Student Number:*</label>
            <input id="stu_number" name="stu_number" class="text" value="<?php if(isset($s_data['stu_number'])) echo $s_data['stu_number']; ?>"/>
        </li><li>
            <label for="branch">Branch:*</label>
            <select id="branch" name="branch" class="text" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($s_data['branch'])) $branch_select=$s_data['branch']; else $branch_select=0;  echo load_select('branches',$branch_select); ?>
            </select>
            <input type="hidden" name="branch" class="" value="<?php echo $branch_select; ?>" />
<!--            <input id="branch" name="branch" class="text"/>-->
        </li><li>
            <label for="date_of_join">Year of Join:*</label>
            <select id="date_of_join" name="date_of_join" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['date_of_join'])) $year_select=$s_data['date_of_join']; else $year_select=0;  echo year_select($year_select,true); ?>
            </select>
<!--            <input id="date_of_join" name="date_of_join" class="text apply_datepicker" readonly="readonly"  value="<?php if(isset($s_data['date_of_join'])) echo $s_data['date_of_join']; ?>"/>-->
        </li><li>
            <label for="address">Address:*</label>
            <textarea name="address" id="address" rows="8" cols="50"><?php if(isset($s_data['address'])) echo $s_data['address']; ?></textarea>
<!--            <input id="address" name="address" class="text"/>-->
        </li><li>
            <label for="mobile_no">Mobile No.:*</label>
            <input id="mobile_no" name="mobile_no" class="text" value="<?php if(isset($s_data['mobile_no'])) echo $s_data['mobile_no']; ?>"/>
        </li>
        <li>
            <label for="website">Upload the Photo:*</label>
<!--            <input type="file" name="photo" size="100" class="" id="id_card_upload"/>-->
            <input name="photo" class="myfile" value="" type="hidden" id="id_card_upload"/>
            <input name="MAX_FILE_SIZE" value="10000" type="hidden" />
        </li>
        <li id="uploaded_image"></li>
        <li>
            <br/>
            <input type="button" name="imageField" class="upload button gblue j_gen_form_submit" value="Get the Id Card"/>
<!--            <input type="button" name="imageField" id="get_button" class="get button" value="Get the id card"style="margin-left: 126px;"/>-->
        </li>
    </ol>
</form>
