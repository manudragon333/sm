<script>
var i=1;
var j=2;

function addSubject()
{

if(parseInt(i)<=20)
{
var table=document.getElementById('t');
table.style.display='block';
//var div=document.getElementById('div');
//table.appendChild(document.createElement('<tr>').innerHTML="<p>hi</p>");
var tr=document.createElement('TR');
var td0=document.createElement('TD');
var td1=document.createElement('TD');
var td2=document.createElement('TD');
var td3=document.createElement('TD');
td0.innerHTML=i;

	var subject = document.createElement("input");
	//subject.setAttribute("type", 'input');
	subject.setAttribute("id", 'subject'+i);
	subject.setAttribute("name", 'subject'+i);
	subject.setAttribute("value", 'subject'+i);
	subject.setAttribute("class", 'required text mdl_ip');
	td1.appendChild(subject);

	var credits = document.createElement("input");
	credits.setAttribute("type", 'input');
	credits.setAttribute("id", 'credits'+i);
	credits.setAttribute("name", 'credits'+i);
	credits.setAttribute("class", 'text mdl_ip');
	credits.setAttribute("maxlength", '1');
	credits.setAttribute("onkeydown", "return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106)|| (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )");

	var stype = document.createElement("select");
	stype.setAttribute("id", 'subject_type_id'+i);
	stype.setAttribute("name", 'subject_type_id'+i);
	stype.setAttribute("class", 'sl_bx');
	stype.innerHTML="<option value='1'>Subject</option><option value='2'>Lab</option>";
td2.appendChild(stype);
//td2.innerHTML="<select id='subject_type_id' name='subject_type_id' class='required'><option><?php if(isset($s_data['subject_type_id'])) $subject_type_id_select=$s_data['subject_type_id']; else $subject_type_id_select=0; echo load_select('subject_type',$subject_type_id_select,array('status'=>'1')); ?></select>";
td3.appendChild(credits)
tr.appendChild(td0);
tr.appendChild(td1);
tr.appendChild(td2);
tr.appendChild(td3);
table.appendChild(tr);
i=i+1;

}
else
{
alert('Subject Limit Exceeded');
return false;
}
}


function formReset()
{
document.forms[0].reset();
var subject=document.getElementsByName('subject');
var type=document.getElementsByName('type');
var credits=document.getElementsByName('credits');
//alert(list.length);
for(var i=0;i<subject.length;i++)
subject[i].value='';
for(var i=0;i<type.length;i++)
type[i].value='';
for(var i=0;i<credits.length;i++)
credits[i].value='';

}
</script>

<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/admin/add_subject">
    <input id="" name="rel" class="text" type="hidden" value="add_subject"/>
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($college_data[0]['id'])) echo $college_data[0]['id']; ?>"/>
    <ol>
        <?php if(isset($college_data[0]['id'])){
            $s_data=$college_data[0];
        } ?>
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text required">
                <option value="">Select</option>
                <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>
        
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text required" title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($s_data['semister_id'])) $semister_id_select=$s_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
<!--        <li>
            <label for="semister_id">Admission Year </label>
            <select id="academic_year_id" name="academic_year_id" class="text required" title="Please select a Academic Year">
                <option value="">Select</option>
                <?php // if(isset($s_data['academic_year_id'])) $academic_year_select=$s_data['academic_year_id']; else $academic_year_select=0; echo load_select('admission_years',$semister_id_select,array('status'=>'1')); ?>
            </select>
           
        </li>-->
        
        <!--<li  style="margin-left:540px">
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save Subject"/>
            <div class="clr"></div>
        </li> -->
		<li>
		    <input type="button" onClick="addSubject()" class="button green" value="+ Add New Subject"/>
		</li>
		<li>
		
		<table id="t" class="table_view" name="t" width="70%" border="0" style="display:none;margin-left:0px;cell-padding:20px;cell-spacing:5px">
			<thead>
			<tr>
				<td width="10%"> S No</td>
				<td width="20%">Subject</td>
				<td width="20%">Type</td>
				<td width="20%">Credits</td>
			</tr>
			</thead>
		</table>
		</li>
		<li>
		<input type="button" name="imageField" id="imageField" class="button gblue j_gen_form_submit" value="Save Subject"/>
		<input type="button" onClick="formReset()"  class="button grey m_l_20" value="Reset"/>
		</li>
    </ol>
</form>