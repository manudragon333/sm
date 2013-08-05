<?php
if($this->session->userdata('preview_conduct_certificate')){
    $s_data=$this->session->userdata('preview_conduct_certificate');
    $data[0]=$s_data;
}else{
    $data=0;
}
if(count($data) && $data){
foreach($data as $k=>$v){?>
<form id="appl_form" action="/students/conduct_certificate" >
    <input type="hidden" name="preview" value="1"/>
    <div class="certificate r_f">
        <div class="std_crtimg p_a"></div>
        <div class="t_a_c crt_col_ph">
            <h3 class="">MY COLLEGE</h3>
            <h5 class="">J#123,Road No.:1,M.G Road, NAVI MUMBAI, MAHARASTRA-012345 </h5>
        </div>
        <div class="crt_coll_logo p_a">
            <img src="<?php echo base_url() .'css/images/college_logo.png'; ?>" width="100" height="80"/>
        </div>
        <div class="crt_cnt">
            <h3 class="t_a_c"> <u>CONDUCT CERTIFICATE</u></h3>
            <div class="m_t_10">This is to certify that Mr/Miss <b><?php echo $v['name']; ?></b>,
                S/O,D/O Sri <b><?php echo $v['co']; ?></b>,  is a bonafied Student of <b><?php echo get_select_name($v['course'], 'courses'); ?></b>
                in this college During the academic year From <b><?php echo dateFormat($v['from_date'],'Y'); ?> </b>To <b><?php echo dateFormat($v['to_date'],'Y'); ?></b>. And during that time His/Her Conduct Has been satisfactory.
            </div>
        </div>
        <div class="o_h">
            <div class="f_l">Date: <?php echo date('d-m-Y'); ?></div>
            <div class="f_r">PRINCIPAL</div>
        </div>
    </div>
    <br/>
    <input type="button" name="imageField" id="imageField" class="m_t_20 button grey" value="Back" onclick="javascript:window.location.reload();"/>
    <input type="button" name="imageField" id="imageField" class="m_t_20 button gblue m_l_20 j_gen_form_submit" value="Confirm"/>
</form>
<?php } }else{?>
<br/>
<p>No Certificate found.!</p>
<?php } ?>