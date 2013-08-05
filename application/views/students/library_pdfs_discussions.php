<pre><?php // print_r($discussions); ?></pre>
<?php 
    if(!empty($discussions)){
    foreach($discussions as $k=>$v){

?>
<div class="ui-widget-header" style="">
    <?php echo $v->commented_by; ?> :&nbsp;
</div>
<div style="border: 1px solid #CCC;border-top: none; padding-left: 30px;">
    <?php echo $v->comment; ?>&nbsp;
</div>

    
<?php }}else{ ?>
<br/> <div class="error">No Discussion Started. You can start discussion by commenting below.</div>
<?php } ?>
<br/>
<form id="appl_form" action="/students/library_pdfs_discussions/<?php echo $enc_id; ?>">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>
        <li>
            <label for="comment">Comment:*</label>
            <textarea id="comment" cols="8" rows="5" name="comment" class="text"></textarea>
        </li>
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="upload button j_gen_form_submit" value="Submit"/>
        </li>
    </ol>
</form>