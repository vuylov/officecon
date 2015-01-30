$(document).ready(function()
{
    $(".edit-product").hover(
        function(){
            $(this).css('border', '1px solid red');
        }, function(){
            $(this).css('border', 'none');
        }
    );
    $("#slider").divas({
        slideTransitionClass: "divas-slide-transition-left",
        titleTransitionClass: "divas-title-transition-left",
        titleTransitionParameter: "left",
        titleTransitionStartValue: "-999px",
        titleTransitionStopValue: "0px",
        wingsOverlayColor: "rgba(9,9,9,0.6)",
        //start: "auto",
        slideInterval: 8000
    });
});