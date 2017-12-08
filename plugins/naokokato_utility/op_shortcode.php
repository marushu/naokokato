<?php
/**
 * Get datas from ACF fields.
 * Make shortcode to admin panel
 */

function get_naoko_shortcode( $atts ) {

	extract( shortcode_atts( array(
		'post_type' => 'p_calendar',
		'class'     => '',
	), $atts ) );

	$args             = array(
		'post_type'      => 'p_calendar',
		'posts_per_page' => - 1,
	);
	$p_calendar_posts = get_posts( $args );
	//var_dump( $p_calendar_posts );

	if ( empty( $p_calendar_posts ) ) {
		return;
	}

	$html = '';
	$html .= '<div class="monthly_calendar_outer">' . "\n";
	foreach ( $p_calendar_posts as $post ) {

		setup_postdata( $post );
		$post_id      = $post->ID;
		$post_title   = esc_html( get_the_title( $post_id ) );
		$post_content = $post->post_content;
		$cal_title_id = get_post_meta( $post_id, 'each_monthly_cal_title', true )
			? get_post_meta( $post_id, 'each_monthly_cal_title', true )
			: '';
		$cal_title_img = wp_get_attachment_image_src( $cal_title_id, 'full' );
		$cal_img_tag = sprintf(
			'<img src="%1$s" alt="%2$s" title="%2$s">',
			esc_url( $cal_title_img[ 0 ] ),
			esc_html( $post_title )
		);

		$html .=  '<div class="monthly_calendar_inner">' . "\n";
		$html .= '<h2 class="monthly_calendar_title">' . $cal_img_tag . '</h2>' . "\n";
		$html .= '<div class="monthly_calendar">' . "\n";


		$post_thumbnail = get_the_post_thumbnail( $post_id )
			? get_the_post_thumbnail( $post_id )
			: '';
		$html           .= '<div class="calendar_front">' . "\n";
		$html           .= $post_thumbnail . "\n";
		$html           .= '</div><!-- /.calendar_front -->' . "\n";

		/*
		 * Get each post's calendar images.
		 */
		$html              .= '<div class="each_month">' . "\n";
		$child_field_count = intval( get_post_meta( $post_id, 'each_monthly', true ) );
		//var_dump( $child_field_count );
		for ( $i = 0; $i < $child_field_count; $i ++ ) {

			$calendar_image_id = get_post_meta( $post_id, sprintf( 'each_monthly_%d_image', $i ), true );
			$calendar_text     = get_post_meta( $post_id, sprintf( 'each_monthly_%d_text', $i ), true );

			$image_obj = wp_get_attachment_image_src( $calendar_image_id, 'full' );
			$image_tag = sprintf(
				'<img src="%1$s" alt="%2$s" title="%2$s">',
				esc_url( $image_obj[0] ),
				esc_html( $calendar_text )
			);

			$html .= '<p class="cal_img">' . $image_tag . '</p>' . "\n";

		}

		$html .= '</div><!-- /.each_month -->';
		$html .= '</div><!-- /.monthly_calendar -->';
		$html .= '</div><!-- /.monthly_calendar_inner -->' . "\n";
		$html .= '<div class="cal_content">' . apply_filters( 'the_content', $post_content ) . '</div>' . "\n";

	}
	wp_reset_postdata();

	$html .= '</div><!-- /.monthly_calendar_outer -->' . "\n";
	return $html;

}

add_shortcode( 'naoko_calendar', 'get_naoko_shortcode' );