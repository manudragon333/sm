

<a href="<?php echo site_url('office/export_cashbook').'?dfrom='.$dfrom.'&dto='.$dto; ?>"> download cashbook </a>

<!--<form id="appl_form" action="/office/cashbook" method="post" >
       <ol>
       
        <li>
            <label for="dfrom">Date From:* </label>
            <input id="dfrom" name="dfrom" class="text apply_datepicker" readonly="readonly"/>
        </li>
        <li>
            <label for="dto">Date to:* </label>
            <input id="dto" name="dto"class="text apply_datepicker" readonly="readonly"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" onclick="checkOpBalance()" class="button j_gen_form_submit" value="Filter"/>
            <!--<input type="submit" name="cbcreate" id="cbcreate" class="button j_gen_form_submit" value="create"/>-->
       <!-- </li>
    </ol>
</form>-->

<table border=1>
<tr>
<th>Date</th><th>Payment</th><th>Pmt Details</th><th>Receipt No</th><th>Debit</th><th>Debit Details</th><th>Payment Type</th><th>V.ref.no</th><th>Balance</th>
</tr>
<?php 
foreach($transactions as $transaction){
?>
<tr><td><?php echo $transaction->date; ?></td><td><?php echo $transaction->credit_amount; ?></td><td><?php echo $transaction->credit_type; ?></td><td><?php echo $transaction->credit_rec_no; ?></td><td><?php echo $transaction->debit_ammount; ?></td><td><?php echo $transaction->debit_details; ?></td><td><?php echo $transaction->debit_type; ?></td><td><?php echo $transaction->debit_rec_no; ?></td><td><?php echo $transaction->updated_by; ?></td><td><?php echo $transaction->balance; ?></td></tr>

<?php }  ?>
</table>
<a href="<?php echo site_url('office/cashbook'); ?>"><< Back </a>