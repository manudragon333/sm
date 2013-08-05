$.extend({
   showModal:function(opts){
       var config={
            id:'',
            buttons:
            [{
                text: "Ok",
                click: function() { $(this).dialog("close"); }
            }],
            height:150,
            width:300,
            dialogClass: "",
            message:'Please Wait..'
       };

       if(opts){
           $.extend(config,opts);
       }

       if($('#modal_buffer').length>0){ $('#modal_buffer').remove(); }
       $('body').append('<div id="modal_buffer" style="display:none;"><div id="modal_message'+config.id+'">'+config.message+'</div></div>')

        //$('<p>'+ config.message + '</p>' )
        $('#modal_message'+config.id+'').dialog({
            height: config.height,
            width: config.width,
            buttons:config.buttons,
            dialogClass: config.dialogClass,
            modal: true
        });
   },
   change_psw_form:function(){
       var content=Array();
       content.push('<form id="password_form">');
       content.push('<ol>');
       content.push('   <li><label style="width:125px;">Old Password:</label> <input type="password" class="text mdl_ip" name="psw" id="psw"/></li>');
       content.push('   <li><label style="width:125px;">New Password:</label> <input type="password" class="text mdl_ip" name="password" id="password"/></li>');
       content.push('   <li><label style="width:125px;">Retype Password:</label> <input type="password" class="text mdl_ip" name="password2" /></li>');
       content.push('</ol>');
       content.push('</form>');
       
       return content.join('');
   }


   
});