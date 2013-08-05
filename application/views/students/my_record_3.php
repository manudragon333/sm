
<html>


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Administrator Control Panel</title>
	<script type="text/javascript" src="js1/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="js1/ui.core.js"></script>
	<script type="text/javascript" src="js1/ui.dialog.js"></script>
	
	
	<link href=" js1/ui.tabs.css" rel="stylesheet" media="all" />


	

</head>
<body>
	<div id="page_wrapper">
		
<script type="text/javascript" src="js1/ui.tabs.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	// Tabs
	$('#tabs, #tabs2, #tabs5').tabs();
        
        $('#month').live('change',function(){
            dataP=$('#month,#user_id').serialize();
            $.ajax({
                url:'<?php echo site_url('admin/student_attendance'); ?>',
                data:dataP,
                type:'POST',
                beforeSend:function(){
                    
                },
                success:function(dataR){
                    $('#attendance_view').html(dataR);
                }
            })
        })
		// $('#report_form').submit(function(){
//        //send ajax request
//        $.ajax({
//            url : '<?php echo base_url(); ?>admin/view_student_results',
//            type : "POST",
//			contentType: "application/x-www-form-urlencoded",
//            data : $('#report_form').serialize(),
//			dataType: "html",
//            success : function(data){
//              
//		
//				 var interv=setTimeout(function () {
//$('div#page3').load('<?php echo base_url();?>admin/view_student_results')}, 1000); // refresh every 50000 milliseconds
//
//            }
//           
//        });
//     
//      return false;
//    });
		//$('#report_form').submit(function(){
//            dataP=$('#report_form').serialize();
//            $.ajax({
//                url:'<?php echo site_url('admin/view_student_results'); ?>',
//                data:dataP,
//                type:'POST',
//				dataType: "html",
//                beforeSend:function(){
//                    
//                },
//                success:function(dt){
//					$('#result_data').html(dt);
//					
//                }
//            });
//        });

});
function subform()
{
document.result.submit();
}
</script>
		<div id="sub-nav">

			
		<div class="clear"></div>
		<div id="page-layout">
			<div id="page-content">
				<div id="page-content-wrapper">

				<div id="tabs">
					<ul>

						<li><a href="#page1">Profile</a></li>
						<li><a href="#page2">Finances</a></li>
						<li><a href="#page3">Results</a></li>
						<li><a href="#page4">Attendance</a></li>
					</ul>
					<div id="page1">

<div style="border:2px solid #4AA02c; margin:10px;padding:10px" >
<ol>

    <li>
        <label for="name">Name:</label>
<?	if (isset($student_details[0]->name))
    echo $student_details[0]->name;  ?>
    </li>
	<li>
        <label for="fathers_name">Father Name:*</label>
        <?php if (isset($student_details[0]->fathers_name))
                   echo $student_details[0]->fathers_name; ?>
    	</li>
    
    <li>
        <label for="students_number">HT Number:*</label>
        <?php if (isset($student_details[0]->students_number))
                   echo $student_details[0]->students_number; ?>
    </li>
<li>
        <label for="students_number">Course Name:*</label>
        <?php if (isset($student_details[0]->course_name))
                   echo $student_details[0]->course_name; ?>
    </li>

<li>
<label for="name">College Name:</label>
<?php if(isset($student_details[0]->college_name)) echo $student_details[0]->college_name; ?>
</li>
    
    
    <li>
        <label for="branch_id">Branch:</label>
       <?php if (isset($student_details[0]->branch_name))
                   echo $student_details[0]->branch_name; ?>

</li>
<li>
        <label for="student_number">Scholarship:</label>
       <?php if (isset($student_details[0]->scholarship)&& $student_details[0]->scholarship==1)
		echo "Yes"; 
	else echo "No";
?>

</li>
<li>
        <label for="student_number">Caste:</label>
       <?php if (isset($student_details[0]->caste))
                   echo $student_details[0]->caste; ?>

</li>
<li>
        <label for="student_number">DOJ:</label>
       <?php if (isset($student_details[0]->doj))
                   echo substr($student_details[0]->doj,0,10); ?>
