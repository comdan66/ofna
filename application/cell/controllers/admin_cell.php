<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Admin_cell extends Cell_Controller {

  /* render_cell ('admin_cell', 'main_header', array ()); */
  // public function _cache_main_header () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function main_header () {
    return $this->load_view ();
  }

  /* render_cell ('admin_cell', 'sub_header', array ()); */
  // public function _cache_sub_header () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function sub_header () {
    return $this->load_view ();
  }

  /* render_cell ('admin_cell', 'footer', array ()); */
  // public function _cache_footer () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function footer () {
    return $this->load_view ();
  }

  /* render_cell ('admin_cell', 'side_menu', array ()); */
  // public function _cache_side_menu () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function side_menu () {
    return $this->load_view ();
  }
}