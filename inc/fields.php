<?php
/*
 *
 * Odin ACF Fields
 *
*/
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_about-us',
		'title' => 'About Us',
		'fields' => array (
			array (
				'key' => 'field_57be2eaf4c1b0',
				'label' => 'Sub Title',
				'name' => 'sub_title',
				'type' => 'text',
				'instructions' => 'Sub Title',
				'required' => 1,
				'default_value' => 'Founder',
				'placeholder' => 'Sub Title',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => 15,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_type',
					'operator' => '==',
					'value' => 'child',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));
}
