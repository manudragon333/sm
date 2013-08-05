$(function(){

    $('#add_user').live('click',function(){
        loadUserTypeSelect('add');
    });

    $('#update_user').live('click',function(){
        loadUserTypeSelect('update');
    });

    $('#user_type_add').live('change',function(){
        loadUserDetailsForm($(this).val());
    });
    $('#user_type_update').live('change',function(){
        // loadUpdateUserDetailsForm($(this).val());
        loadUserSelect($(this).val());
    });

    $('#user_select').live('change',function(){
        loadUsersForm($(this).val());
    })
/****************************************************************************************************************/

    $('[name=users_type],[name=status],[name=college_id],[name=course_id],[name=branch_id],[name=semister_id],[name=section_id],[name=admission_type_id],[name=scholarship],[name=sex],[name=caste_id]').live('change',function(){
        $('#grid_table').setGridParam({
            postData:{
                user_type:$('[name=users_type]').val(),
                status:$('[name=status]').val(),
                college_id:$('[name=college_id]').val(),
                course_id:$('[name=course_id]').val(),
                branch_id:$('[name=branch_id]').val(),
                semister_id:$('[name=semister_id]').val(),
                section_id:$('[name=section_id]').val(),
				admission_type_id:$('[name=admission_type_id]').val(),
				scholarship:$('[name=scholarship]').val(),
				sex:$('[name=sex]').val(),
				caste_id:$('[name=caste_id]').val()
            }
        }).trigger('reloadGrid');
    });

    $('#add_user_btn').live('click',function(){
        loadUserTypeSelect();
    });

    $('#add_attendance_sem_id').live('change',function(){
        loadAttendance();
    });

    $('select[name=college_id]').live('change',function(){
       if($('select[name=course_id]').length>0){
        $.post(site_url+'/admin/getCollegeCourses/'+$('select[name=college_id]').val(),function(dataR){
            $('select[name=course_id]').html(dataR);
        })
       }
    });
    
    //Academic Years
     $('select[name=college_id]').live('change',function(){
       if($('select[name=academic_year]').length>0){
        $.post(site_url+'/admin/getCollegeAcademic/'+$('select[name=college_id]').val(),function(dataR){
            $('select[name=academic_year]').html(dataR);
        })
       }
    });
    
    
    $('select[name=course_id]').live('change',function(){
       if($('select[name=branch_id]').length>0){
        $.post(site_url+'/admin/getCollegeBranches/'+$('select[name=college_id]').val(),'course_id='+$('select[name=course_id]').val(),function(dataR){
            $('select[name=branch_id]').html(dataR);
        })
       }
    });
    $('select[name=branch_id]').live('change',function(){
       if($('select[name=semister_id]').length>0){
         $.post(site_url+'/admin/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
            $('select[name=semister_id]').html(dataR);
        })
       }
       if($('select[name=sem_id]').length>0){
        $.post(site_url+'/admin/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
            $('select[name=sem_id]').html(dataR);
        })
       }
    });
    $('select[name=semister_id]').live('change',function(){
       if($('select[name=subject_id]').length>0){
        $.post(site_url+'/admin/getCollegeSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
            $('select[name=subject_id]').html(dataR);
        })
       }
    });
    //For Sections in Edit staff attendance
     $('select[name=semister_id]').live('change',function(){
       if($('select[name=section_id]').length>0){
        $.post(site_url+'/admin/getCollegeSections/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
            $('select[name=section_id]').html(dataR);
        })
       }
    });
    
    //For Start Roll Numbers
    $('select[name=semister_id]').live('change',function(){
       if($('select[name=start_number]').length>0){
        $.post(site_url+'/admin/getCollegeNumbers/'+$('select[name=college_id]').val()+'/'+$('select[name=course_id]').val()+'/'+$('select[name=branch_id]').val()+'/'+$('select[name=semister_id]').val(),'course_id='+$('select[name=course_id]').val(),function(dataR){
            $('select[name=start_number]').html(dataR);
        })
       }
    });
    
    //For End Roll Numbers
    $('select[name=semister_id]').live('change',function(){
       if($('select[name=end_number]').length>0){
        $.post(site_url+'/admin/getCollegeNumbers/'+$('select[name=college_id]').val()+'/'+$('select[name=course_id]').val()+'/'+$('select[name=branch_id]').val()+'/'+$('select[name=semister_id]').val(),'course_id='+$('select[name=course_id]').val(),function(dataR){
            $('select[name=end_number]').html(dataR);
        })
       }
    });



    $('.editStaffPeriods').live('click',function(){
        dataP='weekday_id='+$(this).attr('weekday_id')+'&period_id='+$(this).attr('period_id')+'&staff_id='+$(this).attr('staff_id')+'&cycle_id='+$(this).attr('cycle_id')+'&academic_year_id='+$(this).attr('academic_year_id')+'';
        $.ajax({
            url:site_url+'/admin/edit_staff_attendance',
            data:dataP,
            type:'POST',
            dataType:'text/html',
            beforeSend:function(){
                
            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        })
    })



});


