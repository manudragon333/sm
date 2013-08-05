<?php // print_r($student_data);
if($this->session->userdata('preview_study_certificate')){
    $data[0]=$student_data;
    $s_data=$this->session->userdata('preview_study_certificate');
    foreach($s_data as $k=>$v){
        $data[0][$k]=$v;
    }
}else{
    $data=0;
}
if(count($data) && $data){
    foreach($data as $k=>$v){ ?>
<form id="appl_form" action="/students/study_certificate" >
    <input type="hidden" name="preview" value="1"/>
    <div class="certificate r_f">
        <div class="std_crtimg p_a"></div>
        <div class="t_a_c crt_col_ph">
            <h3 class="">LAQSHYA COLLEGE</h3>
            <h5 class="">Jaladhija Educational Society's</h5>
        </div>
        <div class="crt_coll_logo p_a">
            <img src="<?php echo base_url() .'css/images/college_logo.png'; ?>" width="100" height="80"/>
        </div>
        <div class="crt_cnt">
            <h3 class="t_a_c"><u>STUDY CERTIFICATE</u></h3>
            <div class="m_t_10">This is to certify that Mr/Miss <b><?php echo $v['name']; ?></b>, 
                S/O,D/O <b><?php echo $v['son_of']; ?></b>, holding Unique Number <b> <?php echo $v['stu_number']; ?> </b>  is a bonafide Student of <?php echo get_select_name($v['course'], 'courses'); ?>
                </b>in this college during the acadamic year From <b><?php echo dateFormat($v['from'],'Y'); ?> </b> To <b><?php echo dateFormat($v['to'],'Y'); ?></b>
            </div>
        </div>
        <div class="o_h">
            <div class="f_l">Date: <?php echo date('d-m-Y'); ?></div>
            <div class="f_r">PRINCIPAL</div>
        </div>
    </div>
    <input type="button" name="imageField" id="imageField" class="m_t_20 button grey" value="Back" onclick="javascript:window.location.reload();"/>
    <input type="button" name="imageField" id="imageField" class="m_t_20 button gblue m_l_20 j_gen_form_submit" value="Confirm"/>
</form>
<?php } }else{?>
<br/>
<p>Please submit certificate form properly.!</p>
<?php } ?>