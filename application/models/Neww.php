<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Neww extends OaModel {

  static $table_name = 'news';

  static $has_one = array (
    array ('pic', 'class_name' => 'NewPic', 'order' => 'sort id', 'foreign_key' => 'new_id')
  );

  static $has_many = array (
    array ('blocks', 'class_name' => 'NewBlock', 'order' => 'sort ASC', 'foreign_key' => 'new_id'),
    array ('pics', 'class_name' => 'NewPic', 'foreign_key' => 'new_id')
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);


  }
}