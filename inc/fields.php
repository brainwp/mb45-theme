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
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));



	register_field_group(array (
		'id' => 'acf_inferior-text',
		'title' => 'Inferior Text',
		'fields' => array (
			array (
				'key' => 'field_57c5f4c353682',
				'label' => 'Bottom Text',
				'name' => 'bottom_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Click Here to Purchase a MB45 Gift Card.	For details on our service(...)',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
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
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	if ( $frontpage_id = get_option( 'page_on_front' ) ) {

	register_field_group(array (
		'id' => 'acf_home-options',
		'title' => 'Home Options',
		'fields' => array (
			array (
				'key' => 'field_57fd72abc7a8e',
				'label' => 'Text color',
				'name' => 'text_color',
				'type' => 'radio',
				'choices' => array (
					'White' => 'White',
					'Black' => 'Black',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'White',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_57fd4bf5d0ff5',
				'label' => 'Textbox or shortcode on right side',
				'name' => 'content_right',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_57fd4c43d0ff6',
				'label' => 'Link text',
				'name' => 'link_text',
				'type' => 'text',
				'default_value' => 'View Menu',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_57fd4c8da0e17',
				'label' => 'Link URL',
				'name' => 'link_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_587560e75a4d3',
				'label' => 'Invert Title Color in Mobile',
				'name' => 'color_mobile',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_parent',
					'operator' => '==',
					'value' => $frontpage_id,
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'revisions',
				6 => 'slug',
				7 => 'author',
				8 => 'format',
				9 => 'categories',
				10 => 'tags',
				11 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));

	}

}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_appointment-product',
		'title' => 'Appointment Product',
		'fields' => array (
			array (
				'key' => 'field_583c8668710db',
				'label' => 'Select the appointment product',
				'name' => 'appointment_product',
				'type' => 'relationship',
				'required' => 1,
				'return_format' => 'object',
				'post_type' => array (
					0 => 'product',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-appointment.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
