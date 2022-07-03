$(document).ready(function(){
    $(window).scroll(function(){
        if($(window).scrollTop() > 150){
            $('header').addClass('scrolled');
        }else{
            $('header').removeClass('scrolled');
        }
    });
});