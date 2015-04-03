<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LikeRecord extends OaModel {

  static $table_name = 'like_records';

  public function __construct ($attributes = array (), $guard_attributes = TRUE, $instantiating_via_find = FALSE, $new_record = TRUE) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  
  public static function remove ($url) {
    if (verifyObject ($object = self::find ('one', array ('conditions' => array ('url = ?', $url))))) {
      $object->click_count = $object->click_count - 1;
      return $object->save ();
    } else {
      return verifyCreateObject ($object = parent::create (array ('url' => $url, 'click_count' => 0, 'is_enabled' => 1)));
    }
  }

  public static function create ($url) {
    if (verifyObject ($object = self::find ('one', array ('conditions' => array ('url = ?', $url))))) {
      $object->click_count = $object->click_count + 1;
      return $object->save ();
    } else {
      return verifyCreateObject ($object = parent::create (array ('url' => $url, 'click_count' => 1, 'is_enabled' => 1)));
    }
  }
}