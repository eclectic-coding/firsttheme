<?php
/**
 * Customize the WordPress Customizer with new Theme Options
 *
 * @package EclecticCoding
 * @since   1.0.0
 * @author  Chuck Smith
 * @link    https://chucksmith.dev
 * @license GNU General Public License 2.0+
 */

add_action( 'customize_register', '_themename_customize_register' );
function _themename_customize_register( $wp_customize ) {

	$wp_customize->add_section( '_themename_footer_options', array(
		'title'       => esc_html__( 'Footer Options', '_themename' ),
		'description' => esc_html__( 'You can change the footer from here', '_themename' )
	) );


	$wp_customize->add_setting( '_themename_site_info', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( '_themename_site_info', array(
		'type'    => 'text',
		'label'   => esc_html__( 'Site Info', '_themename' ),
		'section' => '_themename_footer_options'
	) );
}