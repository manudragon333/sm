<div class="clr"></div>
<br/>
<form id="appl_form" action="/admin/save_user_account">
    <input id="rel" name="rel" type="hidden" class="text" value="user_form"/>
    <input id="id" name="id" type="hidden" class="text" value="<?php if (isset($user_details[0]->id)) echo $user_details[0]->id; ?>"/>
    <input id="users_type_id" type="hidden"  name="users_type_id" class="text" value="<?php if (isset($user_details[0]->users_type_id)) echo $user_details[0]->users_type_id; ?>"/>
<ol>
    <li>
        <label for="username">Username:*</label>
        <input id="username" name="username" class="text" value="<?php if (isset($user_details[0]->username))
                   echo $user_details[0]->username; ?>"/>
    </li>
    <li>
        <label for="password">Password:*</label>
        <input id="password" name="password" class="text" value="<?php if (isset($user_details[0]->password))
                   echo $user_details[0]->password; ?>" type="password"/>
    </li>
    <li>
        <label for="email">Email:*</label>
        <input id="email" name="email" class="text" value="<?php if (isset($user_details[0]->email))
                   echo $user_details[0]->email; ?>"/>
    </li>
    <div class="clr"></div>
</ol>
<br/>
<ol>
    <li>
        <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save"/>
        <input type="button" name="imageField" id="imageField" class="m_l_20 grey button" value="Back" onclick="javascript:window.location.reload();"/>
        <div class="clr"></div>
    </li>
</ol>
</form>