<div>
    <form id="books_dispatched_filter_form">
    <p>
        Filter by:
        <label>Student Number: <input type="text" name="student_number" class="books_dispatched_filter"/></label>
        <label>Staff Number: <input type="text" name="staff_number" class="books_dispatched_filter"/></label>
        <label>Book number: <input type="text" name="book_number" class="books_dispatched_filter"/></label>
    
    </p>
    </form>
</div>
<div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
</div>

<script type="text/javascript" rel="javascript">
    books_dispatched_grid();
</script>
<!-- '<?php // echo $student_number; ?>','<?php // echo $book_number; ?>' -->