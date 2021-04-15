$(document).ready(function(){
    var email = $("#email");
    var submit =$("#signIn-btn");
    // remove error class if text added
    email.on('change', function(){
        if(email.hasClass("error")){
            email.removeClass("error");
        }
    });
    // if email field is filled submit post request to forgetPassword.php
    submit.on('click', function(e){
        e.preventDefault();
        if(email.val() != ""){
            $.ajax({
                type: "post",
                url:  "../php/forgetPassword.php",
                data: {email: email.val()},
            }).done(function(data){
                if(data == "success"){
                $("#message").html("A temporary password has been sent to your email.");
                }
                $("#message").html(data);
            }).fail(function(jqXHR) {console.log("Error: " + jqXHR.status);});
        }else{
            email.addClass("error");
            $("#message").html("Enter a email");
        }
    });
});