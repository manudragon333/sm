
<!--
    <input type="button" onclick="javascript:edit_course_management(0);" name="" id="imageField" class=" m_t_b_10 button green " value="+ Add Course " />
-->

<div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
</div>

<script type="text/javascript" rel="javascript">
    attendance_management_grid();
</script>

<br/>
<hr/>
<div>
    <h2 align="center"><span> Add Period management </span></h2>
    <div class="user_instructions">
        <div class="f_r f_b m_r_10">* required fields</div>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="clr"></div>
    <form action="<?php echo site_url('admin/staff_attendance');?>" id="appl_form2" method="post" >
        <input id="rel" name="rel"  type="hidden" value="submit"/>

        <ol>
            <li>
                <label for="staff_id">Select Teacher:*</label>
                <select name='staff_id' id='staff_id' class="text required" title="Please select the Teacher.">
                     <?php // echo selectBox('Select','staff_records','user_id,name','status="1"','0'); ?>
                    <option value="">Select</option>
                     <?php if(isset($teachersOptions) && !empty($teachersOptions)){
                        foreach ($teachersOptions as $key => $value) {
                          ?>
                        <option value="<?php echo $value['user_id'];  ?>"><?php echo $value['name'];  ?></option>
                     <?php 
                        }
                     }  ?>
                </select>
            </li>
            <li>
                <label for="cycle_id">Select Cycle:*</label>
                <select name='cycle_id' id='cycle_id' class="text required" title="Please select the Cycle.">
                     <?php echo selectBox('Select','period_cycles','id,name','status="1"','0'); ?>
                </select>
            </li>
            <li>
                <label for="academic_year_id">Teaching Year:*</label>
                <select name='academic_year_id' id='academic_year_id' class="text required" title="Please select the Academic Year.">
                     <?php echo selectBox('Select','academic_years','id,name','status="1"','0'); ?>
                </select>
            </li>
            <li>
                <input type="submit" name="submit"  class="gblue button j_gen_form_submit gblue" value="Next "/>
                <div class="clr"></div>
            </li>
        </ol>
    </form>
</div>
