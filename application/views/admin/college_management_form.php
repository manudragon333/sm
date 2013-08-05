<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="<?php echo site_url('admin/save_college'); ?>" method="POST" enctype="multipart/form-data">
    <input id="" name="rel" class="text" type="hidden" value="college_management"/>
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($college_data[0]['id'])) echo $college_data[0]['id']; ?>"/>
    <ol>
        <?php if(isset($college_data[0]['id'])){
            $s_data=$college_data[0];
        } ?>
        <li>
            <label for="branch_id">College Name:* </label>
            <input id="name" name="name" class="text" value="<?php if(isset($college_data[0]['name'])) echo $college_data[0]['name']; ?>">
        </li>
        <li>
            <label for="college_address">College Address:* </label>
            <textarea cols="10" rows="5" name="college_address" id="college_address" class="text required" title="Please enter the college address" ><?php if(isset($college_data[0]['college_address'])) echo $college_data[0]['college_address']; ?></textarea>
<!--            <input id="college_address" name="college_address" class="text" value="">-->
        </li>
        <li>
            <label for="college_code">College Code:* </label>
            <input id="college_code" name="college_code" class="text required" title="Please enter College Code" value="<?php if(isset($college_data[0]['college_code'])) echo $college_data[0]['college_code']; ?>">
        </li>
        <li>
            <label for="estd">Established on:* </label>
            <input id="estd" name="estd" class="text required" title="Please enter the Estd. date" value="<?php if(isset($college_data[0]['estd'])) echo $college_data[0]['estd']; ?>">
        </li>
        <li>
            <br/>
            <?php if(!empty($college_data[0]['college_logo'])){ ?>
                <img src="<?php echo base_url().$college_data[0]['college_logo']; ?>" />
            <?php } ?>
            <br/>
        </li>
        <li><a href="javascript:void(0);" id="change_img">Change Image</a></li>
        <li id="uploader_li" class="hide">
            <label for="upload_image">Upload Image:* </label>
            <div id="uploader_wrap">
                
            </div>
            <br/>
        </li>
        <li>
            <label for="status">Status:* </label>
            <select id="status" name="status" class="text">
                <option value="1" <?php if(isset($college_data[0]['status']) && $college_data[0]['status']=='1') echo ' selected="selected" ' ?>>Active</option>
                <option value="0" <?php if(isset($college_data[0]['status']) && $college_data[0]['status']=='0') echo ' selected="selected" ' ?>>InActive</option>
            </select>
        </li>
        <li>
            <input type="submit" name="imageField" id="imageField" class="send button gblue" value="Save College" />
            <div class="clr"></div>
        </li>
    </ol>
</form>


<script type="text/javascript">
    $(function(){
        $('#appl_form').validate();
        
        $('#change_img').live('click',function(){
            $('#uploader_wrap').html('<input id="upload_image" name="upload_image" class="required" value="" type="file" title="Please upload a image."/>');
            $('#uploader_li').slideDown();
        })
        
    });
</script>
