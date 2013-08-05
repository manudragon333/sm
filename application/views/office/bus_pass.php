<h2 ><span>Bus Pass Request</span></h2>
<div class="clr"></div>

<div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
</div>

<script type="text/javascript" rel="javascript">
    bus_pass_requests_grid();
</script>




<div class="hide">
    <form id="appl_form" suc_msg="Bus pass request Submited Successfully.">
        <input id="" name="rel" class="text" type="hidden" value="busspass"/>
        <ol>
            <li>
                <label for="name">Student Name:*</label>
                <input id="name" name="name" class="text"/>
            </li>
            <li>
                <label for="num">Student Number:*</label>
                <input id="num" name="num" class="text"/>
            </li>
            <li>
                <label for="branch">Branch:*</label>
                <input id="branch" name="branch" class="text"/>
            </li>
            <li>
                <label for="website">Duration :</label>
                <input id="website" name="website" class="text"/>
            </li>
            <li>
                <label for="ppoint">Pickup point:*</label>
                <input id="ppoint" name="ppoint" class="text"/>
            </li>
            <li>
                <label for="website">Photo :</label>
                <input type='file' name='Picture' /><br />
            </li>
            <li><br/>
                <input type="button" name="imageField" id="imageField" class="generate button j_gen_form_submit" value="Generate Bus pass"style="margin-left: 700px;"/>
            </li>
        </ol>
    </form>
</div>