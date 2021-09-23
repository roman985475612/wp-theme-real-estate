<?php

class RMN_Cities_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'RMN_Cities_Widget',
            __( 'Список городов', 'rmn' ),
            [
                'description' => __( 'Вывод списка городов', 'rmn' ),
                'classname'   => 'widget-cities',
            ]
        );
    }

    public function widget( $args, $instance )
    {
        extract( $instance );

        $title = $title ?? '';

        echo $args['before_widget'];
        echo $args['before_title'] . $title . $args['after_title'];

        get_template_part( 'template-parts/widget', 'cities', [ 'cities' => $this->getResult() ] );        
        
        echo $args['after_widget'];
    }

    public function form( $instance )
    {
        extract( $instance );
        $title =  $title ?? '';
        ?>
            <p>
                <label for="<?= $this->get_field_id( 'title' ) ?>"><?php _e( 'Заголовок', 'rmn' ) ?>:</label>
                <input 
                    type="text" 
                    name="<?= $this->get_field_name( 'title' ) ?>" 
                    id="<?= $this->get_field_id( 'title' ) ?>" 
                    class="widefat title" 
                    value="<?= esc_attr( $title ) ?>"
                >
            </p>
        <?php
    }

    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
        return $instance;
    }

    private function getResult(): array
    {
        $result = [];

        $cityQuery = rmn_get_query( [
            'post_type' => 'city',
            'nopaging'  => true,
        ] );

        $cities = $cityQuery->posts;

        if ( count( $cities ) > 0 ) {
            foreach ( $cities as $city ) {
                $subQuery = rmn_get_query( [
                    'post_type'      => 'real_estate',
                    'posts_per_page' => -1,
                    'meta_key'       => 'city',
                    'meta_value'     => $city->ID,
                ] );

                $result[] = [
                    'title' => get_the_title( $city->ID ),
                    'url'   => get_permalink( $city ),
                    'count' => count( $subQuery->posts ),
                ];
            }
        }

        uasort( $result, fn($a, $b) => [$b['count'], $a['count']] <=> [$a['count'], $b['count']] );

        return $result;
    }
}