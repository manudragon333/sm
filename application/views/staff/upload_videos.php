<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/staff/upload_videos">
    <input id="" name="rel" class="text" type="hidden" value="upload_videos"/>
    <ol>
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College">
                <option value="">Select</option>
                <?php if(isset($form_data['college_id'])) $college_id_select=$form_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
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
                // echo selectBox('Select','SELECT * FROM semisters AS s LEFT JOIN courses AS c on c.id=s.course_id LEFT JOIN branches AS b on b.id=s.branch_id ','s.id AS id, concat(c.name," - ", b.name," - ", s.name) AS name',' s.status="1" ORDER BY s.college_id, s.course_id, s.branch_id, s.name ASC',0);
             $semSql='
                 SELECT s.id AS id, concat(c.name," - ", b.name," - ", s.name) AS name FROM semisters AS s 
                    LEFT JOIN courses AS c on c.id=s.course_id 
                    LEFT JOIN branches AS b on b.id=s.branch_id  
                    WHERE s.status="1" ORDER BY s.college_id, s.course_id, s.branch_id, s.name ASC
                ';   
             echo selectBoxSql('Select',$semSql,array('id','name'),0);
                // echo selectBox('Select','semisters','id,name',' status="1" ORDER BY college_id, course_id, branch_id, name ASC',0);
             ?>
            </select>
        </li>
        <li>
            <label for="comments">Comments:</label>
            <textarea id="comments" cols="8" rows="5" name="comments" class="text"></textarea>
        </li>
        <li>
            <label for="embed_code">Video Code:*</label>
            <textarea id="embed_code" cols="8" rows="5" name="embed_code" class="text"></textarea>
        </li>
<!--        <li>
            <label for="photo">Upload the Paper*</label>
            <input type="file" name="photo" size="100" class="" id="doc_upload"/>
            <input name="doc_link" class="myfile" value="" type="hidden" id="doc_link"/>
        </li>-->
        
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="upload gblue button j_gen_form_submit" value="Submit"/>
        </li>
    </ol>
</form>