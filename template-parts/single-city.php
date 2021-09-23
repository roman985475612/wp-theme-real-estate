<?php
    defined( 'ABSPATH' ) || exit;

    $query = rmn_get_query( [
        'post_type' => 'real_estate',
        'posts_per_page' => 10,
        'meta_key'  => 'city',
        'meta_value'=> $post->ID,
    ] );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

        <div class="row">
            <div class="col-md-6">

                <?= get_the_post_thumbnail( $post->ID, 'large', ['class' => 'img-fluid'] ); ?>

            </div>
            <div class="col-md-6">

                <?php
                    the_title( '<h1 class="entry-title">', '</h1>' );
                    the_content();
                ?>

            </div>
        </div>

	</header><!-- .entry-header -->
    
	<div class="entry-content mt-3">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Title</th>
                    <th scope="col">Address</th>
                    <th scope="col">Square</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $query->posts as $real ) : ?>
                    <tr>
                        <th scope="row"><?= $real->ID ?></th>
                        <td><?= get_the_post_thumbnail( $real->ID, 'thumbnail', ['alt' => $real->post_title, 'class' => 'img-thumbnail'] ) ?></td>
                        <td><?= $real->post_title ?></td>
                        <td><?= the_field( 'address', $real->ID ) ?></td>
                        <td><?= the_field( 'square', $real->ID ) ?></td>
                        <td><?= the_field( 'price', $real->ID ) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

