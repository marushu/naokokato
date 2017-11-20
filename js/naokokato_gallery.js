(function($) {

    var windowW = $( 'body' ).width();
    //console.log( windowW );

    // Masonry for gallery page
    if ( windowW > 767 ) {

        var $grid = $('.gallery_slider_inner').masonry({
            // options
            //itemSelector: '.area_image_large__item',
            //columnWidth: '.area_image_large__item',
            columnWidth: 0,
            //isFitWidth: true,
            transitionDuration: 0,
            gutter: 0,
            percentPosition: true,
            //fitWidth: true
            //resize: false
            //columnWidth: 80
            stagger: 30
        });

        $grid.imagesLoaded(function () {
            $grid.masonry('layout');
        });

    }

    $('.venobox').venobox({
       titleattr: 'data-title',
       titlePosition: 'bottom',
       infinigall: true,
       spinner: 'spinner-pulse',
       framewidth: '',
       frameheight: '',
       titleBackground: 'transparent',
       bgcolor: '#000000',
       overlayColor: 'rgba( 255, 255, 255, .95 )',
       numeratio: true,
       //fitWidth: true,
       //columnWidth: 120
    });

    $( '.area_image_large__item' ).on( 'click', function(){

        console.log( this );

    } );

})(jQuery);
