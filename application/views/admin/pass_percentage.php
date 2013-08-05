<?php // print_r($result_data);?>
<div>
    <h2 align="center"><span> Search Report</span></h2>
    <div class="user_instructions">
        <p style="width:200px; float:left;">Please enter details below.</p>
        <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="clr"></div>
    <form action="<?php echo site_url('admin/pass_percentage');?>" id="appl_form2" method="post" >
       
        <ol>
			<li>

                <label for="name">Semister :*</label>
               <select name='sem_id' id='sem_id' class="text">
	 		 <?php  echo selectBox('All','semisters','id,name','status="1"',$sem_id); ?>
	  		</select>
            </li>
			<li>

                <label for="name">Branches :*</label>
               <select name='br_id' id='br_id' class="text">
	 		 <?php echo selectBox('All','branches','id,name','status="1"',$br_id,'name'); ?>
	  		</select>
            </li>
			<li>

                <label for="name">Subjects :*</label>
               <select name='sub_id' id='sub_id' class="text">
	 		 <?php echo selectBox('All','subjects','id,name','status="1"',$sub_id,'name'); ?>
	  		</select>
            </li>
			<li>

                <label for="name">Percentage :*</label>
               <select name='p_id' id='p_id' class="text">
	 			<option value="">All</option>
				<option value="39" <?php if($p_id==39) echo "selected='selected'";?>>Less Than 40</option>
				<option value="40" <?php if($p_id==40) echo "selected='selected'";?>>Greater Than 40</option>
				<option value="59" <?php if($p_id==59) echo "selected='selected'";?>>Between 40 to 60</option>
				<option value="60" <?php if($p_id==60) echo "selected='selected'";?>>Greater Than 60</option>
	  		</select>
            </li>
			<li>
			 <label for="name">Year :*</label>
			<select name='year_id' id='year_id' class="text">
	 		 <?php $html='';for($i=date('Y')-10;$i<=date('Y');$i++){ 
				  if(date('Y')==$i){ 
						 $html.=" selected='selected' "; 
				  }
				echo "<option value='".$i."' ".$html.">".$i."</option>";
			 }//echo selectBox('Select','marks_type','id,name','status="1"','1'); ?>
	  		</select>
			</li>
			<li>
                <input type="submit" name="submit"  class=" button gblue" value="Search"/>
                <div class="clr"></div>
            </li></ol>
    </form>
</div>
<br/><hr/>
<?php if($result_data && count($result_data)){
?>
<h4>Search results</h4>
<table class="sample table_view">
    <tr>
        <th>S.no</th>
        <th>Username</th>
		 <th>First Name</th>
		  <th>Last Name</th>
        <th>Total Marks</th>
        <th>View Marks</th>
    </tr>
    <?php $i=1; foreach($result_data as $v){ //$v=(object) $v_arr; ?>
    <tr>
        <th><?php echo $i; ?></th>
        <th><?php echo $v->username; ?></th>
		<th><?php echo $v->fname; ?></th>
        <th><?php echo $v->lname; ?></th>
		 <th><?php echo $v->t_marks/1; ?></th>
        <th><a target="_blank" href="<?php echo site_url('admin/view_marks/'.$v->student_id); ?>">View marks</a></th>
    </tr>
    <?php $i++; } ?>
</table>

<?php }else if(isset($_POST['sem_id'])){ ?>
    <h4>Search results</h4>
    <div class="error">No results found.</div>
<?php } ?>