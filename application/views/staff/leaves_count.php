<?php // echo '<pre>'; print_r($leaves); echo '</pre>'; ;?>

<?php if(!empty($leaves)){  ?>
    <h2>Leaves Taken:</h2>
    <table class="sample table_view">
            <tr>
                <th>Leave Type</th>
                <th>Number of Leaves</th>
            </tr>
            <?php $count=0; foreach($leaves as $s_k=>$s_v){ ?>
            <tr>
                <td><?php echo $s_v['name']; ?></td>
                <td><?php echo $s_v['number_of_leaves'];  $count+=$s_v['number_of_leaves']; ?></td>
            </tr>
            <?php }  ?>
    </table>
    <br/>
    <p>You have total <?php echo (15-$count);  ?> Remaining Leaves.</p>
    <br/>

<?php }else{  ?>
    <ul class="collegeUpdates">
        <li>
            <img src="<?php echo base_url(); ?>css/images/pushpin_pink.png" class="upd_std" alt="user"/>

            <p>No leaves taken till now.</p>
            <p>You have 15 Leaves remaining.</p>
        </li>

    </ul>
<?php }  ?>