$(document).ready(function() {

    var userName = $("#userName");
    var password = $("#password");
    var confirmPassword = $("#confirmPassword");
    var fName = $("#fName");
    var lName = $("#lName");
    var email = $("#email");
    var button = $("#signUp-btn");

    var elements = [userName, password, fName, lName, email, confirmPassword];
    // remove red highlighting once input changed
    $.each(elements, function() {
        $(this).on('change', function(){
            if($(this).hasClass("error")){
                $(this).removeClass("error");
            }
        })
    });
    // when attempting to submit form program will check if valid input and if password and email are not used
    // if conditions are met the form will be submitted
    button.on('click', function(e){
        if(valid()){
            $.ajax({
                type: "post",
                url:  "../php/validEmailAndPassword.php",
                data: {userName: userName.val(), password: password.val(), fName: fName.val(), lName: lName.val(), email: email.val()},
                aysnc:false
            }).done(function(data){
                if(data === "success"){
                    $(".signup-form").submit();
                }
                //returns message 
                $("#message").text(data);
                
            }).fail(function(jqXHR) {
                // if ajax request fails, display error
                console.log("Error: " + jqXHR.status);
            });
            e.preventDefault();
        }
        e.preventDefault();
    });


    // makes async request to ensure email and username are not in the database
    
    // make sure fields are not empty highlights them red if they are
    function valid(){
        var valid = true;
        for(i = 0; i < elements.length; i++ ){
            // if empty string highlight red
            if(!elements[i].val()){
                elements[i].addClass("error");
                valid = false;
                $("#message").text("All fields must be filled!");
            }
        }
        // make sure passwods match
        if(password.val() != confirmPassword.val()){
            $("#message").html("Passwords must must match!");
            valid = false;
        }
        return valid;
    }
});
