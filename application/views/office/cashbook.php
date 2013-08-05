

<form  action="/office/view_cashbook" id="cash_book" method="post" >
  <input id="rel" name="rel" class="text" type="hidden" value="cash_book"/>    
  
 
<ol>
       <li>
            <label for="datefrom">Date From:* </label>
            <input id="datefrom" name="dfrom" class="text apply_datepicker" readonly="readonly"/>
        </li>
        <li>
            <label for="dateto">Date to:* </label>
            <input id="dateto" name="dto"class="text apply_datepicker" readonly="readonly"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField"  class="button j_gen_form_submit" value="Filter"/>
            <!--<input type="submit" name="cbcreate" id="cbcreate" class="button j_gen_form_submit" value="create"/>-->
        </li>
    </ol>
      


<table border=1>
<tr>
<th>Date</th><th>Payment</th><th>Pmt Details</th><th>Receipt No</th><th>Debit</th><th>Debit Details</th><th>Payment Type</th><th>V.ref.no</th><th>Updated B</th><th>Balance</th>
</tr>
<?php 
foreach($transactions_all as $transaction){
?>
<tr><td><?php echo $transaction->date; ?></td><td><?php echo $transaction->credit_amount; ?></td><td><?php echo $transaction->credit_type; ?></td><td><?php echo $transaction->credit_rec_no; ?></td><td><?php echo $transaction->debit_ammount; ?></td><td><?php echo $transaction->debit_details; ?></td><td><?php echo $transaction->debit_type; ?></td><td><?php echo $transaction->debit_rec_no; ?></td><td><?php echo $transaction->updated_by; ?></td><td><?php echo $transaction->balance; ?></td></tr>

<?php } ?>
</table>

 
</form>
