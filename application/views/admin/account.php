<div>
    <h2><span> Account Details </span></h2>
    <div class="clr"></div>
    <div class="user_instructions">
        <p style="width:200px; float:left;">Please enter details below.</p>
        <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
        <div class="clr"></div>
    </div>
    <div>
        <ol id="admin_account_sel">
            <form action="/students/conduct_certificate" id="appl_form" suc_msg="" err_msg="">
                <li>
                    <label><input type="radio" name="choice" value="1" /> Squeeze the Account</label><br style="clear:both;"/>
                    <label><input type="radio" name="choice" value="2" /> Release the Account</label><br style="clear:both;"/>
                    <label><input type="radio" name="choice" value="3"/> Squeeze the Entire Network</label><br style="clear:both;"/>
                </li>
                <li  id="choice1_li" class="hide">
                    <h2 align="center"><span> Squeeze the Account </span></h2>
                    <div class="clr"></div>
                    <label for="name">Student Name:*</label>
                    <input id="name" name="name" class="text"/>
                    <br class="clearfloat"/><br/>
                    <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Search"/>
                    <div class="clr"></div>
                </li>
                
                
                
            </form>
        </ol>
    </div>
    <div id="choice2_li" class="hide">
        <h2 align="center"><span> Release the Account </span></h2>
        <div class="clr"></div>
        <ol>
            <h4><span> Search Data </span></h4>
            <form action="/students/conduct_certificate" id="appl_form" suc_msg="" err_msg="">
                <input id="" name="rel" class="text" type="hidden" value="account1"/>
                <li>
                    <label for="sname">Student Name:*</label>
                    <input id="sname" name="sname" class="text"/><br/>
                </li><li>
                    <label for="snum">Student Number:*</label>
                    <input id="snum" name="snum" class="text"/><br/>
                </li><li>
                    <label for="account">Account Status :</label>
                    <input id="account" name="account" class="text"/><br/>
                </li><li>
                    <label for="branch">Branch:*</label>
                    <input id="branch" name="branch" class="text"/><br/>
                </li><li>
                    <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Release"/>
                    <div class="clr"></div>
                </li>
            </form>
        </ol>
    </div>
    
    
    <div id="choice3_li" class="hide">
        <h2 align="center"><span> Squeeze the Entire Network </span></h2>
        <div class="clr"></div>
        <ol>
            <form action="/students/conduct_certificate" id="appl_form" suc_msg="" err_msg="">
                <input id="" name="rel" class="text" type="hidden" value="squeeze_entire_network"/>
                <li>
                    <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value=" Squeeze the Entire Network "/>
                    <div class="clr"></div>
                </li>
            </form>
        </ol>
    </div>
</div>