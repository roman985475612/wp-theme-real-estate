<?php

function rmn_create_taxonomy() {
    register_taxonomy( 'type_of_real_estate', [ 'real_estate' ], [
		'label'                 => '',
		'labels'                => [
			'name'              => __( 'Типы объектов недвижимости', 'rmn' ),
			'singular_name'     => __( 'Тип объекта недивижимости', 'rmn' ),
			'search_items'      => __( 'Поиск типов объектов недвижимости', 'rmn' ),
			'all_items'         => __( 'Все типы объектов недвижимости', 'rmn' ),
			'view_item '        => __( 'Просмотреть тип объектов недвижимости', 'rmn' ),
			'parent_item'       => __( 'Parent Genre', 'rmn' ),
			'parent_item_colon' => __( 'Parent Genre:', 'rmn' ),
			'edit_item'         => __( 'Редактировать тип объекта недивижимости', 'rmn' ),
			'update_item'       => __( 'Обновить тип объекта недивижимости', 'rmn' ),
			'add_new_item'      => __( 'Добавить тип объекта недивижимости', 'rmn' ),
			'new_item_name'     => __( 'Новый тип объекта недивижимости', 'rmn' ),
			'menu_name'         => __( 'Типы объектов недвижимости', 'rmn' ),
		],
		'description'           => '',
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => [],
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => null,
		'rest_base'             => null,
	] );
    
    register_taxonomy( 'regions', [ 'city' ], [
		'label'                 => '',
		'labels'                => [
			'name'              => __( 'Регионы', 'rmn' ),
			'singular_name'     => __( 'Регион', 'rmn' ),
			'search_items'      => __( 'Поиск регионов', 'rmn' ),
			'all_items'         => __( 'Все регионы', 'rmn' ),
			'view_item '        => __( 'Просмотреть регион', 'rmn' ),
			'parent_item'       => __( 'Parent Genre', 'rmn' ),
			'parent_item_colon' => __( 'Parent Genre:', 'rmn' ),
			'edit_item'         => __( 'Редактировать регион', 'rmn' ),
			'update_item'       => __( 'Обновить регион', 'rmn' ),
			'add_new_item'      => __( 'Добавить регион', 'rmn' ),
			'new_item_name'     => __( 'Новый регион', 'rmn' ),
			'menu_name'         => __( 'Регионы', 'rmn' ),
		],
		'description'           => '',
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => [],
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'show_in_rest'          => null,
		'rest_base'             => null,
	] );
}