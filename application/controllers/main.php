<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Main extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index () {
    $cell_class = identity ()->get_session ('is_en') ? 'main_en_cell' : 'main_tw_cell';
    $this->load_view (array ('cell_class' => $cell_class));
  }

  public function set_lang ($id = 0) {
    identity ()->set_session ('is_en', $id ? true : false);
    redirect ('');
  }
}
