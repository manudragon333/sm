$(function(){
    $('#staff_select').live('change',function(){
        if($(this).val()!=''){
            showTTDetails();
        }else{
            $('.showTtOptions').hide();
        }
    });

    $('#branch_select, #year_select').live('change',function(){
        if($('#branch_select').val()!='' && $('#year_select').val()!=''){
            showStudentTTDetails();
        }else{
            $('.showTtOptions').hide();
        }
    });
    
    
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
       if($(this).hasClass('getStaffSubjects') && $('select[name=subject_id]').length>0){
            $.post(site_url+'/staff/getStaffSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
                $('select[name=subject_id]').html(dataR);
            });
       }else  if($('select[name=subject_id]').length>0){
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
       if($(this).hasClass('getStaffSubjects') && $('select[name=subject_id]').length>0){
            $.post(site_url+'/staff/getStaffSections/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
                $('select[name=section_id]').html(dataR);
            });
       }else  if($('select[name=section_id]').length>0){
        $.post(site_url+'/staff/getCollegeSections/'+$('select[name=college_id]').val(),'sem_id='+$('select[name=semister_id]').val(),function(dataR){
            $('select[name=section_id]').html(dataR);
        })
       }
    });

    $('#from').datepicker({
        beforeShow:function(input) {
                return {
                        minDate:new Date(),
                        maxDate: (input.id == "from" ? $("#to").datepicker("getDate") : null)
                };
        },
        dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true,
        onSelect:loadLeaveAdjustments
    });
    
    $('#to').datepicker({
        beforeShow:function(input) {
            return {
                      minDate: (input.id == "to" ?( ($("#from").val()!='')?$("#from").datepicker("getDate"):new Date() ): null)
            };
        },
        dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true,
        onSelect:loadLeaveAdjustments
    });
   

});


/*****************************DOC READY END *****************************/


function loadLeaveAdjustments(){
    if($('#from').val()=='' || $('#to').val()==''){ return true; }
    dataP='from='+$('#from').val()+'&to='+$('#to').val()
    $.ajax({
        url:site_url+'/staff/getStaffWeekdaysCyclePeriods',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR!=''){
                $('#work_adjustments').html(dataR)
            }
        }
    });
}

function showTTDetails(){
    dataP='staff_select='+$('#staff_select').val()
    $.ajax({
        url:site_url+'/staff/get_staff_time_table',
        data:dataP,
        type:'POST',
        dataType:'json',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR && dataR[0]){
                $.each(dataR[0],function(k,v){
                    if($('[name='+k+']').length>0){
                        $('[name='+k+']').val(v);
                    }
                })
            }else{
                $('[name=id]').val(0);
                $('form input[type=text]').val('');
                // $('form')[0].reset();
            }
            $('.showTtOptions').show();
        }
    })
}

function showStudentTTDetails(){
    dataP=$('#branch_select, #year_select').serialize();
    $.ajax({
        url:site_url+'/staff/get_student_time_table',
        data:dataP,
        type:'POST',
        dataType:'json',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR && typeof(dataR.length)=='undefined'){
                $.each(dataR,function(day_id,dataV){
                    $.each(dataV,function(k,v){
                        // console.log($('[name="rows['+day_id+']['+k+']"]')); console.log('[name="rows['+day_id+']['+k+']"]')
                        if($('[name="rows['+day_id+']['+k+']"]').length>0){
                            $('[name="rows['+day_id+']['+k+']"]').val(v);
                        }
                    });
                });
            }else{
                $('form input[type=text]').val('');
                // $('form input[type=hidden]').val(0);
            }
            $('.showTtOptions').show();
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
            loadtext:'Loading..'
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
                    {name:'approve',index:'approve', width:150, sortable:false},
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

function approve_q_papers_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/approve_q_papers',
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


function approve_paper(id){
    dataP='id='+id;
    $.ajax({
        url:site_url+'/staff/approve_paper',
        data:dataP,
        type:'POST',
        // dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR){
                $('#grid_table').trigger('reloadGrid');
                window.location.reload();
            }
        }
    })
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



/************ LIBRARY ********************/


function library_books_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/library/library_books',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Books(s)",
            recordtext: "Viewing {0} - {1} of {2} Books(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Unique Number','Book name','Author','Title of Book','Edition/Year','Branch','Book'],
            colModel:[
                    {name:'unique_number',index:'unique_number', width:150},
                    {name:'name',index:'name', width:150},
                    {name:'author',index:'author', width:150},
                    {name:'title',index:'title', width:150},
                    {name:'edition_year',index:'edition_year', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'action',index:'action', width:150,sortable:false}
            ],
            rowNum:10,
            rowList:[10,20,30,40,50],
            pager: '#grid_pager',
            sortname: 'unique_number',
            viewrecords: false,
            sortorder: "desc",
            caption:"Books(s)",
            loadtext:'Loading..'
    });
}


