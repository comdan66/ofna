<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class ProductTag extends OaModel {

  static $table_name = 'product_tags';

  static $has_one = array (
  );

  static $has_many = array (
    array ('product_tag_maps', 'class_name' => 'ProductTagMap'),

    array ('products', 'class_name' => 'Product', 'through' => 'product_tag_maps')
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);


  }
}