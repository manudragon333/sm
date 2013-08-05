<div>
    <h2 align="center"><span> Edit Marks </span></h2>
    <div class="user_instructions">
        <p style="width:200px; float:left;">Please enter details below.</p>
        <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="clr"></div>
	<?php if(!empty($subjects)) foreach($subjects as $v){ ?>
    <form action="<?php echo site_url('admin/edit_marks');?>" id="appl_form2" method="post" >
        <input id="st_id" name="st_id"  type="hidden" value="<?php echo $v->st_id;?>"/>
		<input id="sm_id" name="sm_id"  type="hidden" value="<?php echo $v->sm_id;?>"/>
       
        <ol>
		 <li>
                <label for="name">Student Name:*</label>
               <b><?php echo $v->username;?></b>
            </li>
            <li>
                <label for="name">Subject:*</label>
               <?php echo $v->sname;?>
            </li>
           <li>
                <label for="name">External:*</label>
                <input type="text" id="extr" name="extr" class="text" value="<?php echo $v->marks/1;?>" />
            </li>
            <li>
                <label for="name">Internal 1:*</label>
                <input type="text" id="intr1" name="intr1" class="text" value="<?php echo $v->internal_1/1;?>" />
            </li>
           <li>
                <label for="name">Internal 2:*</label>
                <input type="text" id="intr2" name="intr2" class="text" value="<?php echo $v->internal_2/1;?>" />
            </li>
			<li>
                <label for="name">Internal 3:*</label>
                <input type="text" id="intr3" name="intr3" class="text" value="<?php echo $v->internal_3/1;?>" />
            </li>

            <li>
                <input type="submit" name="submit"  class=" button gblue" value="Save"/>
                <div class="clr"></div>
            </li>
        </ol>
    </form>
	<?php } ?>
</div>
