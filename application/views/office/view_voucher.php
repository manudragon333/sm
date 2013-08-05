<h2><span>View Voucher</span></h2>
<div class="clr"></div>

<div>
    <input type="button" onclick="javascript:window.location='<?php echo site_url('office/debitvoucher');  ?>';" name="" id="imageField" class=" button " value="List  Debit Vouchers " />
    <br/>
</div>

<form method="post" action="view_debitvouchers">
<input id="vorefno" name="vorefno" type="hidden" class="text" value="<?php echo $_GET['vorefno'] ; ?>"/>

</form>
<div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
</div>
<script type="text/javascript" rel="javascript">
    list_vouchers_grid();
</script>