/************** DOC READY END *********************/


function loadUsersForm(users_id){
    if(users_id!=''){
        $.ajax({
            url:site_url+'/admin/users_form',
            data:'users_id='+users_id,
            type:'POST',
            dataType:'text/html',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#user_details').html(dataR);
                if($('.apply_datepicker').length>0){
                    $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
                }
            }
        })
    }else{
        $('#user_details').html('');
    }
}


function loadUserDetailsForm(users_type_id){
    if(users_type_id!=''){
        $.ajax({
            url:site_url+'/admin/user_details_form',
            data:'users_type_id='+users_type_id,
            type:'POST',
            dataType:'text/html',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#user_details').html(dataR);
                if($('.apply_datepicker').length>0){
                    $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
                }
            }
        })
    }else{
        $('#user_details').html('');
    }
}


function loadUserSelect(user_type){
    dataP='user_type='+user_type
    $.ajax({
        url:site_url+'/admin/get_user_list',
        data:dataP,
        type:'POST',
        dataType:'text/html',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#user_select_li').html(dataR);
        }
    })
}
/****************************************************************************************************************/

function addusermarks_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/load_usermarks_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "User(s)",
            recordtext: "Viewing {0} - {1} of {2} User(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Username', 'Email','Semister/Year','Branch','View Marks','Add Marks','Add Attendance'],
            colModel:[
                    {name:'username',index:'username', width:150},
                    {name:'email',index:'email', width:150},
                    {name:'semister',index:'semister', width:150},
                    {name:'Branch',index:'Branch', width:150},
                    {name:'marks',index:'marks', width:150, sortable:false,title:false},
                    {name:'addmarks',index:'addmarks', width:130, sortable:false,title:false},
                    {name:'addattendance',index:'addattendance', width:130, sortable:false,title:false}
            ],
           
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'username',
            viewrecords: false,
            sortorder: "desc",
            caption:"Exam Marks(s)",
            loadtext:'Loading..',
            postData:{
                user_type:$('[name=users_type]').val(),
                status:$('[name=status]').val()
            }
    });
}

/****************************************************************************************************************/

function users_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/load_users_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "User(s)",
            recordtext: "Viewing {0} - {1} of {2} User(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Username','Password', 'Email','Status','Update Account','Squeez/Release'],
            colModel:[
                    {name:'username',index:'username', width:150},
                    {name:'password',index:'password', width:150},
                    {name:'email',index:'email', width:150},
                    {name:'status',index:'status', width:150},
                    {name:'action1',index:'action1', width:150, sortable:false,title:false},
                    {name:'action2',index:'action2', width:130, sortable:false,title:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'username',
            viewrecords: true,
            sortorder: "desc",
            caption:"User(s)",
            loadtext:'Loading..',
            postData:{
                user_type:$('[name=users_type]').val(),
                status:$('[name=status]').val(),
                college_id:$('[name=college_id]').val(),
                course_id:$('[name=course_id]').val(),
                branch_id:$('[name=branch_id]').val(),
                semister_id:$('[name=semister_id]').val(),
                section_id:$('[name=section_id]').val(),
				admission_type_id:$('[name=admission_type_id]').val(),
				scholarship:$('[name=scholarship]').val(),
				sex:$('[name=sex]').val(),
				caste_id:$('[name=caste_id]').val()
            }
    });
}

