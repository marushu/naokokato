<?php

/**
 * Add post type Gallery
 */
function gallery_init() {
	register_post_type( 'gallery_base', array(
		'labels'            => array(
			'name'                => __( 'Gallery', 'naokokato' ),
			'singular_name'       => __( 'Gallery', 'naokokato' ),
			'all_items'           => __( 'All Galleries', 'naokokato' ),
			'new_item'            => __( 'New gallery', 'naokokato' ),
			'add_new'             => __( 'Add New', 'naokokato' ),
			'add_new_item'        => __( 'Add New gallery', 'naokokato' ),
			'edit_item'           => __( 'Edit gallery', 'naokokato' ),
			'view_item'           => __( 'View gallery', 'naokokato' ),
			'search_items'        => __( 'Search gallery', 'naokokato' ),
			'not_found'           => __( 'No galleries found', 'naokokato' ),
			'not_found_in_trash'  => __( 'No gallery found in trash', 'naokokato' ),
			'parent_item_colon'   => __( 'Parent gallery', 'naokokato' ),
			'menu_name'           => __( 'Gallery', 'naokokato' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-admin-post',
		'show_in_rest'      => true,
		'rest_base'         => 'gallery_base',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'menu_position'     => 5,
	) );

}
add_action( 'init', 'gallery_init' );

function gallery_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['gallery'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Gallery updated. <a target="_blank" href="%s">View gallery</a>', 'naokokato'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'naokokato'),
		3 => __('Custom field deleted.', 'naokokato'),
		4 => __('Gallery updated.', 'naokokato'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Gallery restored to revision from %s', 'naokokato'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Gallery published. <a href="%s">View gallery</a>', 'naokokato'), esc_url( $permalink ) ),
		7 => __('Gallery saved.', 'naokokato'),
		8 => sprintf( __('Gallery submitted. <a target="_blank" href="%s">Preview gallery</a>', 'naokokato'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Gallery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview gallery</a>', 'naokokato'),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Gallery draft updated. <a target="_blank" href="%s">Preview gallery</a>', 'naokokato'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}



/**
 * Change text at theme.
 */
add_filter('gettext', 'change_post_to_article');
add_filter('gettext_with_context', 'change_post_to_article');
add_filter('ngettext', 'change_post_to_article');
add_filter('ngettext_with_context', 'change_post_to_article');
function change_post_to_article($translated) {

	$translated = str_ireplace('投稿', 'Blog', $translated );

	return $translated;
}

add_image_size( 'area_small', 67, 44, true );
add_image_size( 'fit_large', 1200, '', true );
add_image_size( 'thumb_300_200', 300, 200, true );
add_image_size( 'thumb_320_999', 320, 999999, false );
/**
 * Front page slider
 */
function front_page_slider() {

	$post_id = get_the_ID();
	$child_field_count = intval( get_post_meta( $post_id, 'top_slider', true ) );
	$html = '';

	if ( $child_field_count > 0 ) {

		$html .= '<div class="top_slider">';
		$html .= '<ul class="slider">';

		for ( $i = 0; $i < $child_field_count; $i++ ) {

			$top_slide_img_id = get_post_meta( $post_id, sprintf('top_slider_%d_image', $i ), true );
			$top_slide_img_obj = wp_get_attachment_image_src( $top_slide_img_id, 'full' );
			$top_slide_img_caption = get_post_meta( $post_id, sprintf('top_slider_%d_caption', $i ), true );
			$image_tag = sprintf(
				'<img src="%1$s" alt="%2$s">',
				esc_url( $top_slide_img_obj[ 0 ] ),
				esc_html( $top_slide_img_caption )
			);

			$html .= '<li>';
			$html .= $image_tag;
			$html .= '</li>';

		}

		$html .= '</ul>';
		$html .= '</div><!-- / .top_slider -->';

	}

	echo $html;

}


/**
 * For Gallery page set the "cat_gallery" archive links.
 * This top level page is get_post_type() === 'gallery_base' archive link page.
 * Set box and post thumbnail with link.
 * And then click each box, open single post(masonry gallery looks :) ).
 */
function gallery_base_archive_box() {

	$args = array(
		'post_type'      => 'gallery_base',
		'posts_per_page' => 9999,
	);
	$gallery_base_posts = get_posts( $args );
	$html = '';
	if ( empty( $gallery_base_posts ) )
		return;

	$html .= '<div class="gallery_posts_archive">';
	$html .= '<ul class="gallery_posts_lists">';

	foreach ( (array)$gallery_base_posts as $gallery_base_post ) {

		$post_id = $gallery_base_post ->ID;
		$post_title = get_the_title( $post_id );
		$default_attr = array(
			'alt'   => trim( strip_tags( esc_html( $post_title ) ) ),
			'title' => trim( strip_tags( esc_html( $post_title ) ) ),
		);
		$gallery_base_post_thumb = has_post_thumbnail( $post_id )
			? get_the_post_thumbnail( $post_id, 'thumb_300_200', $default_attr )
			: '<img src="' . get_template_directory_uri() . '/images/no_image.png" alt="no_image">';

		$html .= '<li class="gallery_item">';
		$html .= '<a href="' . esc_url( get_permalink( $post_id ) ) . '" title="' . esc_html( $post_title ) . '">';
		$html .= $gallery_base_post_thumb;
		$html .= '<span class="gallery_title">' . esc_html( $post_title ) . '</span>';
		$html .= '</a>';
		$html .= '</li>';

	}

	$html .= '</ul>';
	$html .= '</div><!-- / .gallery_posts_archive -->';

	return $html;

}


/**
 * For each gallery category single page.
 */
function gallery_slider( $gallery = '', $post_id = '' ) {

	$post_id =  $post_id === ''
		? get_the_ID()
		: $post_id;
	$child_field_count = intval( get_post_meta( $post_id, 'top_slider', true ) );
	$html = '';

	if ( $child_field_count > 0 ) {

		$html .= '<div class="gallery_slider">';
		$html .= '<ul class="gallery_slider_inner">';

		for ( $j = 0; $j < $child_field_count; $j++ ) {

			$top_slide_img_id = get_post_meta( $post_id, sprintf('top_slider_%d_image', $j ), true );
			$top_slide_img_obj = wp_get_attachment_image_src( $top_slide_img_id, 'full' );
			$top_slide_img_caption = get_post_meta( $post_id, sprintf('top_slider_%d_caption', $j ), true );

			$image_tag = sprintf(
				'<img src="%1$s" alt="%2$s">',
				esc_url( $top_slide_img_obj[ 0 ] ),
				esc_html( $top_slide_img_caption )
			);


			$top_slide_img_small_obj = wp_get_attachment_image_src( $top_slide_img_id, 'thumb_320_999' );
			$small_img_tag = sprintf(
				'<img class="main_image" src="%1$s" alt="%2$s">',
				esc_url( $top_slide_img_small_obj[ 0 ] ),
				esc_html( $top_slide_img_caption )
			);

			if ( $j === 0 ) {

				$html .= '<li class="current area_image_large__item">';
				$html .= '<a class="venobox" data-gall="myGallery" data-title="' . esc_attr( $top_slide_img_caption ) . '" href="' . esc_url( $top_slide_img_obj[ 0 ] ) . '">';
				//$html .= '</a>';
				$html .= '<img class="empty_image" src="' . get_template_directory_uri() . '/images/empty_front.png" alt="">';
				$html .= $small_img_tag;
				$html .= '</a>';
				$html .= '</li>';

			} else {

				$html .= '<li class="area_image_large__item">';
				$html .= '<a class="venobox" data-gall="myGallery" data-title="' . esc_attr( $top_slide_img_caption ) . '" href="' . esc_url( $top_slide_img_obj[ 0 ] ) . '">';
				$html .= '<img class="empty_image" src="' . get_template_directory_uri() . '/images/empty_front.png" alt="">';
				$html .= $small_img_tag;
				$html .= '</a>';
				$html .= '</li>';

			}

		}

		$html .= '</ul>';
		$html .= '</div><!-- / .top_slider -->';

	}

	echo $html;

}


/**
 * Change archive page title
 * @param $title
 */
add_filter( 'get_the_archive_title', 'change_archive_title', 10, 1 );
function change_archive_title( $title ) {

	//var_dump( get_post_type() );
	//var_dump( get_queried_object() );

	if ( get_post_type() === 'news' ) {

		$title = esc_attr( get_queried_object()->name );

	}

	if ( is_home() ) {

		$title = 'blog';

	}

	return $title;

}

/**
 * Change excerpt more.
 * @param $more
 */
function naokokato_excerpt_more( $more ) {

	$link = get_permalink( get_the_ID() );
	$excerpt_content = '<a href="' . esc_url( $link ) . '">…続きを読む</a>';

	return $excerpt_content;

}
add_filter( 'excerpt_more', 'naokokato_excerpt_more', 10, 1 );

/**
 * Add body class :)
 */
function browser_body_class( $classes ) {

	if( is_user_logged_in() ) {
		$classes[] = 'logged-in';
	}

	if( is_page() ) {
		$page = get_post(get_the_ID());
		$classes[] = "page-" . esc_attr( $page->post_name );
	}

	if( ! is_front_page() ) {
		$classes[] = 'child-pages';
	}

	return $classes;
}
add_filter( 'body_class', 'browser_body_class' );

