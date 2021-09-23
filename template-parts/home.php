<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<h1 class="h2 mb-3"><?php esc_html_e( 'Список объектов недвижимости', 'rmn' ) ?></h1>

<?php
    $query = rmn_get_query( ['post_type' => 'real_estate'] );
?>
<?php if( $query->have_posts() ) : ?>
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <?php the_post_thumbnail( $post->ID, ['alt' => $post->post_title] ) ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title h5"><?php the_title() ?></h2>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th>Город</th>
                            <td><?= get_field_object( 'city' )['value']->post_title ?></td>
                        </tr>
                        <tr>
                            <th>Адрес</th>
                            <td><?php the_field( 'address' ) ?></td>
                        </tr>
                        <tr>
                            <th>Стоимость</th>
                            <td><?php the_field( 'price' ) ?></td>
                        </tr>
                        <tr>
                            <th>Площадь</th>
                            <td><?php the_field( 'square' ) ?></td>
                        </tr>
                    </table>
                    <a 
                        href="<?php the_permalink() ?>" 
                        class="btn btn-primary">
                        <?php esc_html_e( 'Смотреть далее', 'rmn' ) ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile ?>
    <?php wp_reset_postdata() ?>

    <?php 
        understrap_pagination( [
            'current' => max( 1, get_query_var( 'page' ) ),
            'total'   => $query->max_num_pages,
        ] ); 
    ?>
<?php endif ?>