function poll_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/poll_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "User(s)",
            recordtext: "Viewing {0} - {1} of {2} User(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Question','Start Date', 'End Date','Edit','Active/Inactive','Result'],
            colModel:[
                    {name:'question',index:'question', width:150},
                    {name:'start_date',index:'start_date', width:150},
                    {name:'end_date',index:'end_date', width:150},
		    {name:'action3',index:'action3', width:150, sortable:false,title:false},
                    {name:'action2',index:'action2', width:130, sortable:false,title:false},
                    {name:'poll_result',index:'poll_result', width:130, sortable:false,title:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'question',
            viewrecords: false,
            sortorder: "desc",
            caption:"Polls(s)",
            loadtext:'Loading..',
            postData:{
                //user_type:$('[name=users_type]').val(),
                //status:$('[name=status]').val()
            }
    });
}

function update_account(id,f){
    dataP='users_id='+id+'&f='+f;
    $.ajax({
        url:site_url+'/admin/update_account',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#users_content_wrap').html(dataR);
            if($('.apply_datepicker').length>0){
                $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
            }
        }
    })
}

function add_account(id,f){
    dataP='users_id='+id+'&f='+f;
    $.ajax({
        url:site_url+'/admin/add_account',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#users_content_wrap').html(dataR);
            if($('.apply_datepicker').length>0){
                $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
            }
        }
    })
}
function squeez_account(id,f){
    dataP='id='+id+'&f='+f;
    $.ajax({
        url:site_url+'/admin/squeez_account',
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


function loadUserTypeSelect(){
    $.ajax({
        url:site_url+'/admin/get_user_types',
        data:'type=add_user',
        type:'POST',
        dataType:'text/html',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#users_content_wrap').html(dataR);
        }
    })
}


function validate_form_student_user_form(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            fathers_name:{
                required:true,
                noDigits:true
            },
            students_number:{
                required:true
            },
            sex:{
                required:true
            },
            dob:{
                required:true
            },
            doj:{
                required:true
            },
            course_id:{
                required:true
            },
            branch_id:{
                required:true
            },
            present_year:{
                required:true
            },
            completing_year:{
                required:true
            },
            fee_details:{
                required:true
            },
            address:{
                required:true
            },
            mobile:{
                required:true,
                digits:true,
                rangelength: [10, 10]
            },
			father_mobile:{
				required:true,
				digits:true,
				rangelength:[10,10]
			},
            email:{
                required:true,
                email:true
            },
            username:{
                required:true
            },
            password:{
                required:true
            },
            name:{
                required:true
            },
            code:{
                required:true
            },
            email2:{
                required:true,
                email:true
            },
            salary:{
                required:true
            }

        },
        messages:{
            name:{
                required:'Enter name'
            },
            fathers_name:{
                required:'Enter Fathers name'
            },
            students_number:{
                required:'Enter Student number'
            },
            sex:{
                required:'Select sex'
            },
            dob:{
                required:'Select Date of birth'
            },
            doj:{
                required:'Select date of join'
            },
            course_id:{
                required:'Select Course'
            },
            branch_id:{
                required:'Select branch'
            },
            present_year:{
                required:'Select present year'
            },
            completing_year:{
                required:'Select completing year'
            },
            fee_details:{
                required:'Enter fee details'
            },
            address:{
                required:'Enter Address'
            },
            mobile:{
                required:'Please enter mobile number',
                digits:'Please enter only digits',
                rangelength:'Mobile number should be 10 digits'
            },
			father_mobile:{
				required:'Please enter father\'s mobile number',
				digits:'Please enter only digits',
                rangelength:'Mobile number should be 10 digits'
			},
            email:{
                required:'Please enter email',
                email:'Please enter a valid email address'
            },
            username:{
                required:'Please enter username'
            },
            password:{
                required:'Please enter Password'
            },
            name:{
                required:'Please enter name'
            },
            code:{
                required:'Please enter staff code'
            },
            email2:{
                required:'Please enter email',
                email:'Please enter a valid email address'
            },
            salary:{
                required:'Please enter salary'
            }
        },
       // submitHandler:function(form){
           // ajax_gen_form(form);
		     
        //},
        errorPlacement: function(error, element) {
            if(element.attr('name')=='sex')
                error.appendTo( $('[name=sex]:last').parents("li") );
            else
                error.appendTo( element.parent() )
        }
    });
    // $('#appl_form').submit();
}

