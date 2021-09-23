<?php

add_action( 'manage_real_estate_posts_columns', 'rmn_manage_real_estate_posts_columns' );
add_action( 'manage_real_estate_posts_custom_column', 'rmn_manage_real_estate_posts_custom_column', 10, 2 );
add_action( 'admin_head', 'rmn_add_views_real_estate_column_css');
add_filter( 'manage_edit-real_estate_sortable_columns', 'rmn_manage_edit_real_estate_sortable_columns' );
add_action( 'pre_get_posts', 'rmn_real_estate_orderby_column' );

function rmn_manage_real_estate_posts_columns( $columns ) {
    $screenshot = ['screenshot' => __( 'Скриншот', 'rmn' )];
    $newColumns = [
        'address' => __( 'Адрес', 'rmn' ),
        'price' => __( 'Стоимость', 'rmn' ),
        'city' => __( 'Город', 'rmn' ),
    ];
    
    return array_slice( $columns, 0, 1 ) + $screenshot 
        + array_slice( $columns, 0, 2 ) + $newColumns
        + $columns;    
}

function rmn_manage_real_estate_posts_custom_column( $column_name, $post_id ) {
    ?>
        <?php if ( $column_name == 'screenshot' && has_post_thumbnail() ) : ?>
            <a href="<?= get_edit_post_link() ?>">
                <?php the_post_thumbnail( 'thumbnail' ) ?>
            </a>
        <?php elseif ( $column_name == 'address' ) : ?>
            <p>
                <?php the_field( 'address', $post_id ) ?>
            </p>
        <?php elseif ( $column_name == 'price' ) : ?>
            <p>
                <?php the_field( 'price', $post_id ) ?>
            </p>
        <?php elseif ( $column_name == 'city' ) : ?>
            <p>
                <?= get_field_object( 'city', $post_id )['value']->post_title ?>
            </p>
        <?php endif ?>
    <?php
    return $column_name;
}

function rmn_add_views_real_estate_column_css() {
    $WP_Screen = get_current_screen();
	if( $WP_Screen->base == 'edit' && $WP_Screen->post_type == 'real_estate') {
        ?>
            <style type="text/css">
                #screenshot { width: 12% }
                #title { width: 15% }
            </style>
        <?php
    }
}

function rmn_manage_edit_real_estate_sortable_columns( $columns ) {
    $columns['price'] = 'price';
    return $columns;
}

function rmn_real_estate_orderby_column( $query ) {
    if( ! is_admin() ) {
        return;
    }
 
    $orderby = $query->get( 'orderby' );
 
    if( 'price' == $orderby ) {
        $query->set('meta_key', 'price');
        $query->set('orderby', 'meta_value_num');
    }
}
