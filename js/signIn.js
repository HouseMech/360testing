$(document).ready(function(){
  var email = $("#email");
  var password = $("#password");
  var submit =$("#signIn-btn");
  var elements = [email, password];

   // remove red highlighting once input changed
  $.each(elements, function() {
    $(this).on('change', function(){
        if($(this).hasClass("error")){
            $(this).removeClass("error");
        }
    })
  });
     // when attempting submit makes sure data is valid then sends async request to php to attempt to sign user in
    submit.on('click', function(e){
      e.preventDefault();
      if(valid()){
          $.ajax({
              type: "post",
              url:  "../php/signIn.php",
              data: {email: email.val(), password: password.val()}
          }).done(function(data){
              if(data == "success"){
                // submit form which will redirect to index.phps
                // will only work on local machine
                window.location.replace("http://localhost/Group32ProjectCosc360/index.php");
                
              }
              $("#message").html(data);
          }).fail(function(jqXHR) {console.log("Error: " + jqXHR.status);});
      }
  });
  function valid(){
    var valid = true;
    for(i = 0; i < elements.length; i++ ){
        // if empty string highlight red
        if(!elements[i].val()){
            elements[i].addClass("error");
            valid = false;
            $("#message").html("All fields must be filled!");
        }
    }
    return valid;
  }
});

function signUp_Visit() {
  // Redirect user to signUp page after clicking 'Sign Up' button.
  window.location.href = "../pages/signUp.php";

}
