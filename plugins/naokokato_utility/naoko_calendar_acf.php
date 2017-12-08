<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_product-for_naoko_calendar',
		'title' => 'Product カレンダー用',
		'fields' => array (
			array (
				'key' => 'field_5a1d0e8af57f1',
				'label' => 'タイトル画像',
				'name' => 'each_monthly_cal_title',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5a1cd28795b2d',
				'label' => '各月のカレンダー画像',
				'name' => 'each_monthly',
				'type' => 'repeater',
				'instructions' => '各月のカレンダー画像を設定します。',
				'sub_fields' => array (
					array (
						'key' => 'field_5a1cd2b795b2e',
						'label' => '画像',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_5a1cd2ce95b2f',
						'label' => '説明テキスト',
						'name' => 'text',
						'type' => 'text',
						'instructions' => '画像の説明を入力します。（例）1月',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => 1,
				'row_limit' => 12,
				'layout' => 'table',
				'button_label' => 'カレンダー画像を追加する',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'p_calendar',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'comments',
				1 => 'author',
				2 => 'format',
				3 => 'categories',
				4 => 'tags',
				5 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

