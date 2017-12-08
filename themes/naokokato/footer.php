<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Naoko_Kato
 */

?>

	</div><!-- #content -->
</div><!-- #page -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
	    <?php //wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer_nav_menu' ) ); ?>
        <p class="copyright">Copyright © naokokato.com All Rights Reserved.</p>
    </div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
