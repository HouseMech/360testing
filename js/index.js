$(document).ready(function() {
   
    // add event listners to all arrows on click expand or compress divs 
    $('.arrow').each(function(){
        $(this).on('click', function(){
            // if arrow up flip it and collapse post
            if($(this).attr('src') === './img/pageImgs/up_arrow.png' ){
                $(this).attr('src', "./img/pageImgs/down_arrow.png");
            }else{
                $(this).attr('src', "./img/pageImgs/up_arrow.png"); 
            }
            // get slide div and collapse it or expand depending on current state
            $(this).parent().siblings('.slide').slideToggle('fast');
        });        
    });

});
