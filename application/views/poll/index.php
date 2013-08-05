<ol>
    <?php if(!empty($poll)){ foreach($poll as $p){?>
    <form action="<?php echo site_url('poll/voting');?>" id="appl_form2" method="post" >
        <input type="hidden" name="pid" id="pid" value="<?php echo $p['id'];?>" />
        <li class="ui-widget-header" style="padding-left: 5px;">
            <label for="name"><?php echo $p['question'];?> :</label>
            <br class="clear" style="clear:both;"/>
        </li>
		<?php foreach($p['options'] as $op){
		?>
        <li style="border: 1px solid #CCC;border-top: none; padding-left: 30px;">
             <label for="name"><?php echo $op['label'];?>:</label>
             <?php if($op['is_voted']==''){?>
        	<input type="radio" name="opt" id="opt" value="<?php echo $op['id'];?>" />
            <?php } else {
            $vote_percent=($op['votes']*100)/$op['tot'];?>
            <div style="width:100px; border: 1px solid #666;float: left;"><div style="width:<?php echo $vote_percent; ?>px; background: #ccc;float: left;">&nbsp;</div></div><div style="float: left;padding-left: 7px;"><?php echo $vote_percent; ?>%</div>
            <?php } ?>
            <br class="clear" style="clear:both;"/>
        </li>
		<?php 
		} if($p['is_voted']==''){ ?>
        <li style="border: 1px solid #CCC;border-top: none; padding-left: 30px; padding-bottom: 10px;">
            <input type="submit" name="submit"  class="gblue button " value="Vote"/>
            <div class="clr"></div>
        </li><?php }?>
    </form>
    <li><br/><hr/><br/></li>
    <?php } } else{ ?>
    <div class="big_info">No Polls Found.</div>
    <?php } ?>

</ol>

