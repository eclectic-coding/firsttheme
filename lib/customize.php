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
/**
 * Customizations using the Theme Customizer API
 *
 */
function _themename_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'            => '.c-header__blogname',
		'container_inclusive' => false,
		'render_callback'     => function () {
			bloginfo( 'name' );
		}
	) );

	/*##################  SINGLE SETTINGS #######################*/

	/*################## GENERAL SETTINGS #######################*/

	$wp_customize->add_section( '_themename_general_options', array(
		'title'       => esc_html__( 'General Options', '_themename' ),
		'description' => esc_html__( 'You can change general options from here.', '_themename' )
	) );

	$wp_customize->add_setting( '_themename_accent_color', array(
		'default'           => '#20ddae',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, '_themename_accent_color', array(
		'label'   => __( 'Accent Color', '_themename' ),
		'section' => '_themename_general_options',
	) ) );

	/*################## FOOTER SETTINGS ########################*/

	$wp_customize->selective_refresh->add_partial( '_themename_footer_partial', array(
		'settings'            => array( '_themename_footer_bg', '_themename_footer_layout' ),
		'selector'            => '#footer',
		'container_inclusive' => false,
		'render_callback'     => function () {
			get_template_part( 'template-parts/footer/info' );
			get_template_part( 'template-parts/footer/widgets' );
		}
	) );

	$wp_customize->add_section( '_themename_footer_options', array(
		'title'       => esc_html__( 'Footer Options', '_themename' ),
		'description' => esc_html__( 'You can change the footer from here', '_themename' )
	) );

	$wp_customize->add_setting( '_themename_site_info', array(
		'default'           => '',
		'sanitize_callback' => '_themename_sanitize_site_info',
		'transport'         => 'postMessage'
	) );

	$wp_customize->add_control( '_themename_site_info', array(
		'type'    => 'text',
		'label'   => esc_html__( 'Site Info', '_themename' ),
		'section' => '_themename_footer_options'
	) );

	$wp_customize->add_setting( '_themename_footer_bg', array(
		'default'   => 'dark',
		'transport' => 'postMessage'
//		'sanitize_callback' => '_themename_sanitize_footer_bg',
	) );

	$wp_customize->add_control( '_themename_footer_bg', array(
		'type'    => 'select',
		'label'   => esc_html__( 'Footer Background', '_themename' ),
		'choices' => array(
			'light' => esc_html__( 'Light', '_themename' ),
			'dark'  => esc_html__( 'Dark', '_themename' ),
		),
		'section' => '_themename_footer_options'
	) );

	$wp_customize->add_setting( '_themename_footer_layout', array(
		'default'           => '3,3,3,3',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
		'validate_callback' => '_themename_validate_footer_layout'
	) );

	$wp_customize->add_control( '_themename_footer_layout', array(
		'type'    => 'text',
		'label'   => esc_html__( 'Footer Layout', '_themename' ),
		'section' => '_themename_footer_options'
	) );
}

function _themename_validate_footer_layout( $validity, $value ) {
	if ( ! preg_match( '/^([1-9]|1[012])(,([1-9]|1[012]))*$/', $value ) ) {
		$validity->add( 'invalid_footer_layout', esc_html__( 'Footer layout is invalid', '_themename' ) );
	}

	return $validity;
}

function _theme_sanitize_footer_bg( $input ) {
	$valid = array( 'light', 'dark' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'dark';
}

function _themename_sanitize_site_info( $input ) {
	$allowed = array(
		'a' => array(
			'href'  => array(),
			'title' => array()
		)
	);

	return wp_kses( $input, $allowed );
}
