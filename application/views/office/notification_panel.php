<h2><span>Notification Panel</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>

<form id="notification_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>
        <li>
            <label for="notification_for">Notification For:* </label>
            <select id="notification_for" name="notification_for" class="text required" title="Please select Notification For">
                <option value="">Select</option>
                <option value="faculty">Faculty</option>
                <option value="students">Students</option>
                <option value="hod">HOD</option>
                <option value="all">Entire College</option>
            </select>
        </li>
        <li>
            <label for="priority">Priority:* </label>
            <select id="priority" name="priority" class="text required" title="Please select Priority">
                <option value="">Select</option>
                <option value="high">HIGH</option>
                <option value="low">LOW</option>
            </select>
        </li>
        <li class="student_filter">
            <i>> You Can filter the students using below College,Course,Branch,Semester .</i>
        </li>
        <li class="student_filter">
            <label for="college_id">College: </label>
            <select id="college_id" name="college_id" class="text " title="Please select College">
                <option value="">Select</option>
                <?php if(isset($form_data['college_id'])) $college_id_select=$form_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li class="student_filter">
            <label for="course_id">Course: </label>
            <select id="course_id" name="course_id" class="text "  title="Please select Course">
                <option value="">Select</option>
                <?php if(isset($form_data['course_id'])) $course_id_select=$form_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li class="student_filter">
            <label for="branch_id">Branch: </label>
            <select id="branch_id" name="branch_id" class="text "  title="Please select Branch">
                <option value="">Select</option>
                <?php if(isset($form_data['branch_id'])) $branch_id_select=$form_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>
        <li class="student_filter">
            <label for="semister_id">Semester: </label>
            <select id="semister_id" name="semister_id" class="text " title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($form_data['semister_id'])) $semister_id_select=$form_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
        
        <li class="student_filter" id="students_list">
            
        </li>
        
        
        
        <li style="padding-top: 10px;">
            <label for="photo">Upload Attachment: </label>
            <input type="file" name="photo" size="100" class="" id="file_upload" title="Please Upload a Attachment if required"/>
            <input name="doc_link" class="myfile " value="" type="hidden" id="doc_link" title="Please Upload a Attachment if required"/>
            <br id="file_uplaoder_next_line"/>
        </li>
        

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

<ol>
    <li>
        <?php
            if(isset($logMsg) && !empty($logMsg)){
                echo showBigSuccess($logMsg);
            }
        ?>
    </li>
    <li>
        <?php
            if(isset($errorMsg) && !empty($errorMsg)){
                echo showBigError($errorMsg);
            }
        ?>
    </li>
</ol>


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
        max-height: 500px;
        overflow: auto;
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


        $('#notification_form').validate({
            errprPlacement:function(error, element) {
                if (element.attr("name") == "doc_link")
                    error.insertAfter("#file_uplaoder_next_line");
                else
                    error.insertAfter(element);
            }
        });

        $('#notification_for').live('change',function(){
            val=$(this).val();
            if(val=='students'){
                $('.student_filter').show();
                $('#students_list').html('<input type="hidden" name="student_ids[]" class="required"  title="Please select a student"/>');
                $('.student_filter select:first').trigger('change');
            }else{
                $('.student_filter').hide();
                $('#students_list').html('');
            }
        });
        
        $('.student_filter select').live('change',function(){
            dataP=$('.student_filter select').serialize();
            $.ajax({
               url:base_url+'office/students_filter_list',
               type:'POST',
               data:dataP,
               beforeSend:function(){
                   $('#students_list').html('<p><b><i>Loading.... </i><b></p>');
               },
               success:function(dataR){
                   $('#students_list').html(dataR);
               }
            });
        });
        
        
        
    });
</script>