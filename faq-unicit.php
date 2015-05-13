<?php
/**
 * Plugin Name: F.A.Q UniCIT
 * Plugin URI: http://webtals.com
 * Description: Perguntas mais frenquentes.
 * Version: 1.0
 * Author: Tony Galvão
 * Author URI: http://webtals.com
 * Text Domain: faq-unicit
 * Domain Path: faq-unicit
 * License: GPL2
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Função que carrega arquivos de tradução
function faq_unicit_load_textdomain() {

	load_plugin_textdomain( 'faq-unicit', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

}


function faq_init(){
	
	$labels = array(
					'name' 				=> __( 'FAQ UniCIT', 'faq-unicit' ),
					'singular_name' 	=> __( 'Singular', 'faq-unicit' ),
					'all_items'			=> __( 'All Questions', 'faq-unicit' ),
					'add_new'			=> __( 'Add Question', 'faq-unicit' )
				);

	$args = array(
			'public' 	=> true,
			'labels'  	=> $labels,
			'menu_icon' => 'dashicons-editor-help',
			'supports' 	=> array(
					'title',
					'editor',
					'author'
				)
		);
		register_post_type('faq_unicit', $args);
	
	$labels = array(
		'name'              => _x( 'Subject', 'faq-unicit' ),
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
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'genre', array( 'faq_unicit' ), $args );


}

add_action( 'init', 'faq_init' );
add_action( 'plugins_loaded', 'faq_unicit_load_textdomain' );