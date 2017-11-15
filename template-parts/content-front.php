<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Naoko_Kato
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

        <?php if ( function_exists( 'front_page_slider' ) ) { echo front_page_slider(); } ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
