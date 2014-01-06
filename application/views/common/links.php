<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8" />

<!-- INLINE STYLES / SCRIPTS  -->
<script type="text/javascript">
    var base_url="<?php echo base_url(); ?>";
    var site_url="<?php echo site_url(); ?>";
    var upload_path="<?php echo $this->config->item('upload_path'); ?>";
    var lang=<?php echo json_encode($this->lang->language); ?>
</script>
<!-- INLINE STYLES / SCRIPTS  -->

<link href="<?php echo base_url();?>css/style.css?v=2013nov01" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/uploadify.css?v=2013nov01" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>jquery-ui/css/smoothness/jquery-ui-1.10.3.custom.min.css?v=2013nov01" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ui.multiselect.css?v=2013nov01"/>
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ui.jqgrid1.css?v=2013nov01"/>-->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ui.jqgrid.css?v=2013nov01"/> OLD JQGRID--> 

<!-- CuFon: Enables smooth pretty custom font rendering. 100% SEO friendly. To disable, remove this section -->
<script type="text/javascript" src="<?php echo base_url();?>js/cufon-yui.js?v=2013nov01"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/arial.js?v=2013nov01"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/cuf_run.js?v=2013nov01"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js?v=2013nov01"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validate.js?v=2013nov01"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/validations.js?v=2013nov01"></script>

<script type="text/javascript" src="<?php echo base_url();?>jquery-ui/js/jquery-ui-1.10.3.custom.min.js?v=2013nov01"></script>

<script type="text/javascript" src="<?php echo base_url();?>uploadify/swfobject.js?v=2013nov01"></script>
<script type="text/javascript" src="<?php echo base_url();?>uploadify/jquery.uploadify.v2.1.4.min.js?v=2013nov01"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/common.js?v=2013nov01"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/views/common.js?v=2013nov01"></script>

<!--<script type="text/javascript" src="js/jquery-1.5.2.min.js?v=2013nov01"></script>-->

<!--<script type="text/javascript" src="<?php echo base_url();?>js/jquery.jqGrid.src.js?v=2013nov01"></script> OLD JQGRID -->

 <!--@@START :: JQ GRID FILES-->
 
 <link href="<?php echo base_url();?>js/jquery.jqGrid-4.5.2/css/ui.jqgrid.css?v=2013nov01" rel="stylesheet"  />
 <script src="<?php echo base_url();?>js/jquery.jqGrid-4.5.2/js/i18n/grid.locale-en.js?v=2013nov01" type="text/javascript" language="javascript"></script>
 <!--<script src="<?php echo base_url();?>js/jquery.jqGrid-4.5.2/src/grid.base.js?v=2013nov01" type="text/javascript" language="javascript"></script>-->
 <script src="<?php echo base_url();?>js/jquery.jqGrid-4.5.2/js/jquery.jqGrid.src.js?v=2013nov01" type="text/javascript" language="javascript"></script>

 <!--@@END :: JQ GRID FILES-->


<script type="text/javascript" src="<?php echo base_url();?>js/jquery.printElement.js?v=2013nov01"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-timepicker-addon.js?v=2013nov01"></script>

<!--STUDENT RELATED JS-->
<!--<script type="text/javascript" src="<?php echo base_url();?>js/student.js?v=2013nov01"></script>-->
<!--STUDENT RELATED JS-->


<!--CHAT RELATED-->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>css/chat/chat.css?v=2013nov01" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>css/chat/screen.css?v=2013nov01" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>css/chat/screen_ie.css?v=2013nov01" />
<![endif]-->

<!--CHAT RELATED-->

<?php $segment=$this->uri->segment(1); ?>
<?php if($segment!='login'){ ?>
<script type="text/javascript" src="<?php echo base_url();?>js/<?php echo $segment; ?>.js?v=2013nov01"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/views/<?php echo $segment; ?>.js?v=2013nov01"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/chat.js?v=2013nov01"></script>
<?php } ?>
