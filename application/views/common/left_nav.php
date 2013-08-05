
<?php
    $url_1 = $this->uri->segment(1);
    $url_2 = $this->uri->segment(2);
    $url_3 = $this->uri->segment(3);
    $url_4 = $this->uri->segment(4);
?>
<script type="text/javascript">
    var postGradIDs=[7,8];
    var graduation_data=<?php echo get_graduation_json('7,8'); ?>;
    var post_graduation_data=<?php echo get_post_graduation_json('7,8'); ?>;
</script>
<?php $userData = $this->session->userdata('user_details'); // echo '<pre>'; print_r($userData); echo '</pre>';  ?>


<ul class="nav_emt">

    <?php if ($userData->users_type_id == 1) { if($student_data=$this->session->userdata('student_data')){ $doj=$student_data[0]->doj; }?>
        <!-- STUDENTS LINKS SET -->
        <li><a class="<?php if ($url_2 == '') echo 'active'; ?>" href="<?php echo site_url('students'); ?>">Home</a></li>
        <li >
            <a class="collapse j_submenu_toggle" href="javascript:void(0);<?php //echo site_url('students/my_office');  ?>">My Office</a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'view_assignments') echo 'active'; ?>" href="<?php echo site_url('students/view_assignments'); ?>">View Assignments</a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'view_library_pdfs') echo 'active'; ?>" href="<?php echo site_url('students/view_library_pdfs'); ?>">View PDF's</a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'my_record') echo 'active'; ?>" href="<?php echo site_url('students/my_record'); ?>">My Record</a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'apply_idcard') echo 'active'; ?>" href="<?php echo site_url('students/apply_idcard'); ?>"> Apply for the ID Card  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'study_certificate') echo 'active'; ?>" href="<?php echo site_url('students/study_certificate'); ?>"> Apply for the Study Certificate  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'conduct_certificate') echo 'active'; ?>" href="<?php echo site_url('students/conduct_certificate'); ?>"> Apply for Conduct Certificate </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'transfer_certificate') echo 'active'; ?>" href="<?php echo site_url('students/transfer_certificate'); ?>"> Apply for the Transfer Certificate  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'bus_pass') echo 'active'; ?>" href="<?php echo site_url('students/bus_pass'); ?>"> Apply for the Bus Pass </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'no_due') echo 'active'; ?>" href="<?php echo site_url('students/no_due'); ?>"> Apply for No Due certificate Submit </a></label>
                </li>
            </ul>
        </li>
        
<!--                    <li><a href="<?php echo site_url('students/my_record'); ?>">My Record</a></li>-->
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">My library </a>
            <ul class="lft_sub_menu">
                <li>
                    <a class="<?php if ($url_2 == 'library') echo 'active'; ?>" href="<?php echo site_url('students/library'); ?>">My library </a>
                </li>
                <li>
                    <a class="<?php if ($url_2 == 'reserved_books') echo 'active'; ?>" href="<?php echo site_url('students/reserved_books'); ?>">Reserved Books </a>
                </li>
            </ul>
        </li>
        <li><a class="<?php if ($url_2 == 'student_attendance') echo 'active'; ?>" href="<?php echo site_url('students/student_attendance'); ?>">Time table </a></li>
        <li><a class="<?php if ($url_2 == 'study_abroad') echo 'active'; ?>" href="<?php echo site_url('students/study_abroad'); ?>">Study Abroad </a></li>
        <li>
            <a href="javascript:void(0);<?php //echo site_url('students/placement');  ?>" class="collapse j_submenu_toggle">Placement Cell </a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'job_alerts') echo 'active'; ?>" href="<?php echo site_url('students/job_alerts'); ?>"> Register for Job Alerts.  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'upload_resume') echo 'active'; ?>" href="<?php echo site_url('students/upload_resume'); ?>"> Upload your Resume.  </a></label>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">Exam Cell</a>
            <ul class="lft_sub_menu">