function validate_form_user_form(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            fathers_name:{
                required:true,
                noDigits:true
            },
            students_number:{
                required:true
            },
            sex:{
                required:true
            },
            dob:{
                required:true
            },
            doj:{
                required:true
            },
            course_id:{
                required:true
            },
            branch_id:{
                required:true
            },
            present_year:{
                required:true
            },
            completing_year:{
                required:true
            },
            fee_details:{
                required:true
            },
            address:{
                required:true
            },
            mobile:{
                required:true,
                digits:true,
                rangelength: [10, 10]
            },
			father_mobile:{
				required:true,
				digits:true,
				rangelength:[10,10]
			},
            email:{
                required:true,
                email:true
            },
            username:{
                required:true
            },
            password:{
                required:true
            },
            name:{
                required:true
            },
            code:{
                required:true
            },
            email2:{
                required:true,
                email:true
            },
            salary:{
                required:true
            }

        },
        messages:{
            name:{
                required:'Enter name'
            },
            fathers_name:{
                required:'Enter Fathers name'
            },
            students_number:{
                required:'Enter Student number'
            },
            sex:{
                required:'Select sex'
            },
            dob:{
                required:'Select Date of birth'
            },
            doj:{
                required:'Select date of join'
            },
            course_id:{
                required:'Select Course'
            },
            branch_id:{
                required:'Select branch'
            },
            present_year:{
                required:'Select present year'
            },
            completing_year:{
                required:'Select completing year'
            },
            fee_details:{
                required:'Enter fee details'
            },
            address:{
                required:'Enter Address'
            },
            mobile:{
                required:'Please enter mobile number',
                digits:'Please enter only digits',
                rangelength:'Mobile number should be 10 digits'
            },
			father_mobile:{
				required:'Please enter father\'s mobile number',
				digits:'Please enter only digits',
                rangelength:'Mobile number should be 10 digits'
			},
            email:{
                required:'Please enter email',
                email:'Please enter a valid email address'
            },
            username:{
                required:'Please enter username'
            },
            password:{
                required:'Please enter Password'
            },
            name:{
                required:'Please enter name'
            },
            code:{
                required:'Please enter staff code'
            },
            email2:{
                required:'Please enter email',
                email:'Please enter a valid email address'
            },
            salary:{
                required:'Please enter salary'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        },
        errorPlacement: function(error, element) {
            if(element.attr('name')=='sex')
                error.appendTo( $('[name=sex]:last').parents("li") );
            else
                error.appendTo( element.parent() )
        }
    });
    $('#appl_form').submit();
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


function approve_q_papers_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/approve_q_papers',
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



function approve_paper(id){
    dataP='id='+id;
    $.ajax({
        url:site_url+'/admin/approve_paper',
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

function notice_board_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/notice_board',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Item(s)",
            recordtext: "Viewing {0} - {1} of {2} Item(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Message', 'Date Added','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:150},
                    {name:'message',index:'message', width:150},
                    {name:'date_added',index:'date_added', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'date_added',
            viewrecords: false,
            sortorder: "desc",
            caption:"College Updates",
            loadtext:'Loading..'
    });
}

function delete_notice(id){
    if(confirm('Are you sure you sure you want to delete this message.?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_notice',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){
                
            },
            success:function(dataR){
                $('#grid_table').trigger('reloadGrid');
            }
        });
    }

}


function edit_notice(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_notice',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){
                
            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}



function subjects_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/branch_semister_subjects',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Item(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Branch', 'Semister','Subject','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'branch_id',index:'branch_id', width:150},
                    {name:'semister_id',index:'semister_id', width:150},
                    {name:'subject_id',index:'subject_id', width:150},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'branch_id',
            viewrecords: false,
            sortorder: "desc",
            caption:"Branch Semister Subjects",
            loadtext:'Loading..'
    });
}


function delete_subject_grid(id){
    if(confirm('Are you sure you sure you want to remove this subject to this branch semister.?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_subject_grid',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#grid_table').trigger('reloadGrid');
            }
        });
    }

}


function edit_subject_grid(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_subject_grid',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}



function system_subjects_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/system_subjects_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Item(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Subject Name', 'Edit','delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'name',index:'branch_id', width:150},
                    {name:'edit',index:'edit', width:150,sortable:false},
                    {name:'delete',index:'delete', width:150,sortable:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'id',
            viewrecords: false,
            sortorder: "asc",
            caption:"Branch Semister Subjects",
            loadtext:'Loading..'
    });
}


function edit_system_subjects(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_system_subjects',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function delete_system_subjects(id){
    if(confirm('Are you sure you sure you want to remove this subject.?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_system_subjects',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#grid_table').trigger('reloadGrid');
            }
        });
    }

}

