<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
class Delay_jobs extends Delay_controller {
  public function __construct () {
    parent::__construct ();
  }

  public function create_like_count () {
    if (verifyString ($url = $this->input_post ('url'))) LikeRecord::create ($url);
  }

  public function remove_like_count () {
    if (verifyString ($url = $this->input_post ('url'))) LikeRecord::remove ($url);
  }

  public function sync_facebook_photos () {
    if (verifyString ($url = $this->input_post ('url')) && verifyString ($message = $this->input_post ('message'))) {
      try {
        if ($this->fb->getUser ()) {
          $res = $this->fb->api ('/me/photos', 'POST', array(
            'url' => $url,
            'message' => $message,
          ));
        }
      } catch(FacebookApiException $e) { }
    }
  }

  public function clean_pictures () {
    array_map (function ($filename) { unlink ($filename); }, glob (FCPATH . APPPATH . 'cache/' . preg_replace ('/\/|:|\./i', '_', base_url (array ('pictures', 'get_pictures', '*')))));
  }

  public function delete_picture () {
    if (verifyString ($id = $this->input_post ('id'))) {
      Picture::table ()->update ($sql = array ('is_enabled' => 0), array ('id' => $id));
      $this->delete_output_cache ('pictures', 'id', '1');
      $this->clean_pictures ();
    }
  }

  public function delete_cache_about () {
    $this->delete_output_cache ('main_index', 'about');
  }

  public function delete_cache_by_key () {
    if (verifyString ($key = $this->input_post ('key'))) {
      switch ($key) {
        case 'main_index_about':
          $this->delete_output_cache ('main_index', 'about');
          break;
        case 'google_map_beigang_319':
          $this->delete_output_cache ('google_map', 'beigang_319');
          break;
        case 'google_map_beigang_320':
          $this->delete_output_cache ('google_map', 'beigang_320');
          break;
        case 'main_index_others':
          $this->delete_output_cache ('main_index', 'others');
          break;
        case 'pictures_disable':
          $this->delete_output_cache ('pictures', 'disable');
          break;
        case 'pictures':
          $this->clean_pictures ();
          $this->delete_output_cache ('pictures');
          $this->delete_output_cache ('pictures', 'index');
          break;
      }
    }
  }
}
