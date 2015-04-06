<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Banners extends Admin_controller {

  public function __construct () {
    parent::__construct ();
    identity ()->user () || redirect (array ('admin'));
  }

  public function index () {
    if ($this->is_ajax ()) {
      $id = $this->input_post ('id');

      $banner = Banner::find ('one', array ('conditions' => array ('id = ?', $id)));
      $banner->name->cleanAllFiles ();
      $banner->delete ();
      return $this->output_json (array ('status' => true));
    } else {
      if ($this->has_post () && ($file = $this->input_post ('file', true, true)) && verifyCreateOrm ($banner = Banner::create (array ('name' => ''))) && $banner->name->put ($file)) {
        identity ()->set_session ('_flash_message', '新增成功!', true);
        redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');
      }
      $banners = Banner::find ('all', array ('order' => 'id DESC'));
      $this->load_view (array ('banners' => $banners));
    }
  }
}
