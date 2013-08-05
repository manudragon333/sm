<?php //echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
    foreach($data as $k=>$v){ ?>
<h5 style="width:300px; padding: 3px; margin: 0;"> Application ID: SC<?php echo (isset($v['id']))?str_pad($v['id'], 7, "0", STR_PAD_LEFT):''; ?></h5>
<div style="border:2px solid; height:630px; width:750px;position:relative;">
    <h3 align=center>MY COLLEGE</h3>
    <h5 align=center>#123,Road No.:1,M.G Road, NAVI MUMBAI, MAHARASTRA-012345 </h5>
    <div align=right style="margin-left:15px;margin-top: 30px;margin-right:15px">
        <h5 >Date: <?php echo date('d-m-Y'); ?></h5>
        <h5 >Unique Number: <?php echo $v['stu_number']; ?></h5>
    </div>
    <div style="margin-left:10px;">
        <img src="<?php echo base_url() .'css/images/college_logo.png'; ?>" width="100" height="100"/>
    </div>
    <div style="margin-left:15px;margin-top: 30px;margin-right:15px">
        <h3 align=center><u>STUDY CERTIFICATE</u></h3>
        <p align=justify>This is to certify that Mr/Miss:<?php echo $v['name']; ?>, 
            S/O,D/O <?php echo $v['son_of']; ?>,  is a bonafide Student of : <?php echo $v['course_name']; ?>
            in this college during the acadamic year From: <?php echo dateFormat($v['from'],'Y'); ?> To: <?php echo dateFormat($v['to'],'Y'); ?>
        </p><br/><br/>
        <h4 align=right>PRINCIPAL</h4>
        <input type="button" name="imageField" id="imageField" class="send button  " value="Print" onclick="this.style.display='none'; window.print();">
<!--<input type="button" name="imageField" id="imageField" class="send button  " value="Generate Card">-->

    </div>
</div>
<?php } }else{?>
<br/>
<p>No Certificate found.!</p>
<?php } ?>