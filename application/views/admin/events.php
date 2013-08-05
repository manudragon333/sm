<?if($events){?>
<table cellspacing="5" cellpadding="5" style="text-align:left">
<tr>
<th>Event</th>
<th>Date</th>
<th>View</th>
<th>Edit</th>
<th>Delete</th>
</tr>
<?foreach($events as $event){?>
<tr>
<td><?echo $event->title?></td>
<td><?echo $event->DateTime?></td>
<td><a href="<?echo site_url('admin/viewevent').'/'.$event->title_slug?>" class="view-events">View</a></td>
<td><a href="<?echo site_url('admin/editevent').'/'.$event->title_slug?>" class="view-events">Edit</a></td>
<td><a href="<?echo site_url('admin/deleteevent').'/'.$event->title_slug?>" class="view-events">Delete</a></td>
</tr>
<?}?>
</table>
<?}else echo "No Events Added";?>