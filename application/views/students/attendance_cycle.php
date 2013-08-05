<div class="f_r f_b m_r_10">* required fields</div>
<form action="<?php echo site_url('students/student_attendance');?>" id="appl_form2" method="post" >
    <input id="rel" name="rel"  type="hidden" value="submit"/>

    <ol>
        <li>
            <label for="cycle_id">Select Cycle:*</label>
            <select name='cycle_id' id='cycle_id' class="text required" title="Please select the Cycle.">
                 <?php echo selectBox('Select','period_cycles','id,name','status="1"','0'); ?>
            </select>
        </li>
        <li>
            <input type="submit" name="submit"  class="button gblue j_gen_form_submit" value="Next &gt;"/>
            <div class="clr"></div>
        </li>
    </ol>
</form>