</li>
<li>
        <label for="student_number">DOB:</label>
       <?php if (isset($student_details[0]->dob))
                   echo substr($student_details[0]->dob,0,10); ?>

</li>
<li>
        <label for="student_number">email:</label>
       <?php if (isset($student_details[0]->email))
                   echo $student_details[0]->email; ?>
</li>

<li>
        <label for="student_number">Mobile:</label>
       <?php if (isset($student_details[0]->mobile))
                   echo $student_details[0]->mobile; ?>
</li>
<li>
        <label for="student_number">Father's Mobile:</label>
       <?php if (isset($student_details[0]->father_mobile))
                   echo $student_details[0]->father_mobile; ?>
</li>
<li>
        <label for="student_number">Address:</label>
       <?php if (isset($student_details[0]->address))
                   echo $student_details[0]->address; ?>
</li>
<li>
<a href="<? if (isset($student_details[0]->photo)&&$student_details[0]->photo!='') echo base_url().'/'.$student_details[0]->photo; else echo "javascript:void(0)"?>">
<img src="<? if (isset($student_details[0]->photo)) echo base_url().'/'.$student_details[0]->photo?>" height="150" width="150" alt="PHOTO">
</a><a href="<? if (isset($student_details[0]->ssc)&&$student_details[0]->ssc!='') echo base_url().'/'.$student_details[0]->ssc; else echo "javascript:void(0)" ?>">
<img src="<? if (isset($student_details[0]->ssc)) echo base_url().'/'.$student_details[0]->ssc?>" height="150" width="150" alt="SSC">
</a><a href="<? if (isset($student_details[0]->inter)&&$student_details[0]->inter!='') echo base_url().'/'.$student_details[0]->inter;else echo "javascript:void(0)"?>">
<img src="<? if (isset($student_details[0]->inter)) echo base_url().'/'.$student_details[0]->inter?>" height="150" width="150" alt="INTER">
</a>
<a href="<? if (isset($student_details[0]->other)&&$student_details[0]->other!='') echo base_url().'/'.$student_details[0]->other;else echo "javascript:void(0)"?>">
<img src="<? if (isset($student_details[0]->other)) echo base_url().'/'.$student_details[0]->other?>" height="150" width="150" alt="OTHER">
</a>
</li>

    <li>
        <div class="clr"></div>
    </li>
