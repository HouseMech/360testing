$(document).ready(function(){

    var search = $("#search");
    

    // add listner to search area. 
    //if username or password contain what is being searched allow them to remain in the table
    // else hide that row. 
    
    search.on('keydown', function(e){
        //every time key press show all rows
        $("tr").each(function(){
            $(this).show();
        })
        // find all rows that doesnt contain search val and hides them
        // also ensures header row stays visible, if they contain username or title
        $("tr:not(:contains('"+ search.val() + "')):not(:contains('Username')):not(:contains('Title:'))").hide();
    })
});