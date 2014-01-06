<h2><span>Exam Duty</span></h2>
<div class="clr"></div>
<br/>
<div>
    <input type="button" name="imageField" id="imageField" class="upload button" value=" Add New Chart " onclick="javascript:window.location='<?php echo site_url('exam/exam_duty_new_chart'); ?>'" />
</div>
<br/>

<div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
</div>

<script type="text/javascript" rel="javascript">
    $(function(){
        
       jQuery("#grid_table").jqGrid({
            url:site_url+'exam/exam_duty',
            datatype: "json",
            width:900,
            height:250,
            mtype: 'POST',
            recordtext: "Exam Duty Charts(s)",
            recordtext: "Viewing {0} - {1} of {2} Charts",
            pgtext : "Page {0} of {1}",
            colNames:['Chart Name','Course', 'From Date','To Date','View','Download','Created By'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'course_id',index:'course_id', width:150},
                    {name:'branch',index:'branch', width:150},
                    {name:'from',index:'from', width:150},
                    {name:'to',index:'to', width:150},
                    {name:'view_link',index:'view_link', width:150, sortable:false},
                    {name:'doc_link',index:'doc_link', width:150, sortable:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'username',
            viewrecords: false,
            sortorder: "desc",
            caption:"Exam Duty Charts(s)",
            loadtext:'Loading..'
        });
 
        
    });
</script>