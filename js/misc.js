$(function(){


});


/******************************************************************/


function placement_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/misc/placement_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Placement Cell Request(s)",
            recordtext: "Viewing {0} - {1} of {2} Placement Cell Request(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Student name','Student Number', 'Alert Type','Resume Link'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'alert_type',index:'alert_type', width:150},
                    {name:'resume_link',index:'resume_link', width:150}
            ],
            rowNum:10,
            rowList:[10,20,50],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"Placement Cell",
            loadtext:'Loading..'
    });
}

function study_abroad_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/misc/study_abroad_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Records",
            recordtext: "Viewing {0} - {1} of {2} Records",
            pgtext : "Page {0} of {1}",
            colNames:['Student name','Email', 'Mobile Number', 'Country Interested','Exam Selected','Message'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'email',index:'email', width:150},
                    {name:'mobile',index:'mobile', width:150},
                    {name:'country_interested',index:'country_interested', width:150},
                    {name:'exam',index:'exam', width:150},
                    {name:'message',index:'message', width:250,sortable:false}
            ],
            rowNum:10,
            rowList:[10,20,50],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"Study abroad",
            loadtext:'Loading..'
    });
}
