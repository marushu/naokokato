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
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

            if ( is_page( 'contact' ) ) {

                echo '<h2 class="post-title">お問い合わせ<span class="title_sub">Please send your inquiries or massages.</span></span></h2>';

            }

		    if( is_page( 'gallery' ) ) {

                if ( function_exists( 'gallery_base_archive_box' ) ) {
                    echo gallery_base_archive_box();
                }

            }

            the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'naokokato' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