</ol>
</div>
</div>
                        <div id="page2">

                            <table style="border:2px solid #4AA02c; margin:10px;padding:10px;width:98%">
                                <tr align="center">
                                    <th>Date</th>
                                    <th>Receipt No</th>
                                    <th>Type of Fee</th>
                                    <th>Fee for year</th>
                                    <th>Received Amount</th>
                                    <th>Payment Type</th>
                                    <th>Fee Balance</th>
                                    <th>Updated by</th>


                                </tr>

                                <?
                                if (count($payment_details) >= 1) {
                                    foreach ($payment_details as $row) {
                                        print "<tr align='center'><td>";
                                        print $row->date;
                                        print "</td><td>";
                                        print $row->receipt_no;
                                        print "</td><td>";
                                        print $row->typeoffee;
                                        print "</td><td>";
                                        print $row->feeforyear;
                                        print "</td><td>";
                                        print $row->amount;
                                        print "</td><td>";
                                        print $row->paymenttype;
                                        print "</td><td>";
                                        print $row->remarks;
                                        print "</td><td>";
                                        print $row->updatedby;
                                        print "</td></tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "</table>";
                                    echo "<br>No Records Found";
                                }
                                ?>

                            </table>
                                
                        </div>
                   
                                    
                        <div id="page4">
                            <?php // echo '<pre>'; print_r($attendance_details); echo '</pre>'; ?>
                            
                            <div style="border:2px solid #4AA02c; margin:10px;padding:10px">
                                <ol>
                                    <li>
                                        <label for="month">Month:* </label>
                                        <input type="hidden" id="user_id" name="user_id" value="<? if (!empty($student_details[0]->user_id)) echo $student_details[0]->user_id; ?>" />
                                        <select id="month" name="month" class="text" title="Please select a month">
                                            <option value="">Select</option>
                                            <?php 
                                            for($y = 2012;$y <= date('Y'); $y++){ 
                                                for($m = 1;$m <= 12; $m++){ 
                                                    $month =  date("F", mktime(0, 0, 0, $m)); 
                                                    echo "<option value='$y-$m'>$month - $y</option>"; 
                                                } 
                                            } 
                                            ?>
                                        </select>
                                    </li>
                                    <li>
                                        <div class="clr"></div>
                                    </li>
                                    <li id="attendance_view">
                                        
                                    </li>
                                </ol>
                            </div>
                            
                        </div>
     <div id="page3">
               <form id="report_form" action="" method="POST" name="result">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
	 <input id="" name="stu_results" class="text" type="hidden" value="admin_stu_results"/>
    <ol>
        <li>
            <label for="search_student_number">Student Number:* </label>
            <input id="search_student_number" name="search_student_number" class="text" type="text" value="<?php if (isset($student_details[0]->students_number))
                   echo $student_details[0]->students_number; ?>"/>
        </li>


        <?php if(isset($student_details[0]->students_number) && isset($student_details[0]->college_id)){  ?>
            
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($student_details[0]->college_id)) $college_id_select=$student_details[0]->college_id; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
            <input id="college_id" name="college_id" class="hide" type="hidden" value="<?php echo $college_id_select;  ?>"/>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text "  title="Please select Course" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($student_details[0]->course_id)) $course_id_select=$student_details[0]->course_id; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
            <input id="course_id" name="course_id" class="hide" type="hidden" value="<?php echo $course_id_select;  ?>"/>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text "  title="Please select Branch" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($student_details[0]->branch_id)) $branch_id_select=$student_details[0]->branch_id; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
            <input id="branch_id" name="branch_id" class="hide" type="hidden" value="<?php echo $branch_id_select;  ?>"/>
        </li>
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text " title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($student_details[0]->section_id)) $semister_id_select=$student_details[0]->section_id; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="semister_id">Sections:* </label>
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($student_details[0]->section_id)) $section_id_select=$s_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
        </li>
        <?php }  ?>
<!--        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text " title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($form_data['subject_id'])) $subject_id_select=$form_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','semister_id'=>$semister_id_select)); ?>
            </select>
        </li>-->

        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload button j_gen_form_submit" value="Submit" onClick="subform()"/>
        </li>
        
    </ol>
