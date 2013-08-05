<div>
    <h2 align="center"><span> Add Details </span></h2>
    <div class="user_instructions">
        <p style="width:200px; float:left;">Please enter details below.</p>
        <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="clr"></div>
    <form action="<?php echo site_url('admin/add_marks');?>" id="appl_form2" method="post" >
        <input id="st_id" name="st_id"  type="hidden" value="<?php echo $st_id;?>"/>
		<input id="sm_id" name="sm_id"  type="hidden" value="<?php echo $sm_id;?>"/>
       
        <ol>
            <li>
                <label for="name">Exam Type:*</label>
                <select name='type_id' id='type_id' class="text">
                     <?php echo selectBox('Select','marks_type','id,name','status="1"','1'); ?>
                </select>
            </li>
            <?php foreach($subjects as $row){?>
            <li>
                <label for="name"><?php echo $row->name;?>:*</label>
                <input id="marks[<?php echo $row->bssid;?>]" name="marks[<?php echo $row->bssid;?>]" class="text" />
            </li>
            <?php } ?>
<li>

                <label for="name">Year:*</label>
               <select name='year_id' id='year_id' class="text">
	 		 <?php $html='';for($i=date('Y')-2;$i<=date('Y');$i++){ 
				  if(date('Y')==$i){ 
						 $html.=" selected='selected' "; 
				  }
				echo "<option value='".$i."' ".$html.">".$i."</option>";
			 }//echo selectBox('Select','marks_type','id,name','status="1"','1'); ?>
	  		</select>
            </li>
            <li>
                <input type="submit" name="submit"  class=" button gblue" value="Save"/>
                <div class="clr"></div>
            </li>
        </ol>
    </form>
</div>
