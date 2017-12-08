<?php

function p_calendar_init() {
	register_post_type( 'p_calendar', array(
		'labels'            => array(
			'name'                => __( 'カレンダー', 'p_calendar' ),
			'singular_name'       => __( 'カレンダー', 'p_calendar' ),
			'all_items'           => __( '全てのカレンダー', 'p_calendar' ),
			'new_item'            => __( '新規カレンダー', 'p_calendar' ),
			'add_new'             => __( '新規追加', 'p_calendar' ),
			'add_new_item'        => __( '新規追加', 'p_calendar' ),
			'edit_item'           => __( 'カレンダーを編集', 'p_calendar' ),
			'view_item'           => __( 'カレンダーを見る', 'p_calendar' ),
			'search_items'        => __( 'カレンダーを検索', 'p_calendar' ),
			'not_found'           => __( 'カレンダーは見つかりませんでした。', 'p_calendar' ),
			'not_found_in_trash'  => __( 'ゴミ箱にカレンダーは見つかりませんでした。', 'p_calendar' ),
			'parent_item_colon'   => __( '親カレンダー', 'p_calendar' ),
			'menu_name'           => __( 'カレンダー', 'p_calendar' ),
		),
		'public'            => false,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-admin-post',
		'show_in_rest'      => true,
		'rest_base'         => 'p_calendar',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'p_calendar_init' );
