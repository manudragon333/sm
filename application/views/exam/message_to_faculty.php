<h2><span>Message to Faculty</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>

<form id="message_to_faculty_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>
        <li>
            <label for="message">Message:*</label>
            <textarea id="message" cols="8" rows="5" name="message" class="text required" title="Please enter a message"><?php echo ((isset($form_data['message'])?$form_data['message']:''));  ?></textarea>
        </li>
        
        
        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload button j_gen_form_submit" value="Submit"/>
        </li>
    </ol>
</form>


<style type="text/css">
    table.sample td {
        padding: 2px 10px;
        width:auto;
    }
    table.sample td input.text{
        width:100px;
        padding: 10px 2px;
    }
    .student_filter{
        display: none;
    }
    #students_list{
        padding-top: 10px;
    }
    #students_list .cell{
        min-width: 210px;
        border: 1px solid #aaaaaa;
        box-shadow: 1px 1px 1px #ccc;
        padding: 5px;
        margin: 3px;
        overflow: hidden;
        display: block;
        height: 28px;
        text-overflow:ellipsis;
    }
</style>

<script type="text/javascript">
    $(function(){

        if($('#file_upload').length>0){
            // '/mycollege/testserver/uploads', // 
            $('#file_upload').uploadify({
                    'uploader'  : base_url+'/uploadify/uploadify.swf',
                    'script'    : base_url+'/uploadify/uploadify.php',
                    'cancelImg' : base_url+'/uploadify/cancel.png',
                    'folder'    : upload_path, // '/testserver/uploads', '/mycollege/testserver/uploads',
                    'auto'      : true,
                    'multi'     : false,
                    'fileExt'   : '',
                    'fileDesc'    : 'Files',
                    'sizeLimit'   : 1024000,
                    'removeCompleted' : false,
                    'onComplete'  : function(event, ID, fileObj, response, data) {
                      $('#doc_link').val(response);
                      $('#doc_link').parent().find('div.error').remove();
                    }
            });
        }


        $('#message_to_faculty_form').validate({
            errprPlacement:function(error, element) {
                if (element.attr("name") == "doc_link")
                    error.insertAfter("#file_uplaoder_next_line");
                else
                    error.insertAfter(element);
            }
        });
        
    });
</script>