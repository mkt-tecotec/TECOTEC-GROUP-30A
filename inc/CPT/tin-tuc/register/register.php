<?php
/**
 * Register Custom Post Type: Tin Tức (News)
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function tecotec_register_cpt_tin_tuc() {
    // Labels for CPT
    $labels = array(
        'name'               => _x('Tin tức', 'post type general name', 'tecotec-group'),
        'singular_name'      => _x('Tin tức', 'post type singular name', 'tecotec-group'),
        'menu_name'          => _x('Tin tức', 'admin menu', 'tecotec-group'),
        'name_admin_bar'     => _x('Tin tức', 'add new on admin bar', 'tecotec-group'),
        'add_new'            => _x('Thêm mới', 'tin tức', 'tecotec-group'),
        'add_new_item'       => __('Thêm tin tức mới', 'tecotec-group'),
        'new_item'           => __('Tin tức mới', 'tecotec-group'),
        'edit_item'          => __('Sửa tin tức', 'tecotec-group'),
        'view_item'          => __('Xem tin tức', 'tecotec-group'),
        'all_items'          => __('Tất cả tin tức', 'tecotec-group'),
        'search_items'       => __('Tìm kiếm tin tức', 'tecotec-group'),
        'parent_item_colon'  => __('Parent Tin Tức:', 'tecotec-group'),
        'not_found'          => __('Không tìm thấy tin tức.', 'tecotec-group'),
        'not_found_in_trash' => __('Không tìm thấy tin tức trong thùng rác.', 'tecotec-group'),
    );

    // Args for CPT
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'tin-tuc'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-media-document',
        'supports'           => array('title', 'thumbnail'),
        'show_in_rest'       => true,
    );
    register_post_type('tin_tuc', $args);

    // Labels for Taxonomy
    $tax_labels = array(
        'name'              => _x('Danh mục', 'taxonomy general name', 'tecotec-group'),
        'singular_name'     => _x('Danh mục', 'taxonomy singular name', 'tecotec-group'),
        'search_items'      => __('Tìm kiếm danh mục', 'tecotec-group'),
        'all_items'         => __('Tất cả danh mục', 'tecotec-group'),
        'parent_item'       => __('Danh mục cha', 'tecotec-group'),
        'parent_item_colon' => __('Danh mục cha:', 'tecotec-group'),
        'edit_item'         => __('Sửa danh mục', 'tecotec-group'),
        'update_item'       => __('Cập nhật danh mục', 'tecotec-group'),
        'add_new_item'      => __('Thêm danh mục mới', 'tecotec-group'),
        'new_item_name'     => __('Tên danh mục mới', 'tecotec-group'),
        'menu_name'         => __('Danh mục', 'tecotec-group'),
    );

    // Args for Taxonomy
    register_taxonomy('danh_muc_tin_tuc', array('tin_tuc'), array(
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'danh-muc-tin-tuc'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'tecotec_register_cpt_tin_tuc');
