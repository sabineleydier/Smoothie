$(function()
{

if ($(window).width() < 960){
        $('.navbar-collapse').add('hide');
        $('.close').toggle('hide');
        $('#photoLogIn').css({'margin-top':'200px'});

        $('.navbar-toggler-icon').on('click', function(){
            $('.navbar-toggler').toggle('hide');
            $('header').height(600);
            $('.navbar-collapse').toggle('hide');
        })

         $('.close').on('click', function(){
            $('.navbar-toggler').toggle('hide');
            $('header').height(200);
            $('.navbar-collapse').toggle('hide');
        })
    }

}); 