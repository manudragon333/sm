$.extend({
    assignment_marks_form:function(opts){
        console.log(opts[0])
        if(opts && opts[0]){
            id=opts[0].id
            marks=opts[0].marks_alloted;
            staff_comments=opts[0].staff_comments;
        }else{
            id='999999'
            marks='';
            staff_comments='';
        }
        var content;
        content='<form id="marks_form"><ol> \
                        <li> <input type="hidden" name="id" id="id" value="'+id+'"/>   \
                            <label style="width:125px;">Marks:</label> \
                            <input type="marks_alloted" name="marks_alloted" id="marks_alloted"  value="'+marks+'"/>\
                        </li>   \
                        <li>\
                            <label style="width:125px;">Staff comments:</label> \
                            <textarea cols="10" rows="3" name="staff_comments" style="width:160px;">'+staff_comments+'</textarea>\
                        </li>\
                    </ol>\
                </form>';
        return content;
    }

});