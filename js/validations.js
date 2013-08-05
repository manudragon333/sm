
function validate_form_id_card(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            stu_number:{
                required:true
            },
            date_of_join:{
                required:true
            },
            branch:{
                required: true
            },
            mobile_no:{
                required:true,
                digits:true,
                rangelength: [10, 10]
            },
            address:{
                required:true
            },
            photo:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Please enter Name'
            },
            stu_number:{
                required:'Please enter Student Number'
            },
            date_of_join:{
                required:'Please select year'
            },
            branch:{
                required: 'Please select Branch'
            },
            mobile_no:{
                required:'Please enter mobile number',
                digits:'Please enter only digits',
                rangelength:'Mobile number should be 10 digits'
            },
            photo:{
                required:'Please upload your Photo'
            },
            address:{
                required:'Please enter Address'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_study_certi(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            stu_number:{
                required:true
            },
            course:{
                required: true
            },
            from:{
                required:true
            },
            to:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Please enter Name'
            },
            stu_number:{
                required:'Please enter Student number'
            },
            course:{
                required: 'Please select Course'
            },
            from:{
                required:'Please enter From date'
            },
            to:{
                required:'Please enter To date'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_cond_certi(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            stu_number:{
                required:true
            },
            course:{
                required: true
            },
            from_date:{
                required:true
            },
            to_date:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Please enter Name'
            },
            stu_number:{
                required:'Please enter Student number'
            },
            course:{
                required: 'Please select Course'
            },
            from_date:{
                required:'Please enter From date'
            },
            to_date:{
                required:'Please enter To date'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_tc_certi(){
    $('#appl_form').validate({
        rules:{
            students_number:{
                required:true
            },
            fathers_name:{
                required:true,
                noDigits:true
            },
            class_studying:{
                required: true
            },
            identification_marks:{
                required:true
            },
            qualified_for:{
                required:true
            },
            conduct:{
                required:true
            },
            reason_of_leaving:{
                required:true
            }
        },
        messages:{
            students_number:{
                required:'Enter student number'
            },
            fathers_name:{
                required:'Enter father/guardian name'
            },
            class_studying:{
                required: 'Enter class studying'
            },
            identification_marks:{
                required:'Enter identification marks'
            },
            qualified_for:{
                required:'Enter qualified for'
            },
            conduct:{
                required:'Enter conduct ex: "Satisfactory"'
            },
            reason_of_leaving:{
                required:'Enter reason for leaving'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_buss_pass(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            student_number:{
                required:true
            },
            start_from:{
                required: true
            },
            branch:{
                required:true
            },
            course:{
                required:true
            },
            photo:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Please enter Name'
            },
            student_number:{
                required:'Please enter Student number'
            },
            start_from:{
                required: 'Please enter start point'
            },
            branch:{
                required:'Please select branch'
            },
            course:{
                required:'Please select course'
            },
            photo:{
                required:'Please upload your Photo'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_nodue(){
    $('#appl_form').validate({
        rules:{
            no_due:{
                required:true
            }
        },
        messages:{
            no_due:{
                required:'Please select an option'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        },
        errorPlacement: function(error, element) {
            error.appendTo( $('[name=no_due]:last').parents("li") );
        }
    });
    $('#appl_form').submit();
}
function validate_form_my_rec(){
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
            email:{
                required:true,
                email:true
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
            email:{
                required:'Please enter email',
                email:'Please enter a valid email address'
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
function validate_form_study_abr(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            email:{
                required:true,
                email:true
            },
            country_interested:{
                required:true
            },
            exam:{
                required:true
            },
            mobile:{
                required:true,
                digits:true,
                rangelength: [10, 10]
            }
        },
        messages:{
            name:{
                required:'Enter name'
            },
            email:{
                required:'Enter email address',
                email:'Please enter a valid email address'
            },
            country_interested:{
                required:'Enter country interested in'
            },
            exam:{
                required:'Select an exam'
            },
            mobile:{
                required:'Enter mobile number',
                digits:'Please enter only digits',
                rangelength:'Mobile number should be 10 digits'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_job_alert(){
    $('#appl_form').validate({
        rules:{
            alert_type:{
                required:true
            }
        },
        messages:{
            alert_type:{
                required:'Please Select your Alert Type'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        },
        errorPlacement: function(error, element) {
            error.appendTo( $('[name=alert_type]:last').parents("li") );
        }
    });
    $('#appl_form').submit();
}
function validate_form_placement_resumes(){
    $('#appl_form').validate({
        rules:{
            resume_link:{
                required:true
            }
        },
        messages:{
            resume_link:{
                required:'Please Select your resume'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }/*,
        errorPlacement: function(error, element) {
            error.appendTo( $('[name=alert_type]:last').parents("li") );
        }*/
    });
    $('#appl_form').submit();
}

function getFromVal(){ return $('#to_month').val(); alert(1) }
function validate_form_payslip(){
    //   return true;
    $('#appl_form').validate({
        rules:{
            from_month:{
                required:true               
            },
            to_month:{
                required:true,
                moreThan:'#from_month'
            },
            year:{
                required:true
            }
        },
        messages:{
            from_month:{
                required:'From Month is required'
            },
            to_month:{
                required:'To Month is required',
                moreThan:'To Month should be more than from month'
            },
            year:{
                required:'Please Select year'
            }           
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_staff_profile(){
    //  return true;
    $('#appl_form').validate({
        rules:{
            name1:{
                required:true,
                noDigits:true
            },
            code1:{
                required:true,
                email:true
            },
            dob1:{
                required:true
            },
            sex1:{
                required:true
            },
            email1:{
                required:true,
                email:true
            },
            mobile:{
                required:true,
                digits:true,
                rangelength: [10, 10]
            }
        },
        messages:{
            name1:{
                required:'Enter Name'
            },
            code1:{
                required:'Enter code'                
            },
            dob1:{
                required:'Enter Date of Birth'
            },
            sex1:{
                required:'Select Sex'
            },
            email1:{
                required:'Enter email address',
                email:'Please enter a valid email address'
            },
            mobile:{
                required:'Enter mobile number',
                digits:'Please enter only digits',
                rangelength:'Mobile number should be 10 digits'
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
function validate_form_send_msg(){
    //   return true;
    $('#appl_form').validate({
        rules:{
            choice3x:{
                required:true                
            },
            student_numberx:{
                required:true                
            },
            message:{
                required:true
            }
        },
        messages:{
            choice3:{
                required:'Select an option'
            },
            student_number:{
                required:'Enter Student Number'                
            },
            message:{
                required:'Enter Your Message'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_check_stu_prof(){
    //  return true;
    $('#appl_form').validate({
        rules:{
            number:{
                eitherRequired:'#name'
            }
        },
        messages:{
            number:{
                eitherRequired:'Enter Student Number or Name'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_upload_q_paper(){
    //  return true;
    $('#appl_form').validate({
        rules:{
            students_count:{
                digits:true
            },
            branch:{
                required:true                
            },
            year:{
                required:true               
            },
            subject:{
                required:true
            },
            doc_link:{
                required:true
            }
        },
        messages:{
            branch:{
                required:'Select Branch'
            },
            year:{
                required:'Select Year'                
            },
            subject:{
                required:'Enter Subject'
            },
            doc_link:{
                required:'Please Upload Question Paper'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_busspass(){
    // return true;
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            num:{
                required:true
            },
            branch:{
                required:true                
            },
            ppoint:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Enter name'
            },
            num:{
                required:'Enter Student Number'
            },
            branch:{
                required:'Enter Branch'               
            },
            ppoint:{
                required:'Enter Pick up Point'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_fee_details(){
    //  return true;
    $('#appl_form').validate({
        rules:{
            student_number:{
                required:true                
            }
        },
        messages:{
            student_number:{
                required:'Enter Student Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_office_id_card(){
    //  return true;
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            stu_num:{
                required:true
            },
            course:{
                required:true
            },
            branch:{
                required:true                
            },
            from:{
                required:true
            },
            to:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Enter name'
            },
            stu_num:{
                required:'Enter Student Number'
            },
            course:{
                required:'Enter Course'
            },
            branch:{
                required:'Enter Branch'               
            },
            from:{
                required:'Select From Date'
            },
            to:{
                required:'Select To Date'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_proc_id_certi(){
    //   return true;
    $('#appl_form').validate({
        rules:{
            student_number:{
                required:true                
            }
        },
        messages:{
            student_number:{
                required:'Enter Student Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_proc_icard(){
    //   return true;
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            stu_num:{
                required:true
            },
            course:{
                required:true
            },
            branch:{
                required:true                
            },
            Picture:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Enter name'
            },
            stu_num:{
                required:'Enter Student Number'
            },
            course:{
                required:'Enter Course'
            },
            branch:{
                required:'Enter Branch'               
            },
            Picture:{
                required:'Upload Photo'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_proc_study(){
    //   return true;
    $('#appl_form').validate({
        rules:{
            name:{
                required:true                
            },
            stu_num:{
                required:true
            },
            course:{
                required:true
            },
            branch:{
                required:true                
            },
            from:{
                required:true
            },
            to:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Enter Student Number'
            },
            stu_num:{
                required:'Enter Student Number'
            },
            course:{
                required:'Enter Course'
            },
            branch:{
                required:'Enter Branch'               
            },
            from:{
                required:'Select From Date'
            },
            to:{
                required:'Select To Date'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_student_data(){
    //   return true;
    $('#appl_form').validate({
        rules:{
            name:{
                required:true                
            }
        },
        messages:{
            name:{
                required:'Enter Student Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_add_book(){
    //  return true;
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            author:{
                required:true
            },
            version:{
                required:true                
            },
            branch_id:{
                required:true                
            },
            year:{
                required:true,
                digits:true
            },
            unique_number:{
                required:true,
                digits:true
            }
        },
        messages:{
            name:{
                required:'Enter Name'
            },
            author:{
                required:'Enter Author Name'
            },
            version:{
                required:'Enter Version'
            },
            branch_id:{
                required:'Enter Category'               
            },
            year:{
                required:'Enter Year'
            },
            unique_number:{
                required:'Enter Book Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_delete_book(){
    //  return true;
    $('#appl_form').validate({
        rules:{
            unique_number:{
                required:true,
                digits:true
            }
        },
        messages:{
            unique_number:{
                required:'Enter Book Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_check_Data(){
    //  return true;
    $('#appl_form').validate({
        rules:{
            student_number:{
                required:function(element) {
                   return $.trim($("[name=teacher_number]").val())=='' || $.trim($("[name=teacher_number]").val())=='';
                }               
            }
        },
        messages:{
            student_number:{
                required:'Enter either Student or Teacher Number'
            },
            teacher_number:{
                required:'Enter Teacher Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_booksdispatch(){
    // return true;
    $('#appl_form').validate({
        rules:{
            student_numberxxx:{
                required:function(element) {
                   return $.trim($("[name=teacher_number]").val())=='' || $.trim($("[name=teacher_number]").val())=='';
                }               
            },
            student_number:{
                eitherRequired:'[name=book_number]'
            }
        },
        messages:{
            student_number:{
                required:'Enter either Student or Teacher Number',
                eitherRequired:'Enter either Student or Unique Number'
            },
            unique_number:{
                required:'Enter Book Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_receive_book(){
    // return true;
    $('#appl_form').validate({
        rules:{
            student_number:{
                eitherRequired:'[name=teacher_number]'
            }
        },
        messages:{
            student_number:{
                required:'Enter either Student or Teacher Number',
                eitherRequired:'Enter either Student or Teacher Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_pass_on_book(){
    // return true;
    $('#appl_form').validate({
        rules:{
            student_number:{
                required:true
            },
            book_number:{
                required:true
            }
        },
        messages:{
            student_number:{
                required:'Enter enter Student Number'
            },
            book_number:{
                required:'Enter enter Unique Book Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_account(){
   // return true;
   $('#appl_form').validate({
        rules:{
            name:{
                required:true               
            }
        },
        messages:{
            name:{
                required:'Enter Student Name'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_account1(){
 //   return true;
 $('#appl_form').validate({
        rules:{
            sname:{
                required:true               
            },
            snum:{
                required:true
            },
            branch:{
                required:true
            }
        },
        messages:{
            sname:{
                required:'Enter Student Name'
            },
            snum:{
                required:'Enter Student Number'
            },
            branch:{
                required:'Enter Branch'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_edit_student(){
   // return true;
   $('#appl_form').validate({
        rules:{
            name:{
                required:true               
            },
            sname:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Enter Student Name'
            },
            sname:{
                required:'Enter Student Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_delete_student(){
   // return true;
   $('#appl_form').validate({
        rules:{
            name:{
                required:true               
            },
            sname:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Enter Student Name'
            },
            sname:{
                required:'Enter Student Number'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_add_stu_details(){
  //  return true;
  $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            student_number:{
                required:true,
                digits:true
            },
            uname:{
                required:true
            },
            pwd:{
                required:true
            },
            branch:{
                required:true                
            },
            course:{
                required:true                
            },
            dob:{
                required:true                
            },
            email:{
                required:true,
                email:true
            },
            mobile:{
                required:true,
                digits:true,
                rangelength: [10, 10]
            }
        },
        messages:{
            name:{
                required:'Enter Student Name'
            },
            student_number:{
                required:'Enter Student Number'                
            },
            uname:{
                required:'Enter User Name'
            },
            pwd:{
                required:'Enter Password'
            },
            branch:{
                required:'Select Branch'                
            },
            course:{
                required:'Select Course'                
            },
            dob:{
                required:'Select Date of Birth'                
            },
            email:{
                required:'Enter email address',
                email:'Please enter a valid email address'
            },
            mobile:{
                required:'Please enter mobile number',
                digits:'Please enter only digits',
                rangelength:'Mobile number should be 10 digits'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_compose_email(){
    $('#appl_form').validate({
        rules:{
            to:{
                required:true,
                email:true
            },
            from:{
                required:true,
                email:true
            },
            subject:{
                required:true
            },
            message:{
                required:true
            }
        },
        messages:{
            to:{
                required:'Enter Email ID'
            },
            from:{
                required:'Enter your Email ID'
            },
            subject:{
                required:'Enter Subject'
            },
            message:{
                required:'Enter Message'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_notice_form(){
   // return true;
   $('#appl_form').validate({
        rules:{
            message:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Enter Mesage'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_sbject_grid_form(){
    $('#appl_form').validate({
        rules:{
            branch_id:{
                required:true
            },
            semister_id:{
                required:true
            },
            subject_id:{
                required:true
            }
        },
        messages:{
            branch_id:{
                required:'Select Branch'
            },
            semister_id:{
                required:'Select Semester'
            },
            subject_id:{
                required:'Select Subject'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_upload_assignments(){
    $('#appl_form').validate({
        rules:{
            branch_id:{
                required:true
            },
            sem_id:{
                required:true
            },
            max_marks:{
                required:true
            },
            subject:{
                required:true
            },
            instructions:{
                required:true
            },
            doc_link:{
                required:true
            },
            last_date:{
                required:true
            }
        },
        messages:{
            branch_id:{
                required:'Select Branch'
            },
            sem_id:{
                required:'Select Semester'
            },
            max_marks:{
                required:'Enter Max Marks'
            },
            subject:{
                required:'Select Subject'
            },
            instructions:{
                required:'Please enter Instructions'
            },
            doc_link:{
                required:'Please Upload Assignment'
            },
            last_date:{
                required:'Enter Last date of submission'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_submit_assignments(){
    $('#appl_form').validate({
        rules:{
            doc_link:{
                required:true
            }
        },
        messages:{
            doc_link:{
                required:'Please Upload Assignment'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_polls_form(){
    $('#appl_form').validate({
        rules:{
            question:{
                required:true
            },
            start_date:{
                required:true
            },
            end_date:{
                required:true
            },
            access:{
                required:true
            },
            'option[]':{
                required:true
            }
        },
        messages:{
            question:{
                required:'Please Enter Question'
            },
            start_date:{
                required:'Please Enter Start date'
            },
            end_date:{
                required:'Please Enter End date'
            },
            access:{
                required:'Please Enter Access'
            },
            'option[]':{
                required:'Please Select Options'
            }
        }
//        ,
//        submitHandler:function(form){
//           // $(form).submit();
//           // ajax_gen_form(form);
//        }
    });
    // $('#appl_form').submit();
}

function validate_form_edit_polls_form(){
    $('#appl_form').validate({
        rules:{
            question:{
                required:true
            },
            start_date:{
                required:true
            },
            end_date:{
                required:true
            },
            access:{
                required:true
            },
            'option[]':{
                required:true
            }
        },
        messages:{
            question:{
                required:'Please Enter Question'
            },
            start_date:{
                required:'Please Enter Start date'
            },
            end_date:{
                required:'Please Enter End date'
            },
            access:{
                required:'Please Enter Access'
            },
            'option[]':{
                required:'Please Select Options'
            }
        },
        submitHandler:function(form){
           // $(form).submit();
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_upload_videos(){
    $('#appl_form').validate({
        rules:{
            branch_id:{
                required:true
            },
            sem_id:{
                required:true
            },
            max_marks:{
                required:true
            },
            subject:{
                required:true
            },
            embed_code:{
                required:true
            },
            doc_link:{
                required:true
            },
            last_date:{
                required:true
            }
        },
        messages:{
            branch_id:{
                required:'Select Branch'
            },
            sem_id:{
                required:'Select Semester'
            },
            max_marks:{
                required:'Enter Max Marks'
            },
            subject:{
                required:'Select Subject'
            },
            embed_code:{
                required:'Please enter Video Code'
            },
            doc_link:{
                required:'Please Upload Assignment'
            },
            last_date:{
                required:'Enter Last date of submission'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_college_management(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true
            },
            status:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Please enter College Name'
            },
            status:{
                required:'Please select a status'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}
function validate_form_course_management(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true
            },
            status:{
                required:true
            },
            college_id:{
                required:true
            }
        },
        messages:{
            name:{
                required:'Please enter Course Name'
            },
            status:{
                required:'Please select a status'
            },
            college_id:{
                required:'Please select a College'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_branch_management(){
    $('#appl_form').validate({
        rules:{
            'branch_names[]':{
                required:true
            },
			subject1:{
                required:true
            },
			subject2:{
                required:true
            },
			subject3:{
                required:true
            },
			subject4:{
                required:true
            },
			subject5:{
                required:true
            },
			subject6:{
                required:true
            },
			subject7:{
                required:true
            },
			subject8:{
                required:true
            },
			subject9:{
                required:true
            },
			subject10:{
                required:true
            },
            status:{
                required:true
            },
            college_id:{
                required:true
            },
            course_id:{
                required:true
            }
        },
        messages:{
            'branch_names[]':{
                required:'Please enter Branch Name'
            },
            'semester_names[]':{
                required:'Please enter Semester Name'
            },
			subject1:{
                required:''
            },
			subject2:{
                required:''
            },
			subject3:{
                required:''
            },
			subject4:{
                required:''
            },
			subject5:{
                required:''
            },
			subject6:{
                required:''
            },
			subject7:{
                required:''
            },
			subject8:{
                required:''
            },
			subject9:{
                required:''
            },
			subject10:{
                required:''
            },
            status:{
                required:'Please select a status'
            },
            college_id:{
                required:'Please select a College'
            },
            course_id:{
                required:'Please select a Course'
            },
            branch_id:{
                required:'Please select a Branch'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}


function validate_form_add_subject(){
    $('#appl_form').validate({
        rules:{
            'branch_names[]':{
                required:true
            },
			subject_type_id:{
			required:true
			},
			credits1:{
                required:true
            },
			credits2:{
                required:true
            },
			credits3:{
                required:true
            },
			credits4:{
                required:true
            },
			credits5:{
                required:true
            },
			credits6:{
                required:true
            },
			credits7:{
                required:true
            },
			credits8:{
                required:true
            },
			credits9:{
                required:true
            },
			credits10:{
                required:true
            },
			subject1:{
                required:true
            },
			subject2:{
                required:true
            },
			subject3:{
                required:true
            },
			subject4:{
                required:true
            },
			subject5:{
                required:true
            },
			subject6:{
                required:true
            },subject7:{
                required:true
            },subject8:{
                required:true
            },subject9:{
                required:true
            },subject10:{
                required:true
            },
            college_id:{
                required:true
            },
            course_id:{
                required:true
            }
        },
        messages:{
            'branch_names[]':{
                required:'Please enter Branch Name'
            },
            'semester_names[]':{
                required:'Please enter Semester Name'
            },
			subject_type_id:{
			  required:''
			},
			credits1:{
                required:''
            },
			credits2:{
                required:''
            },
			credits3:{
                required:''
            },
			credits4:{
                required:''
            },
			credits5:{
                required:''
            },
			credits6:{
                required:''
            },
			credits7:{
                required:''
            },
			credits8:{
                required:''
            },
			credits9:{
                required:''
            },
			credits10:{
                required:''
            },
			subject1:{
                required:''
            },
			subject2:{
                required:''
            },
			subject3:{
                required:''
            },
			subject4:{
                required:''
            },
			subject5:{
                required:''
            },
			subject6:{
                required:''
            },subject7:{
                required:''
            },subject8:{
                required:''
            },subject9:{
                required:''
            },subject10:{
                required:''
            },
            college_id:{
                required:'Please select a College'
            },
            course_id:{
                required:'Please select a Course'
            },
            branch_id:{
                required:'Please select a Branch'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}


function validate_form_general(){
    $('#appl_form').validate({
        submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#appl_form').submit();
}

function validate_form_submit(){
    $('#appl_form').validate({
        submitHandler:function(form){
            $(form).submit();
        }
    });
}function validate_form_cash_book()
{
    $('#cash_book').validate({
       rules:{
           dfrom:{
           required:true
           },
           dto:{
               required:true
           }
       },
       messages:{
           dfrom:{
               required:'Please enter from date'
           },
           dto:{
               required:'Please enter to date'
           }
       },
       submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#cash_book').submit();
}

function validate_form_addbalance_form()
{
    $('#add_balance').validate({
        rules:{
            balance:{
                required:true,
                digits:true
            },
            details:
            {
                required:true
                
            }
            
        },
        messages:{
           details:{
                required:'Please enter payment Details'
            },
            balance:
            {
                required:'Please enter balance',
                digits:'Please enter digits only'
            }
        },
         submitHandler:function(form){
            ajax_gen_form(form);
        }
        
    });
    
     $('#add_balance').submit();
}
function validate_form_cash_book()
{
    $('#cash_book').validate({
       rules:{
           dfrom:{
           required:true
           },
           dto:{
               required:true
           }
       },
       messages:{
           dfrom:{
               required:'Please enter from date'
           },
           dto:{
               required:'Please enter to date'
           }
       },
       submitHandler:function(form){
            ajax_gen_form(form);
        }
    });
    $('#cash_book').submit();
}

function validate_form_addbalance_form()
{
    $('#add_balance').validate({
        rules:{
            balance:{
                required:true,
                digits:true
            },
            details:
            {
                required:true
                
            }
            
        },
        messages:{
           details:{
                required:'Please enter payment Details'
            },
            balance:
            {
                required:'Please enter balance',
                digits:'Please enter digits only'
            }
        },
         submitHandler:function(form){
            ajax_gen_form(form);
        }
        
    });
    
     $('#add_balance').submit();
}

function validate_form_(){
    return true;
}
function validate_form_(){
    return true;
}
function validate_form_(){
    return true;
}
function validate_form_(){
    return true;
}
