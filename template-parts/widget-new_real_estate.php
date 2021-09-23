<?php
    defined( 'ABSPATH' ) || exit;

    $cities = rmn_get_query( [
        'post_type' => 'city',
        'nopaging'  => true,
    ] )->posts;

    $types = get_terms( 'type_of_real_estate', [
        'hide_empty' => false,
    ] );
    
?>

<!-- Button trigger modal -->
<button id="newRealEstateBtn" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newRealEstate">
    <?= $args['title'] ?>
</button>

<!-- Modal -->
<div class="modal fade" id="newRealEstate" tabindex="-1" aria-labelledby="newRealEstateLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRealEstateLabel"><?= $args['title'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="newRealEstateForm" enctype='multipart/form-data'>
            <input type="hidden" name="action" value="rmn_add_real_estate">
            <div class="form-group">
                <input
                    name="post_title" 
                    type="text" 
                    class="form-control validated-field" 
                    id="titleForm" 
                    placeholder="<?php _e( 'Наименование объекта недвижимости', 'rmn' ) ?>"
                    data-valid="notEmpty">                
            </div>
            <div class="form-group">
                <input
                    name="address" 
                    type="text" 
                    class="form-control validated-field" 
                    id="addressForm" 
                    placeholder="<?php _e( 'Адрес объекта недвижимости', 'rmn' ) ?>"
                    data-valid="notEmpty">                
            </div>
            <div class="form-group">
                <input
                    name="floor" 
                    type="number" 
                    class="form-control validated-field" 
                    id="floorForm" 
                    placeholder="<?php _e( 'Количество этаже', 'rmn' ) ?>"
                    data-valid="notEmpty">                
            </div>
            <div class="form-group">
                <input
                    name="square" 
                    type="number" 
                    class="form-control validated-field" 
                    id="squareForm" 
                    placeholder="<?php _e( 'Площадь объекта недвижимости', 'rmn' ) ?>"
                    data-valid="notEmpty">                
            </div>
            <div class="form-group">
                <input
                    name="living_space" 
                    type="number" 
                    class="form-control validated-field" 
                    id="livingSpaceForm" 
                    placeholder="<?php _e( 'Жилая площадь объекта недвижимости', 'rmn' ) ?>"
                    data-valid="notEmpty">                
            </div>
            <div class="form-group">
                <input
                    name="price" 
                    type="number" 
                    class="form-control validated-field" 
                    id="priceForm" 
                    placeholder="<?php _e( 'Стоимость объекта недвижимости', 'rmn' ) ?>"
                    data-valid="notEmpty">                
            </div>
            <div class="form-group">
                <select 
                    name="city"
                    class="form-control validated-field" 
                    id="cityForm"
                    data-valid="notEmpty">
                    <?php foreach( $cities as $city ) : ?>
                        <option value="<?= $city->ID ?>"><?= $city->post_title ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <select 
                    name="type_of_real_estate"
                    class="form-control validated-field" 
                    id="typeForm"
                    data-valid="notEmpty">
                    <?php foreach( $types as $type ) : ?>
                        <option value="<?= $type->term_id ?>"><?= $type->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <input
                    name="photo"
                    type="file" 
                    class="form-control-file" 
                    id="photoForm"
                    data-valid="notEmpty">
            </div>
            <div class="form-group">
                <textarea
                    name="post_content" 
                    class="form-control validated-field" 
                    id="contentForm" 
                    rows="3"
                    data-valid="notEmpty"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success form-submit">Save changes</button>
      </div>
    </div>
  </div>
</div>
