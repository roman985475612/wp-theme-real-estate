<?php

function rmn_get_query(array $args = []) : WP_Query {
    $default = [
        'post_type' => 'post',
        'orderby'   => 'date',
        'order'     => 'DESC',
        'paged'     => get_query_var( 'page' ),
    ];
    return new WP_Query( array_merge( $default, $args ) );
}

function dd(mixed $data, bool $die = false): void
{
    $styles = <<<STYLE
    display: block;
    padding: 2rem 1rem;
    border-radius: 8px;
    background: #eae8d3;
    font-family:'JetBrains Mono';
    color: #003f5c;
    STYLE;

    echo '<pre style="' . $styles . '">'. print_r($data, true) . '</pre>';
    
    if ($die) { die; }
}
