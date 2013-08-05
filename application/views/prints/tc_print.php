<style type="text/css" rel="stylesheet">
    .certi_text i{
        text-decoration: underline;
        padding: 0 5px;
    }
</style>
<?php // echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
foreach($data as $k=>$v){?>
<h5 style="width:300px; padding: 3px; margin: 0;font-size:15px"> TC<?php echo (isset($v['id']))?str_pad($v['id'], 7, "0", STR_PAD_LEFT):''; ?></h5>
<div style="border:none; height:550px; width:750px; position:relative; background: none;">
    <img src="<?php echo base_url();  ?>/css/images/viewer.png" style="position: absolute; left: 0; top:0; z-index: 0;" alt=""/>
    <h5 style="position:absolute; top: 200px; right: 505px;z-index: 10;margin: 0;font-size:15px"> TC<?php echo (isset($v['id']))?str_pad($v['id'], 7, "0", STR_PAD_LEFT):''; ?></h5>
	<h5 style="position:absolute; top: 200px; right: 55px;z-index: 10;margin: 0;">Date: <?php echo date('d-m-Y'); ?></h5>
    <h5 style="position:absolute; top: 318px; left:485px;z-index: 10;margin: 0;font-size:15px"><?php echo $v['students_number']; ?></h5>
    <h5 style="position:absolute; top: 356; left:485px;z-index: 10;margin: 0;font-size:15px"><?php echo $v['name']; ?></h5>
	 <h5 style="position:absolute; top: 400px; left:485px;z-index: 10;margin: 0;font-size:15px"><?php echo $v['fathers_name']; ?></h5>
	 <h5 style="position:absolute; top: 440px; left:485px;z-index: 10;margin: 0;font-size:15px">INDIAN</h5>
	  <h5 style="position:absolute; top: 480px; left:485px;z-index: 10;margin: 0;font-size:15px"> <?php echo $v['caste']; ?></h5>
	  <h5 style="position:absolute; top: 520px; left:485px;z-index: 10;margin: 0;font-size:15px"><?php echo substr($v['dob'],0,10);  ?></h5> 
	  <h5 style="position:absolute; top: 590px; left:485px;z-index: 10;margin: 0;font-size:15px"><?php echo $v['course_name'];  ?></h5> 
	  <h5 style="position:absolute; top: 625px; left:485px;z-index: 10;margin: 0;font-size:15px"><?php echo substr($v['doj'],0,10);  ?></h5> 
	  <h5 style="position:absolute; top: 660px; left:485px;z-index: 10;margin: 0;font-size:15px"><input style="border:1px solid #FBEFEF"></h5> 
	  <h5 style="position:absolute; top: 740px; left:485px;z-index: 10;margin: 0;font-size:15px"><input style="border:1px solid #FBEFEF"></h5> 
	  <h5 style="position:absolute; top: 780px; left:485px;z-index: 10;margin: 0;font-size:15px"><input style="border:1px solid #FBEFEF"></h5> 
	  <h5 style="position:absolute; top: 855px; left:485px;z-index: 10;margin: 0;font-size:15px"><input style="border:1px solid #FBEFEF"></h5> 
	  <h5 style="position:absolute; top: 895px; left:485px;z-index: 10;margin: 0;font-size:15px"><input style="border:1px solid #FBEFEF"></h5> 
	
</div>
<br/>
<div>
    <input type="button" name="imageField" id="imageField" class="gblue button  " value="Print" onclick="this.style.display='none'; window.print();">
 
</div>

<?php } }else{?>
<br/>
<p>No Certificate found.!</p>
<?php } ?>