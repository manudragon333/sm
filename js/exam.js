$(function(){


    /*******************/

    $('select[name=college_id]').live('change',function(){
       if($('select[name=course_id]').length>0){
        $.post(site_url+'/students/getCollegeCourses/'+$('select[name=college_id]').val(),function(dataR){
            $('select[name=course_id]').html(dataR);
        })
       }
    });
    $('select[name=course_id]').live('change',function(){
       if($('select[name=branch_id]').length>0){
        $.post(site_url+'/students/getCollegeBranches/'+$('select[name=college_id]').val(),'course_id='+$('select[name=course_id]').val(),function(dataR){
            $('select[name=branch_id]').html(dataR);
        })
       }
    });
    $('select[name=branch_id]').live('change',function(){
       if($('select[name=semister_id]').length>0){
        $.post(site_url+'/students/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
            $('select[name=semister_id]').html(dataR);
        })
       }
       if($('select[name=sem_id]').length>0){
        $.post(site_url+'/students/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
            $('select[name=sem_id]').html(dataR);
        })
       }
    });
    $('select[name=semister_id]').live('change',function(){
       if($('select[name=subject_id]').length>0){
        $.post(site_url+'/students/getCollegeSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
            $('select[name=subject_id]').html(dataR);
        })
       }
    });
    $('select[name=sem_id]').live('change',function(){
       if($('select[name=subject_id]').length>0){
        $.post(site_url+'/students/getCollegeSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=sem_id]').val(),function(dataR){
            $('select[name=subject_id]').html(dataR);
        })
       }
    });

    //For Sections
    $('select[name=sem_id]').live('change',function(){
       if($('select[name=section_id]').length>0){
        $.post(site_url+'/staff/getCollegeSections/'+$('select[name=college_id]').val(),'sem_id='+$('select[name=sem_id]').val(),function(dataR){
            $('select[name=section_id]').html(dataR);
        })
       }
    });
    //Send message
    $('select[name=semister_id]').live('change',function(){
       if($('select[name=section_id]').length>0){
        $.post(site_url+'/staff/getCollegeSections/'+$('select[name=college_id]').val(),'sem_id='+$('select[name=semister_id]').val(),function(dataR){
            $('select[name=section_id]').html(dataR);
        })
       }
    });
    
});


/******************************************************************/


function print_requests(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/exam/print_request',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Question Paper(s)",
            recordtext: "Viewing {0} - {1} of {2} Question Papers",
            pgtext : "Page {0} of {1}",
            colNames:['Paper from','Student Count', 'Branch','Year','Subject','Exam Number','Download Link','Status/Action'],
            colModel:[
                    {name:'username',index:'username', width:150},
                    {name:'students_count',index:'students_count', width:150},
                    {name:'branch',index:'branch', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'subject',index:'subject', width:150},
                    {name:'exam_number',index:'exam_number', width:150},
                    {name:'doc_link',index:'doc_link', width:150, sortable:false},
                    {name:'is_approved',index:'is_approved', width:150}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'username',
            viewrecords: false,
            sortorder: "desc",
            caption:"Question Papers",
            loadtext:'Loading..'
    });
}

function flag_printed(id){
    dataP='id='+id;
    $.ajax({
        url:site_url+'/exam/flag_paper_printed',
        data:dataP,
        type:'POST',
        // dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR){
                //$('#grid_table').trigger('reloadGrid');
                window.location.reload();
            }
        }
    })
}


function load_q_papers_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/browse_q_papers_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Question Paper(s)",
            recordtext: "Viewing {0} - {1} of {2} Question Papers",
            pgtext : "Page {0} of {1}",
            colNames:['Paper from','Student Count', 'Branch','Year','Subject','Exam Number','Download Link','Status/Action'],
            colModel:[
                    {name:'username',index:'username', width:150},
                    {name:'students_count',index:'students_count', width:150},
                    {name:'branch',index:'branch', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'subject',index:'subject', width:150},
                    {name:'exam_number',index:'exam_number', width:150},
                    {name:'doc_link',index:'doc_link', width:150, sortable:false},
                    {name:'is_approved',index:'is_approved', width:150}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'username',
            viewrecords: false,
            sortorder: "desc",
            caption:"Question Papers",
            loadtext:'Loading..',
            postData:{
                ro:'true'
            }
    });
}


function send_to_print(id){
    dataP='id='+id;
    $.ajax({
        url:site_url+'/staff/send_q_papers_print',
        data:dataP,
        type:'POST',
        // dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR){
                $('#grid_table').trigger('reloadGrid');
            }
        }
    })
}
