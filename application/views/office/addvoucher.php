<style>
    .logoheader {
        border-top: 2px;;
        border-right: 1px solid black;
        border-bottom: 1px solid black;
        border-left: 1px solid black;
    }
    .ollilabel {
        width: 120px;
    }
    .ollilabel2 {
        width: 80px;
        padding-left: 45px;
    }
    .ollilabel3 {
        width: 300px;;
        padding-left: 45px;
    }
    .atable {
        border-collapse: collapse;
        border: 1px solid #AAA;
        margin-left: 120px;
        padding-top:25px;
    }
    .atable th {
        border: 1px solid #AAF;
        background: #BFBFFF;
        font-weight: bold;
    }
    .atable td {
        padding: 4px;
        border: 1px solid #AAF;
    }
    .oddRow {
        background: #FFFFFF;
    }
    .evenRow {
        background: #DFDFFF;
    }
</style>
<div id='printingstuff'>
    <h2 align="center"><span> DEBIT  VOUCHER </span></h2>
    
    <div class="clr"></div>
    <div class="clr"></div>
    <form action="/office/addvoucher" id="debitvoucher_form" method="post" >
    	 <input id="rel" name="rel" type="hidden" class="text" value="debitvoucher_form"/>
    	 <input id="createdby" name="createdby" type="hidden" class="text" value="<?php echo $this->session->userdata('user_details')->username; ?>"/>
    	 <input id="college_code" name="college_code" type="hidden" class="text" value="<?php echo $colleges[0]->college_code; ?>"/>
    	 
    	 <ol>
    	 	<li>
            <label for="Name" class="">College Name :*</label>
            <label for="cname" class='ollilabel3'><b><?php echo $colleges[0]->name;?></b></label>
       </li>
       <li>
            <label for="Address" class="">Address :*</label>
            <label for="caddr" class='ollilabel3'><b><?php echo $colleges[0]->college_address;?></b></label>
        </li>
        <li>
            <label for="vorefno" class="ollilabel">V.Ref.No :*</label>
            <input class="text" type="text" name="vorefno" id ="vorefno" value="<?php echo uniqid($colleges[0]->college_code.'_'); ?>" readonly maxlength='20' style="width:200px;"/>
        
            <label for="vcreationdate" class="ollilabel2">Date :*</label>
            <input id="date" name="vcreationdate" class="text apply_datepicker" readonly="readonly" value="" maxlength='20' style="width:150px;">
        </li>
        <li>
            <label for="debitedto" class="ollilabel">Debited to :*</label>
            <input class="text" type="text" name="debitedto" id ="debitedto" value=""/>
        </li>
			 
        <li>
                <table border="1" class="atable">
                    <tr>
                        <th colspan="1">Payment Particulars</th>
                        <th colspan="1">Amount</th>
                        <th>
                        <input type="button" value="Add Row" class="alternativeRow "/>
                        </th>
                    </tr>
                    <tr>
                       <td>
                        <input type="text" size="45" name="payment_details[]" class=" required"/>
                        </td>
                        <td>
                        	<input type="text" size="15" name="amount[]" class=" required"/>
                        </td>
                        <td>
                        <img src="<?php echo base_url(); ?>css/images/cross.gif" class="delRow" border="0"/>
                        </td>
                    </tr>
                    </table>
            </li>
            <li>
            <label for="type" class="ollilabel">Transaction Type  :*</label>
             <select id="type" name="type" class="ollilabel required">
                <option value="1" >Cash</option>
                <option value="2" >DD</option>
                <option value="3" >Cheque</option>
                <option value="4" >Other</option>
            </select>
        </li>
            <li>
            <label for="amount" class="ollilabel">Received Rs :*</label>
            <input class="text required" type="text" name="received" id ="received" value="" style="width:200px;"/>
        </li>
        
        <li>
            <label for="inwords" class="ollilabel">In Words :*</label>
            <input class="text required" type="text" name="inwords" id ="inwords" value="" readonly=""/>
        </li>
        <li>
        		<label for="username" class="ollilabel">Checked BY :</label><label class="ollilabel"><b></b></label>
            <label for="username" class="ollilabel">Created By :</label><label class="ollilabel"><b><?php echo $this->session->userdata('user_details')->username; ?></b></label>
            <label for="username" class="ollilabel">Receivers Signature :</label><label class="ollilabel"><b></b></label>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Create Voucher & Print" />
            <div class="clr"></div>
        </li>
         </ol>
    </form>
</div>

<script type="text/javascript" rel="javascript">

    ////http://www.examplet.buss.hk/jquery/table.addrow.php
    $("document").ready(function() {
        $(".alternativeRow").btnAddRow({
            oddRowCSS : "oddRow",
            evenRowCSS : "evenRow"
        });
        $(".delRow").btnDelRow();
     });
     
$("#received").live('blur',function()
{
    $('#inwords').val(toWords($(this).val()).toUpperCase());                   
})

// American Numbering System
var th = ['','thousand','million', 'billion','trillion'];
// uncomment this line for English Number System
// var th = ['','thousand','million', 'milliard','billion'];

var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine']; var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen']; var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety']; function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'not a number'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'too big'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'hundred ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'point '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ');}

function printDiv()
{
  var printer = window.open('','','width=300,height=300');
	printer.document.open("text/html");
	printer.document.write(document.getElementById('printingstuff').innerHTML);
	printer.document.close();
	printer.window.close();
	printer.print();
	//alert("Printing the \"printingstuff\" div...");
}
</script>
