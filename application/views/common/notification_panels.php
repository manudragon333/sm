
<h3>Notifications:</h3>
<?php
$notificationCategories=array();
if (isset($notifications) && count($notifications) > 0) {
    foreach ($notifications as $key => $value) {
        $notificationCategories[$value->users_type_id][]=$value;
    }
}
?>

<ul style="margin-left: 100px;">
    <li style="list-style: none;">
        
        <div class="notification_box">
            <h4>Admin Notifications</h4>
            <div class="slide_wrap">
            <?php if(!empty($notificationCategories[9])){          
                foreach ($notificationCategories[9] as $key => $value) {
                    echo '<div class="slide '.($key==0?'first':'').'">',$value->message,'</div>';
                } ?>
            </div>
            <div class="clear clearboth spacer"></div>
            <img class="nextNoti" src="<?php echo base_url(); ?>/css/images/next.png"/><img class="prevNoti" src="<?php echo base_url(); ?>/css/images/prev.png"/>
            <?php
            }else echo showBigInfo('No Notifications'),'</div><br/>';  ?>
            <div class="clear clearboth"></div>
            
        </div>
        
        <div class="notification_box">
            <h4>Exam Notifications</h4>
            <div class="slide_wrap">
            <?php if(!empty($notificationCategories[8])){          
                foreach ($notificationCategories[8] as $key => $value) {
                    echo '<div class="slide '.($key==0?'first':'').'">',$value->message,'</div>';
                } ?>
            </div>
            <div class="clear clearboth spacer"></div>
            <img class="nextNoti" src="<?php echo base_url(); ?>/css/images/next.png"/><img class="prevNoti" src="<?php echo base_url(); ?>/css/images/prev.png"/>
            <?php
            } else echo showBigInfo('No Notifications'),'</div><br/>'; ?>
        </div>
        
        <div class="notification_box clear clearboth">
            <h4>Hod Notifications</h4>
            <div class="slide_wrap">
            <?php if(!empty($notificationCategories[3])){         
                foreach ($notificationCategories[3] as $key => $value) {
                    echo '<div class="slide '.($key==0?'first':'').'">',$value->message,'</div>';
                } ?>
            </div>
            <div class="clear clearboth spacer"></div>
            <img class="nextNoti" src="<?php echo base_url(); ?>/css/images/next.png"/><img class="prevNoti" src="<?php echo base_url(); ?>/css/images/prev.png"/>
            <?php
            } else echo showBigInfo('No Notifications'),'</div><br/>'; ?>
        </div>
        
        <div class="notification_box">
            <h4>Office Notifications</h4>
            <div class="slide_wrap">
            <?php if(!empty($notificationCategories[6])){         
                foreach ($notificationCategories[6] as $key => $value) {
                    echo '<div class="slide '.($key==0?'first':'').'">',$value->message,'</div>';
                } ?>
            </div>
            <div class="clear clearboth spacer"></div>
            <img class="nextNoti" src="<?php echo base_url(); ?>/css/images/next.png"/><img class="prevNoti" src="<?php echo base_url(); ?>/css/images/prev.png"/>
            <?php
            } else echo showBigInfo('No Notifications'),'</div><br/>'; ?>
        </div>
        
        
        <div class="clear clearboth"></div>
    </li>
</ul>



<style type="text/css">
    .notification_box{
        float: left;
        border: 1px solid #444;
        box-shadow: 1px 1px 1px #536059;
        border-radius: 8px;
        padding: 8px;
        margin: 5px;
        width: 380px;
        overflow: auto;
    }
    .notification_box h4{
        margin-top: 2px;
    }
    .notification_box .slide_wrap{
        min-height: 100px;
    }
    .notification_box .slide{
        display: none;
    }
    .notification_box .slide.first{
        display: block;
    }
    .content .mainbar .prevNoti, .content .mainbar .nextNoti{
        background: none;
        border: none;
        margin: 0;
        float: right;
    }
    .spacer{height: 5px;}
</style>

<script type="text/javascript">
    $(function(){
        $('.prevNoti').live('click',function(event, param1){
            var slides=$(this).parents('.notification_box:first').find('.slide'),
            totalSlides=slides.length,
            presentSlideEQ=$(this).parents('.notification_box:first').find('.slide:visible').index(),
            slideToShowEQ=(presentSlideEQ-1<0?totalSlides-1:presentSlideEQ-1);
            
            if(typeof param1=='undefined'){ slides.addClass('skipAuto'); }
            if(slides.eq(slideToShowEQ).hasClass('skipAuto') && typeof param1!='undefined'){
                slides.removeClass('skipAuto');
            }else{
                slides.hide();
                slides.eq(slideToShowEQ).slideDown('fast');
            }
        });
        
        $('.nextNoti').live('click',function(event, param1){
            var slides=$(this).parents('.notification_box:first').find('.slide'),
            totalSlides=slides.length,
            presentSlideEQ=$(this).parents('.notification_box:first').find('.slide:visible').index(),
            slideToShowEQ=(presentSlideEQ+1>=totalSlides?0:presentSlideEQ+1);
            
            if(typeof param1=='undefined'){ slides.addClass('skipAuto'); }
            if(slides.eq(slideToShowEQ).hasClass('skipAuto') && typeof param1!='undefined'){
                slides.removeClass('skipAuto');
            }else{
                slides.hide();
                slides.eq(slideToShowEQ).slideDown('fast');
            }
        });
        
        setInterval(function(){
            $('.nextNoti').trigger('click',['auto']);
        }, 5000);
    });
</script>
