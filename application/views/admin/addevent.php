<h3>Add Event</h3>
<form action="<?echo current_url()?>" method="post">
<table>
<tr>
<th>Event Title</th>
<td><input id="title" name="title"></td>
</tr>
<tr>
<th>Date</th>
<td><input id="date" name="date" class="text apply_datepicker" readonly="readonly"></td>
</tr>
<tr>
<th>Description</th>
<td><textarea id="desc" name="desc"></textarea></td>
</tr>
</table>
<input type="submit" value="save" style="margin-left:100px;margin-top:10px">
</form>