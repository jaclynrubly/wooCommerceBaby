<?php
/**
 * Genesis Sample.
 *
 * This file adds the Customizer additions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

/**
 * Get default link color for Customizer.
 *
 * Abstracted here since at least two functions use it.
 *
 * @since 2.2.3
 *
 * @return string Hex color code for link color.
 */
function genesis_sample_customizer_get_default_link_color() {
	return '#c3251d';
}

/**
 * Get default accent color for Customizer.
 *
 * Abstracted here since at least two functions use it.
 *
 * @since 2.2.3
 *
 * @return string Hex color code for accent color.
 */
function genesis_sample_customizer_get_default_accent_color() {
	return '#c3251d';
}

add_action( 'customize_register', 'genesis_sample_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 2.2.3
 * 
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesis_sample_customizer_register() {

	global $wp_customize;

	$wp_customize->add_setting(
		'genesis_sample_link_color',
		array(
			'default'           => genesis_sample_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_link_color',
			array(
				'description' => __( 'Change the default color for linked titles, menu links, post info links and more.', 'genesis-sample' ),
			    'label'       => __( 'Link Color', 'genesis-sample' ),
			    'section'     => 'colors',
			    'settings'    => 'genesis_sample_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_accent_color',
		array(
			'default'           => genesis_sample_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_accent_color',
			array(
				'description' => __( 'Change the default color for button hovers.', 'genesis-sample' ),
			    'label'       => __( 'Accent Color', 'genesis-sample' ),
			    'section'     => 'colors',
			    'settings'    => 'genesis_sample_accent_color',
			)
		)
	);

}








/*
 * Add Background Images Via the Customizer
 */
add_action( 'customize_register', 'genesischild_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesischild_customizer_register() {
 /**
 * Customize Background Image Control Class
 *
 * @package WordPress
 * @subpackage Customize
 * @since 3.4.0
 */
 class Child_Genesischild_Image_Control extends WP_Customize_Image_Control {
 /**
 * Constructor.
 *
 * If $args['settings'] is not defined, use the $id as the setting ID.
 *
 * @since 3.4.0
 * @uses WP_Customize_Upload_Control::__construct()
 *
 * @param WP_Customize_Manager $manager
 * @param string $id
 * @param array $args
 */
 public function __construct( $manager, $id, $args ) {
 $this->statuses = array( '' => __( 'No Image', 'genesischild' ) );
 parent::__construct( $manager, $id, $args );
 $this->add_tab( 'upload-new', __( 'Upload New', 'genesischild' ), array( $this, 'tab_upload_new' ) );
 $this->add_tab( 'uploaded',   __( 'Uploaded', 'genesischild' ), array( $this, 'tab_uploaded' ) );
 if ( $this->setting->default )
 $this->add_tab( 'default',  __( 'Default', 'genesischild' ), array( $this, 'tab_default_background' ) );
 // Early priority to occur before $this->manager->prepare_controls();
 add_action( 'customize_controls_init', array( $this, 'prepare_control' ), 5 );
 }
 /**
 * @since 3.4.0
 * @uses WP_Customize_Image_Control::print_tab_image()
 */
 public function tab_default_background() {
 $this->print_tab_image( $this->setting->default );
 }
 }
 global $wp_customize;
 // Add in the correct amount of images into the array
 $images = apply_filters( 'genesischild_images', array( '1', '2', '3', '4', '5','6', '7', '8', '9', '10', '11', '12') );
 $wp_customize->add_section( 'genesischild-settings', array(
 'description' => __( 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 1050 pixels tall</strong>.', 'genesischild' ),
 'title' => __( 'Featured Background Images', 'genesischild' ),
 'priority' => 35,
 ) );
 foreach( $images as $image ){
 $wp_customize->add_setting( $image .'-genesischild-image', array(
 'default' => sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $image ),
 'type' => 'option',
 ) );
 $wp_customize->add_control( new Child_Genesischild_Image_Control( $wp_customize, $image .'-genesischild-image', array(
 'label' => sprintf( __( 'Featured Background %s Image:', 'genesischild' ), $image ),
 'section' => 'genesischild-settings',
 'settings' => $image .'-genesischild-image',
 'priority' => $image+1,
 ) ) );
 }
}