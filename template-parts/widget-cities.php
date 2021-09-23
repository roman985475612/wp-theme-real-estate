<?php
    defined( 'ABSPATH' ) || exit;
?>

<ul class="list-group my-3">

    <?php foreach ( $args['cities'] as $item ) : ?>

        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            
            <a href="<?= $item['url'] ?>" class="btn btn-link"><?= $item['title'] ?></a>
            
            <span class="badge badge-primary badge-pill"><?= $item['count'] ?></span>
        
        </li>   

    <?php endforeach ?>

</ul>
