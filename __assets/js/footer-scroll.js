$(document).ready(function(){
    $(window).scroll(function(){
        const scrollBottom = $(window).scrollTop() + $(window).height();
        if(scrollBottom > 450){
            $('footer').addClass('scrolled');
        }else{
            $('footer').removeClass('scrolled');
        }
    });
});