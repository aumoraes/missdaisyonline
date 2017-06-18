<?php

function customizer_extension( $wp_customize ){
	/*
		=================================================
		Contact setting
		=================================================
		*/

	$wp_customize->add_section( 'contato_networking', array(
		 'title'          => __( 'Contato Menu', 'styled-store' ),
		 'priority'       => 50,
	 ) );



	// Setting for hiding the social bar
	$wp_customize->add_setting( 'show_contato', array(
		'sanitize_callback' => 'styledstore_sanitize_checkbox',
	));


	// Control for hiding the social bar
	$wp_customize->add_control( 'show_contato', array(
		'label' => __( 'Mostrar contato', 'styled-store' ),
		'type' => 'checkbox',
		'section' => 'contato_networking',
		'priority' => 1,
	) );


		// Setting group for Facebook
		$wp_customize->add_setting( 'sac_uid', array(
			'sanitize_callback' => 'esc_html',
		) );

		$wp_customize->add_control( 'sac_uid', array(
			'settings' => 'sac_uid',
			'label'    => __( 'SAC', 'styled-store' ),
			'section'  => 'contato_networking',
			'type'     => 'text',
			'priority' => 1,
		) );
	//Setting group for e-mail
	$wp_customize->add_setting( 'email_uid', array(
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'email_uid', array(
		'settings' => 'email_uid',
		'label' => __( 'Email de Contato', 'lojamissdaisy' ),
		'label'    => esc_html__( 'Email de Contato', 'lojamissdaisy' ),
		'section'  => 'contato_networking',
		'type'     => 'text',
		'priority' => 1,
	) );
}

add_action('customize_register', 'customizer_extension');
?>
