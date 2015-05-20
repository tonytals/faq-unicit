<?php
/**
 * Plugin Name: F.A.Q UniCIT
 * Plugin URI: http://webtals.com
 * Description: Perguntas mais frenquentes.
 * Version: 1.0
 * Author: Tony Galvão
 * Author URI: http://webtals.com
 * Template Name: UNICIT-Faq
 * Text Domain: faq-unicit
 * Domain Path: faq-unicit
 * License: GPL2
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// método que carrega arquivos de tradução
function faq_unicit_load_textdomain() {

	load_plugin_textdomain( 'faq-unicit', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

}


function faq_init(){
	
	$labels = array(
		'name'              => _x( 'Subjects', 'faq-unicit' ),
		'singular_name'     => _x( 'Subject', 'faq-unicit' ),
		'search_items'      => __( 'Search Subjects', 'faq-unicit' ),
		'all_items'         => __( 'All Subjects', 'faq-unicit' ),
		'parent_item'       => __( 'Parent Subject', 'faq-unicit' ),
		'parent_item_colon' => __( 'Parent Subject:', 'faq-unicit' ),
		'edit_item'         => __( 'Edit Subject', 'faq-unicit' ),
		'update_item'       => __( 'Update Subject', 'faq-unicit' ),
		'add_new_item'      => __( 'Add New Subject', 'faq-unicit' ),
		'new_item_name'     => __( 'New Subject Name', 'faq-unicit' ),
		'menu_name'         => __( 'Subject', 'faq-unicit' )
		);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'subjects' ),
		);

	register_taxonomy( 'subjects', array( 'faq_unicit' ), $args );


	$labels = array(
		'name' 		    => __( 'FAQ UniCIT', 'faq-unicit' ),
		'singular_name' => __( 'Singular', 'faq-unicit' ),
		'all_items'	    => __( 'All Questions', 'faq-unicit' ),
		'add_new'	    => __( 'Add Question', 'faq-unicit' )
		);

	$args = array(
		'public' 	 	=> true,
		'labels'  	 	=> $labels,
		'menu_icon'  	=> 'dashicons-editor-help',
		'show_ui'	 	=> true,
		'show_in_menu'  => true,
		'query_var' => true,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'capability_type' => 'page',
		'supports' 	 	=> array(
			'title',
			'editor',
			'page-attributes',
			'author'
			)
		);
	register_post_type('faq_unicit', $args);	

}

add_action( 'init', 'faq_init' );
add_action( 'plugins_loaded', 'faq_unicit_load_textdomain' );

function faq_unicit_include_template( $template_path ) {
	global $wp_query;
	$wp_query->is_404 = false;

	if( $wp_query->query['name'] == "faq" ){

		if ( $theme_file = locate_template( array ( 'single-faq_unicit.php' ) ) ) {
			$template_path = $theme_file;
		} else {
			$template_path = plugin_dir_path( __FILE__ ) . '/single-faq_unicit.php';
		}

		return $template_path;
		exit;

	}else{

		return $template_path;
		exit;

	}    
}

add_filter( 'template_include', 'faq_unicit_include_template', 1 );

function faq_unicit_register_my_scripts(){

    // Use `get_stylesheet_directoy_uri() if your script is inside your theme or child theme.
	wp_register_script( 'faq-unicit', plugins_url( '/js/faq-unicit.js', __FILE__ ) );
	wp_register_script( 'main', plugins_url( '/js/main.js', __FILE__ ) );
	wp_register_script( 'jquery-mobile-custom', plugins_url( '/js/jquery.mobile.custom.min.js', __FILE__ ) );
	wp_register_script( 'modernizr', plugins_url( '/js/modernizr.js', __FILE__ ) );

	wp_register_style( 'style_faq_unicit', plugins_url( '/css/style.css', __FILE__ ) );
	wp_register_style( 'reset_faq_unicit', plugins_url( '/css/reset.css', __FILE__ ) );

}

// Always use wp_enqueue_scripts action hook to both enqueue and register scripts
add_action( 'wp_enqueue_scripts', 'faq_unicit_register_my_scripts' );