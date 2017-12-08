/**
 * Naokokato - v0.1.0
 *
 * Copyright 2016, Hibou (http://private.hibou-web.com)
 * Released under the GNU General Public License v2 or later
 */

(function($) {

    $('.slider').bxSlider({
        auto: true,
        mode: 'fade',
        controls: false,
        pager: false,
        responsive: true,
        adaptiveHeight: true
    });

    $( '.area_image_list' ).on( 'click', function( e ) {

        e.preventDefault();
        var target_list = $( '.area_image_list' );
        var counter = $( target_list ).length - 1;
        console.log( counter );

        var target_item = $( '.area_image_large__item' );
        var num = $( target_list ).index( this );

        console.log( num );

        $( target_list ).removeClass( 'current' );
        $( this ).addClass( 'current' );

        $( target_item ).removeClass( 'current' );
        $( target_item ).eq( num ).addClass( 'current' );

        $( 'img' ).attr('oncontextmenu', 'return false');
        $( 'img' ).attr('onSelectStart', 'return false');
        $( 'img' ).attr('onMouseDown', 'return false');

    } );

    $( 'img' ).attr('oncontextmenu', 'return false');
    $( 'img' ).attr('onSelectStart', 'return false');
    $( 'img' ).attr('onMouseDown', 'return false');


})(jQuery);
