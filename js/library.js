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
    

});

/******************** DOC READY END *************************/



function delete_book(id){
    dataP='id='+id;
    $.ajax({
        url:site_url+'/library/book_delete_confirm',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#appl_form').html(dataR);
        }
    })
}


function books_dispatched_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/library/books_dispatched',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Books(s) Dispatched",
            recordtext: "Viewing {0} - {1} of {2} Books(s) Dispatched",
            pgtext : "Page {0} of {1}",
            colNames:['Unique Number','Book name','Author','Version','Year','Branch','Dispatched To','Student Number'],
            colModel:[
                    {name:'unique_number',index:'unique_number', width:150},
                    {name:'name',index:'name', width:150},
                    {name:'author',index:'author', width:150},
                    {name:'version',index:'version', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'student_name',index:'student_name', width:150},
                    {name:'students_number',index:'students_number', width:150}
            ],
            rowNum:10,
            rowList:[10,20,30,40,50],
            pager: '#grid_pager',
            sortname: 'students_number',
            viewrecords: false,
            sortorder: "desc",
            caption:"Books(s) Dispatched",
            loadtext:'Loading..'
    });
}


function check_data_grid(student_number){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/library/check_data_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Books(s) Dispatched",
            recordtext: "Viewing {0} - {1} of {2} Books(s) Dispatched",
            pgtext : "Page {0} of {1}",
            colNames:['Unique Number','Book name','Author','Version','Year','Branch','Booked By','Student Number','Dispatched?'],
            colModel:[
                    {name:'unique_number',index:'unique_number', width:150},
                    {name:'name',index:'name', width:150},
                    {name:'author',index:'author', width:150},
                    {name:'version',index:'version', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'student_name',index:'student_name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'dispatched',index:'dispatched', width:150,sortable:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'students_number',
            viewrecords: false,
            sortorder: "desc",
            caption:"Books(s) Dispatched",
            loadtext:'Loading..',
            postData:{
                'student_number':student_number
            }
    });
}



function no_due_request_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/no_due_requests',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Request(s)",
            recordtext: "Viewing {0} - {1} of {2} Request(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Student Name','Roll Number','Course','Branch','Present Year','Completng Year','Approve?'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'course',index:'course', width:150},
                    {name:'branch',index:'branch', width:150},
                    {name:'present_year',index:'present_year', width:150},
                    {name:'completing_year',index:'completing_year', width:150},
                    {name:'approve',index:'approve', width:150, sortable:false,title:false},
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"No-Due Requests",
            loadtext:'Loading..'
    });
}



function nodue_update(id,update){
    dataP='id='+id+'&update='+update;
    $.ajax({
        url:site_url+'/staff/update_nodue',
        data:dataP,
        type:'POST',
        // dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR){
                alert(dataR);
                $('#grid_table').trigger('reloadGrid');
                window.location.reload();
            }
        }
    })
}


