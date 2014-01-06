$(function(){
        $('#stu_number,#student_number').live('keyup',function(){
            fill_student_data($(this).val());
        });
        checkReturns();

        $('#semisters').live('change',function(){
            loadSemisterNextView($(this).val());
        })

        $('#semisters_attendance').live('change',function(){
            loadSemisterAttendance($(this).val());
        })
});

/******************************** DOCUMENT READY END ************************************/


function library_books_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'library/library_books',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Books(s)",
            recordtext: "Viewing {0} - {1} of {2} Books(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Unique Number','Book name','Author','Title of Book','Edition/Year','Branch','Reserve Book'],
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
            url:site_url+'library/reserved_library_books',
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
    if(!confirm('Are you sure you want to reserve this book.?')){ return false; }
    dataP='id='+id;
    $.ajax({
        url:site_url+'library/reserve_book',
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

function fill_student_data(student_number){
    dataP='student_number='+student_number;
    $.ajax({
        url:site_url+'students/fill_student_data',
        data:dataP,
        type:'POST',
        dataType:'json',
        beforeSend:function(){

        },
        success:function(dataR){
            // if(dataR[0] && dataR[0].length)
            $.each(dataR[0],function(k,v){
                // console.info($('#appl_form [name='+k+']'))
                conversions=new Array(); conversions['fathers_name']='son_of';conversions['course_id']='course'; conversions['branch_id']='branch';
                if(typeof conversions[k]!='undefined'){k2=conversions[k]}else{k2=k}
                if($('#appl_form [name='+k2+']').length>0){
                    $('#appl_form [name='+k2+']').val(v);
                }
                if(k=='fathers_name' && $('#appl_form [name=co]').length>0){ $('#appl_form [name=co]').val(v) }// EXCEPTION
            });
        }
    })
}

function checkReturns(){

    $.ajax({
        url:site_url+'students/check_library_returns',
        data:'',
        type:'POST',
        dataType:'',
        beforeSend:function(){
            
        },
        success:function(dataR){
            if(dataR!='0'){
                $('#system_notification').html('<div class="error"> You have following library book(s) to return.</div>'+dataR);
            }
        }
    })
}


function loadSemisterNextView(id){
    dataP='semester_id='+id;
    $.ajax({
        url:site_url+'students/marks_view',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#semister_next_view').html(dataR);
        }
    })
}


function loadSemisterAttendance(id){
    dataP='semester_id='+id;
    $.ajax({
        url:site_url+'students/get_attendance',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){
            
        },
        success:function(dataR){
            $('#semister_next_view').html(dataR);
        }
    })
}

function view_assignments(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'students/view_assignments',
            datatype: "json",
            height:'auto',
            autowidth: true,
            mtype: 'POST',
            recordtext: "Assignment(s)",
            recordtext: "Viewing {0} - {1} of {2} Assignment(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Date Added','Branch','Semister', 'Subject','Instructions','File Link','Max Marks','Last Date','Submit Assignments'],
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


function view_library_pdfs(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'students/view_library_pdfs',
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


