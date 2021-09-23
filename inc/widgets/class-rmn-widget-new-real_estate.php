<?php

class RMN_New_Real_Estate_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'RMN_New_Real_Estate_Widget',
            __( 'Добавить новый объект недвижимости', 'rmn' ),
            [
                'description' => __( 'Добавление новых объектов недвижимости', 'rmn' ),
                'classname'   => 'widget-new-real-estate',
            ]
        );
    }

    public function widget( $args, $instance )
    {
        extract( $instance );

        $title = $title ?? '';

        echo $args['before_widget'];

        get_template_part( 'template-parts/widget', 'new_real_estate', compact( 'title' ) );        
        
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
}