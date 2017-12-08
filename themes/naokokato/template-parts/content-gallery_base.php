<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Naoko_Kato
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'naoko_post_content' ); ?>>

	<div class="entry-content">
		<?php

            //if ( function_exists( 'gallery_base_archive_box' ) ) {
            //    echo gallery_base_archive_box();
            //}

            ////$newest_gallery = reset( $newest_gallery );
            if ( function_exists( 'gallery_slider' ) ) {
                echo gallery_slider( true, intval( $post->ID ) );
            }

		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