function reserved_books_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/library/reserved_library_books',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Books(s)",
            recordtext: "Viewing {0} - {1} of {2} Books(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Unique Number','Book name','Author','Version','Year','Branch','Collected ?'],
            colModel:[
                    {name:'unique_number',index:'unique_number', width:150},
                    {name:'name',index:'name', width:150},
                    {name:'author',index:'author', width:150},
                    {name:'version',index:'version', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'collected',index:'collected', width:150,sortable:false}
            ],
            rowNum:10,
            rowList:[10,20,30,40,50],
            pager: '#grid_pager',
            sortname: 'unique_number',
            viewrecords: false,
            sortorder: "desc",
            caption:"Books(s)",
            loadtext:'Loading..'
    });
}

function reserve_book(id){
    if(!confirm('Are you sure you want to reserve this book.?')){return false;}
    dataP='id='+id;
    $.ajax({
        url:site_url+'/library/reserve_book',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            alert(dataR);
            $('#grid_table').trigger('reloadGrid');
        }
    })
}



function view_assignments(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/view_assignments',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Assignment(s)",
            recordtext: "Viewing {0} - {1} of {2} Assignment(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Date Added','Branch','Semister', 'Subject','Instructions','File Link','Max Marks','Last Date','View Submissions'],
            colModel:[
                    {name:'date_added',index:'date_added', width:100},
                    {name:'branch_name',index:'branch_id', width:150},
                    {name:'sem_name',index:'sem_id', width:150},
                    {name:'subject',index:'subject', width:150},
                    {name:'instructions',index:'instructions', width:200},
                    {name:'doc_link',index:'doc_link', width:100, sortable:false},
                    {name:'max_marks',index:'max_marks', width:100},
                    {name:'last_date',index:'last_date', width:100, sortable:false},
                    {name:'view_submissions',index:'view_submissions', width:150}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'date_added',
            viewrecords: false,
            sortorder: "desc",
            caption:"Assignments",
            loadtext:'Loading..'
    });
}
var submissionAssId;
function view_submissions(id){
    submissionAssId=id;
    $.ajax({
        url:site_url+'/staff/view_submissions',
        type:'POST',
        dataType:'',
        beforeSend:function(){
            
        },
        success:function(dataR){
            $('#main_content').html(dataR);
        }
    })
}

function view_submissions_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/view_submissions',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Assignment(s)",
            recordtext: "Viewing {0} - {1} of {2} Assignment(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Student Name','Student Number','Student Reply', 'File Link','Marks Alloted','Staff Comments','Assign Marks'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'student_replies',index:'student_replies', width:150},
                    {name:'doc_link',index:'doc_link', width:80, sortable:false},
                    {name:'marks_alloted',index:'marks_alloted', width:80},
                    {name:'staff_comments',index:'staff_comments', width:150},
                    {name:'assign_marks',index:'assign_marks', width:100}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'fname',
            viewrecords: false,
            sortorder: "desc",
            caption:"Assignments",
            loadtext:'Loading..',
            postData:{
                'id':submissionAssId
            }
    });
}


function assign_marks(id){
    dataP='id='+id;
    $.ajax({
        url:site_url+'/staff/get_marks_details',
        data:dataP,
        type:'POST',
        dataType:'json',
        beforeSend:function(){

        },
        success:function(dataR){
            $.showModal({
                id:new Date().getTime().toString(),
                message:$.assignment_marks_form(dataR),
                width:350,
                height:240,
                buttons:
                    [{
                        text: "Cancel",
                        click: function() {$(this).dialog("close");}
                    },
                    {
                        text: "Save",
                        click: function() {submit_marks_form();}
                    }]
            });
        }
    });
}

function submit_marks_form(){
    dataP=$('#marks_form').serialize();
    $.ajax({
        url:site_url+'/staff/save_assignment_marks',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){
            
        },
        success:function(dataR){
            alert('Marks saved.');
            $('.ui-icon-closethick').trigger('click');
            $('#modal_message').dialog('close').dialog( "destroy" );
            $('#grid_table').trigger('reloadGrid');            
        }
    })
}


function view_library_pdfs(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/students/view_library_pdfs',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "PDF's",
            recordtext: "Viewing {0} - {1} of {2} Assignment(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Date Added','Branch','Semister', 'Instructions','File Link','View Discussions'],
            colModel:[
                    {name:'date_added',index:'date_added', width:100},
                    {name:'branch_name',index:'branch_id', width:150},
                    {name:'sem_name',index:'sem_id', width:150},
                    {name:'instructions',index:'instructions', width:200},
                    {name:'doc_link',index:'doc_link', width:100, sortable:false},
                    {name:'view_discussion',index:'view_discussion', width:150}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'date_added',
            viewrecords: false,
            sortorder: "desc",
            caption:"PDF's",
            loadtext:'Loading..'
    });
}

