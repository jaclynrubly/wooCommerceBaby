<?php
/**
 * Genesis Sample.
 *
 * This file adds the required CSS to the front end to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

add_action( 'wp_enqueue_scripts', 'genesis_sample_css' );
/**
* Checks the settings for the link color, and accent color.
* If any of these value are set the appropriate CSS is output.
*
* @since 2.2.3
*/
function genesis_sample_css() {

	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	$color_link = get_theme_mod( 'genesis_sample_link_color', genesis_sample_customizer_get_default_link_color() );
	$color_accent = get_theme_mod( 'genesis_sample_accent_color', genesis_sample_customizer_get_default_accent_color() );

	$css = '';

	//* Calculate Color Contrast
	function genesis_sample_color_contrast( $color ) {
	
		$hexcolor = str_replace( '#', '', $color );

		$red   = hexdec( substr( $hexcolor, 0, 2 ) );
		$green = hexdec( substr( $hexcolor, 2, 2 ) );
		$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

		$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );

		return ( $luminosity > 128 ) ? '#333333' : '#ffffff';

	}
	
	//* Calculate Color Brightness
	function genesis_sample_color_brightness( $color, $change ) {

		$hexcolor = str_replace( '#', '', $color );

		$red   = hexdec( substr( $hexcolor, 0, 2 ) );
		$green = hexdec( substr( $hexcolor, 2, 2 ) );
		$blue  = hexdec( substr( $hexcolor, 4, 2 ) );
	
		$red   = max( 0, min( 255, $red + $change ) );
		$green = max( 0, min( 255, $green + $change ) );  
		$blue  = max( 0, min( 255, $blue + $change ) );

		return '#'.dechex( $red ).dechex( $green ).dechex( $blue );

	}

	//* Change Color Brightness
	function genesis_sample_change_brightness( $color ) {

		$hexcolor = str_replace( '#', '', $color );

		$red   = hexdec( substr( $hexcolor, 0, 2 ) );
		$green = hexdec( substr( $hexcolor, 2, 2 ) );
		$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

		$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );

		return ( $luminosity > 128 ) ? genesis_sample_color_brightness( '#333333', 20 ) : genesis_sample_color_brightness( '#ffffff', -50 );

	}

	$css .= ( genesis_sample_customizer_get_default_link_color() !== $color_link ) ? sprintf( '

		a,
		.entry-title a:focus,
		.entry-title a:hover,
		.genesis-nav-menu a:focus,
		.genesis-nav-menu a:hover,
		.genesis-nav-menu .current-menu-item > a,
		.genesis-nav-menu .sub-menu .current-menu-item > a:focus,
		.genesis-nav-menu .sub-menu .current-menu-item > a:hover,
		.js nav button:focus,
		.js .menu-toggle:focus {
			color: %1$s;
		}
		', $color_link ) : '';

	$css .= ( genesis_sample_customizer_get_default_accent_color() !== $color_accent ) ? sprintf( '

		button:focus,
		button:hover,
		input:focus[type="button"],
		input:focus[type="reset"],
		input:focus[type="submit"],
		input:hover[type="button"],
		input:hover[type="reset"],
		input:hover[type="submit"],
		.archive-pagination li a:focus,
		.archive-pagination li a:hover,
		.archive-pagination .active a,
		.button:focus,
		.button:hover,
		.sidebar .enews-widget input[type="submit"] {
			background-color: %1$s;
			color: %2$s;
		}
		', $color_accent, genesis_sample_color_contrast( $color_accent ), genesis_sample_change_brightness( $color_accent ) ) : '';

	if ( $css ) {
		wp_add_inline_style( $handle, $css );
	}

}










/*
 * Adds the required CSS to the front end.
 */
add_action( 'wp_enqueue_scripts', 'genesischild_css' );
/**
* Checks the settings for the images and background colors for each image
* If any of these value are set the appropriate CSS is output
*
* @since 1.0
*/
function genesischild_css() {
wp_enqueue_style( 'genesischild', get_stylesheet_directory_uri() . '/style.css' );
 //If your theme does not have it's name defined, don't use the $handle variable just use the actual id of the themes CSS, such as in this example 'genesischild' add it further below - wp_add_inline_style( $handle, $css );
 $handle = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';
 // Add in the correct amount of images into the array
 $opts = apply_filters( 'genesischild_images', array( '1', '2', '3', '4', '5','6', '7', '8', '9', '10', '11', '12' ) );
 $settings = array();
 foreach( $opts as $opt ){
 $settings[$opt]['image'] = preg_replace( '/^https?:/', '', get_option( $opt .'-genesischild-image', sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $opt ) ) );
 }
 $css = '';
 foreach ( $settings as $section => $value ) {
 $background = $value['image'] ? sprintf( 'background-image: url(%s);', $value['image'] ) : '';
 // Remove the conditional surrounding the code below if the images are appearing on pages other than the front page
 if( is_front_page() ) {
 $css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.featured-background-%s { %s }', $section, $background ) : '';
 }
 }
 if ( $css ){
 wp_add_inline_style( $handle, $css ); //so here instead of $handle use your themes CSS ID - which in this case is genesischild
 }
}

