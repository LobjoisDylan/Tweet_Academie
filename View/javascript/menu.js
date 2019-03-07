$(document).ready(function(){
    $('.profil').hover(function(){
        $('ul:first',this).css({visibility:"visible"});
    }, function(){
        $('ul:first',this).css({visibility:"hidden"});
    });
});
