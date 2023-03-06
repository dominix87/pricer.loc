<?php
/**
 * Plugin Name: Career Examples
 * Plugin URI: http://goodsite.com.ua/
 * Description: Custom type case examples
 * Version: 1.0
 * Author: Valeriy Baev
 * Author URI: http://goodsite.com.ua/
 * Text Domain: gs-examples
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Ругистрация нового типа данных
add_action('init' , 'init_register_vacancy');

function init_register_vacancy() {
    $data_type = "examples";

    // Регистрация типа данных
    $labels = array(
        'name'               => __( 'Case example', 'gs-examples' ),
        'singular_name'      => __( 'Case example', 'gs-examples' ),
        'add_new'            => __( 'Add case example', 'gs-examples' ),
        'add_new_item'       => __( 'Add case example', 'gs-examples' ),
        'edit_item'          => __( 'Edit case example', 'gs-examples' ),
        'new_item'           => __( 'New case example', 'gs-examples' ),
        'view_item'          => __( 'View case example', 'gs-examples' ),
        'search_items'       => __( 'Search case example', 'gs-examples' ),
        'not_found'          => __( 'Case examples not found', 'gs-examples' ),
        'not_found_in_trash' => __( 'Case examples not found in Trash', 'gs-examples' ),
    );


    register_post_type($data_type, [
        'label'               => __("Case example","gs-examples"),
        'labels'              => $labels,
        'description'         => '',
        'public'              => false,
        'publicly_queryable'  => false,  // Доступна запись во ФронтЕнде
        'exclude_from_search' => true, // исключить из поиска
        'show_ui'             => true,
        'show_in_menu'        => true,
        'capability_type'     => 'post',
        'menu_position'       => 18,    // 20-24 под страницы
        'has_archive'         => false, // Наличие архива во ФронтЕнде
        'menu_icon'           => 'dashicons-format-aside',
        'hierarchical'        => false, // true - древовидная структура
        'supports'            => ['title','editor','thumbnail','revisions','page-attributes'],
        'can_export'          => true,
        'show_in_rest'        => false, // Block editor
        'delete_with_user'    => false,
//        'rewrite'             => array('slug' => 'docs/%docs%')
    ] );


    // Регистрация категории
//    $category_taxonomy_labels = array(
//        'name'          => __( 'Category of Documents', 'gs-team' ),
//        'label'         => __( 'Categories', 'gs-team' ),
//        'singular_name' => __( 'Category', 'gs-team' ),
//        'menu_name'     => __( 'Categories', 'gs-team' ),
//    );
//    $category_taxonomy_args = array(
//        'labels'		=> $category_taxonomy_labels,
//        'hierarchical'	=> true,
//        'rewrite'		=> true,
//        'query_var'		=> true,
//        'public'        => true,
//        'show_ui'       => true,
//        'show_admin_column' => true,
//        'show_in_rest'      => true,
//
//    );

    // Регистрация категории
//    $category_taxonomy_labels = array(
//        'name'          => __( 'Illnesses Categories', 'gs-illness' ),
//        'label'         => __( 'Categories', 'gs-illness' ),
//        'singular_name' => __( 'Category', 'gs-illness' ),
//        'menu_name'     => __( 'Categories', 'gs-illness' ),
//    );
//    $category_taxonomy_args = array(
//        'labels'		=> $category_taxonomy_labels,
//        'hierarchical'	=> true,
//        'rewrite'		=> true,
//        'query_var'		=> true
//    );
//    register_taxonomy( 'docs', $data_type, $category_taxonomy_args );
/**/

    // Регистрация тегов Таксономии
//    $tag_taxonomy_labels = array(
//        'name'          => __( 'Illnesses Tags', 'cherry-projects' ),
//        'label'         => __( 'Tags', 'cherry-projects' ),
//        'singular_name' => __( 'Tag', 'cherry-projects' ),
//        'menu_name'     => __( 'Tags', 'cherry-projects' ),
//    );
//    $tag_taxonomy_args = array(
//        'labels'		=> $tag_taxonomy_labels,
//        'hierarchical'	=> false,
//        'rewrite'		=> true,
//        'query_var'		=> true
//    );
//    register_taxonomy( $data_type . '_tag', $data_type, $tag_taxonomy_args );

}

/*
function gs_docs_post_link( $post_link, $id = 0 ){

    $post = get_post($id);

    if ( is_object( $post ) ){

        $terms = wp_get_object_terms( $post->ID, 'docs' );
//        var_dump($terms);

        if( $terms ){
            return str_replace( '%docs%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}

add_filter( 'post_type_link', 'gs_docs_post_link', 1, 3 );
*/


?>