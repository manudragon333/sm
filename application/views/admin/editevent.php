<h3>Edit Event</h3>
<form action="<?echo current_url()?>" method="post">
<table>
<tr>
<th>Event Title</th>
<td><input id="title" name="title" value="<?echo $details[0]->title?>"> </td>
</tr>
<tr>
<th>Date</th>
<td><input id="date" name="date" class="text apply_datepicker" readonly="readonly" value="<?echo $details[0]->DateTime?>"></td>
</tr>
<tr>
<th>Description</th>
<td><textarea id="desc" name="desc"><?echo $details[0]->desc?></textarea></td>
</tr>
<tr>
<th>Status</th>
<td><input type="checkbox" name="status" id="status" <?if($details[0]->status=='active') echo "checked"?>>Active</td>
</tr>
</table>
<input type="submit" value="save" style="margin-left:100px;margin-top:10px">
</form>