$(document).ready(function(){
    var userName = $("#userName");
    var fName = $("#fName");
    var lName = $("#lName");
    var email = $("#email");



    var elements = [userName, fName, lName, email];
    // get users credentals and diplays them in input boxes
    function updateScreen(){
        $.ajax({ 
            async: true,
            type:"post",
            url:"./php/getUsersCredentials.php"
        })
        .done(function(data){
            var jsonObj =JSON.parse(data)
            userName.val(jsonObj.userName);
            fName.val(jsonObj.firstName);
            lName.val(jsonObj.lastName);
            email.val(jsonObj.email);
            
        });
    }
    // initially get all user credantials and place them in input boxes
    updateScreen();
   

    $("#saveBtn").on('click', function(e){
        e.preventDefault();
        var inputData = $("#accountForm").serialize();
        if(valid()){
            $.ajax({
                async: true,
                type:"post",
                url: "./php/updateCredentials.php",
                data:inputData 
            }).done(function(data){
                $("#message").html(data);
                updateScreen();
                // after 3 seconds remove message
                setTimeout(function(){$("#message").html("");}, 3000);
            });
        }
    });       
    // makes sure all fields are filled
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

