        <a class="button green m_t_b_10" href="<?php echo site_url('admin/addpoll');?>" >+ Add Poll </a>
        <div id="filter_wrap" style="padding-bottom: 5px;">
           <!-- <label for="user_type">User Type: </label>
            <select name="users_type" id="users_type" class="text">
                <?php foreach($user_types as $k=>$v){ ?>
                <option value="<?php echo $v['id']; ?>"> <?php echo $v['name']; ?> </option>
                <?php } ?>
            </select>
            <label for="status">Active/Inactive: </label>
            <select name="status" id="status" class="text">
                <option value="1">Active</option>
                <option value="0">In Active</option>
            </select>-->
        </div>
        <div class="jqgrid_wrap">
            <table id="grid_table"></table>
            <div id="grid_pager"></div>
        </div>

        <script type="text/javascript" rel="javascript">
            poll_grid();
        </script>

