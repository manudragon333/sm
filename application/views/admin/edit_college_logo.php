<h2 align="left"><span><?php if(isset($form_data[0]['id'])) echo 'Edit'; else echo 'Add'; ?> College Logo</span></h2>
<pre><?php // print_r($form_data); ?></pre>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="<?php echo site_url('admin/edit_college_logo'); ?>" method="post" enctype="multipart/form-data">
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($form_data[0]['id'])) echo $form_data[0]['id']; ?>"/>
    <ol>
        <?php 
            if(isset($form_data[0]['id'])){
                $s_data=$form_data[0];
            }
        ?>
        <li>
            <label for="upload_image">Upload Image:* </label>
            <input id="upload_image" name="upload_image" class="required" value="<?php if(isset($form_data[0]['value'])) echo $form_data[0]['value']; ?>" type="file" title="Please upload a image."/>
        </li>
        <li>
            <input type="submit" name="imageField" id="imageField" class=" button gblue" value="Save Image" />
            <div class="clr"></div>
        </li>
    </ol>
</form>

<script type="text/javascript">
    $(function(){
        $('#appl_form').validate();
    });
</script>
