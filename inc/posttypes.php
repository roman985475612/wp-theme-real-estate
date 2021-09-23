<?php

function rmn_create_post_types() {
    register_post_type( 'real_estate', [
        'labels' => [
            'name'               => __( 'Недвижимость', 'rmn' ),
            'singular_name'      => __( 'Недвижимость', 'rmn' ),
            'add_new'            => __( 'Добавить новый объект недвижимости', 'rmn' ),
            'add_new_item'       => __( 'Добавить новый объект недвижимости', 'rmn' ),
            'edit_item'          => __( 'Редактировать объект недвижимости', 'rmn' ),
            'new_item'           => __( 'Новый объект недвижимости', 'rmn' ),
            'view_item'          => __( 'Посмотреть объект недвижимости', 'rmn' ),
            'search_items'       => __( 'Найти объект недвижимости', 'rmn' ),
            'not_found'          => __( 'Объект недвижимости не найден', 'rmn' ),
            'not_found_in_trash' => __( 'В корзине объект недвижимости не найден', 'rmn' ),
            'parent_item_colon'  => __( '', 'rmn' ),
            'menu_name'          => __( 'Недвижимость', 'rmn' ),
        ],
        'public'       => true,
        'show_ui'  	   => true,
        'menu_icon'    => 'dashicons-admin-multisite',
        'show_in_menu' => true,
        'supports'     => ['title', 'editor', 'thumbnail'],
    ] );
    
    register_post_type( 'city', [
        'labels' => [
            'name'               => __( 'Города', 'rmn' ),
            'singular_name'      => __( 'Города', 'rmn' ),
            'add_new'            => __( 'Добавить новый город', 'rmn' ),
            'add_new_item'       => __( 'Добавить новый город', 'rmn' ),
            'edit_item'          => __( 'Редактировать город', 'rmn' ),
            'new_item'           => __( 'Новый город', 'rmn' ),
            'view_item'          => __( 'Посмотреть город', 'rmn' ),
            'search_items'       => __( 'Найти город', 'rmn' ),
            'not_found'          => __( 'Город не найден', 'rmn' ),
            'not_found_in_trash' => __( 'В корзине город не найден', 'rmn' ),
            'parent_item_colon'  => __( '', 'rmn' ),
            'menu_name'          => __( 'Города', 'rmn' ),
        ],
        'public'       => true,
        'show_ui'  	   => true,
        'menu_icon'    => 'dashicons-location',
        'show_in_menu' => true,
        'supports'     => ['title', 'editor', 'thumbnail'],
    ] );
}