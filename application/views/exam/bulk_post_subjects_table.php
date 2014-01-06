<?php 
if(!empty($subjects)){
?>
<table border="2" class="sample">
    <tbody>
        <tr>
            <th>SUBJECT NAME</th>
            <th>SUBJECT TYPE</th>
        </tr>
<?php
    foreach ($subjects as $key => $value) {
?>
        <tr>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['subject_type_name']; ?></td>
        </tr>
<?php
    }
?>
    </tbody>
</table>

<?php } else{ echo showBigError('No Subjects found for this semester.');  } ?>

