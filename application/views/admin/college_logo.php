<h2 align="left"><span>College Logo</span></h2>

<div class="user_instructions">
    <p style="width:200px; float:left;">Present College Logo.</p>
    <div class="clr"></div>
</div>
<?php if(!empty($college_logo)){ ?>
    <img src="<?php echo base_url().$college_logo; ?>" />
<?php } ?>
<div class="clr"></div>
<br/>
<input type="button" name="imageField" id="imageField" class=" button green" value="Change College Logo" onclick="window.location.href='<?php echo site_url('admin/edit_college_logo'); ?>'" />

<div class="clr"></div>