<h2><span>Exam Duty</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>

<form id="exam_duty_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="exam_duty_form"/>
    <ol>
        
        <li>
            <label for="name">Chart Name:* </label>
            <input id="name" name="name" class="text required" title="Please enter a Chart name."/>
        </li>
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
            <label for="type_of_exam_id">Type Of Exam:* </label>
            <select id="type_of_exam_id" name="type_of_exam_id" class="text required"  title="Please select Type Of Exam">
                <option value="">Select</option>
                <?php if(isset($form_data['type_of_exam_id'])) $type_of_exam_id_select=$form_data['course_id']; else $type_of_exam_id_select=0; echo load_select('type_of_exam',$type_of_exam_id_select,array('status'=>'1')); ?>
            </select>
        </li>

        <li>
            <label for="from">From Date:* </label>
            <input id="from" name="from" class="text required" title="Please select a From Date."/>
        </li>

        <li>
            <label for="to">To Date:* </label>
            <input id="to" name="to" class="text required" title="Please select a To Date."/>
        </li>
        
        <li>
            <label for="chief_superintendent">Chief Superintendent:</label>
            <textarea id="chief_superintendent" cols="8" rows="5" name="chief_superintendent" class="text"><?php echo ((isset($form_data['chief_superintendent'])?$form_data['chief_superintendent']:''));  ?></textarea>
        </li>
        
        <li>
            <label for="exam_branch_ic1">Exam Branch I/C 1:</label>
            <textarea id="exam_branch_ic1" cols="8" rows="5" name="exam_branch_ic1" class="text"><?php echo ((isset($form_data['exam_branch_ic1'])?$form_data['exam_branch_ic1']:''));  ?></textarea>
        </li>
        
        <li>
            <label for="exam_branch_ic2">Exam Branch I/C 2:</label>
            <textarea id="exam_branch_ic2" cols="8" rows="5" name="exam_branch_ic2" class="text"><?php echo ((isset($form_data['exam_branch_ic2'])?$form_data['exam_branch_ic2']:''));  ?></textarea>
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
</style>

<script type="text/javascript">
    $(function(){

        $('#exam_duty_form').validate({
            errprPlacement:function(error, element) {
                if (element.attr("name") == "doc_link")
                    error.insertAfter("#file_uplaoder_next_line");
                else
                    error.insertAfter(element);
            }
        });

        $('#from').datepicker({
            beforeShow: function(input) {
                return { maxDate: (($('#to').val()!='')?$('#to').datepicker("getDate"):null) }
            },
            dateFormat:'yy-mm-dd'
        });

        $('#to').datepicker({
            beforeShow: function(input) {
                return { minDate: (($('#from').val()!='')?$('#from').datepicker("getDate"):null) }
            },
            dateFormat:'yy-mm-dd'
        });
        
    });
</script>