function edit_attendance(uid,sem_id){
    dataP='user_id='+uid+'&semister_id='+sem_id
    $.ajax({
        url:site_url+'/admin/add_attendance',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){
            
        },
        success:function(dataR){
            $('#main_content').html(dataR);
        }
    })
}

function loadAttendance(){
    dataP=$('#appl_form').serialize();
    $.ajax({
        url:site_url+'/admin/get_student_attendance',
        data:dataP,
        type:'POST',
        dataType:'json',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR[0]){
                $('[name=id]').val(dataR[0].id);
                $('[name=attend_days]').val(dataR[0].attend_days);
                $('[name=tot_days]').val(dataR[0].tot_days);
                $('#imageField').val('Update Attendance');
                $('#att_title').text('Update Attendance');
            }else{
                $('[name=attend_days],[name=tot_days],[name=id]').val('');
                $('#imageField').val('Add Attendance');
                $('#att_title').text('Add Attendance');
            }
        }
    })
}

function toggle_pool_status(id,status){
    dataP='id='+id+'&status='+status
    $.ajax({
        url:site_url+'/admin/toggle_status',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){
            
        },
        success:function(dataR){
            if(dataR=='1'){
                $('.poll_status_a'+id).html('<b>Active</b>/Inactive');
            }else{
                $('.poll_status_a'+id).html('Active/<b>Inactive</b>');
            }
            jQuery("#grid_table").trigger('reloadGrid');
        }
    })
}

function edit_polls(id){
    dataP='id='+id;
    $.ajax({
        url:site_url+'/admin/edit_poll',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#main_content').html(dataR);
        }
    })
}

function result_polls(id){
    dataP='id='+id;
    $.ajax({
        url:site_url+'/admin/result_poll',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#main_content').html(dataR);
        }
    })
}


/************************************************ MAR 22 + added ****************************************/

function college_management_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/college_management',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} College(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','College Name','College Code', 'Status','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'name',index:'name', width:150},
                    {name:'college_code',index:'college_code', width:150},
                    {name:'status',index:'status', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "asc",
            caption:"Colleges",
            loadtext:'Loading..'
    });
}


function edit_college_management(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_college_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}
function edit_regulation_management(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_regulation_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}

function regulation_management_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/regulation_management',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            //recordtext: "Viewing {0} - {1} of {2} College(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','regulation Name', 'Status','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'name',index:'name', width:150},
                    {name:'status',index:'status', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'id',
            viewrecords: false,
            sortorder: "asc",
            caption:"Regulations",
            loadtext:'Loading..'
    });
}

