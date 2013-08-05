<h2><span>Select to post the results</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>

<form id="post_exam_results_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College">
                <option value="">Select</option>
                <?php if(isset($form_data['college_id'])) $college_id_select=$form_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text required"  title="Please select Course">
                <option value="">Select</option>
                <?php if(isset($form_data['course_id'])) $course_id_select=$form_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text required"  title="Please select Branch">
                <option value="">Select</option>
                <?php if(isset($form_data['branch_id'])) $branch_id_select=$form_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text required" title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($form_data['semister_id'])) $semister_id_select=$form_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text required" title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($form_data['subject_id'])) $subject_id_select=$form_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','id'=>$subject_id_select)); ?>
            </select>
        </li>
<!--        <li>
            <label for="academic_year_id">Academic year:* </label>
            <select id="academic_year_id" name="academic_year_id" class="text required" title="Please select a Academic Year">
                <option value="">Select</option>
                <?php if(isset($form_data['academic_year_id'])) $academic_year_select=$form_data['academic_year_id']; else $academic_year_select=0; echo load_select('academic_years',$academic_year_select,array('status'=>'1')); ?>
            </select>
        </li>-->
        <li style="display:none;">
            <label for="regulation_id">Regulation: </label>
            <select id="regulation_id" name="regulation_id" class="text " title="Please select a Regulation">
                <option value="">Select</option>
                <?php if(isset($form_data['regulation_id'])) $regulation_id_select=$form_data['regulation_id']; else $regulation_id_select=0; echo load_select('regulation',$regulation_id_select,array('status'=>'1')); ?>
            </select>
        </li>
        <li style="">
            <label for="mode_of_exam_id">Mode of Exam:* </label>
            <select id="mode_of_exam_id" name="mode_of_exam_id" class="text required" title="Please select a Mode of the Exam">
                <option value="">Select</option>
                <?php if(isset($form_data['mode_of_exam_id'])) $mode_of_exam_select=$form_data['mode_of_exam_id']; else $mode_of_exam_select=0; echo load_select('mode_of_exam',$mode_of_exam_select,array('status'=>'1')); ?>
            </select>
        </li>

        <li  >
            <label for="is_mba">Course Type:* </label>
            <?php  if(isset($form_data['is_mba'])){ $is_mba_select=$form_data['is_mba']; }else{ $is_mba_select=0; } ?>
            <label ><input id="is_mba_1" type="radio" name="is_mba" value="1" class="required" title="Please Select a Course Type" <?php if($is_mba_select=='1'){ echo ' checked="checked" '; }  ?>/> M.B.A </label>
            <label ><input id="is_mba_2" type="radio" name="is_mba" value="0" class="required" title="Please Select a Course Type" <?php if($is_mba_select=='0'){ echo ' checked="checked" '; }  ?>/> B.Tech/ Others </label>
        </li>

        <li >
            <h4 class="m_t_20">CSV Format:</h4>
            <table class="sample table_view m_t_10">
                <tbody>
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <th>AVERAGE MARKS</th>
                        <th>MARKS AWARDED</th>
                    </tr>
                    <tr>
                        <td>11RC1A0501</td>
                        <td>18</td>
                        <td>68</td>
                    </tr>
                </tbody>
            </table>
        </li>
        <li style="padding-top: 10px;">
            <label for="photo">Upload the CSV Marks:* </label>
            <input type="file" name="photo" size="100" class="" id="csv_upload" title="Please Upload a CSV File"/>
            <input name="doc_link" class="myfile required" value="" type="hidden" id="doc_link" title="Please Upload a CSV File"/>
            <br id="file_uplaoder_next_line"/>
        </li>
        

        <li style="display:none;">
            <label for="comment">Comment:</label>
            <textarea id="comment" cols="8" rows="5" name="comment" class="text"><?php echo ((isset($form_data['comment'])?$form_data['comment']:''));  ?></textarea>
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
</style>

<script type="text/javascript">
    $(function(){

        if($('#csv_upload').length>0){
            // '/mycollege/testserver/uploads', // 
            $('#csv_upload').uploadify({
                    'uploader'  : base_url+'/uploadify/uploadify.swf',
                    'script'    : base_url+'/uploadify/uploadify.php',
                    'cancelImg' : base_url+'/uploadify/cancel.png',
                    'folder'    : '/kits/uploads', // '/testserver/uploads', '/mycollege/testserver/uploads',
                    'auto'      : true,
                    'multi'     : false,
                    'fileExt'   : '*.csv;',
                    'fileDesc'    : 'CSV Files',
                    'sizeLimit'   : 1024000,
                    'removeCompleted' : false,
                    'onComplete'  : function(event, ID, fileObj, response, data) {
                      $('#doc_link').val(response);
                      $('#doc_link').parent().find('div.error').remove();
                    }
            });
        }


        $('#post_exam_results_form').validate({
            errprPlacement:function(error, element) {
                if (element.attr("name") == "doc_link")
                    error.insertAfter("#file_uplaoder_next_line");
                else
                    error.insertAfter(element);
            }
        });

        $('#post_exam_results_form select').change(function(){
            $('#student_marks_li').html('');
        });

        $('.ip_external').keyup(function(){
            if(isNaN($(this).val())){
                $(this).val('');
            }
            // console.log($(this).attr('max_marks'), $(this).val(), parseInt($(this).val())>parseInt($(this).attr('max_marks')))
            if($(this).attr('max_marks')!='' && parseInt($(this).val())>parseInt($(this).attr('max_marks'))){
                $(this).val('')
                return false;
            }
        });
        

    });
</script>