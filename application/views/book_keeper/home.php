<h2><span>Welcome to My College.</span></h2>
<div class="clr"></div>
<p style="width:200px; float:left;">College updates.</p>
<!--<p style="width:200px; float:right;font-weight: bold;"><i> required fields</i></p>-->
<div class="clr"></div>
<ul style="margin-left: 100px;">
    <?php if(isset($notice_board) && count($notice_board)>0){ 
        foreach($notice_board as $v){
    ?>
    <li>
        <p><?php echo $v->message; ?></p>
    </li>
    <?php
        }
    }else{ ?>
    <li>
        <p>No College News.</p>
    </li>
    <?php } ?>
</ul>