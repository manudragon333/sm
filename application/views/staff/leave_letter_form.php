<?php //echo '<pre>'; print_r($data); echo '</pre>'; ;?>
<style type="text/css" rel="stylesheet">
    table.sample td {
        padding: 5px;
        text-align: center;
    }
</style>
<h2 align='center'><span>Leave Application</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/staff/apply_leave">
    <input id="" name="rel" class="text" type="hidden" value="general"/>
    
    <ol>
        <li>
            <label for="staff_name">Employee Name:*</label>
            <input id="staff_name" name="staff_name" class="text required" value="<?php if(isset($data[0]->name )) echo $data[0]->name; ?>" title="Please enter the Employee Name"/>
        </li><li>
            <label for="staff_code">Employee Code:*</label>
            <input id="staff_code" name="staff_code" class="text required" value="<?php if(isset($data[0]->code)) echo $data[0]->code; ?>" title="Please enter the Staff Code"/>
        </li>
        <!-- <li>
            <label for="branch_id">Branch:*</label>
            <select id="branch_id" name="branch_id" class="text required" title="Please select your Branch">
                <option value="">Select</option>
                <?php $branch_selected=(isset($data[0]->branch_id))?$data[0]->branch_id:''; echo load_select('branches',$branch_selected); ?>
            </select>
           <input id="course" name="course" class="text"/>
        </li>-->
        <li>
            <label for="leave_type_id">Type of Leave:*</label>
            <select id="leave_type_id" name="leave_type_id" class="text required" title="Please select the Type of Leave">
                <option value="">Select</option>
                <?php  echo load_select('leave_types',0); ?>
            </select>
    <!--        <input id="course" name="course" class="text"/>-->
        </li>

        <li>
            <label for="from">From:*</label>
            <input id="from" name="from" class="text apply_leave_from_datepicker required" readonly="readonly" value="<?php if(isset($data[0]->from)) echo dateFormat($data[0]->from); ?>" title="Please enter the from Date"/>
        </li>
        <li>
            <label for="to">To:*</label>
            <input id="to" name="to" class="text apply_leave_to_datepicker required" readonly="readonly" value="<?php if(isset($data[0]->to)) echo dateFormat($data[0]->to); ?>" title="Please enter the to date"/>
        </li>

        <li>
            <label for="purpose">Purpose:</label>
            <textarea id="purpose" name="purpose" rows="8" cols="50" class="required" title="Please enter the Purpose of leave"><?php if(isset($data[0]->purpose)) echo $data[0]->purpose; ?></textarea>
        </li>
        <li>
            <pre>
                <?php // print_r($staff_periods);  ?>
            </pre>

            <div id="work_adjustments">
                
            </div>
            <br/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Apply"/>
            <div class="clr"></div>
        </li>
        

    </ol>
</form>
