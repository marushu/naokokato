<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Naoko_Kato
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

            <header class="page-header">
				<?php

                echo '<h1 class="page-title">gallery</h1>';

				//the_archive_title( '<h1 class="page-title">', '</h1>' );
				//the_archive_description( '<div class="archive-description">', '</div>' );

				?>
            </header><!-- .page-header -->

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'gallery_base' );

			//the_post_navigation();

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
