<?php 
//echo '<pre>'; print_r($data); echo '</pre>';
if(isset($data[0])) $data[0]=(object)$data[0];
//echo '<pre>'; print_r($data); echo '</pre>';
?>
<style type="text/css" rel="stylesheet">
    table.sample td {
        padding: 5px;
        text-align: center;
    }
</style>
<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/staff/apply_leave">
    <input id="" name="rel" class="text" type="hidden" value="general"/>
   <ol>
        <li>
            <label for="staff_name">Employee Name:*</label>
            <input id="staff_name" name="staff_name" class="text required" value="<?php if(isset($data[0]->staff_name )) echo $data[0]->staff_name; ?>" disabled="disabled"/>
        </li><li>
            <label for="staff_code">Employee Code:*</label>
            <input id="staff_code" name="staff_code" class="text required" value="<?php if(isset($data[0]->staff_code)) echo $data[0]->staff_code; ?>" disabled="disabled" />
        </li>
        <li>
            <label for="branch_id">Branch:*</label>
            <select id="branch_id" name="branch_id" class="text required" disabled="disabled">
                <option value="">Select</option>
                <?php $branch_selected=(isset($data[0]->branch_id))?$data[0]->branch_id:''; echo load_select('branches',$branch_selected); ?>
            </select>
    <!--        <input id="course" name="course" class="text"/>-->
        </li>
        <li>
            <label for="leave_type_id">Type of Leave:*</label>
            <select id="leave_type_id" name="leave_type_id" class="text required" disabled="disabled">
                <option value="">Select</option>
                <?php  echo load_select('leave_types',((isset($data[0]->leave_type_id))?$data[0]->leave_type_id:0)); ?>
            </select>
    <!--        <input id="course" name="course" class="text"/>-->
        </li>

        <li>
            <label for="from">From:*</label>
            <input id="from" name="from" class="text required"  disabled="disabled" value="<?php if(isset($data[0]->from)) echo dateFormat($data[0]->from); ?>" />
        </li>
        <li>
            <label for="to">To:*</label>
            <input id="to" name="to" class="text required"  disabled="disabled" value="<?php if(isset($data[0]->to)) echo dateFormat($data[0]->to); ?>" />
        </li>

        <li>
            <label for="purpose">Purpose:</label>
            <textarea id="purpose" name="purpose" rows="8" cols="50" class="required" disabled="disabled"><?php if(isset($data[0]->purpose)) echo $data[0]->purpose; ?></textarea>
        </li>
        <li>
            <pre>
                <?php // print_r($staff_periods);  ?>
            </pre>

            <?php if(empty($staff_periods)){  ?>
            <h4>No Work adjustments.!</h4>
            <?php }else{  ?>
            <h4>Work adjustments:</h4>

            <table class="sample table_view">
                <tr>
                    <th width="30%">Subject</th>
                    <th width="15%">Cycle</th>
                    <th  width="15%">Date / Time</th>
                    <th width="30%">Work Adjusted To</th>
                </tr>
                <?php if(!empty($staff_periods)) foreach($staff_periods as $sp_k=>$sp_v){ ?>
                <tr>
                    <td>
                        <?php echo $sp_v['course_name'].'<br/>'.$sp_v['branch_name'].'<br/>'.$sp_v['branch_name'].'<br/>'.$sp_v['subject_name'].'<br/>'; ?>
                    </td>
                    <td>
                        <?php echo $sp_v['cycle_name'];  ?>
                    </td>
                    <td>
                        <?php if(isset($sp_v['work_adjusted_date']) && !empty($sp_v['work_adjusted_date'])){  echo dateFormat($sp_v['work_adjusted_date'], 'd-M-Y'),' / '; } echo $sp_v['time_label'];  ?>
                    </td>
                    <td>
                        <select name='work_adjustments[<?php echo $sp_v['id'];  ?>]' id='work_adjustment<?php echo $sp_v['id'];  ?>' class="text required" style="width: 260px;" disabled="disabled">
                             <?php // echo selectBox('Select','staff_records','user_id,name','status="1"','0'); ?>
                            <option value="">Select</option>
                             <?php if(isset($teachersOptions) && !empty($teachersOptions)){
                                foreach ($teachersOptions as $key => $value) {
                                  ?>
                                <option value="<?php echo $value['user_id'];  ?>" <?php if($sp_v['work_adjusted_to']==$value['user_id']){ echo 'selected="selected"'; }  ?>><?php echo $value['name'];  ?></option>
                             <?php
                                }
                             }  ?>
                        </select>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <?php } ?>
            <br/>
        </li>
        
    </ol>
</form>