function delete_regulation_management(id){
    if(confirm('Are you sure you want to Delete this regulation?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_regulation_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}
function delete_college_management(id){
    if(confirm('Are you sure you want to Delete this College?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_college_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function course_management_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/course_management',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Course(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Course Name', 'College Name','Status','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'name',index:'name', width:150},
                    {name:'college_name',index:'college_name', width:150},
                    {name:'status',index:'status', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            rowList:[10,30,50,100],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "asc",
            caption:"Courses",
            loadtext:'Loading..',
            grouping:true,
            groupingView : {
                groupField : ['college_name'],
                groupDataSorted : true
            }
    });
}


function edit_course_management(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_course_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function delete_course_management(id){
    if(confirm('Are you sure you want to Delete this Course?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_course_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}

/******************************************************************************/


function branch_management_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/branch_management',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Branch(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Branch Name', 'Course Name', 'College Name','Status','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'name',index:'name', width:150},
                    {name:'course_id',index:'course_id', width:150},
                    {name:'college_name',index:'college_name', width:150},
                    {name:'status',index:'status', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            rowList:[10,30,50,100],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "asc",
            caption:"Branches",
            loadtext:'Loading..',
            grouping:true,
            groupingView : {
                groupField : ['college_name'],
                groupDataSorted : true
            }
    });
}


function edit_branch_management(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_branch_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function delete_branch_management(id){
    if(confirm('Are you sure you want to Delete this Branch?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_branch_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


/******************************************************************************/


function semester_management_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/semester_management',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Semester(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Sem Name','Year','Branch Name', 'Course Name', 'College Name','Status','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'name',index:'name', width:150},
                    {name:'year',index:'year', width:50},
                    {name:'branch_id',index:'branch_id', width:150},
                    {name:'course_id',index:'course_id', width:150},
                    {name:'college_name',index:'college_name', width:150},
                    {name:'status',index:'status', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            rowList:[10,30,50,100],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "asc",
            caption:"Semesters",
            loadtext:'Loading..',
            grouping:true,
            groupingView : {
                groupField : ['college_name'],
                groupDataSorted : true
            }
    });
}


function edit_semester_management(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_semester_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function delete_semester_management(id){
    if(confirm('Are you sure you want to Delete this Semester?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_semester_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}



/******************************************************************************/


function subject_management_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/subject_management',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Subjects(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Subject name','Sem Name','Year','Branch Name', 'Course Name', 'College Name','Status','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'name',index:'name', width:150},
                    {name:'semister_name',index:'semister_name', width:150},
                    {name:'year',index:'year', width:50},
                    {name:'branch_id',index:'branch_id', width:150},
                    {name:'course_id',index:'course_id', width:150},
                    {name:'college_name',index:'college_name', width:150},
                    {name:'status',index:'status', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            rowList:[10,30,50,100],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: true,
            sortorder: "asc",
            caption:"Subjects",
            loadtext:'Loading..',
            grouping:true,
            groupingView : {
                groupField : ['college_name'],
                groupDataSorted : true
            }
    });
}


function edit_subject_management(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_subject_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}

function add_subject_management(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/add_subject_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function delete_subject_management(id){
    if(confirm('Are you sure you want to Delete this Subject?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_subject_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function section_management_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/section_management',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Section(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Section name','Sem Name','Year','Branch Name', 'Course Name', 'College Name','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'section',index:'section', width:150},
                    {name:'semister_name',index:'semister_name', width:150},
                    {name:'year',index:'year', width:50},
                    {name:'branch_id',index:'branch_id', width:150},
                    {name:'course_id',index:'course_id', width:150},
                    {name:'college_name',index:'college_name', width:150},
                    //{name:'status',index:'status', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            rowList:[10,30,50,100],
            pager: '#grid_pager',
            sortname: 'section',
            viewrecords: true,
            sortorder: "asc",
            caption:"Section",
            loadtext:'Loading..',
            grouping:true,
            groupingView : {
                groupField : ['college_name'],
                groupDataSorted : true
            }
    });
}


function edit_section_management(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_section_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function delete_section_management(id){
    if(confirm('Are you sure you want to Delete this Section?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_section_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}



/******************************************************************************/


function period_management_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/period_management',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Period Cycle(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Cycle name','College name','No. of periods','Time Period','Starting Time','Status','Edit','Edit Periods','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'name',index:'name', width:150},
                    {name:'college_name',index:'college_name', width:150},
                    {name:'no_of_periods',index:'no_of_periods', width:150},
                    {name:'time_period',index:'time_period', width:150},
                    {name:'starting_time',index:'starting_time', width:150},
                    {name:'status',index:'status', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            rowList:[10,30,50,100],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: true,
            sortorder: "asc",
            caption:"Period Cycles",
            loadtext:'Loading..',
            grouping:true,
            groupingView : {
                groupField : ['college_name'],
                groupDataSorted : true
            }
    });
}


function edit_period_management(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_period_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function edit_periods(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_periods/'+id,
            data:'',
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function delete_period_management(id){
    if(confirm('Are you sure you want to Delete this Cycle?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_period_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}


function attendance_management_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/attendance_management_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Viewing {0} - {1} of {2} Schedule(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Staff Name', 'Cycle Name','Academic Year','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:50},
                    {name:'staff_name',index:'staff_name', width:150},
                    {name:'cycle_name',index:'cycle_name', width:150},
                    {name:'academic_year',index:'academic_year', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false, title:false},
                    {name:'edit',index:'edit', width:150, sortable:false, title:false}
            ],
            rowNum:10,
            rowList:[10,30,50,100],
            pager: '#grid_pager',
            sortname: 'staff_name',
            viewrecords: false,
            sortorder: "asc",
            caption:"Attendance Schedule",
            loadtext:'Loading..',
            grouping:false,
            groupingView : {
                groupField : ['college_name'],
                groupDataSorted : true
            }
    });
}


function delete_attendance_management(id,cycle_id){
    if(confirm('Are you sure you want to Delete this Period Cycle Allocation?')){
        dataP='id='+id+'&cycle_id='+cycle_id;
        $.ajax({
            url:site_url+'/admin/delete_attendance_management',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#grid_table').trigger('reloadGrid');
            }
        });
    }
}

