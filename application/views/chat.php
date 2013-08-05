<?php // session_start(); echo '<pre>';print_r($_SESSION); die;// echo '<pre>'; print_r($users); echo '</pre>'; ; ?>
Online users
<div>
<?php if(count($users)){ foreach($users as $k=>$v){ ?>
    <div class="chat_links"><a href="javascript:void(0)" class="online_icon tf_animation" onclick="javascript:chatWith('<?php echo str_replace(' ', '_', $v['user_type']).'-'.str_replace(' ', '_', $v['username']); ?>')">Chat With:  <?php echo $v['user_type'].'-'.$v['username']; ?></a></div>
<?php }}else{ ?>
<p>No users online.</p>
<?php } ?>
</div>