
<form  action="/office/add_balance" id="add_balance" method="post" >

<input id="rel" name="rel" type="hidden" class="text" value="addbalance_form"/>
<input type="hidden" name="updated_by" id="updated_by" value="<?php echo $this->session->userdata('user_details')->username; ?>"/>
<a href="<?php echo site_url('office/view_cashbook') ?>" > view cashbook >></a>

<?php if($msg){ echo $msg; } ?>
        

       <ol>
       
       
        <li>
            <label for="details">Balance Details:* </label>
            <input id="details" name="details" type="text" class="text required" />
        </li>
         <li>
            <label for="date">previous balance:* </label>
            <input id="pbalance" name="pbalance" class="text " readonly="readonly" value="<?php echo $prev_balance; ?>"/>
        </li>
        <li>
            <label for="details">Balance:* </label>
            <input id="balance" name="balance" type='text'class="text required"/>
        </li>
        
        <li>
            <input type="button" name="imageField" id="imageField"  class="button j_gen_form_submit" value="Add Balance"/>
            <!--<input type="submit" name="cbcreate" id="cbcreate" class="button j_gen_form_submit" value="create"/>-->
        </li>
    </ol>



</from>
<script type=text/javascript>
function popup()
{
alert("hi");
}
</script>
