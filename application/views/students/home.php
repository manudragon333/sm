<ul class="collegeUpdates">
    <?php if(isset($notice_board) && count($notice_board)>0){ 
        foreach($notice_board as $v){
    ?>
    <li>
        <img src="<?php echo base_url(); ?>css/images/pushpin_pink.png" class="upd_std" alt="user"/>
        <?php echo $v->message; ?>
        <div class="post_date p_a"><span>Posted on: </span> <?php echo dateFormat($v->date_added, 'd-M-y'); ?> </div>
    </li>
    <?php
        }
    }else{ ?>
    <li>
        <p>No College News.</p>
    </li>
    <?php } ?>
</ul>