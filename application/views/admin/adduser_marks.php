<div>
    <h2 align="center"><span>  Add Exams Marks / Attendance  </span></h2>
    <div class="clr"></div>
    <div class="clr"></div>
    <div id="users_content_wrap">
    
        <div id="filter_wrap" style="padding-bottom: 5px;">
            <label for="user_type">Branch: </label>
            <select name="users_type" id="users_type" class="text">
                <?php echo selectBox('Select','branches','id,name','status="1"','1'); ?>
            </select>
            <label for="status">Semester: </label>
            <select name="status" id="status" class="text">
                <?php echo selectBox('Select','semisters','id,name','status="1"','1'); ?>
            </select>
        </div>
        <div class="jqgrid_wrap">
            <table id="grid_table"></table>
            <div id="grid_pager"></div>
        </div>

        <script type="text/javascript" rel="javascript">
            addusermarks_grid();
        </script>
    </div>
</div>
