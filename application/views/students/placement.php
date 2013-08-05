<h2 align="center"><span>Placement Cell.</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please select the Services as below.</p>
    <div class="clr"></div>
</div>
<ul style="margin-left: 100px;">
    <li>
        <label for="website"><a href="<?php echo site_url('students/job_alerts'); ?>"> Register for Job Alerts.  </a></label>
    </li>
    <li>
        <label for="website"><a href="<?php echo site_url('students/upload_resume'); ?>"> Upload your Resume.  </a></label>
    </li>
</ul>
<hr/>
<div class="clr"></div>
<p style="width:200px; float:left;">Placement Cell Updates:</p>
<!--<p style="width:200px; float:right;font-weight: bold;"><i> required fields</i></p>-->
<div class="clr"></div>
<ul style="margin-left: 100px;">
    <?php if(isset($notice_board) && count($notice_board)>0){
        foreach($notice_board as $v){
    ?>
    <li>
        <p><?php echo $v->message; ?></p>
    </li>
    <?php
        }
    }else{ ?>
    <li>
        <p>No Placement News.</p>
    </li>
    <?php } ?>
</ul>
