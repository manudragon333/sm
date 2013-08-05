<?php
if($this->session->userdata('preview_bus_pass')){
    $data[]=$this->session->userdata('preview_bus_pass');
}else{
    $data=0;
}
//echo '<pre>'; print_r($data); echo '</pre>';
if(count($data) && $data){
foreach($data as $k=>$v){?>
<form id="appl_form" action="/students/bus_pass" >
    <input type="hidden" name="preview" value="1"/>
    <div class="id_userview">
        <div class="belt_top p_a"></div>
        
        <div class="inner">
            <div class="photo_banner">
                <img src="<?php echo base_url(); ?>css/images/college_logo.png" class="f_l" width="60" height="60" />
                <img src="<?php echo base_url(); echo (isset($v['photo']) && !empty($v['photo']))?'uploads/'.$v['photo']:'css/images/no_photo.png'; ?>" class="f_r" id="photo" width="100" height="120" title="pic"/>
                <div class="c_b"></div>
            </div>
            <div class="stud_det_panel">
                <div class="std_lst">
                    <label>STUDENT NAME:</label>
                    <span>	<?php echo $v['name']; ?></span>
                </div>
                <div class="std_lst">
                    <label>STUDENT NUMBER:</label>
                    <span><?php echo $v['student_number']; ?></span>
                </div>
                <div class="std_lst"><label>BRANCH:</label>	<span><?php echo get_select_name($v['branch'],'branches'); ?></span></div>
                <div class="std_lst"><label>COURSE:</label> <span><?php echo get_select_name($v['course'],'courses'); ?></span></div>
                <div class="std_lst"><label>PICK UP POINT:</label> <span>	<?php echo get_select_name($v['start_from'],'boarding_points'); ?></span></div>
                <div class="std_lst"><label>ISSUED ON:</label> <span>	<?php echo date('d-m-Y'); ?></span></div>
                <div class="c_b"></div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div class="m_t_20">
        <input type="button" name="imageField" id="imageField" class=" button grey " value="Back" onclick="javascript:window.location.reload();"/>
        <input type="button" name="imageField" id="imageField" class=" button  j_gen_form_submit gblue" value="Confirm"/>
    </div>
</form>
<?php } }else{?>
<br/>
<p>Data not found.!</p>
<?php } ?>