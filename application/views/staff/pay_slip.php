<?php
if(isset($data[0]) && isset($data[0]->doj)){
    $start_select=dateFormat($data[0]->doj,'Y');
}else{
    $start_select=date('Y')-3;
}
?>
<h2><span>Request for Pay slip.</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" suc_msg="Payslip Request Submited Successfully.">
    <input id="" name="rel" class="text" type="hidden" value="payslip"/>
    <ol>
        <li>
            <label for="from_month">From Month:* </label>
            <select class="text" name="from_month" id="from_month">
                <option value="">Select</option>
                <?php for($i=1;$i<=12;$i++){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?> (<?php echo date("F", strtotime("01-".$i."-2012")); ?>)</option>
                <?php } ?>
            </select>
        </li>
        <li>
            <label for="to_month">To Month:* </label>
            <select class="text" name="to_month" id="to_month">
                <option value="">Select</option>
                <?php for($i=1;$i<=12;$i++){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?> (<?php echo date("F", strtotime("01-".$i."-2012")); ?>)</option>
                <?php } ?>
            </select>
        </li>
        <li>
            <label for="year">Year:* </label>
            <select class="text" name="year" id="year">
                <option value="">Select</option>
                <?php for($i=$start_select;$i<=date('Y');$i++){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Submit"/>
            <div class="clr"></div>
        </li>
    </ol>
</form>