<ol>
    <li>
        <label for="name">Calendar For Year:* </label>
        <select id="name" name="name" class="text required" title="Please select a Calender Year" disabled="">
            <option value="">Select</option>
            <?php 
                $html = '';
                for ($i = date('Y') - 4; $i <= date('Y') + 4; $i++) {
                    $selected = '';
                    if (empty($form_data[0]->name) && date('Y') == $i) {
                        $selected.=" selected='selected' ";
                    }else if(!empty($form_data[0]->name) && $form_data[0]->name==$i.'-'.($i+1)){
                        $selected.=" selected='selected' ";
                    }
                    $html.="<option value='" . $i.'-'.($i+1) . "' " . $selected . ">" . $i.'-'.($i+1) . "</option>";
                }
                echo $html;
            ?>
        </select>
    </li>
    <li>
        <label for="college_id">College:* </label>
        <select id="college_id" name="college_id" class="text required" title="Please select a College" disabled="">
            <option value="">Select</option>
            <?php if(isset($form_data[0]->college_id)) $college_id_select=$form_data[0]->college_id; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
        </select>
    </li>
    <li>
        <label for="course_id">Course:* </label>
        <select id="course_id" name="course_id" class="text required" title="Please select a Course" disabled="">
            <option value="">Select</option>
            <?php if(isset($form_data[0]->course_id)) $course_id_select=$form_data[0]->course_id; else $course_id_select=0; echo load_select('courses',$course_id_select); ?>
        </select>
    </li>
    <li>
        <label for="sem_ids">Year/Semester:* </label>
        <select id="sem_ids" name="sem_id[]" class="text required" multiple="multple" title="Please select a Year/Sem" style="height: 105px;" disabled="" >
            <option value="">Select</option>
            <?php 
                if(!empty($calendar_sems)){
                    foreach($calendar_sems as $k=>$v){
                        echo "<option value='$v->id' selected='selected' >$v->branch_name - $v->sem_name</option>";
                    }
                }
            ?>
        </select>
    </li>
    <li>
        <label for="status">Status:* </label>
        <select id="status" name="status" class="text required" title="Please select a Status" disabled="">
            <option value="1" <?php if(isset($form_data[0]->status) && $form_data[0]->status=='1') echo ' selected="selected" ' ?>>Active</option>
            <option value="0" <?php if(isset($form_data[0]->status) && $form_data[0]->status=='0') echo ' selected="selected" ' ?>>InActive</option>
        </select>
    </li>
    
    
    <li>
        <br/>
        Calendar Items:
    </li>
    <li>
        
        <?php if(empty($items_data)){ echo showBigInfo('No Items Added to the Calendar. Please try again.'); }else{ ?>

        <div style="padding:5px;" class="">
            <table class="sample table_view">
                <tr>
                    <th>From </th>
                    <th>To</th>
                    <th>Item</th>
                </tr>
                <?php foreach ($items_data as $k => $v) { ?>
                    <tr>
                        <td><?php if (!empty($v->from)) echo dateFormat ($v->from,'Y-m-d'); ?> </td>
                        <td><?php if (!empty($v->to)) echo dateFormat ($v->to,'Y-m-d'); ?> </td>
                        <td><?php if (!empty($v->item_name)) echo $v->item_name; ?> </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <?php } ?>
        
    </li>
    <li>
        <input type="button" name="" id="" class=" button grey m_l_20" value=" Back To Calendars "onclick="javascript:window.location='<?php echo site_url('admin/academic_calendar'); ?>'"/>
        <div class="clr"></div>
    </li>
</ol>



<style type="text/css">
    
    select option {
        background: rgba(0,0,0,0.3);
        color:#fff;
        text-shadow:0 1px 0 rgba(0,0,0,0.4);
    }
</style>