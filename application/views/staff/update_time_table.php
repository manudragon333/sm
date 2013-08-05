<?php // echo '<pre>'; print_r($data); echo '</pre>'; die; ?>

<form id="appl_form" action="/staff/update_time_table">
<ol>
    <li>
        <label for="from_month">Select Staff:* </label>
        <select id="staff_select" class="text" name="user_id" id="user_id">
            <option value="">Select</option>
            <?php foreach($staff as $k=>$v){ ?>
            <option value="<?php echo $v['id']; ?>"><?php echo $v['username'].' ('.$v['label'].')'; ?></option>
            <?php } ?>
        </select>
        <input type="hidden" name="id" value="0"/>
    </li>
    <li class="showTtOptions">
        <br/><br/>
        <table class="sample table_view table_view">
            <tr>
                <th>Day/Year</th>
                <th>1<sup>st</sup>Year</th>
                <th>2<sup>nd</sup>Year</th>
                <th>3<sup>rd</sup>Year</th>
                <th>4<sup>th</sup>Year</th>
            </tr>
            <tr>
                <th>Monday</th>
                <td><input type="text" name="mon_1" value=""/></td>
                <td><input type="text" name="mon_2" value=""/></td>
                <td><input type="text" name="mon_3" value=""/></td>
                <td><input type="text" name="mon_4" value=""/></td>
            </tr>
            <tr>
                <th>Tuesday</th>
                <td><input type="text" name="tue_1" value=""/></td>
                <td><input type="text" name="tue_2" value=""/></td>
                <td><input type="text" name="tue_3" value=""/></td>
                <td><input type="text" name="tue_4" value=""/></td>
            </tr>
            <tr>
                <th>Wednesday</th>
                <td><input type="text" name="web_1" value=""/></td>
                <td><input type="text" name="wed_2" value=""/></td>
                <td><input type="text" name="wed_3" value=""/></td>
                <td><input type="text" name="wed_4" value=""/></td>
            </tr>
            <tr>
                <th>Thursday</th>
                <td><input type="text" name="thu_1" value=""/></td>
                <td><input type="text" name="thu_2" value=""/></td>
                <td><input type="text" name="thu_3" value=""/></td>
                <td><input type="text" name="thu_4" value=""/></td>
            </tr>
            <tr>
                <th>Friday</th>
                <td><input type="text" name="fri_1" value=""/></td>
                <td><input type="text" name="fri_2" value=""/></td>
                <td><input type="text" name="fri_3" value=""/></td>
                <td><input type="text" name="fri_4" value=""/></td>
            </tr>
            <tr>
                <th>Saturday</th>
                <td><input type="text" name="sat_1" value=""/></td>
                <td><input type="text" name="sat_2" value=""/></td>
                <td><input type="text" name="sat_3" value=""/></td>
                <td><input type="text" name="sat_4" value=""/></td>
            </tr>
        </table>
    </li>
</ol>
<br/>
<br/>
<input type="button" name="imageField" id="imageField" class=" button showTtOptions j_gen_form_submit  gblue" value="Save Time Table"/>
</form>