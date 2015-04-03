<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OaModel extends ActiveRecordModel {
  
  // Enable
  //    $users = User::find ('one', array ('enable_append_conditions' => '1', 'conditions' => array ('id = ? OR id = ?' , 1, 2)));
  //    $users = User::find ('one', array ('conditions' => array ('id = ? OR id = ?' , 1, 2)));
  // Disable
  //    $users = User::find ('one', array ('enable_append_conditions' => '0', 'conditions' => array ('id = ? OR id = ?' , 1, 2)));
  
  static $append_conditions = array ('is_enabled' => '1');

  public function __construct ($attributes = array (), $guard_attributes = TRUE, $instantiating_via_find = FALSE, $new_record = TRUE) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
}