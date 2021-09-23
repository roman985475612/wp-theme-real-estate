<?php

add_action( 'wp_ajax_nopriv_rmn_add_real_estate', 'rmn_add_real_estate_handler' );
add_action( 'wp_ajax_rmn_add_real_estate', 'rmn_add_real_estate_handler' );

function rmn_add_real_estate_handler() {
    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $response = [
        'is_valid' => true,
        'errors'   => [],
        'msg'      => null,
    ];

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // $file = wp_handle_upload( $_FILES['photo'], [ 'test_form' => false ] );

    if( ! wp_verify_nonce( $post['nonce'], 'rmn_nonce' ) ) {
        $response['is_valid'] = false;
        $response['errors']['nonce'] = __( 'Ошибка запроса!', 'rmn' );
    }

    if( empty( $post['post_title'] ) ) {
        $response['is_valid'] = false;
        $response['errors']['post_title'] = __( 'Пожалуйста, заполните "post_title"!', 'rmn' );
    }

    if( empty( $post['square'] ) ) {
        $response['is_valid'] = false;
        $response['errors']['square'] = __( 'Пожалуйста, заполните "square"!', 'rmn' );
    }

    if( empty( $post['address'] ) ) {
        $response['is_valid'] = false;
        $response['errors']['address'] = __( 'Пожалуйста, заполните "address"!', 'rmn' );
    }

    if( empty( $post['price'] ) ) {
        $response['is_valid'] = false;
        $response['errors']['price'] = __( 'Пожалуйста, заполните "price"!', 'rmn' );
    }
    
    // if ( ! isset( $file ) || ! empty( $file['error'] ) ) {
    //     $response['is_valid'] = false;
    //     $response['errors']['photo'] = __( 'Ошибка загрузки файла!', 'rmn' );
	// }

    if( ! $response['is_valid'] ) {
        echo json_encode($response);
        wp_die();
    }

    $post_id = wp_insert_post( [
        'post_title'    => $post['post_title'],
        'post_content'  => $post['post_content'],
        'post_type'     => 'real_estate',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'meta_input'    => [
            'address'      => $post['address'],
            'price'        => $post['price'],
            'floor'        => $post['floor'],
            'square'       => $post['square'],
            'living_space' => $post['living_space'],
        ],
        'tax_input'     => [ 
            'type_of_real_estate' => [ $post['type_of_real_estate'] ] 
        ],
    ] );

    $response['msg'] = 'Создан элемент # ' . $post_id . '!';

    update_field( 'city', $post['city'], $post_id );

    $attachment_id = media_handle_upload( 'photo', $post_id );
    
    if ( is_wp_error( $attachment_id ) ) {
        $response['is_valid'] = false;
		$response['errors']['photo'] = "Ошибка загрузки медиафайла";
	}

    if ( ! set_post_thumbnail( $post_id, $attachment_id ) ) {
        $response['is_valid'] = false;
		$response['errors']['photo'] = "Миниатюра не установлена";
    }
    
    echo json_encode($response);
    
    wp_die();
}