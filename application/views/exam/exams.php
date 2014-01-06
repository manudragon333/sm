<p>
    <a href="<?php echo site_url('exam/exam_form'); ?>">
        <input type="button" name="imageField" class=" button  green" value="Add Exam">
    </a>
</p>
<br/>
<div class="clr"></div>

<div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
</div>

<script type="text/javascript" rel="javascript">
    jQuery("#grid_table").jqGrid({
        url:site_url+'/exam/exams',
        datatype: "json",
        height:'auto',
        autowidth: true,
        mtype: 'POST',
        recordtext: "Exam(s)",
        recordtext: "Viewing {0} - {1} of {2} Exam",
        pgtext : "Page {0} of {1}",
        colNames:['Exam Name','Maximum Marks', 'Credits','Branch','Semister','Section','Subject','Status/Action'],
        colModel:[
            {name:'name',index:'name', width:150},
            {name:'maximum_marks',index:'maximum_marks', width:150},
            {name:'credits',index:'credits', width:150},
            {name:'branch_name',index:'branch_name', width:150},
            {name:'semister_name',index:'semister_name', width:150},
            {name:'section_name',index:'section_name', width:150},
            {name:'subject_name',index:'subject_name', width:150},
            {name:'status',index:'status', width:150}
        ],
        rowNum:10,
        //rowList:[10,20],
        pager: '#grid_pager',
        sortname: 'date_added',
        viewrecords: false,
        sortorder: "desc",
        caption:"Exams",
        loadtext:'Loading..'
    });
</script>