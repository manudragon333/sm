<h2><span>Exam Chart ' <?php if(!empty($post_data->name)) echo $post_data->name; ?> '</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <div class="clr"></div>
</div>
<?php // echo '<pre>'; print_r($post_data); echo '</pre>'; ?>
<?php // echo '<pre>'; print_r($exam_duty_day_slots); echo '</pre>'; ?>
<?php // echo '<pre>'; print_r($staff_list); echo '</pre>'; ?>
<?php // echo '<pre>'; print_r($exam_duty_allocations); echo '</pre>'; ?>

<?php 
    $user_exam_duty_allocations=array();
    if(!empty($exam_duty_allocations))
    foreach ($exam_duty_allocations as $key => $value) {
        $allocation_date=  dateFormat($value->allocation_date);
        $user_exam_duty_allocations[$value->user_id][$allocation_date][$value->exam_duty_day_slots_id]=$value;
    }
?>
<?php // echo '<pre>'; print_r($user_exam_duty_allocations); echo '</pre>'; ?>

<form id="post_exam_results_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    
    <ol>
        
        <li style="border:1px solid #dadada; padding-bottom:5px; overflow: auto;">
            <h4 style="margin: 5px;">Chart Details:</h4>
            <?php if(!empty($staff_list)){ ?>
            <table border="2" class="sample">
                <tbody>
                    <tr>
                        <th rowspan="2">Name of Faculty</th>
                        <?php 
                        $startDate=date('Y-m-d',strtotime($post_data->from)); 
                        $endDate=$post_data->to;
                        while($startDate<=$endDate){ /* Excluding Sunday>> */if(dateFormat($startDate, 'N')!='7'){  ?>
                        <th class="center" colspan="<?php echo count($exam_duty_day_slots); ?>"><?php echo $startDate; ?></th>
                        <?php 
                            }
                        $startDate= date('Y-m-d', strtotime($startDate . "+1 days"));
                         } ?>
                    </tr>
                    <tr>
                        <?php 
                        $startDate=date('Y-m-d',strtotime($post_data->from)); 
                        $endDate=$post_data->to;
                        while($startDate<=$endDate){ /* Excluding Sunday>> */if(dateFormat($startDate, 'N')!='7'){ ?>
                        <?php foreach($exam_duty_day_slots as $s_k=>$s_v){ ?>
                        <th align="center"><?php echo $s_v; ?></th>
                        <?php } ?>
                        <?php 
                            }
                        $startDate= date('Y-m-d', strtotime($startDate . "+1 days"));
                         } ?>
                    </tr>
                    <?php foreach($staff_list as $k=>$v){ ?>
                    <tr>
                        <td><?php echo $v->code; ?>(<?php echo $v->name; ?>)</td>
                        
                        <?php 
                        $startDate=date('Y-m-d',strtotime($post_data->from)); 
                        $endDate=$post_data->to;
                        $i=1;
                        while($startDate<=$endDate){ /* Excluding Sunday>> */if(dateFormat($startDate, 'N')!='7'){   ?>
                            <?php foreach($exam_duty_day_slots as $s_k=>$s_v){ ?>
                            <th class="center pointer">
                                <label class="pointer">
                                <?php $recordKey=$v->user_id.'_'.$s_k.'_'.$i ; ?>
                                <input type="checkbox" name="staff_allocations[<?php echo $recordKey; ?>][allocated]" title="Please check to allocate the slot" value="1" <?php if(!empty($user_exam_duty_allocations[$v->user_id]) && !empty($user_exam_duty_allocations[$v->user_id][$startDate][$s_k]) ){ echo ' checked="checked" '; } ?> />
                                <input type="hidden" name="staff_allocations[<?php echo $recordKey; ?>][allocation_date]" value="<?php echo $startDate; ?>" />
                                <input type="hidden" name="staff_allocations[<?php echo $recordKey; ?>][exam_duty_day_slots_id]" value="<?php echo $s_k; ?>" />
                                <input type="hidden" name="staff_allocations[<?php echo $recordKey; ?>][chart_id]" value="<?php echo $post_data->id; ?>" />
                                <input type="hidden" name="staff_allocations[<?php echo $recordKey; ?>][user_id]" value="<?php echo $v->user_id; ?>" />
                                <input type="hidden" name="staff_allocations[<?php echo $recordKey; ?>][mobile]" value="<?php echo $v->mobile; ?>" />
                                <input type="hidden" name="staff_allocations[<?php echo $recordKey; ?>][id]" value="<?php  if(!empty($user_exam_duty_allocations[$v->user_id]) && !empty($user_exam_duty_allocations[$v->user_id][$startDate][$s_k]) ){ $user_exam_duty_allocations[$v->user_id][$startDate][$s_k]->id; } else { echo 0; } ?>" />
                                </label>
                            </th>
                            <?php } ?>
                        <?php 
                        /*
                         * Input Name Format staff_allocations[<USER_ID>][allocated] =1
                         * staff_allocations[<USER_ID>][<OTHER_ATTRIBUTES>] =<VALUE>
                         */
                            }
                        $startDate= date('Y-m-d', strtotime($startDate . "+1 days"));
                        $i++; 
                         } ?>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php }else{ echo showBigInfo('No Staff found under the Course/Branch');  }?>
        </li>
        
        
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="upload button " value="Cancel" onclick="javascript:window.location='<?php echo site_url('exam/exam_duty'); ?>'"/>
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
    table{
        margin: 10px;
    }
    table.sample td {
        padding: 2px 10px;
        width:auto;
    }
    table.sample td input.text{
        width:100px;
        padding: 10px 2px;
    }
    table.sample th {
        min-width: 75px;
    }
    .center{
        text-align: center;
    }
    ol li label {
        width: auto;
        float: none;
    }
    .pointer{
        cursor: pointer;
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
                    'folder'    : upload_path, // '/testserver/uploads', '/mycollege/testserver/uploads',
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