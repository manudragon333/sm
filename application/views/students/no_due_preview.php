<?php  // print_r($data);
if (isset($data) && count($data)>0) { ?>
<table class="sample table_view table_view">
    <thead>
        <th>In charge</th>
        <th>Status</th>
    </thead>
    <tbody>
<?php
$nos=0;
$names=array('principal'=>'Principal','cse_hod'=>'CSE HOD','eee_hod'=>'EEE HOD','ece_hod'=>'ECE HOD','mech_hod'=>'MECHANICAL HOD','it_hod'=>'IT HOD','library'=>'LIBRARY','office_incharge'=>'OFFICE INCHARGE');
foreach ($data as $k => $vObj) { /*if(isset($names[$k]))*/ { $v=(array)$vObj?>
        <tr>
            <td><?php echo $v['name'];?>(<?php if($v['user_type']=='Admin'){ echo 'Principal'; }else{ echo $v['user_type']; }?>)</td>
            <td><?php if($v['approver_status']=='1'){ echo 'Approved'; }else if($v['approver_status']=='2'){ echo 'Rejected'; $nos++;}else{ echo 'Still Waiting'; $nos++;}  ?></td>
        </tr>

<?php }} ?>
    </tbody>
</table>
<?php $p=false; if(isset($only_table)){ $p=false; }else{ $p=true; }  if($nos==0 && $p) { ?>
     <br/><br/>
     <p> Please collect your no-due certificate from office. </p>
     <a  href="<?php echo site_url('students/preview_no_due'); ?>" target="_blank"><input type="button" name="imageField" id="preview_nodue" class="send button" value="Preview No Due"/></a>
<?php } ?>
<?php } else { ?>
    <p> Looks like you dint apply for no due application. </p>
<?php } ?>
