    <?php if(isset($notice_board) && count($notice_board)>0){ 
        echo pinBoardMsg($notice_board);
    }else{ echo pinBoardMsg(array()); } ?>


<?php $this->load->view('common/notification_panels') ?>
