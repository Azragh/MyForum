(function($){
    $(document).ready(function(){

        // thread-rating colors
        $('.thread-rating').each(function(){
            fullRating = $(this);
            rating = fullRating.html().trim().slice( 0, - 2 );
            if ( rating < 1 ) {
                fullRating.css({
                    "background" : "#ccc",
                    "border-color" : "#ccc",
                });
            } else if ( rating >= 1 && rating < 1.5 ) {
                fullRating.css({
                    "background" : "#ff5137",
                    "border-color" : "#ff5137",
                });
            } else if ( rating >= 1.5 && rating < 2.5 ) {
                fullRating.css({
                    "background" : "#ffa63f",
                    "border-color" : "#ffa63f",
                });
            } else if ( rating >= 2.5 && rating < 3.5 ) {
                fullRating.css({
                    "background" : "#ffd43f",
                    "border-color" : "#ffd43f",
                });
            } else if ( rating >= 3.5 && rating < 4.5 ) {
                fullRating.css({
                    "background" : "#a5d43f",
                    "border-color" : "#a5d43f",
                });
            } else if ( rating >= 4.5 ){
                fullRating.css({
                    "background" : "#0acd58",
                    "border-color" : "#0acd58",
                });
            }
        });

        // hiding errors & success messages
        $('.error, .success').on('click', function(){
            $(this).fadeOut('slow');
        });

        // prevent page-flashing
        $('body').css("opacity", "1");

    });
})(jQuery);

function showLogin(){
    $('.loginform').toggleClass('open');
}
