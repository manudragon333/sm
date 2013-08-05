<?php //  echo '<pre>'; print_r($data);print_r($days); echo '</pre>'; die; ?>
<?php if(count($data)){ ?>
<style>
    table.sample td {
        padding: 0px;
    }
    table.sample td{
        padding: 4px 1px;
        width:85px;
    }
</style>
<form id="appl_form">
<h2><span>Time Table.</span></h2>  
<div class="clr"></div>
<ol>
    <li class="">
        <br/><br/>
        <table class="sample table_view">
            <tr>
                <th>Day/Period</th>
                <?php for($i=1;$i<=7;$i++){ ?>
                <th>Subject <?php echo $i; ?></th>
                <?php } ?>
                <th>Lab 1</th>
                <th>Lab 2</th>
            </tr>
            <?php foreach($days as $kd=>$vd){ ?>
            <tr>
                <th><?php echo $vd['day']; ?></th>
                <?php for($i=1;$i<=7;$i++){ ?>
                <td><?php echo $data[$vd['id']]['sub'.$i]  ?> </td>
                <?php } ?>
                <td><?php echo $data[$vd['id']]['lab1']  ?> </td>
                <td><?php echo $data[$vd['id']]['lab2']  ?> </td>
            </tr>
            <?php } ?>
        </table>
    </li>
</ol>
</form>

<?php }else{ ?>
<div class=""> No Time table has been set.</div>
<?php } ?>