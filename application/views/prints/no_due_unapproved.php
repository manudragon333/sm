<style type="text/css" rel="stylesheet">

table.sample {
	border-width: 1px;
	border-spacing: 1px;
	border-style: groove;
	border-color: green;
	border-collapse: separate;
	background-color: rgb(255, 250, 250);
}
table.sample th {
	border-width: 1px;
	padding: 5px;
	border-style: groove;
	border-color: gray;
	background-color: rgb(255, 250, 250);
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
}
table.sample td {
	border-width: 1px;
	padding: 5px 25px;
	border-style: groove;
	border-color: gray;
	background-color: rgb(255, 250, 250);
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
}

</style>
<?php //echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
foreach($data as $k=>$vObj){ $v=(array) $vObj; ?>
<h5 style="width:300px; padding: 3px; margin: 0;"> Application ID: ND<?php echo (isset($v['id']))?str_pad($v['id'], 7, "0", STR_PAD_LEFT):''; ?></h5>
<div style="border:2px solid;  width:750px;position:relative;">
    <h3 align=center>MY COLLEGE</h3>
    <h5 align=center>#123,Road No.:1,M.G Road, NAVI MUMBAI, MAHARASTRA-012345 </h5>
    
    <div style="margin-left:15px;margin-top: 30px;margin-right:15px">
        <h3 align=center> <u>NO DUE CERTIFICATE</u></h3>

        <h4>No Due is not approved by all. Please find the status below.</h4>
        <div style="margin-left:170px;">
        <?php $nodue_view_data['data']=$nodue_data;$this->load->view('students/no_due_preview',$nodue_view_data); ?>
        </div>

        <br/><br/>
<!--        <h4 align=right>PRINCIPAL</h4>-->
<!--        <input type="button" name="imageField" id="imageField" class="send button  " value="Print" onclick="this.style.display='none'; window.print();">-->
<!--<input type="button" name="imageField" id="imageField" class="send button  " value="Generate Card">-->

    </div>
</div>
<?php } }else{?>
<br/>
<p>No data found.!</p>
<?php } ?>