function leave_letter_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/leave_letter',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Leave Letters",
            pgtext : "Page {0} of {1}",
            colNames:['Apply Date','From ', 'To ','Branch','Type of leave','Purpose','View','Status'],
            colModel:[
                    {name:'date_added',index:'date_added', width:150},
                    {name:'from',index:'from', width:150},
                    {name:'to',index:'to', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'leave_type_name',index:'leave_type_name', width:150},
                    {name:'purpose',index:'purpose', width:150},
                    {name:'doc_link',index:'doc_link', width:150, sortable:false},
                    {name:'is_approved',index:'is_approved', width:150}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'date_added',
            viewrecords: false,
            sortorder: "desc",
            caption:"Leave Letters",
            loadtext:'Loading..'
    });
}



function leave_letter_request_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/leave_requests',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Leave Letter Requests",
            pgtext : "Page {0} of {1}",
            colNames:['Apply Date','From ', 'To ','Branch','Type of leave','Purpose','View','Status'],
            colModel:[
                    {name:'date_added',index:'date_added', width:150},
                    {name:'from',index:'from', width:150},
                    {name:'to',index:'to', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'leave_type_name',index:'leave_type_name', width:150},
                    {name:'purpose',index:'purpose', width:150},
                    {name:'doc_link',index:'doc_link', width:150, sortable:false},
                    {name:'is_approved',index:'is_approved', width:150}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'date_added',
            viewrecords: false,
            sortorder: "desc",
            caption:"Leave Letter Requests",
            loadtext:'Loading..'
    });
}

function change_leave_approval(id,status){
    if(!confirm('Do you want to change the Approval Status?')){
        return false;
    }
    dataP='id='+id+'&is_approved='+status;
    $.ajax({
        url:site_url+'/staff/change_leave_approval',
        data:dataP,
        type:'POST',
        beforeSend:function(){
            
        },
        success:function(dataR){
            if(dataR){
                $('#grid_table').trigger('reloadGrid');
            }
        }
    })
}


function leave_adjust_request_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/leave_adjust_requests',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Leave Adjust Requests",
            pgtext : "Page {0} of {1}",
            colNames:['Request Date','Subject/Period Details ', 'Cycle Name ','Time','View','Status'],
            colModel:[
                    {name:'date_added',index:'date_added', width:150},
                    {name:'subject_name',index:'subject_name', width:150},
                    {name:'cycle_name',index:'cycle_name', width:150},
                    {name:'time_label',index:'time_label', width:150},
                    {name:'doc_link',index:'doc_link', width:150, sortable:false},
                    {name:'is_approved',index:'is_approved', width:150}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'date_added',
            viewrecords: false,
            sortorder: "desc",
            caption:"Leave Adjust Requests",
            loadtext:'Loading..'
    });
}

function change_leave_adjust_approval(id,status){
    if(!confirm('Do you want to change the Approval Status?')){
        return false;
    }
    dataP='id='+id+'&is_approved='+status;
    $.ajax({
        url:site_url+'/staff/change_leave_adjust_approval',
        data:dataP,
        type:'POST',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR){
                $('#grid_table').trigger('reloadGrid');
            }
        }
    })
}

function attendance_breach_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/attendance_breach',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Attendance Breachs",
            pgtext : "Page {0} of {1}",
            colNames:['Staff Code','Staff Name', 'College','Breach date','Branch','Subject','Semister','Cycle','Time','Unlock Breach'],
            colModel:[
                    {name:'code',index:'code', width:150},
                    {name:'name',index:'name', width:150},
                    {name:'college_name',index:'college_name', width:150},
                    {name:'breach_date',index:'breach_date', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'subject_name',index:'subject_name', width:150},
                    {name:'semister_name',index:'semister_name', width:150},
                    {name:'cycle_name',index:'cycle_name', width:150},
                    {name:'time_label',index:'time_label', width:150},
                    {name:'doc_link',index:'doc_link', width:250, sortable:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"Attendance Breach",
            loadtext:'Loading..'
    });
}

function unlock_breach(id,id2){
    if(!confirm('Are you sure. Do you want to Unlock?')){
        return false;
    }
    dataP='staff_user_id='+id+'&id='+id2;
    $.ajax({
        url:site_url+'/staff/unlock_breach',
        data:dataP,
        type:'POST',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR){
                $('#grid_table').trigger('reloadGrid');
            }
        }
    })
}