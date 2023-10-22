<?php

if ( ! function_exists( 'lesio_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 0.8.0
	 *
	 * @return void
	 */
	function lesio_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'lesio', get_template_directory() . '/languages' );

		// Enqueue editor styles and fonts.
		add_editor_style(
			array(
				'./style.css',
			)
		);

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

	}
}
add_action( 'after_setup_theme', 'lesio_setup' );

// Enqueue style sheet.
add_action( 'wp_enqueue_scripts', 'lesio_enqueue_style_sheet' );
function lesio_enqueue_style_sheet() {

	wp_enqueue_style( 'lesio', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

}

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function lesio_register_block_styles() {

	$block_styles = array(
		'core/columns' => array(
			'columns-reverse' => __( 'Reverse', 'lesio' ),
		),
		'core/group' => array(
			'shadow-light' => __( 'Shadow', 'lesio' ),
			'shadow-solid' => __( 'Solid', 'lesio' ),
		),
		'core/image' => array(
			'shadow-light' => __( 'Shadow', 'lesio' ),
			'shadow-solid' => __( 'Solid', 'lesio' ),
		),
		'core/list' => array(
			'no-disc' => __( 'No Disc', 'lesio' ),
		),
		'core/quote' => array(
			'shadow-light' => __( 'Shadow', 'lesio' ),
			'shadow-solid' => __( 'Solid', 'lesio' ),
		),
		'core/social-links' => array(
			'outline' => __( 'Outline', 'lesio' ),
		),
	);

	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'lesio_register_block_styles' );

/**
 * Register block pattern categories.
 *
 * @since 1.0.4
 */
function lesio_register_block_pattern_categories() {

	register_block_pattern_category(
		'page',
		array(
			'label'       => __( 'Page', 'lesio' ),
			'description' => __( 'Create a full page with multiple patterns that are grouped together.', 'lesio' ),
		)
	);
	register_block_pattern_category(
		'pricing',
		array(
			'label'       => __( 'Pricing', 'lesio' ),
			'description' => __( 'Compare features for your digital products or service plans.', 'lesio' ),
		)
	);

}

add_action( 'init', 'lesio_register_block_pattern_categories' );

if(!function_exists("lesio_enqueue_block_variations")) :

function lesio_enqueue_block_variations(){
	$jsonString = file_get_contents(get_template_directory_uri() . '/dist/manifest.json');
    $data = json_decode($jsonString, true);
    $jsScript = $data["index.html"]["file"];
   
	
	wp_enqueue_script(
		"lesio_enqueue_block_variations" ,
      get_template_directory_uri() . '/dist/' . $jsScript,
		array("wp-blocks","wp-dom-ready","react" ),
		  '1.0', // Script version
        true 
	);
	
}
//  add_action(  "enqueue_block_editor_assets", "lesio_enqueue_block_variations");
endif;
if(!function_exists("lesio_scripts_and_styles")) :

function lesio_scripts_and_styles(){

    $jsonString = file_get_contents(get_template_directory_uri() . '/dist/manifest.json');
    $data = json_decode($jsonString, true);
    $jsScript = $data["index.html"]["file"];
    wp_enqueue_style( "lesio-style", get_stylesheet_uri(  ), array(),wp_get_theme()->get("Version") );
    wp_enqueue_script(
        'lesio-scripts', // Script handle
        get_template_directory_uri() . '/dist/' . $jsScript, // Script source
        array(), // Dependencies
        '1.0', // Script version
        true // Load script in footer
    );
}
// add_action(  "wp_enqueue_scripts", "lesio_scripts_and_styles" );
endif;
if(!function_exists("wz_multiple_blocks_register_blocks")) :

function wz_multiple_blocks_register_blocks() {
	// Register blocks in the format $dir => $render_callback.
	$blocks = array(
		// 'dynamic' => 'wz_tutorial_dynamic_block_recent_posts', // Dynamic block with a callback.

		// Static block. Doesn't need a callback.
		"grid" => ""
	);
	foreach ( $blocks as $dir => $render_callback ) {
		$args = array();
		if ( ! empty( $render_callback ) ) {
			$args['render_callback'] = $render_callback;
		}
		register_block_type( __DIR__ . '/blocks/build/' . $dir, $args );
	}
}
add_action( 'init', 'wz_multiple_blocks_register_blocks' );
endif;
