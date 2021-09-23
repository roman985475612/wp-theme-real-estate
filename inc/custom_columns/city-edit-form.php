<?php

add_action( 'manage_city_posts_columns', 'rmn_manage_city_posts_columns' );
add_action( 'manage_city_posts_custom_column', 'rmn_manage_city_posts_custom_column', 10, 2 );
add_action( 'admin_head', 'rmn_add_views_city_column_css');

function rmn_manage_city_posts_columns( $columns ) {
    $screenshot = ['screenshot' => __( 'Скриншот', 'rmn' )];
    $cityText = ['city_text' => __( 'Описание', 'rmn' )];
    
    return array_slice( $columns, 0, 1 ) + $screenshot 
        + array_slice( $columns, 0, 2 ) + $cityText
        + $columns;    
}

function rmn_manage_city_posts_custom_column( $column_name, $post_id ) {
    ?>
        <?php if ( $column_name == 'screenshot' && has_post_thumbnail() ) : ?>
            <a href="<?= get_edit_post_link() ?>">
                <?php the_post_thumbnail( 'thumbnail' ) ?>
            </a>
        <?php elseif ( $column_name == 'city_text' ) : ?>
            <p>
                <?= get_the_excerpt( $post_id ) ?>
            </p>
        <?php endif ?>
    <?php
    return $column_name;
}

function rmn_add_views_city_column_css() {
    $WP_Screen = get_current_screen();
	if( $WP_Screen->base == 'edit' && $WP_Screen->post_type == 'city') {
        ?>
            <style type="text/css">
                #screenshot { width: 12% }
                #title { width: 15% }
            </style>
        <?php
    }
}