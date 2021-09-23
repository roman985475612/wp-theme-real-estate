<?php
    defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
    
    <div class="entry-meta">

        <?php understrap_posted_on(); ?>

    </div><!-- .entry-meta -->

	<div class="entry-content mt-3">

		<?php
		    the_content();
		?>

        <table class="table table-borderless">
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
            <?php if ( ! empty( get_field( 'living_space' ) ) ) : ?>
                <tr>
                    <th>Жилая площадь</th>
                    <td><?php the_field( 'living_space' ) ?></td>
                </tr>
            <?php endif ?>
            <?php if ( ! empty( get_field( 'floor' ) ) ) : ?>
                <tr>
                    <th>Этаж</th>
                    <td><?php the_field( 'floor' ) ?></td>
                </tr>
            <?php endif ?>
        </table>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
