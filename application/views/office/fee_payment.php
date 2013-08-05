<?
//if($_SERVER['HTTPS']!="on")
 // {
   //  $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
   //  header("Location:$redirect");
 // }

?>
<h3>Confirm Password</h3>
<form method="post" action="<?php echo site_url('office/feepayment'); ?>">
<table border="0">
<tr><td>
Password * <input type="password" id="password" name="password">
</td><td>
<input type="submit" value="Confirm">
</td>
</tr>
</table>
</form>
