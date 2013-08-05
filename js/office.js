$(function(){


});


/*****************************DOC READY END *****************************/

function id_card_requests_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/office/id_card_requests',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "ID Card request(s)",
            recordtext: "Viewing {0} - {1} of {2} ID Card request(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Student Name','Student Number', 'Branch','Date of join','Address','Mobile Number','Photo','Status/Action'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'stu_number',index:'stu_number', width:150},
                    {name:'branch',index:'branch', width:150},
                    {name:'date_of_join',index:'date_of_join', width:150},
                    {name:'address',index:'address', width:150},
                    {name:'mobile_no',index:'mobile_no', width:150},
                    {name:'photo',index:'photo', width:160, sortable:false},
                    {name:'action',index:'action', width:130, sortable:false,title:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"ID Card request(s)",
            loadtext:'Loading..'
    });
}

function bus_pass_requests_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/office/bus_pass',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Bus Pass request(s)",
            recordtext: "Viewing {0} - {1} of {2} Bus Pass request(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Student Name','Student Number', 'Start From','Branch','Course','Action'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'student_number',index:'student_number', width:150},
                    {name:'start_from',index:'start_from', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'course_name',index:'course_name', width:150},
                    {name:'action',index:'action', width:130, sortable:false,title:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"Bus Pass request(s)",
            loadtext:'Loading..'
    });
}

function study_certi_requests_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/office/study_certi_requests',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Study Certificate request(s)",
            recordtext: "Viewing {0} - {1} of {2} Study Certificate request(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Student Name','Student Number', 'Son Of','Course','From','To','Action'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'student_number',index:'student_number', width:150},
                    {name:'son_of',index:'son_of', width:150},
                    {name:'course_name',index:'course_name', width:150},
                    {name:'from',index:'from', width:150},
                    {name:'to',index:'to', width:130 },
                    {name:'action',index:'action', width:130, sortable:false,title:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"Study Certificate request(s)",
            loadtext:'Loading..'
    });
}

function conduct_certi_requests_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/office/conduct_certi_requests',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Conduct Certificate request(s)",
            recordtext: "Viewing {0} - {1} of {2} Conduct Certificate request(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Student Name','Student Number', 'C/O','Course','From','To','Action'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'stu_number',index:'stu_number', width:150},
                    {name:'co',index:'co', width:150},
                    {name:'course_name',index:'course_name', width:150},
                    {name:'from_date',index:'from_date', width:150},
                    {name:'to_date',index:'to_date', width:130},
                    {name:'action',index:'action', width:130, sortable:false,title:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"Conduct Certificate request(s)",
            loadtext:'Loading..'
    });
}


function tc_requests_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/office/tc_certi_requests',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Transfer Certificate request(s)",
            recordtext: "Viewing {0} - {1} of {2} Transfer Certificate  request(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Student Name','Student Number', 'Branch','Course','Date of Join','To','Action'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'course_name',index:'course_name', width:150},
                    {name:'doj',index:'doj', width:150},
                    {name:'completing_year',index:'completing_year', width:130},
                    {name:'action',index:'action', width:130, sortable:false,title:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"Transfer Certificate request(s)",
            loadtext:'Loading..'
    });
}


function print_id_card(id){
    my_win=window.open(''+site_url+'/office/id_card_print_preview/'+id+'','id_card_print_preview','');
}

function print_bus_pass(id){
    my_win=window.open(''+site_url+'/office/bus_pass_print/'+id+'','id_card_print_preview','');
}

function print_study_certi(id){
    my_win=window.open(''+site_url+'/office/study_certi_print/'+id+'','id_card_print_preview','');
}

function print_conduct_certi(id){
    my_win=window.open(''+site_url+'/office/conduct_certi_print/'+id+'','id_card_print_preview','');
}

function print_tc(id){
    my_win=window.open(''+site_url+'/office/tc_print/'+id+'','id_card_print_preview','');
}

function print_nodue(id){
    my_win=window.open(''+site_url+'/office/no_due_print/'+id+'','no_due_print_preview','');
}


/*** Office head ***/

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
            rowList:[10,20,30,40,50],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"No-Due Requests",
            loadtext:'Loading..'
    });
}

function close_requests(controller,id){
    // Flag is issued
    dataP='id='+id+'&controller='+controller;
    $.ajax({
        url:site_url+'/office/close_requests',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){
            
        },
        success:function(dataR){
            $('#grid_table').trigger('reloadGrid');
            window.location.reload();
        }
    })
}


function send_print_data(option,id){
    // Flag is issued
    dataP='id='+id+'&option='+option;
    $.ajax({
        url:site_url+'/office/send_print_data',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){
            
        },
        success:function(dataR){
            alert('Data Sent');
            $('#grid_table').trigger('reloadGrid');
        }
    })
}


function pay_slip_request_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/office/pay_slip_requests',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Request(s)",
            recordtext: "Viewing {0} - {1} of {2} Request(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Staff Name','Staff Number','Email','From Month','To Month','Year','Salary','Action'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'code',index:'code', width:150},
                    {name:'email',index:'email', width:150},
                    {name:'from_month',index:'from_month', width:150},
                    {name:'to_month',index:'to_month', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'salary',index:'salary', width:150},
                    {name:'approve',index:'approve', width:150, sortable:false,title:false},
            ],
            rowNum:10,
            rowList:[10,20,30,40,50],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"Pay Slip Requests",
            loadtext:'Loading..'
    });
}

function print_payslip(id){
    my_win=window.open(''+site_url+'/office/payslip_print/'+id+'','payslip_print_preview','');
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

function payment_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/office/test_grid',
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
            viewrecords: false,
            sortorder: "desc",
            caption:"User(s)",
            loadtext:'Loading..',
            postData:{
             //   user_type:$('[name=users_type]').val(),
             //   status:$('[name=status]').val(),
             //   college_id:$('[name=college_id]').val(),
             //   course_id:$('[name=course_id]').val(),
             //   branch_id:$('[name=branch_id]').val(),
             //   semister_id:$('[name=semister_id]').val(),
             //   section_id:$('[name=section_id]').val()

            }
    });
}



}

