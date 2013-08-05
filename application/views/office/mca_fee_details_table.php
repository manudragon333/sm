<style>
    table.sample td {
        padding: 0px;
    }
    table.sample td input{
        border:1px dashed #ccc;
        padding: 4px 1px;
    }
    .showTtOptions{
        display:none;
    }
</style>
<?php // echo '<pre>'; print_r($data); echo '</pre>'; 
if(count($data)){
?>
<div class="clr"></div>
<form id="appl_form" action="/office/save_fee_details">
    <input type="hidden" name="id" value="<?php if(isset($data[0]['id'])) echo $data[0]['id']; else echo 0;?>"/>
    <input type="hidden" name="user_id" value="<?php if(isset($data[0]['user_id'])) echo $data[0]['user_id']; else echo 0;?>"/>
    <ol>
        <li>
            <table class="sample table_view">
                <tr>
                    <th>Year</th>
                    <th>1<sup>st</sup>YEAR</th>
                    <th>2<sup>nd</sup>YEAR</th>
                    <th>3<sup>rd</sup>YEAR</th> 
                <!--<th>4<sup>TH</sup>YEAR</th> --> 
                </tr>
                <tr>
                    <th>Fee Status</th>
                    <td><input type="text" name="fee1" value="<?php if(isset($data[0]['fee1']))echo $data[0]['fee1']; ?>"/></td>
                    <td><input type="text" name="fee2" value="<?php if(isset($data[0]['fee2']))echo $data[0]['fee2']; ?>"/></td>
                    <td><input type="text" name="fee3" value="<?php if(isset($data[0]['fee3']))echo $data[0]['fee3']; ?>"/></td> 
                   <!-- <td><input type="text" name="fee4" value="<?php if(isset($data[0]['fee4']))echo $data[0]['fee4']; ?>"/></td> -->
                </tr>
            </table>
        </li>
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="button j_gen_form_submit" value="Save Details"/>
        </li>
    </ol>
</form>
<?php }else{ ?>
<br/>
<div class="error">No Details found. please check the student number.</div>
<?php } ?>