
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
});
</script>
		<div id="sub-nav">
			
		<div id="page-layout">
			<div id="page-content">
				<div id="page-content-wrapper">

				<div id="tabs">
					<ul>

						<li><a href="#page1">Profile</a></li>
						<li><a href="#page2">Finances</a></li>
						<li><a href="#page3">Results</a></li>
					</ul>
					<div id="page1">

<div>
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

<table style="border:2px solid #999; margin:10px;padding:10px;width:98%">
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
if(count($payment_details)>=1)
{
foreach($payment_details as $row)
{
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
}
else
{
echo "</table>";
echo "<br>No Records Found";
}
?>



					</div>
					<div id="page3">
                                            <div class="results_wrap">
                                                <?php // echo '<pre>'; print_r($student_details); echo '</pre>'; ?>
                                                <form id="appl_form" action="exam/view_student_results" method="POST">
                                                <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
                                                <input name="only_results_table" class="text" type="hidden" value="true"/>
                                                <ol>
                                                <li>
                                                    <label for="search_student_number">Student Number:* </label>
                                                    <input id="search_student_number" name="search_student_number" class="text" type="text" value="<?php if(isset($student_details[0]->students_number)) echo $student_details[0]->students_number;  ?>" readonly="readonly"/>
                                                </li>
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
                                                        <?php if(isset($student_details[0]->semister_id)) $semister_id_select=$student_details[0]->semister_id; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
                                                    </select>
                                                </li>
                                                <li>
                                                    <label for="section_id">Sections:* </label>
                                                    <select id="section_id" name="section_id" class="text" title="Please select a Section">
                                                        <option value="">Select</option>
                                                        <?php if(isset($student_details[0]->section_id)) $section_id_select=$student_details[0]->section_id; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
                                                    </select>
                                                </li>
                                                <li>
                                                    <br/>
                                                    <input type="submit" name="imageField" id="imageField" class="upload button gblue j_gen_form_submit" value="Submit"/>
                                                </li>
                                                </ol>
                                                </form>

                                            </div>
					</div>

				</div>



				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</body>


</html>