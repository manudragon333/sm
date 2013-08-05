<div>
    <h2 align="center"><span> View Period management </span></h2>
    <div class="user_instructions">
        <p style="width:200px; float:left;">Please enter details below.</p>
        <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="clr"></div>
    <form action="<?php echo site_url('staff/attendance');?>" id="appl_form2" method="post" >
        <input id="rel" name="rel"  type="hidden" value="submit"/>

        <ol>
            <li>
                <label for="cycle_id">Select Cycle:*</label>
                <select name='cycle_id' id='cycle_id' class="text required" title="Please select the Cycle.">
                     <?php echo selectBox('Select','period_cycles','id,name','status="1"','0'); ?>
                </select>
            </li>
            <li>
            <label for="academic_year_id">Academic year:* </label>
            <select id="academic_year_id" name="academic_year_id" class="text required" title="Please select a Academic Year">
                <option value="">Select</option>
                <?php if(isset($s_data['academic_year_id'])) $academic_year_select=$s_data['academic_year_id']; else $academic_year_select=0; echo load_select('academic_years',$academic_year_select,array('status'=>'1')); ?>
            </select>
        </li>
            <li>
                <input type="submit" name="submit"  class="gblue button j_gen_form_submit" value="Next >"/>
                <div class="clr"></div>
            </li>
        </ol>
    </form>
</div>