</form>
<?php if(isset($external_marks) && isset($internal_marks)){  ?>

<ol>
        <?php if(empty($external_marks) && empty($internal_marks)){  ?>
        <li>
            <h4>No Records Found.</h4>
        </li>
        <?php }else{  ?>
        <?php
            /*
             * Format MARKS
             */
             $student_internal_marks=array();
             if(!empty($internal_marks)){
                 foreach($internal_marks as $k=>$v){
//                         if(isset($student_internal_marks[$v->subject_id])){
//                             $average_marks_total=$student_internal_marks[$v->subject_id]['average_marks_total'];
//                         }else{
//                             $average_marks_total=0;
//                         }
//                         $average_marks_total+=$v->objective+$v->descriptive+$v->assignment;
                     $this_average_marks=$v->objective+$v->descriptive+$v->assignment;
                     if(isset($v->avg_marks) && !empty($v->avg_marks)){
                         $average_marks=$v->avg_marks;
                     }else if(isset($student_internal_marks[$v->subject_id]) && $student_internal_marks[$v->subject_id]['average_marks']>$this_average_marks){
                         $average_marks=$student_internal_marks[$v->subject_id]['average_marks'];
                     }else{
                         $average_marks=$this_average_marks;
                     }

                     /*
                      * Special Case for 1st Year. - Dont take best of like above. take Average of all 3 internals
                      */
                     if($v->is_first_year=='1'){
                         $totalMarksForAverageCalculation=0;
                         if(isset($student_internal_marks[$v->subject_id]['internal_1'])){
                             $totalMarksForAverageCalculation+=$student_internal_marks[$v->subject_id]['internal_1'];
                         }
                         if(isset($student_internal_marks[$v->subject_id]['internal_2'])){
                             $totalMarksForAverageCalculation+=$student_internal_marks[$v->subject_id]['internal_2'];
                         }
                         if(isset($student_internal_marks[$v->subject_id]['internal_3'])){
                             $totalMarksForAverageCalculation+=$student_internal_marks[$v->subject_id]['internal_3'];
                         }
                         $totalMarksForAverageCalculation+=$this_average_marks;
                         $average_marks=round($totalMarksForAverageCalculation/3);
                     }

                     /* Copying Prev internal Marks!!! :X */
                     $internal_1=$internal_1=0;
                     if(isset($student_internal_marks[$v->subject_id]['internal_1'])){
                         $internal_1=$student_internal_marks[$v->subject_id]['internal_1'];
                     }
                     if(isset($student_internal_marks[$v->subject_id]['internal_2'])){
                         $internal_2=$student_internal_marks[$v->subject_id]['internal_2'];
                     }

                     $student_internal_marks[$v->subject_id]=array(
                         'average_marks'=>$average_marks,
                         'subject_name'=>$v->subject_name,
                         'subject_type_id'=>$v->subject_type_id,
                         'max_credits'=>$v->credits,
                         'max_marks'=>(($form_data['is_mba']=='1')?60:(($v->subject_type_id=='1')?75:60))
                     );

                     /* Copying Prev internal Marks!!! :X */
                     if(!empty($internal_1)){
                         $student_internal_marks[$v->subject_id]['internal_1']=$internal_1;
                     }
                     if(!empty($internal_2)){
                         $student_internal_marks[$v->subject_id]['internal_2']=$internal_2;
                     }

                     $student_internal_marks[$v->subject_id]['internal_'.$v->internal_number]=$v->objective+$v->descriptive+$v->assignment;

                 }
             }
             $numberOfBacklogs=0; $subjectsBacklog=array();
             if(!empty($external_marks)){
                 foreach($external_marks as $k=>$v){
                     if(array_key_exists($v->subject_id, $student_internal_marks)){
                         $student_internal_marks[$v->subject_id]['external_marks']=$v->external_marks;
                         $student_internal_marks[$v->subject_id]['final_marks']=$v->final_marks; //($student_internal_marks[$v->subject_id]['average_marks_total']/2)+$v->external_marks;
                         $student_internal_marks[$v->subject_id]['credits']=$v->credits;
                         $student_internal_marks[$v->subject_id]['pass']=($v->pass=='1')?'Pass':'Fail';
                         $student_internal_marks[$v->subject_id]['this_db_id']=((!empty($v->id))?$v->id:0);
                         $student_internal_marks[$v->subject_id]['mode_of_exam_id']=((!empty($v->mode_of_exam_id))?$v->mode_of_exam_id:0);
                     }
                     if(isset($v->pass) && $v->pass=='0' && !in_array($v->subject_id, $subjectsBacklog)){
                         $numberOfBacklogs++;
                         $subjectsBacklog[]=$v->subject_id;
                     }
                 }
             }

        ?>
        <li id="student_marks_li">
            <h4>Result of: <?php if(isset($form_data['student_number'])){ echo $form_data['student_number']; }  ?></h4>
            <h4>Date of Join: <?php if(isset($student_data->doj)){ echo dateFormat($student_data->doj, 'd-m-Y'); }  ?></h4>
            <h4>Present Semester: <?php if(isset($student_data->sem_id)){ echo generalId('name','semisters','id',$student_data->sem_id); }  ?></h4>
            <h4>No. of Backlogs: <?php if(isset($numberOfBacklogs)){ echo $numberOfBacklogs; }  ?></h4>
            <br/>
            <table class="sample table_view">
                <tr>
                    <th>Subject</th>
                    <th>Internal 1</th>
                    <th>Internal 2</th>
                    <?php if(isset($student_internal_marks[key($student_internal_marks)]['internal_3'])){ $internal_3_exists=true; ?>
                    <th>Internal 3</th>
                    <?php }  ?>
                    <th>Average Marks</th>
                    <th>Marks Awarded</th>
                    <th>Final Marks</th>
                    <th>Credits</th>
                    <th>Pass</th>
                </tr>
                <?php
                if(!empty($student_internal_marks)){
                foreach($student_internal_marks as $k=>$v){
                    $avg_marks=0;
                    ?>
                <tr>
                    <td><?php echo $v['subject_name'];  ?>:</td>
                    <td <?php if(isset($internal_3_exists) && $internal_3_exists && $v['subject_type_id']=='2'){ echo 'colspan="3" '; } else if($v['subject_type_id']=='2'){ echo 'colspan="2" '; } ?> ><?php  if(!empty($v['internal_1'])) echo $v['internal_1'];?></td>
                    <?php if($v['subject_type_id']!='2'){  ?>
                    <td><?php  if(!empty($v['internal_2'])) echo $v['internal_2'];  ?></td>
                    <?php if(isset($internal_3_exists) && $internal_3_exists){  ?>
                    <td><?php  if(!empty($v['internal_3'])) echo $v['internal_3'];  ?></td>
                    <?php }  ?>
                    <?php }  ?>
                    <td>
                        <?php echo $v['average_marks'];  ?>
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][this_db_id]" value="<?php if(!empty($v['this_db_id'])) echo $v['this_db_id'];  ?>" />
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][average_marks]" value="<?php echo $v['average_marks'];  ?>" />
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][subject_type_id]" value="<?php echo $v['subject_type_id'];  ?>" />
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][max_credits]" value="<?php echo $v['max_credits'];  ?>" />
                    </td>
                    <td>
                        <?php if(isset($form_data['view_only'])){  ?>
                            <?php if(isset($v['external_marks'])){  echo $v['external_marks']; }
                                  if(!empty($v['mode_of_exam_id']) && $v['mode_of_exam_id']=='2'){ echo '<b> *</b>'; }  ?>
                        <?php }else{  ?>
                        <input id="student_marks_<?php echo $k;  ?>" name="student_marks[<?php echo $k;  ?>][external_marks]" class="text required ip_external" max_marks="<?php if(isset($v['max_marks'])){ echo $v['max_marks']; }  ?>" title="Please enter Marks" <?php if(isset($v['external_marks'])){  echo 'value="',$v['external_marks'],'"'; if($form_data['mode_of_exam_id']!='2') echo ' readonly="readonly" '; }  ?> />
                        <?php if(!empty($v['mode_of_exam_id']) && $v['mode_of_exam_id']=='2'){ echo '<b> *</b>'; }  ?>
                        <?php }  ?>
                    </td>
                    <td>
                        <?php if(isset($v['final_marks'])){ echo $v['final_marks']; }  ?>
                    </td>
                    <td>
                        <?php if(isset($v['credits'])){ echo $v['credits']; }  ?>
                    </td>
                    <td>
                        <?php if(isset($v['pass'])){ echo $v['pass']; }  ?>
                    </td>
                </tr>
                <?php }
                }
                ?>
            </table>
        </li>
        <?php }  ?>
