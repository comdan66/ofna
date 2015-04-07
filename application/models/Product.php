<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Product extends OaModel {

  static $table_name = 'products';

  static $has_one = array (
    array ('pic', 'class_name' => 'ProductPic', 'order' => 'id ASC')
  );

  static $has_many = array (
    array ('product_tag_maps', 'class_name' => 'ProductTagMap'),
    array ('pics', 'class_name' => 'ProductPic'),
    array ('tags', 'class_name' => 'ProductTag', 'through' => 'product_tag_maps'),
    array ('blocks', 'class_name' => 'ProductBlock', 'order' => 'sort ASC'),
    array ('prices', 'class_name' => 'ProductPrice', 'order' => 'id ASC')
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);


  }
}