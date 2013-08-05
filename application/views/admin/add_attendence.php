<div>
    <h2 align="center"><span> Add Attendence </span></h2>
    <div class="user_instructions">
        <p style="width:200px; float:left;">Please enter details below.</p>
        <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="clr"></div>
    <form action="<?php echo site_url('admin/add_attendence');?>" id="appl_form2" method="post" >
        <input id="st_id" name="st_id"  type="hidden" value="<?php echo $st_id;?>"/>
       
        <ol>
		<li>

                <label for="name">Present days:*</label>
                <input id="attd" name="attd" type="text" class="text" />
            </li>
			<li>

                <label for="name">Total days:*</label>
                <input id="attd_tot" name="attd_tot" type="text" class="text" />
            </li>
			<li>

                <label for="name">Semester:*</label>
               <select name='sem_id' id='sem_id' class="text">
	 		 <?php echo selectBox('Select','semisters','id,name','status="1"','1'); ?>
	  		</select>
            </li>
			
			<li>
                <input type="submit" name="submit"  class="send button gblue " value="Save"/>
                <div class="clr"></div>
            </li></ol>
    </form>
</div>
