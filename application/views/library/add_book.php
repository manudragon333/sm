<div class="f_r f_b m_r_10">* required fields</div>

<div>
    <form id="appl_form" action="/library/save_book">
        <input id="rel" name="rel" class="text" type="hidden" value="add_book"/>
        <ol>
<!--            <li>
                <label for="name">Name of Book:*</label>
                <input id="name" name="name" class="text"/>
            </li>-->
            <li>
                <label for="unique_number">Accession No:*</label>
                <input id="unique_number" name="unique_number" class="text required" title="Please enter the Accession No"/>
            </li>
            <li>
                <label for="author">Author:*</label>
                <input id="author" name="author" class="text"/>
            </li>
            <li>
                <label for="title">Title of the book:*</label>
                <input id="title" name="title" class="text required" title="Please enter the Title of the book"/>
            </li>
            <li>
                <label for="edition_year">Edition/Year:*</label>
                <input id="edition_year" name="edition_year" class="text" title="Please enter the Edition/Year"/>
            </li>
            <li>
                <label for="pages">Pages:*</label>
                <input id="pages" name="pages" class="text required" title="Please enter the pages"/>
            </li>
            <li>
                <label for="volume">Volume:</label>
                <input id="volume" name="volume" class="text" title="Please enter the pages"/>
            </li>
            <li>
                <label for="publisher_name_addr">Publisher Name/Addr:*</label>
                <input id="publisher_name_addr" name="publisher_name_addr" class="text required" title="Please enter the publisher name/Addr"/>
            </li>
            <li>
                <label for="isbn_no">ISBN:</label>
                <input id="isbn_no" name="isbn_no" class="text" title="Please enter the ISBN Number"/>
            </li>
            <li>
                <label for="call_no">Call No:</label>
                <input id="call_no" name="call_no" class="text" title="Please enter the Call No"/>
            </li>
            <li>
                <label for="book_cost">Book Cost:*</label>
                <input id="book_cost" name="book_cost" class="text required" title="Please enter the Book Cost"/>
            </li>
            <li>
                <label for="date_of_withdrawl">Date of With-drawl:</label>
                <input id="date_of_withdrawl" name="date_of_withdrawl" class="text apply_datepicker" title="Please enter the Date of With-drawl"/>
            </li>
            <li>
                <label for="remarks">Remarks:</label>
                <input id="remarks" name="remarks" class="text" title="Please enter the Remarks"/>
            </li>
<!--            <li>
                <label for="version">Version:*</label>
                <input id="version" name="version" class="text"/>
            </li>-->

            <li>
                <label for="college_id">College:* </label>
                <select id="college_id" name="college_id" class="text required" title="Please select College">
                    <option value="">Select</option>
                    <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
                </select>
            </li>
            <li>
                <label for="course_id">Course:* </label>
                <select id="course_id" name="course_id" class="text required"  title="Please select Course">
                    <option value="">Select</option>
                    <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
                </select>
            </li>
            <li>
                <label for="branch_id">Branch:*</label>
                <select id="branch_id" name="branch_id" class="text">
                    <option value="">Select</option>
                    <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
                </select>
            </li>
            <li>
                <label for="year">Published in Year:*</label>
                <select id="year" name="year" class="text">
                    <option value="">Select</option>
                    <?php for($i=1980;$i<=date('Y');$i++){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </li>
<!--            <li>
                <label for="unique_number">Unique Number:*</label>
                <input id="unique_number" name="unique_number" class="text"/>
            </li>-->
            <li>
                <input type="button" class="gblue button j_gen_form_submit" value="Include the Book"/><br />
            </li>
        </ol>
    </form>
    <div class="clr"></div>
</div>

<script type="text/javascript" rel="javascript">
    $(function(){
        if($('.apply_datepicker').length>0){
            $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
        }
    })
</script>
