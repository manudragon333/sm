<?php // echo '<pre>'; print_r($data); echo '</pre>'; die; ?>
<h2><span>My Time Table.</span></h2><br /><br />
<div class="clr"></div>
<div class="clr"></div>
<ol>
    <li>
        <table class="sample table_view">
            <tr>
                <th>Day/Year</th>
                <th>1<sup>st</sup>Year</th>
                <th>2<sup>nd</sup>Year</th>
                <th>3<sup>rd</sup>Year</th>
                <th>4<sup>th</sup>Year</th>
            </tr>
            <tr>
                <th>Monday</th>
                <td><?php if(isset($data[0]->mon_1))echo $data[0]->mon_1; ?></td>
                <td><?php if(isset($data[0]->mon_2))echo $data[0]->mon_2; ?></td>
                <td><?php if(isset($data[0]->mon_3))echo $data[0]->mon_3; ?></td>
                <td><?php if(isset($data[0]->mon_4))echo $data[0]->mon_4; ?></td>
            </tr>
            <tr>
                <th>Tuesday</th>
                <td><?php if(isset($data[0]->tue_1))echo $data[0]->tue_1; ?></td>
                <td><?php if(isset($data[0]->tue_2))echo $data[0]->tue_2; ?></td>
                <td><?php if(isset($data[0]->tue_3))echo $data[0]->tue_3; ?></td>
                <td><?php if(isset($data[0]->tue_4))echo $data[0]->tue_4; ?></td>
            </tr>
            <tr>
                <th>Wednesday</th>
                <td><?php if(isset($data[0]->web_1))echo $data[0]->web_1; ?></td>
                <td><?php if(isset($data[0]->wed_2))echo $data[0]->wed_2; ?></td>
                <td><?php if(isset($data[0]->wed_3))echo $data[0]->wed_3; ?></td>
                <td><?php if(isset($data[0]->wed_4))echo $data[0]->wed_4; ?></td>
            </tr>
            <tr>
                <th>Thursday</th>
                <td><?php if(isset($data[0]->thu_1))echo $data[0]->thu_1; ?></td>
                <td><?php if(isset($data[0]->thu_2))echo $data[0]->thu_2; ?></td>
                <td><?php if(isset($data[0]->thu_3))echo $data[0]->thu_3; ?></td>
                <td><?php if(isset($data[0]->thu_4))echo $data[0]->thu_4; ?></td>
            </tr>
            <tr>
                <th>Friday</th>
                <td><?php if(isset($data[0]->fri_1))echo $data[0]->fri_1; ?></td>
                <td><?php if(isset($data[0]->fri_2))echo $data[0]->fri_2; ?></td>
                <td><?php if(isset($data[0]->fri_3))echo $data[0]->fri_3; ?></td>
                <td><?php if(isset($data[0]->fri_4))echo $data[0]->fri_4; ?></td>
            </tr>
            <tr>
                <th>Saturday</th>
                <td><?php if(isset($data[0]->sat_1))echo $data[0]->sat_1; ?></td>
                <td><?php if(isset($data[0]->sat_2))echo $data[0]->sat_2; ?></td>
                <td><?php if(isset($data[0]->sat_3))echo $data[0]->sat_3; ?></td>
                <td><?php if(isset($data[0]->sat_4))echo $data[0]->sat_4; ?></td>
            </tr>
        </table>
    </li>
</ol>
<br/>
<br/>
<input type="button" name="imageField" id="imageField" class="gblue button  " value="Print" onclick="this.style.display='none'; window.print();">
