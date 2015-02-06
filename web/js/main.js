$(document).ready(function(){
    $("ul.slider-container").roundabout({
        autoplay: true,
        autoplayDuration: 7000,
        autoplayPauseOnHover: true,
        btnNext: $('#roundabout-next'),
        btnPrev: $('#roundabout-prev')
    });

    $('[data-toggle = "tooltip"]').tooltip();
    $('img.step').hover(
        function(){
            var src  = $(this).attr('src').replace('_g', '_y');
            $(this).attr('src', src);
        },
        function(){
            var src = $(this).attr('src').replace('_y', '_g');
            $(this).attr('src', src);
        }
    );

});