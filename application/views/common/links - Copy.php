<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8" />

<!-- INLINE STYLES / SCRIPTS  -->
<script type="text/javascript">
    var base_url="<?php echo base_url(); ?>";
    var site_url="<?php echo site_url(); ?>";
</script>
<!-- INLINE STYLES / SCRIPTS  -->

<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/uploadify.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/jquery-ui-custom.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ui.multiselect.css"/>
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ui.jqgrid1.css"/>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ui.jqgrid.css"/>

<!-- CuFon: Enables smooth pretty custom font rendering. 100% SEO friendly. To disable, remove this section -->
<script type="text/javascript" src="<?php echo base_url();?>js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/arial.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/cuf_run.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/jquery.library.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validations.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-custom.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>uploadify/swfobject.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>uploadify/jquery.uploadify.v2.1.4.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/common.js?ver=23jun2013"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/views/common.js?ver=23jun2013"></script>

<!--<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.jqGrid.src.js"></script>


<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-timepicker-addon.js"></script>

<!--STUDENT RELATED JS-->
<!--<script type="text/javascript" src="<?php echo base_url();?>js/student.js"></script>-->
<!--STUDENT RELATED JS-->


<!--CHAT RELATED-->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>css/chat/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>css/chat/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>css/chat/screen_ie.css" />
<![endif]-->

<!--CHAT RELATED-->

<?php $segment=$this->uri->segment(1); ?>
<?php if($segment!='login'){ ?>
<script type="text/javascript" src="<?php echo base_url();?>js/<?php echo $segment; ?>.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/views/<?php echo $segment; ?>.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/chat.js"></script>
<?php } ?>
