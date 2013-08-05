<h2><span>Upload Files.</span></h2>
<div class="clr"></div>
<div class="user_instructions">
<div><?php if(@$_GET['status']=="success"){ echo "Your .zip file was uploaded and unpacked.";}else if(@$_GET['status']=="Error"){ echo "There was a problem with the upload. Please try again."; }else if(@$_GET['status']=="notzip"){ echo "The file you are trying to upload is not a .zip file. Please try again."; } ?> </div>
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="start_upload" enctype="multipart/form-data" method="post">
    <input id="" name="rel" class="text" type="hidden" value="compose_email"/>
    <ol> 
        <li>
            <label for="to">Choose a zip file to upload:</label>
            <input type="file" id="zip_file" name="zip_file"/>
        </li>
       
<!--        <li>
            <label for="website">Attachment:*</label>
            <input name="file" class="myfile" value="" type="hidden" id="email_attach"/>
            <input type="hidden" name="file_name" id="file_name" value=""/>
            <input type="hidden" name="file_type" id="file_type" value=""/>
            <input type="hidden" name="file_size" id="file_size" value=""/>
        </li>-->
       
        
        <li>
            <br/>
            <input type="submit" name="submit" class="upload button" value="Upload"/>
<!--            <input type="button" name="imageField" id="get_button" class="get button" value="Get the id card"style="margin-left: 126px;"/>-->
        </li>
    </ol>
</form> 