</ol>
<br/>
<br/>
<br/>
<br/>
<b>*</b> :<i> Represents Supplementary/Re-sitted Marks. </i>


<?php }  ?>
                        </div>
                    </div>



                    </div>
                    <div class="clear"></div>
                </div>
		</div>
	</div>
</body>


</html>
<script type="text/javascript">
    $(function(){
        $('#report_form').validate();

        $('#report_form select').change(function(){
            $('#report_li').html('');
        });


        $('select[name=branch_id]').live('change',function(){
           if($('select[name=semister_id]').length>0){
            $.post(site_url+'/students/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
                $('select[name=semister_id]').html(dataR);
            })
           }
           if($('select[name=sem_id]').length>0){
            $.post(site_url+'/students/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
                $('select[name=sem_id]').html(dataR);
            })
           }
        });
        $('select[name=semister_id]').live('change',function(){
           if($(this).hasClass('getStaffSubjects') && $('select[name=subject_id]').length>0){
                $.post(site_url+'/staff/getStaffSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
                    $('select[name=subject_id]').html(dataR);
                });
           }else  if($('select[name=subject_id]').length>0){
            $.post(site_url+'/students/getCollegeSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
                $('select[name=subject_id]').html(dataR);
            })
           }
        });
        $('select[name=sem_id]').live('change',function(){
           if($('select[name=subject_id]').length>0){
            $.post(site_url+'/students/getCollegeSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=sem_id]').val(),function(dataR){
                $('select[name=subject_id]').html(dataR);
            })
           }
        });


    });
</script>





