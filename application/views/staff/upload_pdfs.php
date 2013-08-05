<h2><span>Upload PDF's</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/staff/upload_pdfs">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>
<!--        <li>
            <label for="branch_id">Branch:*</label>
            <select id="branch_id" name="branch_id" class="text">
                <option value="">Select</option>
                <?php echo load_select('branches');?>
            </select>
        </li>
        <li>
            <label for="sem_id">Year/Sem:*</label>
            <select name='sem_id' id='sem_id' class="text">
             <?php
                echo selectBox('Select','semisters','id,name','status="1"',0);
             ?>
            </select>
        </li>-->


        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College">
                <option value="">Select</option>
                <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text required"  title="Please select Course">
                <option value="">Select</option>
                <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text required"  title="Please select Branch">
                <option value="">Select</option>
                <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="sem_id">Semester:* </label>
            <select id="sem_id" name="sem_id" class="text required" title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($s_data['semister_id'])) $semister_id_select=$s_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
        
        <li>
            <label for="semister_id">Sections:* </label>
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($s_data['section_id'])) $section_id_select=$s_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
        </li>

        

        <li>
            <label for="instructions">Instructions:*</label>
            <textarea id="instructions" cols="8" rows="5" name="instructions" class="text"></textarea>
        </li>
        <li>
            <label for="photo">Upload the Paper*</label>
            <input type="file" name="photo" size="100" class="" id="doc_upload"/>
            <input name="doc_link" class="myfile" value="" type="hidden" id="doc_link"/>
        </li>
        
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="upload button j_gen_form_submit" value="Submit"/>
        </li>
    </ol>
</form>