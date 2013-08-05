<div>
    <h2 class="fl"><span>Your Leave Letters</span></h2>
    <ol class="fr">
        <li>
            <a href="<?php echo site_url('staff/apply_leave')  ?>"><input type="button" value="Apply Leave" id="add_user_btn" class="send button" style="margin-top: 0;"/></a>
        </li>
    </ol>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<br/>

<div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
</div>

<script type="text/javascript" rel="javascript">
    leave_letter_grid();
</script>