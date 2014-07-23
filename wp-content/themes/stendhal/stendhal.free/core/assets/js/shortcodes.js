/* JS for Shortcode */
(function($){

$(document).ready(function(){   
    //flickr rss
    $( '.widget_flickrRSS img' ).hover(
        function() {
            $( this ).stop( true, true ).animate( { 'opacity' : 0.6 } );
        },
        function() {
            $( this ).stop( true, true ).animate( { 'opacity' : 1 } );
        }
    );    
});

})(jQuery);