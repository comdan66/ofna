<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends OaModel {

  static $table_name = 'abouts';

  static $has_many = array (
    array ('pictures', 'class_name' => 'AboutPicture', 'order' => 'sort DESC, id DESC')
  );
  
  public function __construct ($attributes = array (), $guard_attributes = TRUE, $instantiating_via_find = FALSE, $new_record = TRUE) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  
  public function delete () {
    array_map (function ($picture) { $picture->delete (); }, $this->pictures);
    $this->is_enabled = 0;
    $this->save ();
  }
}