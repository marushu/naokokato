    <?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Naoko_Kato
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'naoko_post_content naoko_archive_post_content' ); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
            if ( ! is_single() ) {
	            the_excerpt();
            } else {
                the_content();
            }

        ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
