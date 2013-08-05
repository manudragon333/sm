<style type="text/css" lang="stylesheet">
    pre{
        font-weight: bold;
        margin: 0;
        padding: 2px 0;
    }
</style>
<?php // echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
foreach($data as $k=>$v){?>
<h5 style="width:300px; padding: 3px; margin: 0;"> Application ID: IC<?php echo (isset($v['id']))?str_pad($v['id'], 7, "0", STR_PAD_LEFT):''; ?></h5>
<div style="border:2px solid; /*width:710px; */ display: inline-block;position:relative; background: url(<?php echo base_url(); ?>css/images/card_bg.png) no-repeat center center;">
    <div id="left_band" style="float: left; width:30px; background:#003399; font-family: Aparajita, Ariel; font-size: 40px;color:white;padding:0 5px 0;text-align: center;">
        S<br/>T<br/>U<br/>D<br/>E<br/>N<br/>T
    </div>
    <div id="card_content" style="float: left;">
        <h4 style="width:200px; float: left;margin: 10px 0 10px 30px; font-family: Aparajita, Ariel; font-size: 70px; color:#003399;">LITS</h4>
        <img src="<?php echo base_url(); ?>css/images/college_logo_trans1.png" width="" height="" style="float: right;margin: 10px;"/>
        <div style="clear:both;"></div>

        <img src="<?php echo base_url(); echo (isset($v['photo']) && !empty($v['photo']))?'uploads/'.$v['photo']:'css/images/no_photo.png'; ?>" id="photo"
             width="100" height="120" title="pic" style=" float: left; padding: 10px;"/>
        <div style="margin-left:30px;margin-top: 10px; float: left; font-size: bold;padding-right: 10px;">

            <pre>STUDENT NAME	:	<?php echo $v['name']; ?></pre>
            <pre>STUDENT NUMBER	:	<?php echo $v['stu_number']; ?></pre>
            <pre>BRANCH		:	<?php echo $v['branch_name']; ?></pre>
            <pre>YEAR OF JOIN	:	<?php echo $v['date_of_join']; ?></pre>
            <pre>ADDRESS		:	<?php echo $v['address']; ?></pre>
            <pre>MOBILE Number	:	<?php echo $v['mobile_no']; ?></pre>
            <br/>
        </div>
        <div style="clear:both;"></div>

        <hr style="border: 2px solid #cc6633"/>
        <div>
            <h1 style=" font-family: Aparajita, Ariel; text-align: center; margin: 0;">Laqshya Group Of Colleges</h1>
            <h3 style=" font-family: Aparajita, Ariel; text-align: center; margin: 0;">Tanikella(v),Konijerla(M),khammam (DIST),Andhra Pradesh</h3>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>
<br/>
<input type="button" name="imageField" id="imageField" class="gblue button  " value="Print" onclick="this.style.display='none'; window.print();">
<?php } }else{?>
<br/>
<p>No ID Card found.!</p>
<?php } ?>