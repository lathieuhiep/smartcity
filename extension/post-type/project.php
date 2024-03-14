<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'smartcity_create_project', 10);

function smartcity_create_project() {

    /* Start post type template */
    $labels = array(   
        'name'                  =>  _x( 'Dự án', 'post type general name', 'smartcity' ),
        'singular_name'         =>  _x( 'Dự án', 'post type singular name', 'smartcity' ),
        'menu_name'             =>  _x( 'Dự án', 'admin menu', 'smartcity' ),
        'name_admin_bar'        =>  _x( 'Danh sách Dự án', 'add new on admin bar', 'smartcity' ),
        'add_new'               =>  _x( 'Thêm mới', 'Dự án', 'smartcity' ),
        'add_new_item'          =>  esc_html__( 'Thêm Dự án', 'smartcity' ),
        'edit_item'             =>  esc_html__( 'Sửa Dự án', 'smartcity' ),
        'new_item'              =>  esc_html__( 'Dự án mới', 'smartcity' ),
        'view_item'             =>  esc_html__( 'Xem dự án', 'smartcity' ),
        'all_items'             =>  esc_html__( 'Tất cả dự án', 'smartcity' ),
        'search_items'          =>  esc_html__( 'Tìm kiếm dự án', 'smartcity' ),
        'not_found'             =>  esc_html__( 'Không tìm thấy', 'smartcity' ),
        'not_found_in_trash'    =>  esc_html__( 'Không tìm thấy trong thùng rác', 'smartcity' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-open-folder',
        'capability_type'    => 'post',
        'rewrite'            => array('slug' => 'du-an' ),
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type('smartcity_project', $args );
    /* End post type template */

    /* Start taxonomy */
    $taxonomy_labels = array(
        'name'              => _x( 'Danh mục dự án', 'taxonomy general name', 'smartcity' ),
        'singular_name'     => _x( 'Danh mục dự án', 'taxonomy singular name', 'smartcity' ),
        'search_items'      => __( 'Tìm kiếm danh mục', 'smartcity' ),
        'all_items'         => __( 'Tất cả danh mục', 'smartcity' ),
        'parent_item'       => __( 'Danh mục cha', 'smartcity' ),
        'parent_item_colon' => __( 'Danh mục cha:', 'smartcity' ),
        'edit_item'         => __( 'Sửa', 'smartcity' ),
        'update_item'       => __( 'Cập nhật', 'smartcity' ),
        'add_new_item'      => __( 'Thêm mới', 'smartcity' ),
        'new_item_name'     => __( 'Tên mới', 'smartcity' ),
        'menu_name'         => __( 'Danh mục', 'smartcity' ),
    );

    $taxonomy_args = array(

        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'danh-muc-du-an' ),
    );

    register_taxonomy( 'smartcity_project_cat', array( 'smartcity_project' ), $taxonomy_args );
    /* End taxonomy */

}