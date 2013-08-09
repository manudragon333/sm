<div class="f_r f_b m_r_10">* required fields</div>

<form id="send_student_marks_form" action="" method="POST">
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
            <select id="semister_id" name="semister_id" class="text getStaffSubjects required" title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($form_data['semister_id'])) $semister_id_select=$form_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
<!--        <li>
            <label for="section_id">Sections:* </label>
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($form_data['section_id'])) $section_id_select=$form_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
        </li>-->
<!--        <li>
            <label for="batch_id">Batch No:* </label>
            <select id="batch_id" name="batch_id" class="text required" title="Please select a Batch">
                <option value="">Select</option>
                <?php if(isset($form_data['batch_id'])) $batch_id_select=$form_data['batch_id']; else $batch_id_select=0; echo load_select('batch_nos',$batch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>-->
        
        <li>
            <label for="marks_types_id">Internals:* </label>
            <?php if(!empty($marks_types)){ ?>
                <?php foreach ($marks_types as $key => $value) { if($value->id!=1){ /*Not Displaying External*/?>
            <label>
                <input type="checkbox" value="<?php echo $value->id-1; /* SOMEONE HAD CODED THE INTERNAL IDS Instead taking from DB while assigning/saving in DB SO ADJUSTED ID BY -1 */ ?>" name="marks_types_ids[]" class="required " title="Please select a Internal" <?php if(!empty($form_data['marks_types_ids']) && in_array($value->id-1, $form_data['marks_types_ids'])){ echo 'checked="checked"';  } ?>/> <?php echo $value->name; ?>
            </label>
                <?php }} ?>
            <?php } ?>
        </li>
        <li id="internal_error_li">
        </li>
         
        <?php if(isset($students_data) && !empty($students_data)){
            /*
             * Show the Students Progress report.
             */
            ?>
             <?php
            foreach($students_data as $k=>$v){
            ?>
            <li id="student_marks_li">
                <br/>
                <hr/>
                <br/>
                <h3><?php echo $v->name;  ?> (<?php echo $v->students_number; // $v->user_id ?>):</h3>
            </li>
            <li>
                <h3>Progress Report:</h3>
            </li>
            
<!--            PROGRESS REPORT START -->
            
        <?php if(isset($subjects_data) && empty($subjects_data)){ ?>
            <li>
                <br/>
                <b>No Subjects Found.</b>
            </li>
        <?php } else if(isset($subjects_data)){ ?>
            <li>
                <div style="border: 1px solid; padding:10px; background: white; box-shadow: 2px 2px 2px #777;" id="card_print_<?php echo $k; ?>" class="br8 card_print">
                    <div class="head">
                        <div class="fl b p5 br5" style="">
                            <img height="50" src="<?php echo base_url().generalId('college_logo', 'colleges', 'id', $v->college_id); ?>"/>
                        </div>
                        <div class="fr b p5 ml5 br5">
                            <?php echo $v->address; ?>
                        </div>
                        <div class="clearboth"></div>
                    </div>
                    <br/>

                    <div class="head center p5 b br5 report_head">
                        <p><?php echo generalId('college_address', 'colleges', 'id', $v->college_id); ?></p>
                    </div>

                    <div class="head">
                        <div class="fr p5 ml5">
                            <?php echo date('Y-M-d'); ?>
                        </div>
                        <div class="clearboth"></div>
                    </div>
                    <div class="head center p5 b br5 report_head">
                        <p style="text-decoration: underline;">PROGRESS REPORT</p>
                    </div>
                    <br/>
                    <div class="head  p5 ">
                        Dear Parent <br/>
                        Your ward <?php echo $v->name; ?> Student Number <?php echo $v->students_number; ?>
                        Mobile no <?php echo $v->father_mobile; ?> Studying <?php echo $v->sem_name; ?>
                        , these are the marks he/she got for Below Internals
                    </div>
                    <br/>

                    <table class="sample table_view b br5"  style="width: 95%;margin: 0 auto;">
                        <tr>
                            <th> Subject </th>
                            <th> Max Marks</th>
                            <th> Marks Secured</th>
                        </tr>
                        <?php if(!empty($marks_types)){ ?>
                            <?php foreach ($marks_types as $key => $value) { $internal_number=$value->id-1;if($value->id!=1 && !empty($form_data['marks_types_ids']) && in_array($internal_number, $form_data['marks_types_ids'])){ /*Not Displaying External && Not Showing non-selected subjects */?>
                                <tr>
                                    <td colspan="3"> <i><b><?php echo $value->name; ?></b></i> </td>
                                </tr>
                                <?php
                                foreach($subjects_data as $sub_k=>$sub_v){
                                ?>
                                <tr>
                                    <td><?php echo $sub_v->name;  ?></td>
                                    <td>25</td>
                                    <td>
                                        <?php 
                                        if(isset($student_marks[$v->user_id][$sub_v->id][$internal_number])){
                                            $total_marks1= $student_marks[$v->user_id][$sub_v->id][$internal_number]['objective']+$student_marks[$v->user_id][$sub_v->id][$internal_number]['descriptive']+$student_marks[$v->user_id][$sub_v->id][$internal_number]['assignment'];
                                        }else{
                                            $total_marks1= 'N/a';
                                        }
                                        echo $total_marks1; 
                                        ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php }} ?>
                        <?php } ?>

                    </table>
                    <br/>
                    <div class="head  p5 ">
                        Your Ward Mentor (In charge) name:  <br/>
                        Designation of the Mentor, Mobile No : 
                    </div>

                    <div class="head  p5 ">
                        NOTE: the student Failing Short of 75% of Attendance will not be sent to JNTU end examinations.and also confirm the mobile number <?php echo $v->father_mobile; ?>.
                    </div>
                    <br/>
                    <style type="text/css">
                        /* PLACED TO GET STYLES IN PRINT */
                            table.sample td {
                                padding: 2px;
                            }
                            table.sample td input{
                                width: 50px;
                                padding: 3px 1px;
                            }
                            
                            table.print_view{
                                border-collapse: collapse;
                            }
                            table.print_view td{
                                padding: 2px;
                                font-size: 11px;
                            }
                            
                            .b{
                                border:1px solid;
                            }
                            .p10{
                                padding: 10px;
                            }
                            .p5{
                                padding: 5px;
                            }
                            .br5{
                                border-radius: 5px;
                            }
                            .br8{
                                border-radius: 8px;
                            }
                            .ml5{
                                margin-left: 5px;
                            }
                            .ml10{
                                margin-left: 10px;
                            }
                            .center{
                                text-align: center;
                            }
                            .card_print .head img{
                                margin: 0;
                            }
                            .report_head p{
                                font-size: 14px;
                                font-weight: bold;
                                margin-bottom: 0;
                                padding: 0;
                            }
                    </style>
                </div>
                
<!--                <br/>
                <input type="button" name="imageField" id="" class="upload button print_card_btn" value="Print Card"/>-->
            </li>
            
        <?php } ?>
        
<!--            PROGRESS REPORT END -->
            
            <?php } ?>
            <br/>
            <input type="button" name="imageField" id="" class="upload gblue button print_all_cards_btn" value="Print All Cards"/>
            <br/>
            <br/>
            <input type="button" name="imageField" id="" class="upload gblue button print_all_cards_together_btn" value="Print All Cards Together"/>
        <?php 
        }
        ?>
        <?php if(isset($students_data) && empty($students_data)){ ?>
            <li>
                <br/>
                <b>No Students Found.</b>
            </li>
        <?php }  ?>
            
        
            
        <?php if(!isset($subjects_data)){ ?>
        <li>
            <input type="submit" name="imageField" id="imageField" class="upload gblue button j_gen_form_submit" value="Submit"/>
        </li>
        <?php } ?>
    </ol>
</form>


<script type="text/javascript">
    $(function(){
        $('#send_student_marks_form').validate({
            errorPlacement: function(error, element) {
                if(element.attr('name')=='marks_types_ids[]')
                    error.appendTo( $('#internal_error_li') );
                else if(element.attr('name')=='subject_ids[]')
                    error.appendTo( $('#student_marks_li') );
                else
                    error.appendTo( element.parent() )
            }
        });
    });
    
    function send_teacher_sms(id){
        dataP='subject_id='+id+' ';
        $.ajax({
            url:site_url+'/staff/send_teacher_sms',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                alert('SMS sent to teacher');
            }
        });
    }
    
    $('.print_card_btn').live('click',function(){
        $(this).parent('li').find('table').addClass('print_view');
        $(this).parent('li').find('.card_print').css('width','700px').printElement();
        $(this).parent('li').find('.card_print').css('width','');
        $(this).parent('li').find('table').removeClass('print_view');
    });
    
    $('.print_all_cards_btn').live('click',function(){
        $('.card_print table').addClass('print_view');
        $('.card_print').css('width','700px').printElement();
        $('.card_print').css('width','');
        $('.card_print table').removeClass('print_view');
    });
    
    $('.print_all_cards_together_btn').live('click',function(){
        $('.card_print table').addClass('print_view');
        $('.card_print').css('width','700px');
        
        printHtml='';
        $.each($('.card_print'),function(){
            printHtml+='<br/><br/><br/>'+$('<div></div>').html($(this).clone()).html();
        });
        $('<div>'+printHtml+'</div>').printElement();
        
        $('.card_print').css('width','');
        $('.card_print table').removeClass('print_view');
    });
    
</script>