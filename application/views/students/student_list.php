<?php if(empty($student_details)){ echo showBigInfo('No Students found with the search criteria. Please try again.'); }else{ ?>

<div style="padding:5px; padding-left: 0;" class="">
    <table class="sample table_view">
        <tr>
            <th>Student Name</th>
            <th>Student Number</th>
            <th>Present Year</th>
            <th>Branch</th>
            <th>View</th>
        </tr>
        <?php foreach($student_details as $k=>$v){ ?>
        <tr>
            <td><?php if (!empty($v->name)) echo $v->name; ?> </td>
            <td><?php if (!empty($v->students_number)) echo $v->students_number; ?> </td>
            <td><?php if (!empty($v->semister_name)) echo $v->semister_name; ?> </td>
            <td><?php if (!empty($v->branch_name)) echo $v->branch_name; ?> </td>
            <td>
                <form id="appl_form" action="<?php echo site_url('admin/student_data'); ?>" method="POST">
                    <input id="id" name="user_id" type="hidden" class="text" value="<?php if (isset($v->user_id)) echo $v->user_id; ?>"/>
                    <input type="submit" name="imageField" id="imageField" class="gblue button " value="View">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php } ?>

