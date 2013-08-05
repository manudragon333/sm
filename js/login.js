$(function(){
    $('#userlogin').validate({
        rules:{
            uname:{
                required:true
            },
            psw:{
                required:true
            }
        },
        messages:{
            uname:{
                required:'Please enter your username'
            },
            psw:{
                required:'Please enter your password'
            }
        }
    });
    
    $('#login_bt').live('click',function(){
        $(this).parents('form').submit();
    });
    
    $("#userlogin input").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $('#login_spinner').show();
            $('#userlogin').submit();
        }
    });
    
    
    
    $('.forgot_psw_form').validate({
        rules:{
            uname:{
                required:true
            }
        },
        messages:{
            uname:{
                required:'Please enter your username'
            }
        }
    });
    
    $(".forgot_psw_form input").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $('#login_spinner').show();
            $('#forgot_psw_form').submit();
        }
    });
    
    
    
    
});