<!--                            <li>
                    <label for="website"><a href="<?php echo site_url('students/exam_marks'); ?>"> Exam Marks </a></label>
                </li>-->
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'attendance') echo 'active'; ?>" href="<?php echo site_url('students/attendance'); ?>"> Attendance </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'view_results') echo 'active'; ?>" href="<?php echo site_url('students/view_results'); ?>"> View Results </a></label>
                </li>
            </ul>
        </li>
        <li><a class="<?php if ($url_2 == 'videos') echo 'active'; ?>" href="<?php echo site_url('students/videos'); ?>">Videos</a></li>
        <li><a class="<?php if ($url_1 == 'poll') echo 'active'; ?>" href="<?php echo site_url('poll'); ?>">Polls</a></li>
        <li><a class="<?php if ($url_2 == 'compose') echo 'active'; ?>" href="<?php echo site_url('email/compose'); ?>">Email</a></li>
        <!-- STUDENTS LINKS SET -->
        <?php
    }
    if ($userData->users_type_id == 2 || $userData->users_type_id == 3) {
        ?>
        <!-- STAFF/HOD LINKS SET -->
        <li><a class="<?php if ($url_2 == '') echo 'active'; ?>" href="<?php echo site_url('staff'); ?>">Home</a></li>
        <li><a class="<?php if ($url_2 == 'profile') echo 'active'; ?>" href="<?php echo site_url('staff/profile'); ?>">My Profile</a></li>
        <?php
        if ($userData->users_type_id == 2) {
            ?>
        <li><a class="<?php if ($url_2 == 'attendance') echo 'active'; ?>" href="<?php echo site_url('staff/attendance'); ?>">My Time Table</a></li>
        <?php }else if($userData->users_type_id == 3){ ?>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">Time Table </a>
            <ul class="lft_sub_menu">
                <li>
                    <a class="<?php if ($url_2 == 'attendance') echo 'active'; ?>" href="<?php echo site_url('staff/attendance'); ?>">My Time Table</a>
                </li>
                <li>
                    <a class="<?php if ($url_2 == 'update_time_table') echo 'active'; ?>" href="<?php echo site_url('staff/update_time_table'); ?>">Update Staff Time Table </a>
                </li>
                <li>
                    <a class="<?php if ($url_2 == 'update_student_time_table') echo 'active'; ?>" href="<?php echo site_url('staff/update_student_time_table'); ?>">Update Student Time Table </a>
                </li>
            </ul>
        </li>
        <?php } ?>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">My library </a>
            <ul class="lft_sub_menu">
                <li>
                    <a class="<?php if ($url_2 == 'library') echo 'active'; ?>" href="<?php echo site_url('staff/library'); ?>">My Library</a>
                </li>
                <li>
                    <a class="<?php if ($url_2 == 'reserved_books') echo 'active'; ?>" href="<?php echo site_url('staff/reserved_books'); ?>">Reserved Books </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);<?php //echo site_url('staff/office');  ?>" class="collapse j_submenu_toggle">My Office</a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'upload_pdfs') echo 'active'; ?>" href="<?php echo site_url('staff/upload_pdfs'); ?>"> Upload PDF's  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'view_library_pdfs') echo 'active'; ?>" href="<?php echo site_url('staff/view_library_pdfs'); ?>">View PDF's</a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'upload_assigments') echo 'active'; ?>" href="<?php echo site_url('staff/upload_assigments'); ?>"> Upload Assignments  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'view_assignments') echo 'active'; ?>" href="<?php echo site_url('staff/view_assignments'); ?>"> View Assignments  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'upload_q_papers') echo 'active'; ?>" href="<?php echo site_url('staff/upload_q_papers'); ?>"> Upload Question papers  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'browse_q_papers') echo 'active'; ?>" href="<?php echo site_url('staff/browse_q_papers'); ?>"> Browse the Question papers  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'pay_slip') echo 'active'; ?>" href="<?php echo site_url('staff/pay_slip'); ?>"> Pay slip Request  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'send_msg') echo 'active'; ?>" href="<?php echo site_url('staff/send_msg'); ?>"> Send a Message  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'apply_id_card') echo 'active'; ?>" href="<?php echo site_url('staff/apply_id_card'); ?>"> Apply ID Card  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'attendance') echo 'active'; ?>" href="<?php echo site_url('staff/attendance'); ?>"> Attendance  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'leave_letter') echo 'active'; ?>" href="<?php echo site_url('staff/leave_letter'); ?>"> Leaves  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'leave_adjust_requests') echo 'active'; ?>" href="<?php echo site_url('staff/leave_adjust_requests'); ?>"> Leave Adjustment Requests  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'check_leave_count') echo 'active'; ?>" href="<?php echo site_url('staff/check_leave_count'); ?>"> Leave Count Status  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'post_exam_results') echo 'active'; ?>" href="<?php echo site_url('staff/post_exam_results'); ?>"> Post Exam Results </a></label>
                </li>
                <?php if ($userData->users_type_id == 3) {  ?>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'leave_requests') echo 'active'; ?>" href="<?php echo site_url('staff/leave_requests'); ?>"> Leave Letter Requests  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'attendance_breach') echo 'active'; ?>" href="<?php echo site_url('staff/attendance_breach'); ?>"> Attendance Breach </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'send_student_marks') echo 'active'; ?>" href="<?php echo site_url('staff/send_student_marks'); ?>"> Send Student Marks </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'progress_card') echo 'active'; ?>" href="<?php echo site_url('staff/progress_card'); ?>"> Progress Card </a></label>
                </li>

                <?php }  ?>
            </ul>
        </li>
        <li><a class="<?php if ($url_2 == 'student_profile') echo 'active'; ?>" href="<?php echo site_url('staff/student_profile'); ?>">Student Profile</a></li>
        <?php
        if ($userData->users_type_id == 3) {
            ?>
            <li>
                <a href="javascript:void(0);<?php //echo site_url('staff/approvals');  ?>" class="collapse j_submenu_toggle">Approvals 
                    <?php if($this->session->userdata('approval_count')){ ?>
                    <span class="count_notify"><?php echo $this->session->userdata('approval_count'); ?></span>
                    <?php } ?>
                </a>
                <ul class="lft_sub_menu">
                    <li>
                        <label for="website"><a class="<?php if ($url_2 == 'no_due_requests') echo 'active'; ?>" href="<?php echo site_url('staff/no_due_requests'); ?>"> No Due Request  </a></label>
                    </li>
                    <li>
                        <label for="website"><a class="<?php if ($url_2 == 'approve_q_papers') echo 'active'; ?>" href="<?php echo site_url('staff/approve_q_papers'); ?>"> Approve Question papers  </a></label>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <li><a class="<?php if ($url_2 == 'upload_videos') echo 'active'; ?>" href="<?php echo site_url('staff/upload_videos'); ?>">Videos</a></li>
        <li><a class="<?php if ($url_1 == 'poll') echo 'active'; ?>" href="<?php echo site_url('poll'); ?>">Polls</a></li>
        <li><a class="<?php if ($url_2 == 'compose') echo 'active'; ?>" href="<?php echo site_url('email/compose'); ?>">Email</a></li>
        <!-- STAFF LINKS SET -->
    <?php } ?>



    <?php
    if ($userData->users_type_id == 4) {
        $request_counts=$this->session->userdata('request_counts');
        ?>
        <!-- Employee/ Library SET -->
        <li><a class="<?php if ($url_2 == '') echo 'active'; ?>" href="<?php echo site_url('library'); ?>">Home</a></li>
        <li>
            <a href="javascript:void(0);<?php //echo site_url('library/book_details');  ?>" class="collapse j_submenu_toggle">Book Details</a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'add_book') echo 'active'; ?>" href="<?php echo site_url('library/add_book'); ?>"> Add Book Details  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'delete_book') echo 'active'; ?>" href="<?php echo site_url('library/delete_book'); ?>"> Delete Book Details  </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'update_book') echo 'active'; ?>" href="<?php echo site_url('library/update_book'); ?>"> Update Book Details  </a></label>
                </li>
            </ul>
        </li>
        <li><a class="<?php if ($url_2 == 'check_data') echo 'active'; ?>" href="<?php echo site_url('library/check_data'); ?>">Check the Data</a></li>
        <li><a class="<?php if ($url_2 == 'books_dispatched') echo 'active'; ?>" href="<?php echo site_url('library/books_dispatched'); ?>">Books Dispatched</a></li>
        <li><a class="<?php if ($url_2 == 'no_due') echo 'active'; ?>" href="<?php echo site_url('library/no_due'); ?>">No Due request <?php if(isset($request_counts['no_due']) && !empty($request_counts['no_due'])){ ?><span class="count_notify"><?php  echo $request_counts['no_due']; ?></span><?php } ?></a></li>
        <li><a class="<?php if ($url_2 == 'compose') echo 'active'; ?>" href="<?php echo site_url('email/compose'); ?>">Email</a></li>

        <!-- Employee/ Library SET -->
    <?php } ?>


    <?php
    if ($userData->users_type_id == 5) {
        $request_counts=$this->session->userdata('request_counts');
        ?>
        <!-- Employee/ Book Keeper SET -->
        <li><a class="<?php if ($url_2 == '') echo 'active'; ?>" href="<?php echo site_url('book_keeper'); ?>">Home</a></li>
        <li><a class="<?php if ($url_2 == 'books_dispatched') echo 'active'; ?>" href="<?php echo site_url('book_keeper/books_dispatched'); ?>">Books Dispatched</a></li>
        <li><a class="<?php if ($url_2 == 'receive_books') echo 'active'; ?>" href="<?php echo site_url('book_keeper/receive_books'); ?>">Receive Books </a></li>
        <li><a class="<?php if ($url_2 == 'pass_on_books') echo 'active'; ?>" href="<?php echo site_url('book_keeper/pass_on_books'); ?>">Pass on Books</a></li>
        <li><a class="<?php if ($url_2 == 'books_reserved') echo 'active'; ?>" href="<?php echo site_url('book_keeper/books_reserved'); ?>">Books Reserved <?php if(isset($request_counts['books_reserved']) && !empty($request_counts['books_reserved'])){ ?><span class="count_notify"><?php  echo $request_counts['books_reserved']; ?></span><?php } ?></a></li>
        <li><a class="<?php if ($url_2 == 'ticket') echo 'active'; ?>" href="<?php echo site_url('book_keeper/ticket'); ?>">Ticket <?php if(isset($request_counts['ticket']) && !empty($request_counts['ticket'])){ ?><span class="count_notify"><?php  echo $request_counts['ticket']; ?></span><?php } ?></a></li>
        <!-- Employee/ Book Keeper SET -->
    <?php } ?>


    <?php
    if ($userData->users_type_id == 6) {
        $request_counts=$this->session->userdata('request_counts');
        ?>
        <!-- Employee/ Office SET -->
        <li><a class="<?php if ($url_2 == '') echo 'active'; ?>" href="<?php echo site_url('office'); ?>">Home</a></li>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">ID Card <?php if(isset($request_counts['id_card']) && !empty($request_counts['id_card'])){ ?><span class="count_notify"><?php echo $request_counts['id_card']; ?></span><?php } ?></a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'id_card_requests') echo 'active'; ?>" href="<?php echo site_url('office/id_card_requests'); ?>"> Id Card Request <?php if(isset($request_counts['id_card'])) echo '('.$request_counts['id_card'].')'; ?> </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'processed_id_cards') echo 'active'; ?>" href="<?php echo site_url('office/processed_id_cards'); ?>"> Processed Id Cards  </a></label>
                </li>
            </ul>
        </li>
        <li><a class="<?php if ($url_2 == 'bus_pass') echo 'active'; ?>" href="<?php echo site_url('office/bus_pass'); ?>">Bus Pass <?php if(isset($request_counts['buss_pass']) && !empty($request_counts['buss_pass'])){ ?><span class="count_notify"><?php echo $request_counts['buss_pass'] ; ?></span><?php } ?></a></li>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">Study Certificate <?php if(isset($request_counts['study_certi']) && !empty($request_counts['study_certi'])) { ?><span class="count_notify"><?php echo $request_counts['study_certi']; ?></span><?php } ?></a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'study_certi_requests') echo 'active'; ?>" href="<?php echo site_url('office/study_certi_requests'); ?>"> Study Certificate Request <?php if(isset($request_counts['study_certi'])) echo '('.$request_counts['study_certi'].')'; ?> </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'processed_study_certis') echo 'active'; ?>" href="<?php echo site_url('office/processed_study_certis'); ?>"> Processed Request  </a></label>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">Conduct Certificate <?php if(isset($request_counts['conduct_certi']) && !empty($request_counts['conduct_certi'])){ ?><span class="count_notify"><?php  echo $request_counts['conduct_certi']; ?></span><?php } ?></a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'conduct_certi_requests') echo 'active'; ?>" href="<?php echo site_url('office/conduct_certi_requests'); ?>"> Conduct Certificate Request <?php if(isset($request_counts['conduct_certi'])) echo '('.$request_counts['conduct_certi'].')'; ?> </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'processed_conduct_certis') echo 'active'; ?>" href="<?php echo site_url('office/processed_conduct_certis'); ?>"> Processed Request  </a></label>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">TC <?php if(isset($request_counts['tc']) && !empty($request_counts['tc'])){ ?><span class="count_notify"><?php  echo $request_counts['tc']; ?></span><?php } ?></a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'tc_certi_requests') echo 'active'; ?>" href="<?php echo site_url('office/tc_certi_requests'); ?>"> Transfer Certificate Request <?php if(isset($request_counts['tc'])) echo '('.$request_counts['tc'].')'; ?> </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'processed_tc_certis') echo 'active'; ?>" href="<?php echo site_url('office/processed_tc_certis'); ?>"> Processed Request  </a></label>
                </li>
            </ul>
        </li>
        <li><a class="<?php if ($url_2 == 'student_data') echo 'active'; ?>" href="<?php echo site_url('office/student_data'); ?>">Student Data</a></li>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">My Fees</a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'fee_payment') echo 'active'; ?>" href="<?php echo site_url('office/fee_payment'); ?>"> Fee Payments </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'fee_ledger') echo 'active'; ?>" href="<?php echo site_url('office/fee_ledger'); ?>"> Fee Ledger  </a></label>
                </li>
                <li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'fee_reports') echo 'active'; ?>" href="<?php echo site_url('office/fee_reports'); ?>">List Payments  </a></label>
                </li>
                <li><label for="website"><a class="<?php if ($url_2 == 'coll_reports') echo 'active'; ?>" href="<?php echo site_url('office/coll_reports'); ?>">College Wise Reports Reports  </a></label></li>
                <li><label for="website"><a class="<?php if ($url_2 == 'dayReports') echo 'active'; ?>" href="<?php echo site_url('office/dayReports'); ?>">Day Wise Reports </a></label></li>
                <li><label for="website"><a class="<?php if ($url_2 == 'paymentGrid') echo 'active'; ?>" href="<?php echo site_url('office/paymentGrid'); ?>">Payment Grid </a></label></li> 
                <li><label for="website"><a class="<?php if ($url_2 == 'duegrid') echo 'active'; ?>" href="<?php echo site_url('office/duegrid'); ?>">Due Reports </a></label></li>
                <li><label for="website"><a class="<?php if ($url_2 == 'addvoucher') echo 'active'; ?>" href="<?php echo site_url('office/addvoucher'); ?>">Debit voucher </a></label></li>
                <li><label for="website"><a class="<?php if ($url_2 == 'debitvoucher') echo 'active'; ?>" href="<?php echo site_url('office/debitvoucher'); ?>">List of vouchers </a></label></li>
                <li><label for="website"><a class="<?php if ($url_2 == 'cashbook') echo 'active'; ?>" href="<?php echo site_url('office/cashbook'); ?>">Cash Book </a></label></li>   

            </ul>
        </li>




        <!-- Employee/ Office SET -->
    <?php } ?>




    <?php
    if ($userData->users_type_id == 7) {
        $request_counts=$this->session->userdata('request_counts');
        ?>
        <!-- Employee/ Office HEAD SET -->
        <li><a class="<?php if ($url_2 == '') echo 'active'; ?>" href="<?php echo site_url('office'); ?>">Home</a></li>
        <li><a class="<?php if ($url_2 == 'student_data') echo 'active'; ?>" href="<?php echo site_url('office/student_data'); ?>">Student Data</a></li>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">Fee details</a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'fee_details') echo 'active'; ?>" href="<?php echo site_url('office/fee_details'); ?>"> Individual Fee Details </a></label> </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'feebulkupdate') echo 'active'; ?>" href="<? echo site_url('office/feebulkupdate'); ?>"> Bulk Update </a></label> </li> <li>
                    <label for="website"><a class="<?php if ($url_2 == 'discounts') echo 'active'; ?>" href="<?php echo site_url('office/discounts'); ?>"> Dicount </a></label> </li>
                <li><label for="website"><a class="<?php if ($url_2 == 'cashbook') echo 'active'; ?>" href="<?php echo site_url('office/cashbook'); ?>">Cashbook</a></label> </li>
            </ul>
        </li>


        <li><a class="<?php if ($url_2 == 'no_due_requests') echo 'active'; ?>" href="<?php echo site_url('office/no_due_requests'); ?>">No Due Requests <?php if(isset($request_counts['no_due']) && !empty($request_counts['no_due'])){ ?><span class="count_notify"><?php  echo $request_counts['no_due']; ?></span><?php } ?></a></li>
        <li><a class="<?php if ($url_2 == 'pay_slip_requests') echo 'active'; ?>" href="<?php echo site_url('office/pay_slip_requests'); ?>">Pay Slip Requests <?php if(isset($request_counts['pay_slip']) && !empty($request_counts['pay_slip'])){ ?><span class="count_notify"><?php  echo $request_counts['pay_slip']; ?></span><?php } ?></a></li>
        <li><a class="<?php if ($url_2 == 'compose') echo 'active'; ?>" href="<?php echo site_url('email/compose'); ?>">Email</a></li>
        <!-- Employee/ Office HEAD SET -->
    <?php } ?>



    <?php
    if ($userData->users_type_id == 8) {
        $request_counts=$this->session->userdata('request_counts');  
        ?>
        <!-- Employee/ Examiner SET -->
        <li><a class="<?php if ($url_2 == '') echo 'active'; ?>" href="<?php echo site_url('exam'); ?>">Home</a></li>
        <li><a class="<?php if ($url_2 == 'student_data') echo 'active'; ?>" href="<?php echo site_url('exam/student_data'); ?>">Student Data</a></li>
        <li><a class="<?php if ($url_2 == 'sendmsg') echo 'active'; ?>" href="<?php echo site_url('exam/sendmsg'); ?>">Send a Message</a></li>
        <li><a class="<?php if ($url_2 == 'browse_q_papers') echo 'active'; ?>" href="<?php echo site_url('exam/browse_q_papers'); ?>"> Browse the Question papers  </a></li>
        <li><a class="<?php if ($url_2 == 'print_request') echo 'active'; ?>" href="<?php echo site_url('exam/print_request'); ?>">Print Request <?php if(isset($request_counts['prints']) && !empty($request_counts['prints'])){ ?><span class="count_notify"><?php  echo $request_counts['prints']; ?></span><?php } ?></a></li>
<!--                    <li><a href="<?php echo site_url('exam/results'); ?>">Results</a></li>-->
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">Exam</a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'post_exam_results') echo 'active'; ?>" href="<?php echo site_url('exam/post_exam_results'); ?>"> Post Exam Result </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'bulk_post_exam_results') echo 'active'; ?>" href="<?php echo site_url('exam/bulk_post_exam_results'); ?>"> Bulk Post Exam Result </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'exam_report') echo 'active'; ?>" href="<?php echo site_url('exam/exam_report'); ?>"> Exam Reports </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'view_student_results') echo 'active'; ?>" href="<?php echo site_url('exam/view_student_results'); ?>"> Search Student Results </a></label>
                </li>
                <!--                            <li>
                                    <label for="website"><a href="<?php echo site_url('office/processed_tc_certis'); ?>"> Processed Request  </a></label>
                                </li>-->
            </ul>
        </li>
        <li><a class="<?php if ($url_2 == 'compose') echo 'active'; ?>" href="<?php echo site_url('email/compose'); ?>">Email</a></li>

        <!-- Employee/ Examiner SET -->
    <?php } ?>


    <?php
    if ($userData->users_type_id == 9) {
        $request_counts=$this->session->userdata('request_counts');
        ?>
        <!-- Admin SET -->
        <li><a class="<?php if ($url_2 == '') echo 'active'; ?>" href="<?php echo site_url('admin'); ?>">Home</a></li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'student_data') echo 'active'; ?>" href="<?php echo site_url('admin/student_data'); ?>"> Student Data  </a></label>
        </li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'user_accounts') echo 'active'; ?>" href="<?php echo site_url('admin/user_accounts'); ?>"> User Accounts  </a></label>
        </li>
        <?php if($userData->id == 18){ ?>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'no_due') echo 'active'; ?>" href="<?php echo site_url('admin/no_due'); ?>"> No-Due Requests <?php if(isset($request_counts['no_due']) && !empty($request_counts['no_due'])){ ?><span class="count_notify"><?php  echo $request_counts['no_due']; ?></span><?php } ?></a></label>
        </li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'approve_q_papers') echo 'active'; ?>" href="<?php echo site_url('admin/approve_q_papers'); ?>"> Approve Question papers <?php if(isset($request_counts['q_papers']) && !empty($request_counts['q_papers'])){ ?><span class="count_notify"><?php  echo $request_counts['q_papers']; ?></span><?php } ?></a></label>
        </li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'leave_requests') echo 'active'; ?>" href="<?php echo site_url('staff/leave_requests'); ?>"> Leave Letter Requests  </a></label>
        </li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'attendance_breach') echo 'active'; ?>" href="<?php echo site_url('staff/attendance_breach'); ?>"> Attendance Breach </a></label>
        </li>
        <?php } ?>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'notice_board') echo 'active'; ?>" href="<?php echo site_url('admin/notice_board'); ?>"> College Updates </a></label>
        </li>
   <!--     <li>
            <a href="javascript:void(0);">Exam</a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a href="<?php echo site_url('admin/branch_semister_subjects'); ?>"> Add Exams </a></label>
                </li>
                <li>
                    <label for="website"><a href="<?php echo site_url('admin/adduser_marks'); ?>"> Add Exams Marks / Attendance </a></label>
                </li>
                <li>
                    <label for="website"><a href="<?php echo site_url('admin/system_subjects_grid'); ?>"> Add Subject </a></label>
                </li>


                <li>
                    <label for="website"><a href="<?php echo site_url('admin/pass_percentage'); ?>"> View Reports </a></label>
                </li>
            </ul>
        </li>  -->
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">Polls</a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'polls') echo 'active'; ?>" href="<?php echo site_url('admin/polls'); ?>"> View Polls </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'addpoll') echo 'active'; ?>" href="<?php echo site_url('admin/addpoll'); ?>"> Add Polls </a></label>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="collapse j_submenu_toggle">College Administration</a>
            <ul class="lft_sub_menu">
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'college_management') echo 'active'; ?>" href="<?php echo site_url('admin/college_management'); ?>"> College management </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'course_management') echo 'active'; ?>" href="<?php echo site_url('admin/course_management'); ?>"> Course management </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'branch_management') echo 'active'; ?>" href="<?php echo site_url('admin/branch_management'); ?>"> Branch management </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'semester_management') echo 'active'; ?>" href="<?php echo site_url('admin/semester_management'); ?>"> Semester management </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'subject_management') echo 'active'; ?>" href="<?php echo site_url('admin/subject_management'); ?>"> Subject management </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'period_management') echo 'active'; ?>" href="<?php echo site_url('admin/period_management'); ?>"> Period Cycle management </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'attendance_management') echo 'active'; ?>" href="<?php echo site_url('admin/attendance_management'); ?>"> Attendance management </a></label>
                </li>
                <!--<li>
                    <label for="website"><a href="<?php echo site_url('admin/regulation_management'); ?>"> Regulation management </a></label>
                </li>
                <li>
                    <label for="website"><a href="<?php echo site_url('admin/admission_year'); ?>"> Admission year management </a></label>
                </li>-->
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'academic_year') echo 'active'; ?>" href="<?php echo site_url('admin/academic_year'); ?>"> Teaching Years </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'section_management') echo 'active'; ?>" href="<?php echo site_url('admin/section_management'); ?>"> Section management </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'batch_no') echo 'active'; ?>" href="<?php echo site_url('admin/batch_no'); ?>"> Batch No management </a></label>
                </li>
                <!--
                <li>
                    <label for="website"><a href="<?php echo site_url('admin/college_logo'); ?>"> College Logo </a></label>
                </li>
                -->

                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'items') echo 'active'; ?>" href="<?php echo site_url('admin/items'); ?>"> Calendar Items </a></label>
                </li>
                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'academic_calendar') echo 'active'; ?>" href="<?php echo site_url('admin/academic_calendar'); ?>"> Academic Calendar </a></label>
                </li>

                <li>
                    <label for="website"><a class="<?php if ($url_2 == 'send_msg') echo 'active'; ?>" href="<?php echo site_url('staff/send_msg'); ?>"> Send Message </a></label>
                </li>
            </ul>
        </li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'compose') echo 'active'; ?>" href="<?php echo site_url('email/compose'); ?>"> Email </a></label>
        </li>



        <!--<li>
            <label for="website"><a href="<?php echo site_url('files/upload'); ?>"> Files </a></label>
        </li> -->

        <!-- Admin SET -->
    <?php } ?>

    <?php
    if ($userData->users_type_id == 10) {
        // $request_counts=$this->session->userdata('request_counts');
        ?>
        <!-- MISC SET -->
        <li><a href="<?php echo site_url('misc'); ?>">Home</a></li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'placement_cell') echo 'active'; ?>" href="<?php echo site_url('misc/placement_cell'); ?>"> Placement cell  </a></label>
        </li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'study_abroad') echo 'active'; ?>" href="<?php echo site_url('misc/study_abroad'); ?>"> Study Abroad  </a></label>
        </li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'send_msg') echo 'active'; ?>" href="<?php echo site_url('staff/send_msg'); ?>"> Send Message </a></label>
        </li>
        <li>
            <label for="website"><a class="<?php if ($url_2 == 'compose') echo 'active'; ?>" href="<?php echo site_url('email/compose'); ?>"> Email </a></label>
        </li>

        <!-- MISC SET -->
    <?php } ?>



</ul>

