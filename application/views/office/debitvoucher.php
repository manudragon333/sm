<h2><span>Debit Vouchers Management</span></h2>
<div class="clr"></div>

<div>
    <input type="button" onclick="javascript:window.location='<?php echo site_url('office/addvoucher');  ?>';" name="" id="imageField" class=" button " value="Add Debit Voucher " />
    <br/>
</div>
<form method="post" action="export_debitvouchers">
	<label for="vcreationdate" class="ollilabel2">Date :*</label>
	<input id="date" name="vcreationdate" class="text apply_datepicker"  value="<?php if(isset($s_data['vcreationdate'])) $vorefno_select=$s_data['vcreationdate']; else $vcreationdate=''?>" maxlength='20' style="width:150px;">
	<label for="vorefno" class="ollilabel">V.Ref.No :*</label>
	<select name="vorefno" id="vorefno" class="text">
		<option value="">Select</option>
		<?php if(isset($s_data['vorefno'])) $vorefno_select=$s_data['vorefno']; else $vorefno_select=0; echo load_select_vouchcer('debit_vouchers',$vorefno_select); ?>
		</select>
</form>
<div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
</div>
<script type="text/javascript" rel="javascript">

    debit_vouchers_grid();
</script>