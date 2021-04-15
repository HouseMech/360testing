$(document).ready(function(){
    var tag = $("#pTags");

    $("#newPost-form").on('submit', function(e){
       // check if tag contains spaces
        if(tag.val().indexOf(' ') >= 0){
            e.preventDefault();
            tag.addClass("error");
            $("#message").html("tags cannot contain spaces.");
            setTimeout(function(){$("#message").html("");}, 3000);
        }
    });       
    



});