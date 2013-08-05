$(function(){
    $('.books_dispatched_filter').live('keyup',function(){
        jQuery("#grid_table").setGridParam({
            postData:{
                student_number:$.trim($('#books_dispatched_filter_form [name=student_number]').val()),
                book_number:$.trim($('#books_dispatched_filter_form [name=book_number]').val()),
                staff_number:$.trim($('#books_dispatched_filter_form [name=staff_number]').val())
            }
        }).trigger('reloadGrid');
    });
});

/**************** DOC READY END **********************/

function books_dispatched_grid(student_number,book_number){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/book_keeper/books_dispatched_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Books(s) Dispatched",
            recordtext: "Viewing {0} - {1} of {2} Books(s) Dispatched",
            pgtext : "Page {0} of {1}",
            colNames:['Unique Number','Book name','Author','Version','Year','Branch','Dispatched To','Student/Staff Number','Dispatched On'],
            colModel:[
                    {name:'unique_number',index:'unique_number', width:150},
                    {name:'name',index:'name', width:150},
                    {name:'author',index:'author', width:150},
                    {name:'version',index:'version', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'student_name',index:'student_name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'dispatched_on',index:'dispatched_on', width:150, sortable:false}
            ],
            rowNum:10,
            rowList:[10,20,30,40,50],
            pager: '#grid_pager',
            sortname: 'students_number',
            viewrecords: false,
            sortorder: "desc",
            caption:"Books(s) Dispatched",
            loadtext:'Loading..',
            postData:{
                student_number:student_number,
                book_number:book_number
            }
    });
}



function books_reserved_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/book_keeper/books_reserved',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Books(s) Reserved",
            recordtext: "Viewing {0} - {1} of {2} Books(s) Reserved",
            pgtext : "Page {0} of {1}",
            colNames:['Unique Number','Book name','Author','Version','Year','Branch','Reserved To','Student/Staff Number','Dispatch Book'],
            colModel:[
                    {name:'unique_number',index:'unique_number', width:150},
                    {name:'name',index:'name', width:150},
                    {name:'author',index:'author', width:150},
                    {name:'version',index:'version', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'student_name',index:'student_name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'action',index:'action', width:150,sortable:false}
            ],
            rowNum:10,
            rowList:[10,20,30,40,50],
            pager: '#grid_pager',
            sortname: 'students_number',
            viewrecords: false,
            sortorder: "desc",
            caption:"Books(s) Reserved",
            loadtext:'Loading..'
    });
}

function dispatch_book(id){
    dataP='id='+id
    $.ajax({
        url:site_url+'/book_keeper/dispatch_book',
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



function receive_books_grid(student_number,teacher_number){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/book_keeper/receive_books_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Books(s) Dispatched",
            recordtext: "Viewing {0} - {1} of {2} Books(s) Dispatched",
            pgtext : "Page {0} of {1}",
            colNames:['Unique Number','Book name','Author','Version','Year','Branch','Dispatched To','Student Number','Receive Book'],
            colModel:[
                    {name:'unique_number',index:'unique_number', width:150},
                    {name:'name',index:'name', width:150},
                    {name:'author',index:'author', width:150},
                    {name:'version',index:'version', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'student_name',index:'student_name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'action',index:'action', width:150,sortable:false}
            ],
            rowNum:10,
            rowList:[10,20,30,40,50],
            pager: '#grid_pager',
            sortname: 'students_number',
            viewrecords: false,
            sortorder: "desc",
            caption:"Books(s) Dispatched",
            loadtext:'Loading..',
            postData:{
                student_number:student_number,
                teacher_number:teacher_number
            }
    });
}



function receive_book(id){
    dataP='id='+id
    $.ajax({
        url:site_url+'/book_keeper/receive_book',
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



function ticket_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/book_keeper/ticket_grid',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Books(s)",
            recordtext: "Viewing {0} - {1} of {2} Books(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Unique Number','Book name','Author','Version','Year','Branch','Dispatched To','Student Number','Action'],
            colModel:[
                    {name:'unique_number',index:'unique_number', width:150},
                    {name:'name',index:'name', width:150},
                    {name:'author',index:'author', width:150},
                    {name:'version',index:'version', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'branch_name',index:'branch_name', width:150},
                    {name:'student_name',index:'student_name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'action',index:'action', width:300,sortable:false}
            ],
            rowNum:10,
            rowList:[10,20,30,40,50],
            pager: '#grid_pager',
            sortname: 'students_number',
            viewrecords: false,
            sortorder: "desc",
            caption:"Books(s)",
            loadtext:'Loading..'
    });
}

function ticket_msg(id,option,mobile){
    dataP='id='+id+'&option='+option+'&mobile='+mobile;
    $.ajax({
        url:site_url+'/book_keeper/ticket_msg',
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

